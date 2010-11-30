<?php

class fileComponents extends sfComponents
{
  public function executeSelector()
  {
    $account_id = $this->getUser()->getProfile()->getAccountId();
    $this->page = $this->getRequestParameter('page', 1);
    
    $this->pager = FileManager::getFilesByAccountPager($account_id, $this->page);    
  }
}