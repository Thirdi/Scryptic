<?php
class ActivationEmail
{
  private $email_address;

  const ACTIVATION_EMAIL_SUBJECT_KEY = 'ACTIVATION_EMAIL_SUBJECT';
  const ACTIVATION_EMAIL_CONTENT_KEY = 'ACTIVATION_EMAIL_CONTENT';
  const ACCOUNT_ACTIVATION_URL_KEY = 'ACCOUNT_ACTIVATION_URL';
  const EMAIL_ADDRESS_KEY = 'EMAIL_ADDRESS';
  const PASSWORD_KEY = 'PASSWORD';

  function __construct($email, $password, $code)
  {
    $this->email_address = $email;
    $this->password = $password;
    $this->activation_code = $code;

    // so we can use url_for
    sfLoader::loadHelpers(array('Url', 'Tag'));
  }

  public function send()
  {
    $logger = sfContext::getInstance()->getLogger();
    $activate_link = url_for('user/activate', $absolute = true).'?code=CODE&email=EMAIL';
    $activate_link = str_replace('CODE', $this->activation_code, $activate_link);
    $activate_link = str_replace('EMAIL', $this->email_address, $activate_link);


    $configs = $this->loadConfig();

    $config_email_content = $configs[self::ACTIVATION_EMAIL_CONTENT_KEY];
    if ($config_email_content == NULL)
    {
      throw new Exception('Cannot retrieve configuration for welcome email content. Key='.self::ACTIVATION_EMAIL_CONTENT_KEY);
    }
    $text = $config_email_content->getConfigurationValue();
    $text = str_replace(self::ACCOUNT_ACTIVATION_URL_KEY, $activate_link, $text);
    $text = str_replace(self::EMAIL_ADDRESS_KEY, $this->email_address , $text);
    $text = str_replace(self::PASSWORD_KEY, $this->password , $text);


    $subject = 'Welcome!';
    $config_email_subject = $configs[self::ACTIVATION_EMAIL_SUBJECT_KEY];
    if ($config_email_subject != NULL)
    {
      $subject = $config_email_subject->getConfigurationValue();
    }

    $admin_email = sfConfig::get('app_admin_email');

    $logger->debug('Email text: '.$text);
    $email = new Email();
    $email->setAddress($this->email_address);
    $email->setSender($admin_email, "Administrator");
    $email->setContentType('text/html');
    $email->setSubject($subject);
    $email->setBody($text);
    $email->setAltBody($text);
    $email->send();
  }

  /**
   * Loads config from database. Returns a map of config key to config object.
   */
  private function loadConfig()
  {
    $keys = array(self::ACTIVATION_EMAIL_CONTENT_KEY,
                  self::ACTIVATION_EMAIL_SUBJECT_KEY);
    $values = ConfigurationPeer::findByConfigurationKeys($keys);
    $map = array();
    foreach ($values as $val)
    {
      $map[$val->getConfigurationKey()] = $val;
    }
    return $map;
  }
}
?>
