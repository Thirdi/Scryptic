<?php

/**
 * user actions.
 *
 * @package    sf_sandbox
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class userActions extends sfActions
{
  public function executeActivate()
  {
    // check if the user is already logged in and redirect to the Print page
  	if ($this->getUser()->isAuthenticated()) 
  	{
  	  $this->redirect('@printpage');  	
  	}	
    
    $this->activated = false;
    $request = $this->getRequest();
    $activation_code = InputHelper::sanitize($request->getParameter('code'));
    $email = InputHelper::sanitize(trim($request->getParameter('email')));

    $this->email = $email;
    $this->code = $activation_code;

    try
    {
      $this->activated = UserManager::activateAccount($email, $activation_code);
      if ($this->activated)
      {
        // auto sign-in
        $guard_user = sfGuardUserPeer::retrieveByUsername($email);
        if ($guard_user)
        {
          $this->getUser()->signIn($guard_user);
        }
        
        // force password change
        if ($this->getUser()->isAuthenticated() && $this->getUser()->getProfile()->getForcePasswordChange() == 1)
        {
          $this->redirect('@force_password_change');
        }
      }
      return sfView::SUCCESS;
    }
    catch (Exception $e)
    {
      ExceptionLogger::log('Error activating user account email='.$email, $e);
      throw $e;
    }
  }
  
  public function executeForcePasswordChange()
  {
    $request = $this->getRequest();
    if ($request->getMethod() == sfRequest::POST)
    {
      $user_id = $this->getUser()->getProfile()->getId();
      $new_password = $request->getParameter('password');
      UserManager::changePassword($user_id, $new_password);
      $this->changed = true;
    }
    else
    {
      return sfView::SUCCESS;
    }
  }
  
  public function executeIndex() 
  {
    $user = $this->getUser()->getProfile();
    $this->users = sfGuardUserProfilePeer::findByAccountId($user->getAccountId());
    return sfView::SUCCESS;  
  }

  public function executeList() 
  {
    $user = $this->getUser()->getProfile();
    $users = array();
    try
    {
      $users = sfGuardUserProfilePeer::findByAccountId($user->getAccountId());
    } 
    catch (Exception $e) 
    {
      sfLogger::getInstance()->err('Error loading user list: '.$e->getMessage());  
    }
    $this->users = $users;
    
    if ($this->getRequest()->isXmlHttpRequest()) {
      $this->setLayout(false);
    }
  }
  
  public function executeDelete() 
  {
    $request = $this->getRequest();
    $response = array('success'=>false);
    
    try 
    {
      $this->authorizeUpdateRequest($request);

      $id = $request->getParameter('id');
      
      // RD-63:
      $curr_user_id = $this->getUser()->getProfile()->getId();
      if ($curr_user_id != $id) {
        UserManager::deleteUser($id);
        $response['success'] = true;
      }
    } 
    catch (Exception $e)
    {
      sfLogger::getInstance()->err('Error deleting user: '.$e->getMessage());
    }
    $this->renderText(json_encode($response));
    return sfView::NONE;
  }

  public function executeEdit() 
  {
    $request = $this->getRequest();
    $id = $request->getParameter('id');
    $user = sfGuardUserProfilePeer::retrieveByPK($id);
    
    // make sure person editing user is under the same account
    $this->authorizeUpdateRequest($request);
    $curr_user = $this->getUser()->getProfile();

    $this->setUserFieldsInRequest($user, $request);
    
    return sfView::SUCCESS;
  }
  
  private function setUserFieldsInRequest($user, $request) 
  {
    $request->setParameter('user_id', $user->getId());
    $request->setParameter('first_name', $user->getFirstName());
    $request->setParameter('last_name', $user->getLastName());
    $request->setParameter('email', $user->getSfGuardUser()->getUsername());
    $request->setParameter('old_email', $user->getSfGuardUser()->getUsername());
    $user_perms = $user->getSfGuardUser()->getsfGuardUserPermissionsJoinsfGuardPermission();
    $is_admin = false;
    foreach ($user_perms as $user_perm)
    {
      if ($user_perm->getsfGuardPermission()->getName() == 'administrator')
      {
        $is_admin = true;
      }
    }
    $request->setParameter('is_admin', $is_admin ? 'yes' : 'no');
  }

  private function clearUserFieldsInRequest($request) 
  {
    $request->setParameter('first_name', '');
    $request->setParameter('last_name', '');
    $request->setParameter('email', '');
    $request->setParameter('old_email', '');
    $request->setParameter('is_admin', '');
  } 
   
  public function executeMyAccount() 
  {
    $user = $this->getUser()->getProfile();
    $request = $this->getRequest();
    if ($request->getMethod() == sfRequest::POST)
    {
      try
      {
        $request->setParameter('user_id', $user->getId());
        UserManager::updateUser($request);
      }
      catch (Exception $e)
      {
        sfLogger::getInstance()->log('Error updating my account: '.$e->getMessage().'. uid='.$user->getId());
        throw $e;
      }
      
      $this->redirect('@printpage');          
    }
    else
    {
      $this->setUserFieldsInRequest($user, $this->getRequest());
    }
  }
  
  public function handleErrorMyAccount() 
  {
    return sfView::SUCCESS;    
  }
  
  public function validateSignup() 
  {
    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      $overall_result = $this->validateEverything();
  
      // robot
      $result = $this->validateRobot();
      if (!$result)
      {
        $overall_result = false;        
      }
  
      // password
      $result = $this->validatePassword();
      if (!$result)
      {
        $overall_result = false;
      }
        
      return $overall_result;
    }
    else
    {
      return true;
    }
  }
  
  private function validateRobot()
  {
    $validators = UserInfoValidatorFactory::getRobotValidators();
    $validator = $validators['robotValidator'];
    $v = $this->getRequestParameter('validate');
    $error = '';
    $result = $validator->execute($v, $error);
    if (!$result)
    {
      $this->getRequest()->setError('validate', $error);
      return false;
    }
    
    return true;
  }
  
  public function validateMyAccount()
  {
    $overall_result = $this->validateEverything();
    
    // password
    $password = $this->getRequestParameter('password');
    if (!empty($password)) 
    {
      $result = $this->validatePassword();
      if (!$result)
      {
        $overall_result = false;
      }  
    }

    return $overall_result;
  }
  
  private function validateEverything()
  {
    $overall_result = true;
    $request = $this->getRequest();
    if ($request->getMethod() == sfRequest::POST) 
    {
      // first and last name
      $result = $this->validateFirstLastName();
      if (!$result) {
        $overall_result = false;
      }

      // email
      $result = $this->validateEmail();
      if (!$result) {
        $overall_result = false;
      }
    }
    
    return $overall_result;
  }
  
  /**
   * Handle user add and edit.
   */
  public function executeUpdate() 
  {
    $request = $this->getRequest();
  
    // update...  
    $this->authorizeUpdateRequest($request);
    $curr_user = $this->getUser()->getProfile();
    
    $request->setParameter('account_id', $curr_user->getAccountId());
    UserManager::updateUser($request);
    
    // clear fields ...
    $this->clearUserFieldsInRequest($request);
    
    if ($request->isXmlHttpRequest()) 
    {
      return sfView::NONE;
    }
    else 
    {
      $this->forward('user', 'index');
    }
  }
  
  private function authorizeUpdateRequest($request) {
    $curr_user = $this->getUser()->getProfile();
    $user = sfGuardUserProfilePeer::retrieveByPk($request->getParameter('user_id'));
    if (!empty($user) && $curr_user->getAccountId() != $user->getAccountId()) {
      throw new Exception('Unauthorized request');
    }
  }
  
  public function handleErrorUpdate() 
  {
    if ($this->getRequest()->isXmlHttpRequest()) 
    {
      $this->setLayout(false);
    }
    else
    {
      // RD-4: work around
      $this->setTemplate('edit');
    } 
    return sfView::SUCCESS;
  }

  public function validateUpdate() 
  {
    $result = $this->validateFirstLastName();
    if (!$result) {
      return false;
    }

    $result = $this->validateEmail();
    if (!$result) {
      return false;
    } 
    
    return true;
  }
  
  public function handleErrorForcePasswordChange()
  {
    return sfView::SUCCESS;
  }
  
  public function validateForcePasswordChange()
  {
    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      return $this->validatePassword();
    }
    else
    {
      return true;
    }
  }
  
  private function validateFirstLastName() 
  {
    $request = $this->getRequest();
    $error = '';
    $validators = UserInfoValidatorFactory::getFirstNameValidators();
    $result = true;
    $fname = $request->getParameter('first_name');
    foreach ($validators as $v) 
    {
      $result = $v->execute($fname, $error);
      if (!$result) {
        $request->setError('first_name', $error);
        $result = false;
      }
    }
    
    $validators = UserInfoValidatorFactory::getLastNameValidators();
    $lname = $request->getParameter('last_name');
    foreach ($validators as $v) 
    {
      $result = $v->execute($lname, $error);
      if (!$result) {
        $request->setError('last_name', $error);
        $result = false;
      }
    }
    
    return $result;
  }
  
  private function validateEmail() 
  {
    $request = $this->getRequest();
    $result = false;
    $error = '';
    
    // check email
    $old_email = $request->getParameter('old_email');
    $email = trim($request->getParameter('email'));

    $validators = UserInfoValidatorFactory::getEmailValidators();
    $v3 = $validators['sfStringValidator'];      
    $result = $v3->execute($email, $error);
    if (!$result) { 
      $request->setError('email', $error);
      return false;
    }

    if (empty($old_email) || $old_email != $email) { 
      // skip email validation
      $v1 = $validators['sfEmailValidator'];      
      $result = $v1->execute($email, $error);
      if (!$result) {
        $request->setError('email', $error);
        return false;
      }
      
      $v2 = $validators['uniqueEmailValidator'];      
      $result = $v2->execute($email, $error);
      if (!$result) {
        $request->setError('email', $error);
        return false;
      }
    }
    
    return true;  
  }
  
  private function validatePassword() 
  {
    $request = $this->getRequest();
    $result = false;
    $error = '';
    
    $password = $request->getParameter('password');
    $password_confirm = $request->getParameter('password_confirm');

    $ctx = sfContext::getInstance(); 
    $params = new sfParameterHolder();

    $empty_fields = false;
    $validators = UserInfoValidatorFactory::getPasswordValidators();
    $v3 = $validators['stringValidator'];
    $result = $v3->execute($password, $error);
    if (!$result) { 
      $request->setError('password', $error);
      $empty_fields = true;
    }

    $validators = UserInfoValidatorFactory::getPasswordConfirmValidators();
    $v1 = $validators['stringValidator'];
    $result = $v1->execute($password_confirm, $error);
    if (!$result) { 
      $request->setError('password_confirm', $error);
      $empty_fields = true;
    }
    if ($empty_fields) {
      // stop pwd validation now
      return false;
    }
    
    $v1 = $validators['sfCompareValidator'];
    $result = $v1->execute($password_confirm, $error);
    if (!$result) { 
      $request->setError('password_confirm', $error);
      return false;
    }
    
    return true;  
  }
  
  public function executeSignout()
  {
    $this->forward('sfGuardAuth','signout');
  }

  public function executeSignup()
  {
    // check if the user is already logged in and redirect to the Print page
  	if ($this->getUser()->isAuthenticated()) 
  	{
  	  $this->redirect('@printpage');  	
  	}	
  	
    $request = $this->getRequest();
    $user = $this->getUser();	
    
    if ($request->getMethod() == sfRequest::POST)
    {
   	  try
      {		
        $request->setParameter('is_admin', 'yes');
        $new_user = UserManager::signupNewUser($request);
      }
      catch (Exception $e)
      {
        $this->logMessage("User signup failed: ".$e->getMessage(), 'err');
        return sfView::ERROR;
      }
      $user_id = $new_user->getId();
        
      if ($user->isAuthenticated())
      {
        return $this->redirect('user/pokerrooms');
      }
      else
      {
        return $this->redirect('user/signupsuccess');
      }
    }
  }
  
  public function executeSignupsuccess()
  {
  	// check if the user is already logged in and redirect to the Print page
  	if ($this->getUser()->isAuthenticated()) 
  	{
  	  $this->redirect('@printpage');  	
  	}	
  }
  
  public function handleErrorSignup()
  {
    return sfView::SUCCESS;
  }  
  
}
