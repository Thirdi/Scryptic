<?php
require_once 'autoloadmagic.php';

class MsDocWatermarkableDocumentTest extends PHPUnit_Framework_TestCase
{
  public function test_GetFilePath()
  {
    $wd = new MsWordWatermarkableDocument('foobar');
    $this->assertEquals('foobar', $wd->getFilePath());    
  }

  public function test_GetMimeType()
  {
    $wd = new MsWordWatermarkableDocument();
    $this->assertEquals('application/msword', $wd->getMimeType());
  }
}
?>
