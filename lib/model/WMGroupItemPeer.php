<?php

/**
 * Subclass for performing query and update operations on the 'wm_group_item' table.
 *
 * 
 *
 * @package lib.model
 */ 
class WMGroupItemPeer extends BaseWMGroupItemPeer
{
  public static function getByAccountIdAndIds($account_id, $group_item_ids) 
  {
    $c = new Criteria();
    $c->add(WMGroupPeer::ACCOUNT_ID, $account_id);
    $c->addJoin(WMGroupPeer::ID, WMGroupItemPeer::WM_GROUP_ID);
    $c->add(WMGroupItemPeer::ID, $group_item_ids, Criteria::IN);
    return WMGroupItemPeer::doSelect($c);
  }
}
