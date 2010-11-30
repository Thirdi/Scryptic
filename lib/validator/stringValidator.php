<?php
/**
 * Extends symfony's string validator by allowing the caller to specify "required" and "required_msg"
 * programmatically.
 */
class stringValidator extends sfStringValidator
{
  public function initialize($context, $parameters = null)
  {
    // Initialize parent
    parent::initialize($context);

    $this->setParameter('required', true);
    $this->setParameter('required_msg', 'Required');

    return true;
  }

  public function execute(&$value, &$error)
  {
    if ($this->getParameter('required') && empty($value)) 
    {
      $error = $this->getParameter('required_msg');
      return false;
    }
    
    return parent::execute($value, $error);
  }
}
?>
