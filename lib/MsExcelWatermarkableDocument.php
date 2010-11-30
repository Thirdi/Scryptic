<?php
class MsExcelWatermarkableDocument extends AbstractWatermarkableDocument
{
  public function getPageCount()
  {
    // TODO: implement me
    return -1;
  }
  
  public function getMimeType()
  {
    return 'application/vnd.ms-excel';    
  }
  
  public function convertToPdf() 
  {
    // force file extension to be .xls because document converter relies on file ext for proper conversion
    $working_name = $this->getFilePath();
    $ext = $this->getExtension();
    if (stripos($working_name, '.'.$ext) === FALSE)
    {
      $working_name = $working_name.'.'.$ext;
      rename($this->getFilePath(), $working_name);
    }
    $converted_name = $this->getFilePath().'-converted.pdf';
    
    $converter = new JavaBridgedConverter();
    $converter->convert($working_name, $converted_name);
    rename($converted_name, $this->getFilePath());  
  }
}
?>
