<?php

/**
 * Subclass for representing a row from the 'wm_group' table.
 *
 * 
 *
 * @package lib.model
 */ 
class WMGroup extends BaseWMGroup
{
  private $transcient_group_items; // hack! store group items without fetching from/storing to DB
  
  public function __construct() 
  {
    $this->transcient_group_items = array();  
  }
  
  public static function getSampleData() 
  {
    $group = new WMGroup();
    $group->setName('SAMPLE');
    $group_item = new WMGroupItem();
    $group_item->setValue('PREVIEW');
    $group->addWMGroupItem($group_item);
    $group->addTranscientWMGroupItem($group_item);

    return $group;    
  }
  
  public function addTranscientWMGroupItem($v) 
  {
    $this->transcient_group_items[] = $v;
  }
  
  public function getTranscientWMGroupItems()
  {
    return $this->transcient_group_items;
  }
}
