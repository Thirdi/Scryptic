<?php
class WatermarkStatistics {

  private $numPages;
  private $numDocuments;
  private $executionTime;
  private $finalFileSize;
  private $outputContentType;
  
  public function __construct() {
    $this->numPages = -1;
    $this->numDocuments = -1;
    $this->executionTime = -1;
    $this->finalFileSize = -1;
    $this->outputContentType = null;
  }
  
  public function getFinalFileSize() {
    return $this->finalFileSize;
  }
  
  public function setFinalFileSize($v) {
    $this->finalFileSize = $v;
  }
  
  public function getNumPages() {
    return $this->numPages;
  }
  
  public function setNumPages($v) {
    $this->numPages = $v;
  }
  
  public function getExecutionTime() {
    return $this->executionTime;
  }
  
  public function setExecutionTime($v) {
    $this->executionTime = $v;
  }
  
  public function getOutputContentType()
  {
    return $this->outputContentType;
  }
  
  public function setOutputContentType($v)
  {
    $this->outputContentType = $v;
  }
  
  public function getNumDocuments()
  {
    return $this->numDocuments;
  }
  
  public function setNumDocuments($v)
  {
    $this->numDocuments = $v;
  }
}
?>
