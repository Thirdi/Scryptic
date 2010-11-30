<?php

/**
 * Subclass for representing a row from the 'print_configuration' table.
 *
 * 
 *
 * @package lib.model
 */ 
class PrintConfiguration extends BasePrintConfiguration
{
  /**
   * @return colour as an decimal array of indexed by 'r', 'g', 'b' (like 255, 255, 255)
   */
  public function getColourRGB()
  {
    // assume colour is stored as hex string RRGGBB
    $hex = $this->getColour();
    $hex = str_replace('#', '', $hex);
    $rgb = array();
    $rgb['r'] = hexdec($hex[0].$hex[1]);
    $rgb['g'] = hexdec($hex[2].$hex[3]);
    $rgb['b'] = hexdec($hex[4].$hex[5]);
    return $rgb;
  }
  
  public function setFields($request) 
  {
    $this->setId($request->getParameter('id'));
    $this->setLayoutId($request->getParameter('layout_id') ? $request->getParameter('layout_id') : null);
    $this->setFontId($request->getParameter('font_id') ? $request->getParameter('font_id') : null);
    $this->setSize($request->getParameter('size'));
    $this->setColour($request->getParameter('color'));
    $this->setOpacity($request->getParameter('amount'));
    $this->setWatermarkImageId($request->getParameter('watermark_image_id') ? $request->getParameter('watermark_image_id') : null);
  }
  
  public static function getDefaultConfiguration() 
  {
    $pc = new PrintConfiguration();
    $pc->setLayoutId(1);
    $pc->setFontId(1);
    $pc->setSize(20);
    $pc->setColour('ff0000');
    $pc->setOpacity(50);
    return $pc;  
  }
}
