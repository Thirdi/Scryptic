<?php
class PrintManager 
{
  private $print_history_id;
  
  public function sendPDF($user, $watermarked_pdf) 
  {
    //http://ca3.php.net/header
    $filesize = filesize($watermarked_pdf);
    header("Expires: Mon, 26 Nov 1962 00:00:00 GMT"); // TODO cache?
    header("Last-Modified: " . gmdate("D,d M Y H:i:s") . " GMT");
    header("Cache-Control: no-cache, must-revalidate");
    header("Pragma: no-cache");
    header("Content-type: Application/pdf");
    header("Content-length: " . $filesize);
  
    // This will work on all systems, but will need considerable resources
    // We could also loop with fread($fp, 4096) to save memory
    readfile($watermarked_pdf);
  }

  /**
   * $operation: one of: disposition, 
   */
  public function sendFile($user, $watermarked_file, $content_type, $save_as_filename) 
  {
    //http://ca3.php.net/header
    $filesize = filesize($watermarked_file);
    header("Expires: Mon, 26 Nov 1962 00:00:00 GMT"); // TODO cache?
    header("Last-Modified: " . gmdate("D,d M Y H:i:s") . " GMT");
    header("Cache-Control: no-cache, must-revalidate");
    header("Pragma: no-cache");
    header("Content-type: $content_type");
    if ($content_type != 'application/pdf')
    {
      header('Content-Disposition: attachment; filename="'.$save_as_filename.'"');
    }
    header("Content-length: " . $filesize);
  
    // This will work on all systems, but will need considerable resources
    // We could also loop with fread($fp, 4096) to save memory
    readfile($watermarked_file);
  }

  public function createJob($file_id, $user_id, $user_ip, $print_config, $wm_groups) 
  {
    $this->print_history_id = '';
    $conn = null;
    try 
    {
      $conn = Propel::getConnection(PrintHistoryPeer::DATABASE_NAME);
      $conn->begin();

      $print_history = new PrintHistory();
      $print_history->setFileId($file_id);
      $print_history->setUserId($user_id);
      $print_history->setUserIp($user_ip);
  //    $print_history->setCreationTime(); // TODO find out what this is
      $print_history->setCreatedAt(time());
      
      // the following will be set in updateWatermarkStats function
      $print_history->setSize(-1); 
      $print_history->setPages(-1);
      $print_history->setTotalTime(-1);      
      $print_history->setNumDocuments(-1);
      
      $print_history->save($conn);
      $this->print_history_id = $print_history->getId();

      $print_history_configuration = PrintHistoryConfiguration::createFromPrintConfig($print_config);
      $print_history_configuration->setPrintHistoryId($print_history->getId());
      $print_history_configuration->save($conn);
      
      foreach ($wm_groups as $wm_group) 
      {
        $print_history_group = new PrintHistoryGroup();
        $print_history_group->setName($wm_group->getName());
        $print_history_group->setPrintHistoryId($print_history->getId());
        $print_history_group->save($conn);
        
        $wm_group_items = $wm_group->getTranscientWMGroupItems();
        foreach ($wm_group_items as $item) 
        {
          $print_history_group_item = new PrintHistoryGroupItem();
          $print_history_group_item->setValue($item->getValue());
          $print_history_group_item->setPrintHistoryGroupId($print_history_group->getId());
          $print_history_group_item->save($conn);
        }
      }
      
      $conn->commit();
    } 
    catch (Exception $e) 
    {
      if ($conn != null) 
      {
        $conn->rollback();  
      }      
      throw $e;
    }
    
    return $this->print_history_id;
  }
  
  public function updateWatermarkStats(WatermarkStatistics $wm_stat) 
  {
    try
    {
      $print_history = PrintHistoryPeer::retrieveByPk($this->print_history_id);
      if ($print_history != null)
      {
        $print_history->setPages($wm_stat->getNumPages());
        $print_history->setSize($wm_stat->getFinalFileSize());
        $print_history->setTotalTime($wm_stat->getExecutionTime());
        $print_history->setNumDocuments($wm_stat->getNumDocuments());
        $print_history->save();      
      } 
      else 
      {
        // log and ignore
        error_log('PrintManager::updateWatermarkStats() was not expecting a null PrintHistory object!');
      }
    }
    catch (Exception $e) 
    {
      // log and ignore
      error_log('PrintManager::updateWatermarkStats() error: '.$e->getMessage());  
    }
  }
}
?>
