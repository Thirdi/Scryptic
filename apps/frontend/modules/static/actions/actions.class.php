<?php
class staticActions extends sfActions
{
  public function executeIndex()
  {
    $this->forward('default', 'module');
  }

  public function executeDispatch() 
  {
    $page = $this->getRequestParameter('page');
    if (empty($page)) 
    {
      $this->redirect404($page.' not found');
    }
    else
    {
      $this->setTemplate($page);
      return sfView::SUCCESS;
    }  
  }
}
