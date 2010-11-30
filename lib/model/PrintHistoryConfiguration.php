<?php

/**
 * Subclass for representing a row from the 'print_history_configuration' table.
 *
 * 
 *
 * @package lib.model
 */ 
class PrintHistoryConfiguration extends BasePrintHistoryConfiguration
{
  /**
   * Creates a new instance of PrintHistoryConfiguration object from an existing PrintConfiguration object.
   */
  public static function createFromPrintConfig($pc) 
  {
    $phc = new PrintHistoryConfiguration();
    $phc->setLayoutId($pc->getLayoutId());
    $phc->setFontId($pc->getFontId());
    $phc->setOpacity($pc->getOpacity());
    $phc->setColour($pc->getColour());
    $phc->setSize($pc->getSize());
    return $phc;
  }
}
