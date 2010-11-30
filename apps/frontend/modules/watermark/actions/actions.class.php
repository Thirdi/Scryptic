<?php

/**
 * watermark actions.
 *
 * @package    sf_sandbox
 * @subpackage watermark
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class watermarkActions extends sfActions
{
   
  /**
   * Executes create group action
   *
   */
  public function executeCreateGroup()
  {
    // ajax only
    $request = $this->getRequest();
    $profile = $this->getUser()->getProfile();	
    $response = array('success'=>false);
    
    if ($request->getMethod() == sfRequest::POST)
    {
   	  try
      {		
      	$new_watermark_group = WatermarkManager::createNewWatermarkGroup($request, $profile->getAccountId());
        $response['success'] = true;
        $response['id'] = $new_watermark_group->getId();
      }
      catch (Exception $e)
      {
        $this->logMessage("Watermark Group creation failed: ".$e->getMessage(), 'err');        
        $response['message'] = $e->getMessage();
      } 
    }
    
    $this->renderText(json_encode($response));
    return sfView::NONE;
  }
  
  /**
   * Executes create group item action
   *
   */
  public function executeCreateGroupItem()
  {
    // ajax only
    $request = $this->getRequest();
    $response = array('success'=>false, 'groupId'=>$request->getParameter('wm_group_id'));
    $this->group_id = InputHelper::sanitize(trim($request->getParameter('wm_group_id')));

    if ($request->getMethod() == sfRequest::POST)
    {
   	  try
      {		
      	$new_watermark_group = WatermarkManager::createNewWatermarkGroupItem($request);
        $response['success'] = true;
        $response['id'] = $new_watermark_group->getId();
      }
      catch (Exception $e)
      {
        $this->logMessage("Watermark Group Item creation failed: ".$e->getMessage(), 'err');
        $response['message'] = $e->getMessage();
      }       
    }
    $this->renderText(json_encode($response));
    return sfView::NONE;
  }
  
  /**
   * Executes delete group action
   *
   */
  public function executeDeleteGroup()
  {
    $request = $this->getRequest();
    $response = array('success'=>false, 'id'=>$request->getParameter('id'));
    try
    {		
  	  $id = InputHelper::sanitize(trim($request->getParameter('id')));
      WatermarkManager::deleteWatermarkGroup($id);
      $response['success'] = true;
    }
    catch (Exception $e)
    {
      $this->logMessage("Watermark Group deletion failed: ".$e->getMessage(), 'err');
      $response['message'] = $e->getMessage();
    }

    $this->renderText(json_encode($response));
    return sfView::NONE;  
  }
  
  /**
   * Executes delete group item action
   *
   */
  public function executeDeleteGroupItem()
  {
    $request = $this->getRequest();
    $response = array('success'=>false, 'id'=>$request->getParameter('id'), 'groupId'=>$request->getParameter('groupId'));        
    try
    {		
  	  WatermarkManager::deleteWatermarkGroupItem($request);
      $response['success'] = true;
    }
    catch (Exception $e)
    {
      $this->logMessage("Watermark Group Item deletion failed: ".$e->getMessage(), 'err');
    }
  
    $this->renderText(json_encode($response));
    return sfView::NONE;
  }
  
  public function executeRenderGroup() {
    // ajax request only
    $id = $this->getRequestParameter('id');
    $wm_group = WMGroupPeer::retrieveByPk($id);
    $this->forward404Unless($wm_group);
    $this->group = $wm_group;
    $this->setLayout(false);
  }

  public function executeRenderGroupItem() {
    // ajax request only
    $id = $this->getRequestParameter('id');
    $wm_group_item = WMGroupItemPeer::retrieveByPk($id);
    $this->forward404Unless($wm_group_item);
    $this->group = $wm_group_item->getWMGroup();
    $this->item = $wm_group_item;
    $this->setLayout(false);
  }
  
  /**
   * Executes update group action
   *
   */
  public function executeUpdateGroup()
  {
    // ajax requests only!
    // TODO validation (ajax)
    $request = $this->getRequest();
    $response = array('success'=>false, 'id'=>$request->getParameter('id'), 'value'=>$request->getParameter('wm_group_name'));
    if ($request->getMethod() == sfRequest::POST)
    {
   	  try
      {		
      	$this->wmGroup = WatermarkManager::updateWatermarkGroup($request);
        $response['success'] = true;
      }
      catch (Exception $e)
      {
        $this->logMessage("Watermark Group update failed: ".$e->getMessage(), 'err');       
        $response['message'] = $e->getMessage();
      }	  
    }
    $this->renderText(json_encode($response));
    return sfView::NONE;
  }
  
  /**
   * Executes edit group item action
   *
   */
  public function executeUpdateGroupItem()
  {
    // ajax requests only!
    // TODO validation (ajax)
    $request = $this->getRequest();
    $response = array('success'=>false, 'id'=>$request->getParameter('id'), 'value'=>$request->getParameter('value'), 'alt_value'=>$request->getParameter('alt_value'));
    if ($request->getMethod() == sfRequest::POST)
    {
   	  try
      {		
      	$this->wmGroupItem = WatermarkManager::updateWatermarkGroupItem($request);
        $response['success'] = true;
      }
      catch (Exception $e)
      {
        $this->logMessage("Watermark Group Item update failed: ".$e->getMessage(), 'err');
        $response['message'] = $e->getMessage();
      }  
    }
    
    $this->renderText(json_encode($response));
    return sfView::NONE;
  }
  
  public function handleErrorCreateGroup()
  {
    return $this->handleAjaxError();
  }
  
  public function handleErrorCreateGroupItem() 
  {
    $response = array('wm_group_id' => $this->getRequestParameter('wm_group_id'));
    return $this->handleAjaxError($response);
  }

  public function handleErrorUpdateGroup() 
  {
    $response = array('id' => $this->getRequestParameter('id'));
    return $this->handleAjaxError($response);
  }

  public function handleErrorUpdateGroupItem() 
  {
    $response = array('id' => $this->getRequestParameter('id'));
    return $this->handleAjaxError($response);
  }
  
  private function handleAjaxError($response = array()) 
  {
    $response = array_merge($response, array('valid'=>false, 'errors'=> $this->getRequest()->getErrors()));
    $this->renderText(json_encode($response));
    return sfView::NONE;
  }  
}
