<?php

/**
 * Subclass for representing a row from the 'account' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Account extends BaseAccount
{
  const TYPE_TRIAL = '0';
  const TYPE_PAID = '1';
  
  public function __toString() {
    return 'Account object';
  }
}
