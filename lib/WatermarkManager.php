<?php
class WatermarkManager {
  
  private $error_level; // mask Strict Standards hassle

  private $print_config; // instance of PrintConfiguration object
  private $source_pdf; // instance of SmartPDF object
  
  /**
   * @param: $source_pdf - FQN to source PDF
   */
  public function __construct($print_config, $source_pdf) {
    $this->error_level = error_reporting(E_ALL ^ E_NOTICE);
    $this->print_config = $print_config;
    $this->source_pdf = $source_pdf; 
  }
  
  public function __destruct() {
    error_reporting($this->error_level);
  }
  
  /**
   * Run through the use case of creating up a new watermark group.
   *
   * @return WMGroup object that was created
   */
  public static function createNewWatermarkGroup($request, $account_id)
  {
    $conn = Propel::getConnection(WMGroupPeer::DATABASE_NAME);
    $logger = Util::getLogger();

    try
    {
      $conn->begin();

 	  // create watermark group
      $wm_group = new WMGroup();
      $wm_group->setAccountId($account_id);
      $wm_group->setName(InputHelper::sanitize(trim($request->getParameter('wm_group_name'))));
      $wm_group->save($conn);

      $conn->commit();
    }
    catch (Exception $e)
    {
      $logger->info('Error creating new watermark group:'.$e->getMessage().'. Rollback!');
      $conn->rollback();
      throw $e;
    }

    return $wm_group;
  }
  
  /**
   * Run through the use case of creating up a new watermark group item.
   *
   * @return WMGroupItem object that was created
   */
  public static function createNewWatermarkGroupItem($request)
  {
    $conn = Propel::getConnection(WMGroupItemPeer::DATABASE_NAME);
    $logger = Util::getLogger();

    try
    {
      $conn->begin();

 	  // create watermark group item
      $wm_group_item = new WMGroupItem();
      $wm_group_item->setWMGroupId(InputHelper::sanitize(trim($request->getParameter('wm_group_id'))));
      $wm_group_item->setValue(InputHelper::sanitize(trim($request->getParameter('wm_group_item_value'))));
      $wm_group_item->setAltValue(InputHelper::sanitize(trim($request->getParameter('wm_group_item_alt_value'))));
      $wm_group_item->save($conn);

      $conn->commit();
    }
    catch (Exception $e)
    {
      $logger->info('Error creating new watermark group item:'.$e->getMessage().'. Rollback!');
      $conn->rollback();
      throw $e;
    }

    return $wm_group_item;
  }
  
  /**
   * Run through the use case of deleting a watermark group.
   *
   * @return true if the WMGroup has been deleted
   */
  public static function deleteWatermarkGroup($wm_group_id)
  {
    $conn = Propel::getConnection(WMGroupPeer::DATABASE_NAME);
    $logger = Util::getLogger();

    try
    {
      $wm_group = WMGroupPeer::retrieveByPK($wm_group_id);

      $conn->begin();
      if ($wm_group) {
        $wm_group_items = $wm_group->getWMGroupItems();
        foreach ($wm_group_items as $item) 
        {
          $item->delete($conn);  
        }
      }
      $wm_group->delete($conn);

      $conn->commit();
    }
    catch (Exception $e)
    {
      $logger->err('Error deleting watermark group:'.$e->getMessage().'. Rollback!');
      $conn->rollback();
      throw $e;
    }

    return $wm_group->isDeleted();
  }
  
  /**
   * Run through the use case of deleting a watermark group item.
   *
   * @return true if the WMGroupItem has been deleted
   */
  public static function deleteWatermarkGroupItem($request)
  {
    $conn = Propel::getConnection(WMGroupItemPeer::DATABASE_NAME);
    $logger = Util::getLogger();

    try
    {
      $conn->begin();

 	  // delete watermark group item
      $wm_group_item = new WMGroupItem();
      // TODO :: IS THERE A BETTER WAY THAN SETNEW?
      $wm_group_item->setNew(false);
      $wm_group_item->setId(InputHelper::sanitize(trim($request->getParameter('id'))));
      $wm_group_item->delete($conn);

      $conn->commit();
    }
    catch (Exception $e)
    {
      $logger->info('Error deleting watermark group item:'.$e->getMessage().'. Rollback!');
      $conn->rollback();
      throw $e;
    }

    return $wm_group_item->isDeleted();
  }
  
