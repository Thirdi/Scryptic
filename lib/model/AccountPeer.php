<?php

/**
 * Subclass for performing query and update operations on the 'account' table.
 *
 * 
 *
 * @package lib.model
 */ 
class AccountPeer extends BaseAccountPeer
{
  public static function getAll($include_delete = false)
  {
    $c = new Criteria();
    if ($include_delete == false)
    {
      $c->add(AccountPeer::DELETED_AT, null, Criteria::ISNULL);
    }
    return self::doSelect($c);
  }
}
