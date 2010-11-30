<?php

/**
 * Subclass for performing query and update operations on the 'file' table.
 *
 * 
 *
 * @package lib.model
 */ 
class FilePeer extends BaseFilePeer
{
  public static function getByFileIdAccountId($file_id, $account_id) 
  {
    $c = new Criteria();
    $c->addJoin(FilePeer::USER_ID, sfGuardUserProfilePeer::ID);
    $c->add(FilePeer::ID, $file_id);
    $c->add(sfGuardUserProfilePeer::ACCOUNT_ID, $account_id);
    $c->add(FilePeer::DELETED_AT, null, Criteria::ISNULL);
    return FilePeer::doSelectOne($c);      
  }

  public static function getByFileIdUserId($file_id, $user_id) 
  {
    $c = new Criteria();
    $c->add(FilePeer::ID, $file_id);
    $c->add(FilePeer::USER_ID, $user_id);
    $c->add(FilePeer::DELETED_AT, null, Criteria::ISNULL);
    return FilePeer::doSelectOne($c);      
  }
  
  public static function getByUserId($user_id)
  {
    $c = new Criteria();
    $c->add(FilePeer::USER_ID, $user_id);
    $c->add(FilePeer::DELETED_AT, null, Criteria::ISNULL);
    return FilePeer::doSelect($c);      
  }
}