  /**
   * Run through the use case of updating a watermark group.
   *
   * @return WMGroup object that was saved
   */
  public static function updateWatermarkGroup($request)
  {
    $conn = Propel::getConnection(WMGroupPeer::DATABASE_NAME);
    $logger = Util::getLogger();

    try
    {
      $conn->begin();

 	  // update watermark group
      $wm_group = WMGroupPeer::retrieveByPK(InputHelper::sanitize(trim($request->getParameter('id'))));
      $wm_group->setName(InputHelper::sanitize(trim($request->getParameter('wm_group_name'))));
      $wm_group->save($conn);

      $conn->commit();
    }
    catch (Exception $e)
    {
      $logger->info('Error updating watermark group:'.$e->getMessage().'. Rollback!');
      $conn->rollback();
      throw $e;
    }

    return $wm_group;
  }
  
  /**
   * Retrieve all watermarks that belong to the given account_id.
   *
   * @return WMGroup object that was saved
   */
  public static function retrieveByAccountId($account_id) 
  {
  	$c = new Criteria();
    $c->add(WMGroupPeer::ACCOUNT_ID, $account_id);
    $c->addDescendingOrderByColumn(WMGroupPeer::CREATED_AT);
    
    return WMGroupPeer::doSelect($c);
  }
  
  /**
   * Retrieve all watermark items that belong to the given group_id.
   *
   * @return WMGroupItems array
   */
  public static function retrieveByGroupId($group_id) 
  {
  	$c = new Criteria();
    $c->add(WMGroupItemPeer::WM_GROUP_ID, $group_id);
    $c->addDescendingOrderByColumn(WMGroupItemPeer::CREATED_AT);
    
    return WMGroupItemPeer::doSelect($c);
  }
  
  /**
   * Run through the use case of updating a watermark group item.
   *
   * @return WMGroupItem object that was saved
   */
  public static function updateWatermarkGroupItem($request)
  {
    $conn = Propel::getConnection(WMGroupItemPeer::DATABASE_NAME);
    $logger = Util::getLogger();
    
    $wm_group_item_id = InputHelper::sanitize(trim($request->getParameter('id')));

    try
    {
      $conn->begin();

 	  // update watermark group item
 	  // update watermark group
      $wm_group_item = WMGroupItemPeer::retrieveByPK($wm_group_item_id);
      $wm_group_item->setValue(InputHelper::sanitize(trim($request->getParameter('value'))));
      $wm_group_item->setAltValue(InputHelper::sanitize(trim($request->getParameter('alt_value'))));
      $wm_group_item->save($conn);

      $conn->commit();
    }
    catch (Exception $e)
    {
      $logger->info('Error updating watermark group item:'.$e->getMessage().'. Rollback!');
      $conn->rollback();
      throw $e;
    }

    return $wm_group_item;
  }
  
  /**
   * Creates a new PDF with watermark added using GroupItem objects.
   * @return a new PDF object (or string to location?)
   */
  public function createPdfUsingGroupItems($group_items) {
    
    // for v1, watermark will support 2 layouts: top/bottom and left/right. it's more of a 
    // prototype than a polished product.
    
    $group = count($group_items) > 0 ? $group_items[0]->getWMGroup() : null;
    $layout_id = $this->print_config->getLayoutId();
    $pdf_root_filename = 'PDFxyz'; // TODO remove this
    $pdf_names = array(); // to store all the pdf generated
    $counter = 0;
    foreach ($group_items as $group_item) {

      $pdf = new SmartPDF();
      $page_count = $pdf->setSourceFile($this->source_pdf);
      for ($i = 1; $i <= $page_count; $i++) { 
        $tplidx = $pdf->ImportPage($i); 
        $s = $pdf->getTemplatesize($tplidx); 
        $pdf->AddPage('P', array($s['w'], $s['h'])); 
        $pdf->useTemplate($tplidx);
        $this->applyWatermark($pdf, $group, $group_item, $s); 
      } 
      
      $pdf_name = $pdf_root_filename.'-'.$counter.'.pdf';
      $fullpath = FileManager::getUploadDirectoryByAccount($group->getAccountId()).$pdf_name;
      $pdf->Output($fullpath, 'F');
      $pdf_names[] = $fullpath;
      $counter++;
    }
    
    return $this->concatPDFs($pdf_names);
  }

