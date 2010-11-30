<?php
/**
 * Java bridged PDF watermarker. See http://php-java-bridge.sourceforge.net/pjb/FAQ.html
 */
$bridge_endpoint = sfConfig::get('app_java_php_bridge_connection_endpoint', '127.0.0.1:8181');
define ("JAVA_HOSTS", $bridge_endpoint);

require_once ("java/Java.inc");
java_autoload("iText-2.1.5.jar;PDFRenderer.jar;watermarker.jar");

class JavaBridgedWatermarker implements IWatermarker {

  public function create($watermarker_parameter)
  {
    $source_filename = $watermarker_parameter->getSourceFilename();
    $output_filename = $watermarker_parameter->getOutputFilename();
    $print_config = $watermarker_parameter->getPrintConfig();
    $groups = $watermarker_parameter->getGroups();

    $watermarker = new Java("watermark.Watermarker");
    $cfg = $this->javaifyConfig($print_config);
    $params = $this->javaifyParams($print_config, $groups);
    $stat = $watermarker->create($source_filename, $output_filename, $cfg, $params, $limit = 99999);
    return $this->phpifyStat($stat);
  }

  public function preview($watermarker_parameter)
  {
    $source_filename = $watermarker_parameter->getSourceFilename();
    $output_filename = $watermarker_parameter->getOutputFilename();
    $print_config = $watermarker_parameter->getPrintConfig();
    $groups = $watermarker_parameter->getGroups();

    $watermarker = new Java("watermark.Watermarker");
    $cfg = $this->javaifyConfig($print_config);
    $params = $this->javaifyParams($print_config, $groups);

    // RD-128: workaround for PDFRender's inability to display watermark image opacity properly
    $tmpBasename =  md5(time().$source_filename).'.pdf';
    $tmpDirname = '/tmp/scryptic';
    if (!file_exists($tmpDirname))
    {
      mkdir($tmpDirname);
      chmod($tmpDirname, 0777);
    }
    $tmpFilename = $tmpDirname.DIRECTORY_SEPARATOR.$tmpBasename;
    $watermarker->create($source_filename, $tmpFilename, $cfg, $params, 1);
    $cmd = 'convert '.$tmpFilename.' '.$output_filename;
    $output2 = array();
    $ret_val = '';
    $output = exec($cmd, $output2, $ret_val);

    if ($ret_val != 0)
    {
      error_log('Possible error with pdf->png conversion. Ret val='.$ret_val.'. Output of convert: '.var_export($output, true));
    }
    $ret_val = unlink($tmpFilename);
  }

  private function phpifyStat($stat) {
    $wm_stat = new WatermarkStatistics();
    $wm_stat->setNumPages($stat->getNumPageWatermarked()->__cast('i'));
    $wm_stat->setExecutionTime($stat->getExecutionTime()->__cast('i'));
    $wm_stat->setFinalFileSize($stat->getFinalFileSize()->__cast('i'));
    $wm_stat->setNumDocuments($stat->getNumDocuments()->__cast('i'));
    $wm_stat->setOutputContentType('application/pdf');
    return $wm_stat;
  }

  private function javaifyConfig($print_config) {

    $cfg = new Java("watermark.Configuration");
    $cfg->setFont($print_config->getFont()->getName());
    $cfg->setFontFilename(sfConfig::get('sf_root_dir').DIRECTORY_SEPARATOR.'fonts'.DIRECTORY_SEPARATOR.$print_config->getFont()->getFileName());
    $cfg->setOpacity($print_config->getOpacity()/100);
    $cfg->setFontSize($print_config->getSize());
    $rgb = $print_config->getColourRGB();
    $color = new Java("java.awt.Color", $rgb['r'], $rgb['g'], $rgb['b']);
    $cfg->setFontColour($color);
    return $cfg;
  }

  private function javaifyParams($print_config, $groups) {

    $layout_id = $print_config->getLayoutId();
    $watermark_image_id = $print_config->getWatermarkImageId();
    $params = new Java("java.util.ArrayList");
    foreach ($groups as $group) {
      $group_items = $group->getTranscientWMGroupItems();
      $hotspot_1_value = $group->getName();

      // RD-61: deal with the case where there are no group items
      if (count($group_items) == 0) {
        $placeholder = new WMGroupItem();
        $placeholder->setValue('');
        $group_items[] = $placeholder;
      }

      foreach ($group_items as $group_item) {
        $param = new Java("watermark.Parameter");
        $alt_value = $group_item->getAltValue();
        if (!empty($alt_value))
        {
          $hotspot_1_value = $group_item->getValue();
          $hotspot_2_value = $alt_value;
        }
        else
        {
          $hotspot_1_value = $group->getName();
          $hotspot_2_value = $group_item->getValue();
        }

        if ($layout_id == Layout::TOP_BOTTOM) {
          $param->setTopText($hotspot_1_value);
          $param->setBottomText($hotspot_2_value);
        } else if ($layout_id == Layout::LEFT_RIGHT) {
          $param->setLeftText($hotspot_1_value);
          $param->setRightText($hotspot_2_value);
        } else if ($layout_id == Layout::DIAGONAL || $layout_id == Layout::DIAGONAL_135) {
          $param->setDiagonalText($hotspot_2_value);
          $param->setDiagonalTextRotation($layout_id == Layout::DIAGONAL ? -45.0 : 45.0);
        } else if (empty($layout_id) && !empty($watermark_image_id)) {
          $upload_dir = FileManager::getUploadDirectoryByAccount($print_config->getAccountId());
          $param->setCenterImageName($upload_dir.DIRECTORY_SEPARATOR.$print_config->getWatermarkImage()->getImageName());
          $param->setCenterImageWidth($print_config->getWatermarkImage()->getWidth());
          $param->setCenterImageHeight($print_config->getWatermarkImage()->getHeight());
        } else {
          throw new Exception('Unsupported layout: layout_id='.$layout_id);
        }
        $params->add($param);
      }
    }
    return $params;
  }
}
?>
