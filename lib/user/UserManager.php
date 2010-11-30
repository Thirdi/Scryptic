<?php
class UserManager
{
  /**
   * Activates user account. Precond: activation code has been verified.
   */
  public static function activateAccount($email, $activation_code)
  {
    $email = trim($email);
    $activation_code = trim($activation_code);

    $result = false;
    $logger = Util::getLogger();

    $user = sfGuardUserProfilePeer::findByEmail($email);
    if ($user != null && strcasecmp($user->getEmail(), $email) == 0)
    {
      $result = ActivationCodeManager::verifyActivationCode($user->getAccountId(), $activation_code);
      if ($result)
      {
        $user->enableAccount();
        try
        {
          ActivationCodeManager::markVerified($activation_code);
        }
        catch (Exception $e)
        {
          $logger->warning('Error marking activation code "'.$activation_code.'" as verified: '.$e-getMessage());
        }
      }
    }
    else
    {
      $logger->info('Cannot locate user with email=`'.$email.'` to activate account');
    }

    return $result;
  }

  /**
   * Run through the use case of signing up a new user.
   *
   * @return User object that was created
   */
  public static function signupNewUser($request)
  {
    $conn = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME);
    $logger = Util::getLogger();

    try
    {
      $conn->begin();

 	  $account_id = InputHelper::sanitize(trim($request->getParameter('account_id')));
 	  if (empty($account_id) || !is_numeric($account_id))
 	  {
 	    $account = new Account();
 	    $account->save($conn);

 	    $account_id = $account->getId();
 	  }

      $email = InputHelper::sanitize(trim($request->getParameter('email')));
      $password = trim($request->getParameter('password'));

      // create SF guard user
      $sf_guard_user = new sfGuardUser();
      $sf_guard_user->setUsername($email);
      $sf_guard_user->setPassword($password);
      $sf_guard_user->setCreatedAt('NOW');
      $sf_guard_user->setIsActive(0);
      $sf_guard_user->setIsSuperAdmin(0);
      $sf_guard_user->save($conn);

      // user account
      $user = new sfGuardUserProfile();
      $user->setAccountId($account_id);
      $user->setFirstName(InputHelper::sanitize(trim($request->getParameter('first_name'))));
      $user->setLastName(InputHelper::sanitize(trim($request->getParameter('last_name'))));
      $user->setForcePasswordChange(InputHelper::sanitize(trim($request->getParameter('force_password_change', false))));
      $user->setUserId($sf_guard_user->getId());
      $user->save($conn);
      $user->setSfGuardUser($sf_guard_user);

      self::setUserPermissions($user->getSfGuardUser(), $request, $conn);

      $conn->commit();
    }
    catch (Exception $e)
    {
      $logger->info('Error signing up new user:'.$e->getMessage().'. Rollback!');
      $conn->rollback();
      throw $e;
    }

    self::sendActivationEmail($user, $password);

