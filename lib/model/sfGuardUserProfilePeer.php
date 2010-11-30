<?php

/**
 * Subclass for performing query and update operations on the 'sf_guard_user_profile' table.
 *
 * 
 *
 * @package lib.model
 */ 
class sfGuardUserProfilePeer extends BasesfGuardUserProfilePeer
{
  public static function findByEmail($email)
  {
    $c = new Criteria();
    $c->add(sfGuardUserPeer::USERNAME, $email);
    $c->setIgnoreCase(true);
    $user =  sfGuardUserProfilePeer::doSelectJoinsfGuardUser($c);
    if (isset($user[0]))
    {
      return $user[0];
    }
    return null;
  }
  
  public static function findByAccountId($account_id)
  {
    $c = new Criteria();
    $c->add(sfGuardUserProfilePeer::ACCOUNT_ID, $account_id);
    $c->add(sfGuardUserProfilePeer::IS_DELETED, 0);
    return sfGuardUserProfilePeer::doSelect($c);  
  }
}
