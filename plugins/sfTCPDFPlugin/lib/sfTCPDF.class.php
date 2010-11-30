<?php

/**
 * sfTCPDF class.
 *
 * This class provides an abstraction layer to the PHP TCPDF library
 * witch provides creation/modification of pdf files with UTF8 support
 * (it's an extension of the FPDF )
 *
 * @package    sfTCPDFPlugin
 * @author     Vernet Loïc aka COil <qrf_coil@yahoo.fr>
 * @link       http://sourceforge.net/projects/tcpdf/
 */

/**
 * Plugin
 */

class sfTCPDF extends TCPDF
{

  /**
   * Instantiate TCPDF lib
   *
   * @param string $orientation
   * @param string $unit
   * @param string $format
   * @param boolean $unicode
   * @param string $encoding
   */
  public function __construct($orientation = 'P', $unit = 'mm', $format = 'A4', $unicode = true, $encoding = "UTF-8")
  {
    parent::__construct($orientation, $unit, $format, $unicode, $encoding);
  }

  public function __destruct()
  {
  }

}