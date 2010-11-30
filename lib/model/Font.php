<?php

/**
 * Subclass for representing a row from the 'font' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Font extends BaseFont
{
  public function __toString() {
    return $this->getName();
  }
}
