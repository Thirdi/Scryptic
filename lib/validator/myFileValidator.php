<?php
class myFileValidator extends sfFileValidator
{
  public function execute(&$value, &$error)
  {
    $mime_check = $this->mimeCheck($value, $error);
    if (!$mime_check)
    {
      return false;
    }
    
    return parent::execute($value, $error);
  }

  public function initialize($context, $parameters = null)
  {
    parent::initialize($context, $parameters);
  }
  
  private function mimeCheck(&$value, &$error)
  {
    $mime_type = FileManager::getMimeType(sfContext::getInstance()->getRequest());
    $mime_types = $this->getParameter('mime_types');
    if ($mime_type == null || ($mime_types !== null && !in_array($mime_type, $mime_types)))
    {
      $error = $this->getParameter('mime_types_error');
      return false;
    }
    return true;
  }
}
?>
