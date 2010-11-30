<?php
class WatermarkableDocumentFactory
{
  public static function getWatermarkableDocument($mime_type, $file_path, $extension)
  {
    $wd = null;
    if ($mime_type == 'application/pdf')
    {
      $wd = new PdfWatermarkableDocument($file_path, $extension);      
    } 
    else if ($mime_type == 'application/msword' || $mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
    {
      $wd = new MsWordWatermarkableDocument($file_path, $extension); 
    }
    else if ($mime_type == 'application/vnd.ms-excel' || $mime_type == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
    {
      $wd = new MsExcelWatermarkableDocument($file_path, $extension);
    }
    else if (stripos($mime_type, 'image/') === 0)
    {
      $wd = new ImageWatermarkableDocument($file_path, $extension);
    }
    if ($wd == null)
    {
      throw new Exception('Unsupported mime type: '.$mime_type);
    }
    else
    {
      return $wd;
    }
  }
}
?>
