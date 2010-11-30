<?php
define ('MIN_FILENAME', '16');
define ('MAX_FILENAME', '64');
define ('USE_CHARS', 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');

class FileManager {

  /**
   * Run through the use case of deleting a file.
   *
   * @return true if the WMGroup has been deleted
   */
  public static function deleteFile(&$request, $account_id)
  {
    $conn = Propel::getConnection(FilePeer::DATABASE_NAME);
    $logger = Util::getLogger();

    try
    {
      $conn->begin();

 	  $file = FilePeer::retrieveByPK(InputHelper::sanitize(trim($request->getParameter('id'))), $conn);
      self::_deleteFileFromDisc($account_id, $file->getFileHash());
      $file->setDeletedAt('NOW');
      $file->save($conn);

      $conn->commit();
    }
    catch (Exception $e)
    {
      $logger->info('Error deleting watermark group:'.$e->getMessage().'. Rollback!');
      $conn->rollback();
      throw $e;
    }

    return $file->isDeleted();
  }

  public static function deleteWatermarkImage(&$request, $account_id)
  {
    try
    {
      $file = WatermarkImagePeer::retrieveByPK(InputHelper::sanitize(trim($request->getParameter('id'))));
      if ($file->getAccountId() == $account_id)
      {
        self::_deleteFileFromDisc($account_id, $file->getImageName());
        $file->setIsDeleted(1);
        $file->save();
      }
    }
    catch (Exception $e)
    {
      throw $e;
    }

    return $file->isDeleted();
  }

  /**
   * Run through the use case of uploading a new file.
   *
   * @return File object that was created
   */
  public static function uploadFile($request, &$profile)
  {
    $file_name = InputHelper::sanitize(trim($request->getFileName('file')));
    $file_hash = self::_generateRandomFilename($file_name);
    $file_size = $request->getFileSize('file');

    self::_saveFileToDisc($request, $profile->getAccountId(), $file_hash);

    $mime_type = self::getMimeType($request);
    $file_path = self::getUploadDirectoryByAccount($profile->getAccountId()).$file_hash;
    $extension = self::getFileExtension($request->getFileName('file'));
    $wd = WatermarkableDocumentFactory::getWatermarkableDocument($mime_type, $file_path, $extension);
    $wd->convertToPdf();
    $page_count = $wd->getPageCount();

    return self::_saveFileToDB($profile->getAccountId(), $profile->getId(), $file_name, $file_hash, $file_size, $page_count, $mime_type);
  }

  public static function uploadWatermarkImage($request, &$profile)
  {
    $file_name = InputHelper::sanitize(trim($request->getFileName('file')));
    $file_hash = self::_generateRandomFilename($file_name);
    $file_size = $request->getFileSize('file');

    $savedTo = self::_saveFileToDisc($request, $profile->getAccountId(), $file_hash);

    // store meta-data in database ...
    $dimension = getimagesize($savedTo);
    $wm_image = new WatermarkImage();
    $wm_image->setAccountId($profile->getAccount()->getId());
    $wm_image->setImageName($file_hash);
    $wm_image->setContentType($request->getFileType('file'));
    $wm_image->setWidth($dimension[0]);
    $wm_image->setHeight($dimension[1]);
    $wm_image->save();
    return $wm_image;
  }

  public static function getMimeType($request)
  {
    $mime_type = null;
    $mime_type = $request->getFileType('file');
    if ($mime_type == 'application/octet-stream' || $mime_type == 'application/x-zip-compressed')
    {
      // workaround: some file types like XLS are uploaded as application/octet-stream.
      // need to use file extension
      $name = $request->getFileName('file');
      $ext = self::getFileExtension($name);
      $mime_type = self::extensiontoMimeType($ext);
    }

    // IE sends weird mime types. Convert to conventional mime type...
    switch ($mime_type)
    {
      case 'image/pjpeg':
        $mime_type = 'image/jpeg';
        break;
      case 'image/x-png':
        $mime_type = 'image/png';
        break;
    }

    return $mime_type;
  }

  private static function getFileExtension($name)
  {
    $pi = pathinfo($name);
    $ext = strtolower($pi['extension']);
    return $ext;
  }

  public static function extensionToMimeType($extension)
  {
    $extension = strtolower($extension);
    $mime_type = null;
    switch ($extension)
    {
      case 'xls':
      case 'xlsx':
        $mime_type = 'application/vnd.ms-excel';
        break;
      case 'doc':
      case 'docx':
        $mime_type = 'application/msword';
        break;
      case 'pdf':
        $mime_type = 'application/pdf';
        break;
      default:
        $mime_type = null;
    }
    return $mime_type;
  }

  /**
   * Delete a file from disc based on the given account_id (directory) and file name
   *
   * @return true if file is deleted, else false
   */
  private static function _deleteFileFromDisc ($account_id, $file_name)
  {
    $logger = Util::getLogger();

    try
    {
      $full_path = sfConfig::get('sf_upload_dir').'/'.$account_id.'/'.$file_name;
      if (file_exists($full_path))
      {
        if (unlink($full_path) === FALSE)
          throw new Exception ("Unable to delete file: " .$full_path);
      }
    }
    catch (Exception $e)
    {
      $logger->info('Error deleting file from directory:'.$e->getMessage());
      throw $e;
    }

    return true;
  }

  /**
   * Generate a random text string to be used as a filename.
   *
   * @return A randomly generated filename
   */
  private static function _generateRandomFilename()
  {
  	$num_chars  = rand(MIN_FILENAME, MAX_FILENAME);
    $num_usable = strlen(USE_CHARS) - 1;
    $use_chars = USE_CHARS;
    $file_hash = '';

    for($i = 0; $i < $num_chars; $i++)
    {
        $rand_char = rand(0, $num_usable);

        $file_hash .= $use_chars{$rand_char};
    }

    return $file_hash;
  }

  /**
   * Save information for the uploaded file to the database.
   *
   * @return File object which has been saved
   */
  private static function _saveFileToDB ($account_id, $user_id, $file_name, $file_hash, $file_size, $page_count, $content_type)
  {
    $logger = Util::getLogger();
    $conn = Propel::getConnection(WMGroupPeer::DATABASE_NAME);

    try
    {


      $conn->begin();

 	  // create file
      $file = new File();
      $file->setUserId($user_id);
      $file->setName($file_name);
      $file->setFileHash($file_hash);
      $file->setSize($file_size);
      $file->setPages($page_count);
      $file->setContentType($content_type);
      $file->save($conn);

      $conn->commit();

      return $file;
    }
    catch (Exception $e)
    {
      $logger->info('Error saving file to db:'.$e->getMessage().'. Rollback!');
      $conn->rollback();
      self::_deleteFileFromDisc($account_id, $file_hash);
      throw $e;
    }
  }

  /**
   * Save a newly uploaded file to disc.
   *
   * @ return true on successful save, else false
   */
  private static function _saveFileToDisc ($request, $account_id, $file_hash)
  {
  	$logger = Util::getLogger();
  	$savedTo = '';
  	try
   	{
        $savedTo = self::getUploadDirectoryByAccount($account_id).$file_hash;
        $request->moveFile('file', $savedTo);
   	}
   	catch (Exception $e)
   	{
   	  $logger->info('Error saving file to directory:'.$e->getMessage());
        throw $e;
   	}
    return $savedTo;
  }

  /**
   * @return PDF directory for an account
   */
  public static function getUploadDirectoryByAccount($account_id)
  {
    return sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.$account_id.DIRECTORY_SEPARATOR;
  }

  public static function getFilesByAccountPager($account_id, $page)
  {
  	// limit to active files owned by the users account
    $c = new Criteria();
    $c->addJoin(FilePeer::USER_ID, sfGuardUserProfilePeer::ID);
    $c->add(sfGuardUserProfilePeer::ACCOUNT_ID, $account_id);
    $c->add(FilePeer::DELETED_AT, null, Criteria::ISNULL);
    $c->addDescendingOrderByColumn(FilePeer::CREATED_AT);

    // paginate
    $pager = new sfPropelPager('File', sfConfig::get('app_pager_limit_uploaded_documents', 3));
    $pager->setCriteria($c);
    $pager->setPage($page);
    $pager->init();

    return $pager;
  }
}
?>
