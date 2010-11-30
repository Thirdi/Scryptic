<?php
interface IWatermarker {

  public function create($watermarker_parameter);
  
  /**
   * Creates a JPEG preview.
   */
  public function preview($watermarker_parameter);
}
?>
