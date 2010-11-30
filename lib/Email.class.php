<?php
/*
 * Send an email with symfony mail via sfEmail plugin.
 *
 * Overrides email destination on non-production environment
 *
 */
class Email
{
  private
    $mail = null,
    $addresses = array();

  public function __construct()
  {
    $this->mail = new sfEmail();
    $this->mail->initialize();
    $this->mail->setMailer('sendmail');
    $this->mail->setCharset('utf-8');
  }

  // adds a destination
  public function setAddress($email)
  {
    $this->mail->addAddress($email);
    $this->addresses[$email] = true;
  }

  public function addAddress($email)
  {
    $this->mail->addAddress($email);
    $this->addresses[$email] = true;
  }

  public function setSender($email, $name)
  {
    // set required parameters
    $this->mail->setSender($email, $name);
    $this->mail->setFrom($email, $name);
  }

  public function setSubject($subject)
  {
    $this->mail->setSubject($subject);
  }

  public function setBody($text)
  {
    $this->mail->setBody($text);
  }

  // send the email
  public function send()
  {
    $logger = sfContext::getInstance()->getLogger();

    $site_environent = sfConfig::get('app_site_environment');
    if (!$site_environent)
    {
      throw new Exception("app_site_environment is not defined");
    }
    if ($site_environent != 'PRODUCTION')
    {
      $addresses_str = implode(', ', array_keys($this->addresses));

      $override_email = sfConfig::get('app_override_email');
      if (empty($override_email))
      {
        throw new Exception('app_override_email is not defined');
      }
      $logger->err("Email override is on, would have sent to: ".$addresses_str." actually sending to: ".$override_email);
      $this->mail->clearAddresses();
      $this->setAddress($override_email);
    }

    // send the mail
    try
    {
      $this->mail->send();
    }
    catch (Exception $e)
    {
      // if the email failed to send, log error but continue
      $logger->err("Failed to send email: ".$e->getMessage());
    }
  }

  public function addEmbeddedImage($image, $cid, $alt, $encoding, $mimeType)
  {
    $this->mail->addEmbeddedImage($image, $cid, $alt, $encoding, $mimeType);
  }

  public function setContentType($type)
  {
    $this->mail->setContentType($type);
  }

  public function setAltBody($text)
  {
    $this->mail->setAltBody($text);
  }

  public function addAttachment($path, $name = '', $encoding = 'base64', $type = 'application/octet-stream')
  {
    $this->mail->addAttachment($path, $name, $encoding, $type);
  }
}
