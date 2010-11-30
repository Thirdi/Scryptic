<?php
require_once(sfConfig::get('sf_plugins_dir').'/sfGuardPlugin/modules/sfGuardAuth/lib/BasesfGuardAuthActions.class.php');

/**
 * sfGuardAuth actions.
 *
 * @package    sf_sandbox
 * @subpackage sfGuardAuth
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class sfGuardAuthActions extends BasesfGuardAuthActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $this->forward('default', 'module');
  }

  public function executeRequestPassword()
  {
    $email = InputHelper::sanitize(trim($this->getRequestParameter('username')));
    if ($this->getRequest()->getMethod() != sfRequest::POST)
    {
      return sfView::SUCCESS;
    }
    else
    {
      try
      {
        UserManager::resetPassword($email);
      }
      catch (UserNotFoundException $e)
      {
        $this->getRequest()->setError("username","No account with email address <strong>$email</strong> was found");
        return sfView::SUCCESS;
      }
      catch (Exception $e)
      {
        sfLogger::getInstance()->err('Error resetting user password: '.$e->getMessage());
        throw $e;
      }

      $this->redirect('@sf_guard_password_sent');
    }
  }

  public function handleErrorRequestPassword()
  {
    return sfView::SUCCESS;
  }

  public function executePasswordSent()
  {
    return sfView::SUCCESS;
  }
}
