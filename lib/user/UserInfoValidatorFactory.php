<?php
class UserInfoValidatorFactory 
{
  public static function getPasswordValidators()
  {
    $validators = array();

    $ctx = sfContext::getInstance(); 
    $params = new sfParameterHolder();

    $v3 = new stringValidator();
    $v3->initialize($ctx, $params);

    $cfg = sfConfig::get('app_user_validation_password');
    $v3->setParameter('min',          self::getValue($cfg, 'min', 4));
    $v3->setParameter('min_error',    self::getValue($cfg, 'min_error', 'The minimum password length is 4'));
    $v3->setParameter('required',     self::getValue($cfg, 'required', true));
    $v3->setParameter('required_msg', self::getValue($cfg, 'required_msg', 'Password is required'));
    
    $validators['stringValidator'] = $v3;

    return $validators;
  }  

  public static function getPasswordConfirmValidators()
  {
    $validators = array();

    $ctx = sfContext::getInstance(); 
    $params = new sfParameterHolder();

    $v3 = new stringValidator();
    $v3->initialize($ctx, $params);
    $cfg = sfConfig::get('app_user_validation_password_confirm');
    $v3->setParameter('required',     self::getValue($cfg, 'required', true));
    $v3->setParameter('required_msg', self::getValue($cfg, 'required_msg', 'Repeat password is required'));
    
    $validators['stringValidator'] = $v3;

    $v1 = new sfCompareValidator(); 
    $v1->initialize($ctx, $params);
    $v1->setParameter('check',         self::getValue($cfg, 'check', 'password'));
    $v1->setParameter('compare_error', self::getValue($cfg, 'compare_error', 'The two passwords do not match'));
    $validators['sfCompareValidator'] = $v1;
 
    return $validators;
  }  
  
  public static function getFirstNameValidators()
  {
    $validators = array();

    $ctx = sfContext::getInstance(); 
    $params = new sfParameterHolder();
      
    $v3 = new stringValidator();
    $v3->initialize($ctx, $params);
    $cfg = sfConfig::get('app_user_validation_first_name');
    $v3->setParameter('required',     self::getValue($cfg, 'required', true));
    $v3->setParameter('required_msg', self::getValue($cfg, 'required_msg', 'The first name field cannot be left blank'));
    $v3->setParameter('max',          self::getValue($cfg, 'max', 64));
    $v3->setParameter('max_error',    self::getValue($cfg, 'max_error', 'The first name field should be less than 64 characters'));
    $validators['sfStringValidator'] = $v3;
    
    return $validators;  
  } 
  
  public static function getLastNameValidators()
  {
    $validators = array();

    $ctx = sfContext::getInstance(); 
    $params = new sfParameterHolder();
      
    $v3 = new stringValidator();
    $v3->initialize($ctx, $params);
    $cfg = sfConfig::get('app_user_validation_last_name');
    $v3->setParameter('required',     self::getValue($cfg, 'required', true));
    $v3->setParameter('required_msg', self::getValue($cfg, 'required_msg', 'The last name field cannot be left blank'));
    $v3->setParameter('max',          self::getValue($cfg, 'max', 64));
    $v3->setParameter('max_error',    self::getValue($cfg, 'max_error', 'The last name field should be less than 64 characters'));
    $validators['sfStringValidator'] = $v3;
    
    return $validators;  
  }
  
  public static function getEmailValidators()
  {
    $validators = array();

    $ctx = sfContext::getInstance(); 
    $params = new sfParameterHolder();
      
    $v3 = new sfStringValidator();
    $cfg = sfConfig::get('app_user_validation_email');
    $v3->initialize($ctx, $params);
    $v3->setParameter('max',       self::getValue($cfg, 'max', 128));
    $v3->setParameter('max_error', self::getValue($cfg, 'max_error', 'The email address field should be less than 128 characters'));
    $validators['sfStringValidator'] = $v3;

    $v1 = new sfEmailValidator();
    $v1->initialize($ctx, $params);
    $v1->setParameter('email_error', self::getValue($cfg, 'email_error', 'The email address is invalid'));
    $validators['sfEmailValidator'] = $v1;

      
    $v2 = new uniqueEmailValidator();
    $v2->initialize($ctx, $params);
    $v2->setParameter('unique_email_error', self::getValue($cfg, 'unique_email_error', 'The email address is already taken'));
    $validators['uniqueEmailValidator'] = $v2;
    
    return $validators;  
  } 
  
  public static function getRobotValidators()
  {
    $validators = array();

    $ctx = sfContext::getInstance(); 
    $params = new sfParameterHolder();

    $validator = new robotValidator();
    $validator->initialize($ctx, $params);
    $cfg = sfConfig::get('app_user_validation_validate');
    $validator->setParameter('robot_error', self::getValue($cfg, 'robot_error', 'The validate field should not contain a value'));
    $validators['robotValidator'] = $validator;
    
    return $validators;
  }
  
  private static function getValue($values, $name, $default)
  {
    $v = array_key_exists($name, $values) ? $values[$name] : $default;
    return $v;
  }
}
?>
