<?php

/**
 * home actions.
 *
 * @package    sf_sandbox
 * @subpackage home
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class homeActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {  
  	$user = $this->getUser();
  	
  	// check if the user is already logged in and redirect to the Print page
  	if ($user->isAuthenticated()) 
  	{
  	  $this->redirect('@printpage');  	
  	}	
  	
  }
}