    return $user;
  }

  /**
   * Send activation email to user. Note: this method does not throw any exception since account
   * has already been created successfully. User must read email + click link before they can login.
   */
  private static function sendActivationEmail(&$user, $password)
  {
    $logger = Util::getLogger();

    $email = $user->getSfGuardUser()->getUsername();
    try
    {
      $ac = ActivationCodeManager::requestActivationCode($user->getAccountId(), $email);
      if ($ac == null)
      {
        $logger->warning('ActivationCode object should not be NULL!');
        return;
      }
    }
    catch (Exception $e)
    {
      $logger->warning('Error requesting account activation code. Reason: '. $e->getMessage().'. Abort sending welcome email.');
      return;
    }

    $activation_code = $ac->getCode();

    $activation_email = new ActivationEmail($email, $password, $activation_code);
    try
    {
      $activation_email->send();
    }
    catch (Exception $e)
    {
      $logger->err('Error sending welcome email to '.$email.'. Reason: '.$e->getMessage());
    }
  }

  public static function resetPassword($sf_guard_username)
  {
    // get user
    $c = new Criteria();
    $c->add(sfGuardUserPeer::USERNAME, $sf_guard_username);

    $guardUser = sfGuardUserPeer::doSelectOne($c);
    if ($guardUser == null)
    {
      throw new UserNotFoundException("Cannot reset the password of a user that does not exist. Username: '".$sf_guard_username."'");
    }

    $password = self::generatePassword();

    // update new password
    $guardUser->setPassword($password);
    $guardUser->save();

    $text = "As requested, we have reset your password. Your new password is:\n";
    $text .= "  ".$password."\n";
    $text .= "\n\n";

    $email = new Email();
    $email->setAddress($guardUser->getUsername());
    $email->setSender(sfConfig::get('app_admin_email'), sfConfig::get('app_admin_name'));
    $email->setSubject('Password Reset');
    $email->setBody($text);
    $email->send();
  }

  private static function generatePassword()
  {
    // create random password
    $length = 10;
    $password = '';
    $pool   = 'abcdefghijklmnopqrstuvwzyzABCDEFGHIJKLMNOPQRSTUVWZYZ0123456789';
    for ($i = 1; $i <= $length; $i++)
    {
      $password .= substr($pool, rand(0, 61), 1);
    }
    return $password;
  }

  public static function changePassword($user_id, $new_password)
  {
    $user = sfGuardUserProfilePeer::retrieveByPk($user_id);
    if ($user)
    {
      $guardUser = $user->getsfGuardUser();
      $guardUser->setPassword($new_password);
      $guardUser->save();
    }
    else
    {
      throw new Exception('User not found');
    }
  }

  public static function updateUser($request)
  {
    $user_id = $request->getParameter('user_id');
    if (empty($user_id))
    {
      $password = self::generatePassword();
      $request->setParameter('password', $password);
      $request->setParameter('force_password_change', true);
      UserManager::signupNewUser($request);
    }
    else
    {
      self::updateUser2($user_id, $request);
    }
  }

  private static function updateUser2($user_id, $request)
  {
    $conn = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME);
    try
    {
      $conn->begin();

      $user = sfGuardUserProfilePeer::retrieveByPK($user_id);
      if ($user) {
        $user->setFirstName($request->getParameter('first_name'));
        $user->setLastName($request->getParameter('last_name'));
        $user->getSfGuardUser()->setUsername($request->getParameter('email'));

        $password = trim($request->getParameter('password'));
        if (!empty($password))
        {
          $user->getSfGuardUser()->setPassword($password);
        }

        self::setUserPermissions($user->getSfGuardUser(), $request, $conn);
        $user->save($conn);
      }

      $conn->commit();
    }
    catch (Exception $e)
    {
      if ($conn != null)
      {
        $conn->rollback();
      }
      throw $e;
    }
  }

  public static function deleteUser($id)
  {
    $user = sfGuardUserProfilePeer::retrieveByPk($id);
    if ($user)
    {
      $user->setIsDeleted(1);
      $user->getSfGuardUser()->setIsActive(0);
      $old_username = $user->getSfGuardUser()->getUsername();
      $user->getSfGuardUser()->setUsername($id.'-deleted-'.$old_username); // RD-63 hack: make username unique so that another account with the same email address can be created
      $user->save();
    }
    else
    {
      throw new Exception('Unable to delete. User id='.$id.' not found');
    }
  }

  private static function setUserPermissions($guard_user, $request, $conn)
  {
    $perms = $guard_user->getsfGuardUserPermissionsJoinsfGuardPermission();
    $values = array();
    foreach ($perms as $perm)
    {
      $values[] = $perm->getsfGuardPermission()->getName();
    }

    $is_admin = $request->getParameter('is_admin');
    if ($is_admin == 'yes' && array_search('administrator', $values) === false)
    {
      // add missing credential
      $permission = sfGuardPermissionPeer::getByName('administrator');
      $user_permission = new sfGuardUserPermission();
      $user_permission->setPermissionId($permission->getId());
      $user_permission->setsfGuardUser($guard_user);
      $guard_user->addSfGuardUserPermission($user_permission);
      $user_permission->save($conn);
    }
    elseif ( $is_admin == 'no' && array_search('administrator', $values) !== false)
    {
      // remove credential
      foreach ($perms as $perm)
      {
        if ($perm->getsfGuardPermission()->getName() == 'administrator')
        {
          $perm->delete($conn);
        }
      }
    }
  }
}
?>
