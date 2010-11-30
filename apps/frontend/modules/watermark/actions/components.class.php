<?php

class watermarkComponents extends sfComponents
{
  public function executeWatermarkGroups()
  {
    $this->wmGroups = WatermarkManager::retrieveByAccountId($this->getUser()->getProfile()->getAccountId());
  }
}