<?php

/**
 * Subclass for performing query and update operations on the 'configuration' table.
 *
 * 
 *
 * @package lib.model
 */ 
class ConfigurationPeer extends BaseConfigurationPeer
{
  public static function findByConfigurationKey($key)
  {
    $c = new Criteria();
    $c->add(ConfigurationPeer::CONFIGURATION_KEY, $key);
    return ConfigurationPeer::doSelectOne($c);
  }

  public static function findByConfigurationKeys($keys)
  {
    $c = new Criteria();
    $c->add(ConfigurationPeer::CONFIGURATION_KEY, $keys, Criteria::IN);
    return ConfigurationPeer::doSelect($c);
  }
}
