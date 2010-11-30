<?php
/*
 * Checks if an email address is already in the database,
 * excluding the current user (user_id)
 *
 * Optionally can supply a error_on_empty = true, and then the effect will
 * be reversed. This will validate FALSE if the email address does not exist
 *
 * @author     Mark Deepwell <mdeepwell@thirdi.com>
 * @version    1.2 - Jan 9, 2009
 */
class uniqueEmailValidator extends sfValidator
{
  protected
    $user_id = 0,
    $reverse_error = false;

  public function initialize($context, $parameters = null)
  {
    // Initialize parent
    parent::initialize($context);

    // Set default parameters value
    $this->setParameter('unknown_email_error', 'The email address is unknown');
    $this->setParameter('unique_email_error', 'The email address is already taken');

    // Set parameters
    $this->getParameterHolder()->add($parameters);

    // Ignore email address of user we are editing
    $this->user_id = $context->getRequest()->getParameter('user_id', 0);

    return true;
  }

  public function execute(&$value, &$error)
  {
    $c = new Criteria();
    $c->add(sfGuardUserPeer::USERNAME, trim($value));
    $c->add(sfGuardUserPeer::ID, $this->user_id, Criteria::NOT_EQUAL);
    $c->setIgnoreCase(true);
    $count = sfGuardUserPeer::doCount($c);


    if ($this->getParameter('error_on_empty', false))
    {
      if ($count == 0)
      {
        $error = $this->getParameter('unknown_email_error');
        return false;
      }
    }
    else // regular, error if email is already in database
    {
      if ($count > 0)
      {
        $error = $this->getParameter('unique_email_error');
        return false;
      }
    }

    return true;
  }
}
