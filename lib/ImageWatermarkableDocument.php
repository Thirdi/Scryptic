<?php
class ImageWatermarkableDocument extends AbstractWatermarkableDocument
{
  public function getPageCount()
  {
    return 1;
  }
  
  public function getMimeType()
  {
    $ext = strtolower($this->getExtension());
    if ($ext == 'jpg')
    {
      $ext = 'jpeg';
    }
    return 'image/'.$ext;    
  }
}
?>
