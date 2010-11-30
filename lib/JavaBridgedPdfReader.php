<?php
$bridge_endpoint = sfConfig::get('app_java_php_bridge_connection_endpoint', '127.0.0.1:8181');
define ("JAVA_HOSTS", $bridge_endpoint);

require_once ("java/Java.inc");
java_autoload("iText-2.1.5.jar");

class JavaBridgedPdfReader 
{
  private $source_file;
  
  public function __construct($source_file)
  {
    $this->source_file = $source_file;
  }
  
  public function getPageCount()
  {
    $pdf_reader = new Java("com.lowagie.text.pdf.PdfReader", $this->source_file);
    $page_count = $pdf_reader->getNumberOfPages()->__cast('i');
    return $page_count;    
  }  
}
?>
