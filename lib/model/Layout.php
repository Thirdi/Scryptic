<?php

/**
 * Subclass for representing a row from the 'layout' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Layout extends BaseLayout
{
  const TOP_BOTTOM = 1;
  const LEFT_RIGHT = 2;
  const DIAGONAL = 3;     // 45-degree diagonal
  const DIAGONAL_135 = 4; // 135-degree diagonal

  public function __toString() {
    return $this->getName();
  }
}
