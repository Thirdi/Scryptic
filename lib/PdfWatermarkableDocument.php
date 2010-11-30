<?php
class PdfWatermarkableDocument extends AbstractWatermarkableDocument
{
  
  public function getPageCount()
  {
    $reader = new JavaBridgedPdfReader($this->getFilePath());
    return $reader->getPageCount();
  }
  
  public function getMimeType()
  {
    return 'application/pdf';    
  }
}
?>
