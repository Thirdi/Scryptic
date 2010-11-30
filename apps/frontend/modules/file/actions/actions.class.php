<?php

/**
 * file actions.
 *
 * @package    sf_sandbox
 * @subpackage file
 * @author     mfriesen
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class fileActions extends sfActions
{
  /**
   * Executes delete action
   *
   */
  public function executeDelete()
  {
    $request = $this->getRequest();
    $profile = $this->getUser()->getProfile();

    try
    {
  	  FileManager::deleteFile($request, $profile->getAccountId());
    }
    catch (Exception $e)
    {
      $request->setError('deleteError', 'Error deleting file');
      $this->logMessage("File deletion failed: ".$e->getMessage(), 'err');
    }

    $this->forward('file', 'list');
  }

  public function executeList()
  {
    $account_id = $this->getUser()->getProfile()->getAccountId();
    $this->page = $this->getRequestParameter('page', 1);

    $this->pager = FileManager::getFilesByAccountPager($account_id, $this->page);

    if ($this->getRequest()->isXmlHttpRequest()) {
      $this->setLayout(false);
    }
  }

  /**
   * Executes upload action
   *
   */
  public function executeUpload()
  {
    $request = $this->getRequest();
    $profile = $this->getUser()->getProfile();
    $result = true;

    // Flag for use in the template to decide whether to use JS code or not.
    $this->isUploaded = false;

    if ($request->getMethod() == sfRequest::POST)
    {
   	  try
      {
      	$file = FileManager::uploadFile($request, $profile);
      	$this->isUploaded = !$file->isNew();
        $result = 'success';
      }
      catch (Exception $e)
      {
        // TODO: hook up with error reporting framework
        sfLogger::getInstance()->err("File upload failed: ".$e->getMessage());
        $result = false;
      }
    }

    $this->upload_result = $result;
    $this->setLayout(false);
    return sfView::SUCCESS;
  }

/*
  public function validateUpload()
  {
    // check file extension for application/octet-stream mime type
    $mime_type = strtolower($this->getRequest()->getFileType('file'));
//error_log('file upload action: mime type='.$mime_type);
    $request = $this->getRequest();
    $name = $request->getFileName('file');
    $pi = pathinfo($name);
    $ext = strtolower($pi['extension']);
    $valid = true;
    if ($mime_type == 'application/octet-stream' || $mime_type == 'application/x-zip-compressed')
    {
      // allow: xls
      switch ($ext)
      {
        case 'xls':
        case 'xlsx':
        case 'docx':
          // allow
          $valid = true;
          break;
        default:
          // note: sync message with upload.yml
          $valid = false;
      }
    }
    elseif ($mime_type == 'application/vnd.ms-excel' && ($ext != 'xls' || $ext != 'xlsx'))
    {
      $valid = false;
    }

    if (!$valid)
    {
      $request->setError('file', 'Only PDF, DOC, XLS, JPG, GIF, PNG files are allowed');
    }

    return $valid;
  }
*/

  public function handleErrorUpload()
  {
    $this->setLayout(false);
    return sfView::SUCCESS;
  }
}
