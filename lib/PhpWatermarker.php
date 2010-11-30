<?php
class PhpWatermarker implements IWatermarker {
  
  private $error_level; // mask Strict Standards hassle
  
  /**
   * @param: $source_pdf - FQN to source PDF
   */
  public function __construct() {
    $this->error_level = error_reporting(E_ALL ^ E_NOTICE);
  }
  
  public function __destruct() {
    error_reporting($this->error_level);
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
      $group_items = $group->getWMGroupItems();      
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
  private function concatPDFs($names, $output_filename) 
  {
    $concat_pdf = new SmartPDF();
    $concat_pdf->setFiles($names);
    $concat_pdf->concat();
    $concat_pdf->Output($output_filename, 'F');

    return $output_filename;
  }
  
  public function create($source_filename, $output_filename, $print_config, $groups) {
    // for v1, watermark will support 2 layouts: top/bottom and left/right. it's more of a 
    // prototype than a polished product.
    
    $layout_id = $print_config->getLayoutId();
    $pdf_root_filename = 'PDFxyz'; // TODO remove this
    $pdf_names = array(); // to store all the pdf generated
    $counter = 0;
    foreach ($groups as $group) {
      $group_items = $group->getWMGroupItems();      
      foreach ($group_items as $group_item) {
        $pdf = new SmartPDF();
        $page_count = $pdf->setSourceFile($source_filename);
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
    
    return $this->concatPDFs($pdf_names, $output_filename);
  }
}
?>
