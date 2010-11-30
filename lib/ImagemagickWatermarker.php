<?php
class ImagemagickWatermarker implements IWatermarker
{
  const MARGIN_X = 30; // left and right margins in pixels
  const MARGIN_Y = 30; // top and bottom margins in pixels

  public function create($watermarker_parameter)
  {
    $start_time = time();

    $source_filename = $watermarker_parameter->getSourceFilename();
    $output_filename = $watermarker_parameter->getOutputFilename();
    $groups = $watermarker_parameter->getGroups();
    $print_config = $watermarker_parameter->getPrintConfig();
    $file_obj = $watermarker_parameter->getFileObj();
    $src_image_dimension = getimagesize($source_filename);

    $tmp_names = array();
    $tmp_dir = '/tmp';
    $tmp_base_name = md5($output_filename);
    $counter = 0;

    // for each group, add watermark
    try
    {
      foreach ($groups as $group)
      {
        $items = $group->getTranscientWMGroupItems();
        foreach ($items as $item)
        {
          $tmp_name = $tmp_base_name.'-'.$counter.'.'.strtolower($file_obj->getExtension());
          $tmp_names[] = $tmp_name;

          $alt_value = $item->getAltValue();
          if (!empty($alt_value))
          {
            $hotspot1 = $item->getValue();
            $hotspot2 = $alt_value;
          }
          else
          {
            $hotspot1 = $group->getName();
            $hotspot2 = $item->getValue();
          }

          $img = new sfImage($source_filename, $file_obj->getContentType());

          $layout_id = $print_config->getLayoutId();
          $width = $src_image_dimension[0];
          $height = $src_image_dimension[1];
          if ($print_config->getWatermarkImageId()!='')
          {
            // use image as watermark
            $overlay_path= FileManager::getUploadDirectoryByAccount($print_config->getAccountId()).$print_config->getWatermarkImage()->getImageName();
            $overlay_img = new sfImage($overlay_path, $print_config->getWatermarkImage()->getContentType());
            $img->overlay($overlay_img, 'middle-center', $print_config->getOpacity()/100);
          }
          else
          {
            switch ($layout_id)
            {
              case Layout::LEFT_RIGHT:
                $this->addText($img, $hotspot1, max(self::MARGIN_X, $print_config->getSize()), $height/2, -90, $print_config);
                $this->addText($img, $hotspot2, $width - self::MARGIN_X, $height/2, -90, $print_config);
                break;
              case Layout::TOP_BOTTOM:
                $this->addText($img, $hotspot1, $width/2, max(self::MARGIN_Y, $print_config->getSize()), 0, $print_config);
                $this->addText($img, $hotspot2, $width/2, $height - self::MARGIN_Y, 0, $print_config);
                break;
              case Layout::DIAGONAL:
                $this->addText($img, $hotspot2, $width/2, $height/2, 45, $print_config);
                break;
              case Layout::DIAGONAL_135:
                $this->addText($img, $hotspot2, $width/2, $height/2, -45, $print_config);
                break;
            }
          }

          $img->saveAs($tmp_dir.DIRECTORY_SEPARATOR.$tmp_name);
          $counter++;
        }
      }
    }
    catch (WatermarkLimitException $e)
    {
      // limit reached. stop watermarking
    }

    // zip up da files
    if ($watermarker_parameter->getCreateArchive() === true)
    {
      $this->zipFiles($output_filename, $tmp_dir, $tmp_names);
    }
    if ($watermarker_parameter->isPreviewMode())
    {
      rename($tmp_dir.DIRECTORY_SEPARATOR.$tmp_names[0], $output_filename);
    }

    // collect stats
    $wm_stat = new WatermarkStatistics();
    $wm_stat->setNumPages($counter);
    $wm_stat->setExecutionTime((time() - $start_time) * 1000);
    $wm_stat->setFinalFileSize(filesize($output_filename));
    $wm_stat->setNumDocuments($counter);
    $wm_stat->setOutputContentType('application/zip');
    return $wm_stat;
  }

  public function preview($watermarker_parameter)
  {
    $watermarker_parameter->setCreateArchive(false);
    $watermarker_parameter->setLimit(1);
    $watermarker_parameter->setPreviewMode(true);

    $this->create($watermarker_parameter);
  }

  private function addText(&$img, $text, $x, $y, $rotation, &$print_config)
  {
    $font_filename = $print_config->getFont()->getFileName();
    if (stripos($font_filename, '.ttf') !== false)
    {
      $font_filename = str_ireplace('.ttf', '', $font_filename);
    }
    $img->text($text, $x, $y, $print_config->getSize(), $font_filename, $print_config->getColour(), $rotation);
  }

  private function zipFiles($output_filename, $directory, $filenames)
  {
    $names = array();
    foreach ($filenames as $fname)
    {
      $names[] = $directory.DIRECTORY_SEPARATOR.$fname;
    }
    $zip_cmd = "zip -j $output_filename ".implode(" ", $names);
    $output = shell_exec($zip_cmd);
    foreach ($names as $filename)
    {
      unlink($filename); // delete temp files
    }
  }
}
?>
