<?php

/**
 * sample actions.
 *
 * @package    sf_sandbox
 * @subpackage sample
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class sampleActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    return sfView::SUCCESS;
  }
}
