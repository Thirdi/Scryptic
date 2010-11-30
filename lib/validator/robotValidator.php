<?php
/*
 * Checks if the validate input field has text.
 * As this field is cloaked with CSS, this should not contain a value and is likely a robot.
 *
 * @author     Matt Friesen <mfriesen@thirdi.com>
 * @version    1.0 - Feb 11, 2009
 */
class robotValidator extends sfValidator
{
  protected
    $user_id = 0,
    $reverse_error = false;

  public function initialize($context, $parameters = null)
  {
    // Initialize parent
    parent::initialize($context);

    // Set default parameters value
    $this->setParameter('robot_error', 'Robot Alert! The validate field should be blank');

    // Set parameters
    $this->getParameterHolder()->add($parameters);

    return true;
  }

  public function execute(&$value, &$error)
  {
    
    if (!empty($value))
    {
        $error = $this->getParameter('robot_error');
        return false;
      
    }

    return true;
  }
}
