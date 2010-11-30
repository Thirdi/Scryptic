<?php
/**
 * Parameter holder for IWatermarker
 */
class WatermarkerParameter
{
  private $print_config;
  private $source_filename;
  private $output_filename;
  private $file_obj;
  private $groups = array();
  private $create_archive = true;
  private $preview_mode = false;

  public function isPreviewMode()
  {
    return $this->preview_mode;
  }

  public function setPreviewMode($v)
  {
    $this->preview_mode = $v;
  }

  public function getCreateArchive()
  {
    return $this->create_archive;
  }

  public function setCreateArchive($v)
  {
    $this->create_archive = $v;
  }

  public function getPrintConfig()
  {
    return $this->print_config;
  }

  public function setPrintConfig($v)
  {
    $this->print_config = $v;
  }

  public function getSourceFilename()
  {
    return $this->source_filename;
  }

  public function setSourceFilename($v)
  {
    $this->source_filename = $v;
  }

  public function getOutputFilename()
  {
    return $this->output_filename;
  }

  public function setOutputFilename($v)
  {
    $this->output_filename = $v;
  }

  public function getGroups()
  {
    return $this->groups;
  }

  public function setGroups($v)
  {
    $this->groups = $v;
  }

  public function getFileObj()
  {
    return $this->file_obj;
  }

  public function setFileObj($v)
  {
    $this->file_obj = $v;
  }
}
?>
