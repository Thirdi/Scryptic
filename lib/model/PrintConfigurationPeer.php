<?php

/**
 * Subclass for performing query and update operations on the 'print_configuration' table.
 *
 * 
 *
 * @package lib.model
 */ 
class PrintConfigurationPeer extends BasePrintConfigurationPeer
{
  public static function getLatestByAccountId($account_id) 
  {
    $c = new Criteria();
    $c->add(PrintConfigurationPeer::ACCOUNT_ID, $account_id);
    $c->addDescendingOrderByColumn(PrintConfigurationPeer::CREATED_AT);
    $c->setLimit(1);
    return PrintConfigurationPeer::doSelectOne($c);  
  }
}
