<?php
/**
 * This class generates random alphanumeric strings to be used as account activation code.
 */
class ActivationCodeManager
{
  /**
   * Deletes an activation code from the system.
   */
  public static function deleteActivationCode($activation_code)
  {
    $activation_code = trim($activation_code);
  	$c = new Criteria();
    $c->add(ActivationCodePeer::CODE, $activation_code);
    ActivationCodePeer::doDelete($c);
  }

  /**
   * Marks an activation code verified.
   */
  public static function markVerified($activation_code)
  {
    $activation_code = trim($activation_code);
    
    $logger = Util::getLogger();
    $logger->debug('verifying code='.$activation_code);
    
    $c = new Criteria();
    $c->add(ActivationCodePeer::CODE, $activation_code);
    $ac = ActivationCodePeer::doSelectOne($c);
    if ($ac != NULL)
    {
      $ac->setVerifiedAt('NOW');
      $ac->save();
    }
  }

  /**
   * Returns an instance of ActivationCode object.
   */
  public static function requestActivationCode($account_id, $email)
  {
    $ac = new ActivationCode();
    $ac->setAccountId($account_id);
    $ac->setCreatedAt('NOW');
    $ac->setCode(self::generateCode($email));
    $ac->save();
    
    return $ac;
  }
  
  public static function verifyActivationCode($account_id, $activation_code)
  {
    $activation_code = trim($activation_code);

    $logger = Util::getLogger();
    $logger->debug('Verifying activation code for account id='.$account_id.' with code='.$activation_code);
    
    $result = false;
    $c = new Criteria();
    $c->add(ActivationCodePeer::CODE, $activation_code);
    $c->add(ActivationCodePeer::ACCOUNT_ID, $account_id);
    $ac = ActivationCodePeer::doSelectOne($c);
    if ($ac != NULL)
    {
      // activation code can only be used once to prevent malicious users from enabling banned accounts 
      // through account activation email.
      if ($ac->getVerifiedAt() == NULL)
      {
        $result = true;
      }
      else
      {
      	$logger->info('Account id='.$account_id.' attempted to re-activate account.');
      }
    }   	

    return $result;
  }
  
  private static function generateCode($seed = '')
  {
    $salt = time();
    $hash_algorithm = 'sha256';
    
    $result = hash_hmac($hash_algorithm, $seed, $salt);
    if ($seed == '')
    {
    	$result = hash_hmac($hash_algorithm, $result, $salt);
    }
    
    return $result;
  }
}
?>
