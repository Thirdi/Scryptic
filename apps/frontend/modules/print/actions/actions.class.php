<?php

/**
 * print actions.
 *
 * @package    sf_sandbox
 * @subpackage print
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class printActions extends sfActions
{
  const PRINT_KEY = 'watermarked_pdf';

  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {

  }

  public function executeDownload()
  {
    // send watermarked pdf as stream
    $token = $this->getRequestParameter('token');
    $file = $this->getDownloadFilename($token);
    if (empty($file)) {
      $this->redirect404();
      return sfView::NONE;
    } else {
      $pm = new PrintManager();
      $pm->sendFile($this->getUser()->getProfile(), $file, $this->getDownloadContentType($token), 'watermark-download.zip');
      $delete = $this->getRequestParameter('delete');
      if (empty($delete) || $delete == 'true') {
        $this->cleanup($token, $file);
      }
      return sfView::NONE;
    }
  }

  public function executeDelete()
  {
    $token = $this->getRequestParameter('token');
    $file = $this->getDownloadFilename($token);
    if (!empty($file)) {
      $this->cleanup($token, $file);
    }
    return sfView::NONE;
  }

  private function cleanup($token, $file)
  {
    $this->getUser()->setAttribute($token, null, self::PRINT_KEY);
    unlink($file);
  }

  public function executePrint()
  {
    $user = $this->getUser()->getProfile();
    $account_id = $user->getAccountId();
    $file_id = $this->getRequestParameter('file_id');
    $group_id = $this->getRequestParameter('group_id');

    if (!is_array($group_id)) {
      $group_id = array($group_id);
    }

    $success = false;
    $message = '';
    $content_type = '';

    $pm = new PrintManager();
    try {
      $file = FilePeer::getByFileIdAccountId($file_id, $user->getAccountId());
      if (!$file) {
        throw new Exception('File not found');
      }

      $wm = WatermarkerFactory::getInstance($file->getContentType());
      $wm_groups = $this->loadWmGroups($account_id);
      $source_pdf = FileManager::getUploadDirectoryByAccount($account_id).$file->getFileHash();
      $token = $account_id.'-'.time().'-'.$source_pdf;
      $token = md5($token);
      $output_pdf = sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'printdownload'.DIRECTORY_SEPARATOR.$token.'.pdf';

      $print_config = $this->getPrintConfiguration($account_id);
      if ($print_config == null) {
        // create one NOW
        $print_config = PrintConfiguration::getDefaultConfiguration();
        $print_config->setAccountId($account_id);
        $print_config->save();
      }

      $job_id = $pm->createJob($file_id, $user->getId(), $_SERVER['REMOTE_ADDR'], $print_config, $wm_groups);

      $watermarker_parameter = new WatermarkerParameter();
      $watermarker_parameter->setSourceFilename($source_pdf);
      $watermarker_parameter->setOutputFilename($output_pdf);
      $watermarker_parameter->setPrintConfig($print_config);
      $watermarker_parameter->setGroups($wm_groups);
      $watermarker_parameter->setFileObj($file);

      $wm_stat = $wm->create($watermarker_parameter);
      $pm->updateWatermarkStats($wm_stat);
      $watermark_session_data = array('content-type' => $wm_stat->getOutputContentType(),
                                      'filename'     => $output_pdf);
      $this->getUser()->setAttribute($token, $watermark_session_data, self::PRINT_KEY);
      $content_type = $wm_stat->getOutputContentType();
      $success = true;
    } catch (Exception $e) {
      $token = ''; // clear token!
      error_log('Error watermarking PDF: '.$e->getMessage());
      $message = $e->getMessage();
      sfLogger::getInstance()->err($e->getMessage());
    }

    $response = array('success'=>$success, 'token'=>$token, 'message'=>$message, 'job_id'=>$job_id, 'contentType'=>$content_type);
    $this->renderText(json_encode($response));
    return sfView::NONE;
  }

  public function executePreview()
  {
    $response = array('success'=>false);
    $account_id = $this->getUser()->getProfile()->getAccountId();

    try {
      $config = $this->getPrintConfiguration($account_id);
      if ($config) {

        $fs_preview_dir = sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'preview'.DIRECTORY_SEPARATOR;
        $output_filename = md5($account_id.'-'.time()).'.png';
        $output_filepath = $fs_preview_dir.$output_filename;

        $file_id = $this->getRequestParameter('file_id');
        $file = FilePeer::getByFileIdAccountId($file_id, $account_id);
        $source_filename = FileManager::getUploadDirectoryByAccount($account_id).$file->getFileHash();

        $groups = $this->loadWmGroups($account_id);

        $watermarker_parameter = new WatermarkerParameter();
        $watermarker_parameter->setSourceFilename($source_filename);
        $watermarker_parameter->setOutputFilename($output_filepath);
        $watermarker_parameter->setPrintConfig($config);
        $watermarker_parameter->setGroups($groups);
        $watermarker_parameter->setFileObj($file);

        $wm = WatermarkerFactory::getInstance($file->getContentType());
        $wm->preview($watermarker_parameter);
        $response['success'] = true;
        $response['image_url'] = '/preview/'.$output_filename;
        $dimension = getimagesize($output_filepath);
        $response['pdfWidth'] = $dimension[0];
        $response['pdfHeight'] = $dimension[1];
      } else {
        // no config
        $response['error_code'] = 1;
      }

    } catch (Exception $e) {
      // log and ignore
      $response['error_code'] = 2;
      sfLogger::getInstance()->err($e->getMessage());
    }

    $this->renderText(json_encode($response));
    return sfView::NONE;
  }

  private function getPrintConfiguration($account_id)
  {
    $cfg = PrintConfigurationPeer::getLatestByAccountId($account_id);
    if ($cfg == null) {
      $cfg = PrintConfiguration::getDefaultConfiguration();
    }
    return $cfg;
  }

  private function loadWmGroups($account_id)
  {
    $group_ids = $this->getRequestParameter('group_ids', array());
    $group_item_ids = $this->getRequestParameter('group_item_ids', array());

    // RD-61
    $groups = array();
    $tmp_groups = WMGroupPeer::getByIds($group_ids);
    foreach ($tmp_groups as $tmp_group) {
      $groups[$tmp_group->getId()] = $tmp_group;
    }

    $group_items = WMGroupItemPeer::getByAccountIdAndIds($account_id, $group_item_ids);
    // segregate items by group id
    foreach ($group_items as $item)
    {
      $group = null;
      if (!array_key_exists($item->getWmGroupId(), $groups))
      {
        $group = $item->getWmGroup();
        $groups[$item->getWmGroupId()] = $group;
      }
      else
      {
        $group = $groups[$item->getWmGroupId()];
      }
      $group->addTranscientWMGroupItem($item);
    }
    return $groups;
  }

  public function executeReport()
  {
    if ($this->getRequest()->isXmlHttpRequest())
    {
      // meat of report
      $page = $this->getRequestParameter('page', 1);
      $user_id = $this->getUser()->getProfile()->getId();
      $account_id = $this->getUser()->getProfile()->getAccountId();

      $c = new Criteria();
      $c->add(SfGuardUserProfilePeer::ACCOUNT_ID, $account_id);
      $c->addDescendingOrderByColumn(PrintHistoryPeer::CREATED_AT);

      $pager = new sfPropelPager('PrintHistory', sfConfig::get('app_pager_limit_print_report', 10));
      $pager->setCriteria($c);
      $pager->setPeerMethod('doSelectJoinAll');
      $pager->setPeerCountMethod('doCountJoinAll');
      $pager->setPage($page);
      $pager->init();

      $this->pager = $pager;
      $this->setTemplate('reportContent');
      return sfView::SUCCESS;
    }
    else
    {
      // report scaffold
      return sfView::SUCCESS;
    }
  }

  public function executePrintReport()
  {
    $id = $this->getRequestParameter('id');
    $flavour = $this->getRequestParameter('flavour');
    $history = PrintHistoryPeer::retrieveByPk($id);
    $this->forward404Unless($history);
    $this->forward404Unless($history->getsfGuardUserProfile()->getAccountId() == $this->getUser()->getProfile()->getAccountId());

    $html = $this->generateReportHtml($history);
    if ($flavour == 'pdf')
    {
      $pdf = $this->generateReportPdf($history, $html);
      $pdf->Output('PrintHistoryReport-'.$id.'.pdf', 'D');
      return sfView::NONE;
    }
    else
    {
      $this->html = $html;
      return sfView::SUCCESS;
    }
  }

  private function generateReportPdf($history, $html)
  {
    $pdf = new sfTCPDF($orientation = 'P', $unit = 'mm', $format = 'LETTER');

    // settings
    $pdf->SetFont("FreeSerif", "", 12);
    $pdf->SetMargins($marginLeft = 15, $marginTop = 27, $marginRight = 15);
    $pdf->setHeaderFont(array($fontName = "FreeSerif", '', $fontSize = 10));
    $pdf->setFooterFont(array($fontName = "FreeSerif", '', $fontSize = 8));
    $pdf->setHeaderMargin(5);
    $pdf->setFooterMargin(10);

    // init pdf doc
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->Ln(2); // line break

    $pdf->writeHTML($html, true, 0, true, 0);
    return $pdf;
  }

  private function generateReportHtml(PrintHistory $history)
  {
    $html =
<<< EOF
<div class="fieldvalue-row">
  <label>Date</label><span>%s</span>
</div>
<div class="fieldvalue-row">
  <label>User</label><span>%s</span>
</div>
<div class="fieldvalue-row">
  <label>Number of Documents</label><span>%s</span>
</div>
<div class="fieldvalue-row">
  <label>Time</label><span>%s</span>
</div>
<div class="fieldvalue-row">
  <label>File</label><span>%s</span>
</div>
<div class="fieldvalue-row">
  <label>Watermarks</label><span>%s</span>
</div>

EOF;

    $watermarks = '';
    $groups = $history->getPrintHistoryGroups();
    foreach ($groups as $group)
    {
      $watermarks .= $group->getName().'<br/>';
      $watermarks .= $group->getGroupItemsAsString(', ');
      $watermarks .= '<br/>';
      $watermarks .= '<br/>';
    }

    $name = $history->getSfGuardUserProfile()->getFirstName().' '.$history->getSfGuardUserProfile()->getLastName();
    $created_at = $history->getCreatedAt();
    $time = number_format($history->getTotalTime() / 1000, 2) .'s';
    $file = $history->getFile()->getName();
    $num_docs = $history->getNumDocuments();

    $ret_val = sprintf($html,
                       $created_at,
                       $name,
                       $num_docs,
                       $time,
                       $file,
                       $watermarks);

    return $ret_val;
  }

  private function getWatermarkSessionData($token)
  {
    $data = $this->getUser()->getAttribute($token, null, self::PRINT_KEY);
    return $data;
  }

  private function getDownloadFilename($token)
  {
    $data = $this->getWatermarkSessionData($token);
    return $data['filename'];
  }

  private function getDownloadContentType($token)
  {
    $data = $this->getWatermarkSessionData($token);
    return $data['content-type'];
  }
}
