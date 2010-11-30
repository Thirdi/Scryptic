<?php
interface WatermarkableDocument 
{
  /**
   * Return the number of pages in this document.
   */
  public function getPageCount();
  
  /**
   * Return the mime type associated with this document.
   */
  public function getMimeType(); 
  
  /**
   * Convert the current document to a PDF.
   */
  public function convertToPdf(); 
  
  /**
   * Return the extension of the watermarkable document
   */
  public function getExtension();
}
?>