  /**
   * Creates a new PDF with watermark added using Group objects.
   * @return a new PDF object (or string to location?)
   */
  public function createPdfUsingGroups($groups) {
    
    // for v1, watermark will support 2 layouts: top/bottom and left/right. it's more of a 
    // prototype than a polished product.
    
    $layout_id = $this->print_config->getLayoutId();
    $pdf_root_filename = 'PDFxyz'; // TODO remove this
    $pdf_names = array(); // to store all the pdf generated
    $counter = 0;
    foreach ($groups as $group) {
      $group_items = $group->getTranscientWMGroupItems();      
      foreach ($group_items as $group_item) {
        $pdf = new SmartPDF();
        $page_count = $pdf->setSourceFile($this->source_pdf);
        for ($i = 1; $i <= $page_count; $i++) { 
          $tplidx = $pdf->ImportPage($i); 
          $s = $pdf->getTemplatesize($tplidx); 
          $pdf->AddPage('P', array($s['w'], $s['h'])); 
          $pdf->useTemplate($tplidx);
          $this->applyWatermark($pdf, $group, $group_item, $s); 
        } 
        
        $pdf_name = $pdf_root_filename.'-'.$counter.'.pdf';
        $fullpath = FileManager::getUploadDirectoryByAccount($group->getAccountId()).$pdf_name;
        $pdf->Output($fullpath, 'F');
        $pdf_names[] = $fullpath;
        $counter++;
      }
    }
    
    return $this->concatPDFs($pdf_names);
  }

  private function applyWatermark(&$pdf, $group, $group_item, $template_sizes) {
    // FIXME: remove hard code badness
    $hotspot_1_value = $group->getName();
    $hotspot_2_value = $group_item->getValue(); 
    $layout_id = $this->print_config->getLayoutId();
    
    $pdf->SetFont($this->print_config->getFont()->getName());
    $pdf->SetFontSize($this->print_config->getSize());
    $rgb = $this->print_config->getColourRGB();
    $pdf->SetTextColor($rgb['r'], $rgb['g'], $rgb['b']);
    $pdf->setAlpha($this->print_config->getOpacity() / 100);

    if ($layout_id == Layout::TOP_BOTTOM) {
      $page_width = $template_sizes['2'];
      $pdf->SetXY(5, 5);
      $pdf->drawTextBox($hotspot_1_value, $page_width, 0, 'C', 'T', 0); // str, w, h, align, valign, border
      $pdf->SetXY(5, -30);
      $pdf->drawTextBox($hotspot_2_value, $page_width, 0, 'C', 'T', 0); // str, w, h, align, valign, border
    } else if ($layout_id == Layout::LEFT_RIGHT) {
      $page_height = $template_sizes['h'];
      $pdf->SetXY(5, 5);
      $pdf->drawTextBox($hotspot_1_value, 1, $page_height, 'C', 'M', 0); // str, w, h, align, valign, border
      $pdf->SetXY(-5, 5);
      $pdf->drawTextBox($hotspot_2_value, 1, $page_height, 'C', 'M', 0); // str, w, h, align, valign, border
    } else {
      throw new Exception('Unsupported layout: layout_id='.$layout_id);
    }
    
    $pdf->setAlpha(1);
  }
  
  /**
   * Concat watermarked pdfs into one big PDF for printing.
   */
  private function concatPDFs($names) 
  {
    $acct_dir = FileManager::getUploadDirectoryByAccount(1);
    $concat_name = $acct_dir.'concat.pdf';

    $concat_pdf = new SmartPDF();
    $concat_pdf->setFiles($names);
    $concat_pdf->concat();
    $concat_pdf->Output($concat_name, 'F');

    return $concat_name;
  }
}
?>
