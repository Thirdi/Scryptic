<?php
require_once 'autoloadmagic.php';

class WatermarkManagerTest extends PHPUnit_Framework_TestCase {

//  public function testCreate_TopBottomLayout() {
//    $config = $this->getPrintConfig(1);
//    $group_items = $this->getGroupItems();
//    $wm_manager = new WatermarkManager($config, 'manuale_eng.pdf');
//    $wm_manager->createPdfUsingGroupItems($group_items);    
//  } 

  public function testCreate_TopBottomLayout() {
    $config = $this->getPrintConfig(2);
    $group_items = $this->getGroupItems();
    $wm_manager = new WatermarkManager($config, 'manuale_eng.pdf');
    $wm_manager->createPdfUsingGroupItems($group_items);    
  } 
  
  private function getPrintConfig($layout_id) {
    $config = new PrintConfiguration();
    $config->setLayoutId($layout_id);
    return $config;
  }

  private function getGroupItems() {
    $group = new WMGroup();
    $group->setId(100);
    $group->setName('GroupName');
    
    $group_items = array();
    for($i=0; $i<2; $i++) {
      $group_item = new WMGroupItem();
      $group_item->setWMGroup($group);
      $group_item->setWmGroupId($group->getId());
      $group_item->setValue('GroupItem value '.$i);
      $group_items[] = $group_item;
    }
    
    return $group_items;
  }
}  
?>
