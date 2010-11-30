<?php

/**
 * Subclass for representing a row from the 'print_history_group' table.
 *
 * 
 *
 * @package lib.model
 */ 
class PrintHistoryGroup extends BasePrintHistoryGroup
{
  public function getGroupItemsAsString($delimiter = ',')
  {
    $items = $this->getPrintHistoryGroupItems();
    $vals = array();
    foreach ($items as $item)
    {
      $vals[] = $item->getValue();
    }
    return implode($delimiter, $vals);
  }
}
