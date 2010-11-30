<?php
require_once 'autoloadmagic.php';

class PdfWatermarkableDocumentTest extends PHPUnit_Framework_TestCase
{
  public function test_GetFilePath()
  {
    $wd = new PdfWatermarkableDocument('foo');
    $this->assertEquals('foo', $wd->getFilePath());    
  }

  public function test_GetMimeType()
  {
    $wd = new PdfWatermarkableDocument();
    $this->assertEquals('application/pdf', $wd->getMimeType());
  }
}
?>
