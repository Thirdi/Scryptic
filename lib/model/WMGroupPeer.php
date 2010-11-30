<?php

/**
 * Subclass for performing query and update operations on the 'wm_group' table.
 *
 * 
 *
 * @package lib.model
 */ 
class WMGroupPeer extends BaseWMGroupPeer
{
  public static function getById($group_id)
  {
    $c = new Criteria();
    $c->add(WMGroupPeer::ID, $group_id);
    return WMGroupPeer::doSelectOne($c);   
  }
  
  public static function getByIds($group_ids)
  {
    $c = new Criteria();
    $c->add(WMGroupPeer::ID, $group_ids, Criteria::IN);
    return WMGroupPeer::doSelect($c);   
  }

  public static function getByAccountId($account_id)
  {
    $c = new Criteria();
    $c->add(WMGroupPeer::ACCOUNT_ID, $account_id);
    return WMGroupPeer::doSelect($c);   
  }
}
