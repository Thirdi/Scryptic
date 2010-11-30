<?php
class WatermarkerFactory {

  public static function getInstance($content_type = null) {
    $class = 'JavaBridgedWatermarker'; // the default watermarker
    switch ($content_type) {
      case 'image/jpeg':
      case 'image/pjpeg':
      case 'image/png':
      case 'image/x-png':
      case 'image/gif':
        $class = 'ImagemagickWatermarker';
        break;
    }

    return new $class;
  }
}
?>
