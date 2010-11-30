<?php

/**
 * Subclass for performing query and update operations on the 'font' table.
 *
 * 
 *
 * @package lib.model
 */ 
class FontPeer extends BaseFontPeer
{
  public static function getAllOrderByName() 
  {
    $c = new Criteria();
    $c->addAscendingOrderByColumn(FontPeer::NAME);
    return self::doSelect($c);
  }
}
