<?php

/**
 * Subclass for representing a row from the 'sf_guard_user_profile' table.
 *
 * 
 *
 * @package lib.model
 */ 
class sfGuardUserProfile extends BasesfGuardUserProfile
{
  public function enableAccount()
  {
    $this->getsfGuardUser()->setIsActive(1);
    $this->getsfGuardUser()->save();
  }
  
  public function getEmail()
  {
    if ($this->getId() <= 0)
    {
      return '';
    }
    else
    {
      return $this->getSfGuardUser()->getUsername();
    }
  }
  
  public function getFullName()
  {
  	if ($this->getId() <= 0)
    {
      return '';
    }
    else
    {
      return $this->getFirstName().' '.$this->getLastName();
    }	
  }
  
  public function hasRole($role)
  {
    $role = strtolower($role);
    $user_perms = sfGuardUserPermissionPeer::getByUserId($this->getSfGuardUser()->getId());
    $has = false;
    foreach ($user_perms as $up)
    {
      $perm = $up->getsfGuardPermission();
      if (strtolower($perm->getName()) == $role)
      {
        $has = true;
        break;
      }
    }
    return $has;
  }
}
