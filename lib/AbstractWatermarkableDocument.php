<?php
abstract class AbstractWatermarkableDocument implements WatermarkableDocument
{
  private $file_path;
  private $extension;
  
  public function __construct($file_path, $extension)
  {
    $this->file_path = $file_path;
    $this->extension = $extension;
  }
  
  public function getFilePath()
  {
    return $this->file_path;
  }

  public function convertToPdf() {}
  
  public function getExtension() 
  {
    return $this->extension; 
  }
} 
?>
