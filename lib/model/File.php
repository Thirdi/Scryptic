<?php

/**
 * Subclass for representing a row from the 'file' table.
 *
 * 
 *
 * @package lib.model
 */ 
class File extends BaseFile
{
  public function getExtension()
  {
    $pathinfo = pathinfo($this->getName());
    return $pathinfo['extension'];
  }
}
