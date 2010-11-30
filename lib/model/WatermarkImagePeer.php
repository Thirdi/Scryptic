<?php

/**
 * Subclass for performing query and update operations on the 'watermark_image' table.
 *
 * 
 *
 * @package lib.model
 */ 
class WatermarkImagePeer extends BaseWatermarkImagePeer
{
  public static function findByAccountId($account_id)
  {
    $c = new Criteria();
    $c->add(WatermarkImagePeer::ACCOUNT_ID, $account_id);
    $c->add(WatermarkImagePeer::IS_DELETED, 0);
    return WatermarkImagePeer::doSelect($c);
  }
  
  public static function findByName($name)
  {
    $c = new Criteria();
    $c->add(WatermarkImagePeer::IMAGE_NAME, $name);
    $c->add(WatermarkImagePeer::IS_DELETED, 0);
    return WatermarkImagePeer::doSelectOne($c);
  }
}
