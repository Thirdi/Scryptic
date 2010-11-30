<?php


abstract class BasePrintHistory extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $user_id;


	
	protected $user_ip;


	
	protected $file_id;


	
	protected $size;


	
	protected $num_documents;


	
	protected $pages;


	
	protected $creation_time;


	
	protected $total_time;


	
	protected $created_at;

	
	protected $asfGuardUserProfile;

	
	protected $aFile;

	
	protected $collPrintHistoryConfigurations;

	
	protected $lastPrintHistoryConfigurationCriteria = null;

	
	protected $collPrintHistoryGroups;

	
	protected $lastPrintHistoryGroupCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getUserId()
	{

		return $this->user_id;
	}

	
	public function getUserIp()
	{

		return $this->user_ip;
	}

	
	public function getFileId()
	{

		return $this->file_id;
	}

	
	public function getSize()
	{

		return $this->size;
	}

	
	public function getNumDocuments()
	{

		return $this->num_documents;
	}

	
	public function getPages()
	{

		return $this->pages;
	}

	
	public function getCreationTime()
	{

		return $this->creation_time;
	}

	
	public function getTotalTime()
	{

		return $this->total_time;
	}

	
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->created_at === null || $this->created_at === '') {
			return null;
		} elseif (!is_int($this->created_at)) {
						$ts = strtotime($this->created_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [created_at] as date/time value: " . var_export($this->created_at, true));
			}
		} else {
			$ts = $this->created_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = PrintHistoryPeer::ID;
		}

	} 
	
	public function setUserId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = PrintHistoryPeer::USER_ID;
		}

		if ($this->asfGuardUserProfile !== null && $this->asfGuardUserProfile->getId() !== $v) {
			$this->asfGuardUserProfile = null;
		}

	} 
	
	public function setUserIp($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->user_ip !== $v) {
			$this->user_ip = $v;
			$this->modifiedColumns[] = PrintHistoryPeer::USER_IP;
		}

	} 
	
	public function setFileId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->file_id !== $v) {
			$this->file_id = $v;
			$this->modifiedColumns[] = PrintHistoryPeer::FILE_ID;
		}

		if ($this->aFile !== null && $this->aFile->getId() !== $v) {
			$this->aFile = null;
		}

	} 
	
	public function setSize($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->size !== $v) {
			$this->size = $v;
			$this->modifiedColumns[] = PrintHistoryPeer::SIZE;
		}

	} 
	
	public function setNumDocuments($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->num_documents !== $v) {
			$this->num_documents = $v;
			$this->modifiedColumns[] = PrintHistoryPeer::NUM_DOCUMENTS;
		}

	} 
	
	public function setPages($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->pages !== $v) {
			$this->pages = $v;
			$this->modifiedColumns[] = PrintHistoryPeer::PAGES;
		}

	} 
	
	public function setCreationTime($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->creation_time !== $v) {
			$this->creation_time = $v;
			$this->modifiedColumns[] = PrintHistoryPeer::CREATION_TIME;
		}

	} 
	
	public function setTotalTime($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->total_time !== $v) {
			$this->total_time = $v;
			$this->modifiedColumns[] = PrintHistoryPeer::TOTAL_TIME;
		}

	} 
	
	public function setCreatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [created_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->created_at !== $ts) {
			$this->created_at = $ts;
			$this->modifiedColumns[] = PrintHistoryPeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->user_id = $rs->getInt($startcol + 1);

			$this->user_ip = $rs->getString($startcol + 2);

			$this->file_id = $rs->getInt($startcol + 3);

			$this->size = $rs->getInt($startcol + 4);

			$this->num_documents = $rs->getInt($startcol + 5);

			$this->pages = $rs->getInt($startcol + 6);

			$this->creation_time = $rs->getInt($startcol + 7);

			$this->total_time = $rs->getInt($startcol + 8);

			$this->created_at = $rs->getTimestamp($startcol + 9, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 10; 
		} catch (Exception $e) {
			throw new PropelException("Error populating PrintHistory object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BasePrintHistory:delete:pre') as $callable)
    {
      $ret = call_user_func($callable, $this, $con);
      if ($ret)
      {
        return;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PrintHistoryPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PrintHistoryPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BasePrintHistory:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BasePrintHistory:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(PrintHistoryPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PrintHistoryPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BasePrintHistory:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


												
			if ($this->asfGuardUserProfile !== null) {
				if ($this->asfGuardUserProfile->isModified()) {
					$affectedRows += $this->asfGuardUserProfile->save($con);
				}
				$this->setsfGuardUserProfile($this->asfGuardUserProfile);
			}

			if ($this->aFile !== null) {
				if ($this->aFile->isModified()) {
					$affectedRows += $this->aFile->save($con);
				}
				$this->setFile($this->aFile);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = PrintHistoryPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += PrintHistoryPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collPrintHistoryConfigurations !== null) {
				foreach($this->collPrintHistoryConfigurations as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPrintHistoryGroups !== null) {
				foreach($this->collPrintHistoryGroups as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


												
			if ($this->asfGuardUserProfile !== null) {
				if (!$this->asfGuardUserProfile->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfGuardUserProfile->getValidationFailures());
				}
			}

			if ($this->aFile !== null) {
				if (!$this->aFile->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aFile->getValidationFailures());
				}
			}


			if (($retval = PrintHistoryPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collPrintHistoryConfigurations !== null) {
					foreach($this->collPrintHistoryConfigurations as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPrintHistoryGroups !== null) {
					foreach($this->collPrintHistoryGroups as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PrintHistoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getUserId();
				break;
			case 2:
				return $this->getUserIp();
				break;
			case 3:
				return $this->getFileId();
				break;
			case 4:
				return $this->getSize();
				break;
			case 5:
				return $this->getNumDocuments();
				break;
			case 6:
				return $this->getPages();
				break;
			case 7:
				return $this->getCreationTime();
				break;
			case 8:
				return $this->getTotalTime();
				break;
			case 9:
				return $this->getCreatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PrintHistoryPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getUserId(),
			$keys[2] => $this->getUserIp(),
			$keys[3] => $this->getFileId(),
			$keys[4] => $this->getSize(),
			$keys[5] => $this->getNumDocuments(),
			$keys[6] => $this->getPages(),
			$keys[7] => $this->getCreationTime(),
			$keys[8] => $this->getTotalTime(),
			$keys[9] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PrintHistoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setUserId($value);
				break;
			case 2:
				$this->setUserIp($value);
				break;
			case 3:
				$this->setFileId($value);
				break;
			case 4:
				$this->setSize($value);
				break;
			case 5:
				$this->setNumDocuments($value);
				break;
			case 6:
				$this->setPages($value);
				break;
			case 7:
				$this->setCreationTime($value);
				break;
			case 8:
				$this->setTotalTime($value);
				break;
			case 9:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PrintHistoryPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUserId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setUserIp($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setFileId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setSize($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setNumDocuments($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setPages($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCreationTime($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setTotalTime($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCreatedAt($arr[$keys[9]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PrintHistoryPeer::DATABASE_NAME);

		if ($this->isColumnModified(PrintHistoryPeer::ID)) $criteria->add(PrintHistoryPeer::ID, $this->id);
		if ($this->isColumnModified(PrintHistoryPeer::USER_ID)) $criteria->add(PrintHistoryPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(PrintHistoryPeer::USER_IP)) $criteria->add(PrintHistoryPeer::USER_IP, $this->user_ip);
		if ($this->isColumnModified(PrintHistoryPeer::FILE_ID)) $criteria->add(PrintHistoryPeer::FILE_ID, $this->file_id);
		if ($this->isColumnModified(PrintHistoryPeer::SIZE)) $criteria->add(PrintHistoryPeer::SIZE, $this->size);
		if ($this->isColumnModified(PrintHistoryPeer::NUM_DOCUMENTS)) $criteria->add(PrintHistoryPeer::NUM_DOCUMENTS, $this->num_documents);
		if ($this->isColumnModified(PrintHistoryPeer::PAGES)) $criteria->add(PrintHistoryPeer::PAGES, $this->pages);
		if ($this->isColumnModified(PrintHistoryPeer::CREATION_TIME)) $criteria->add(PrintHistoryPeer::CREATION_TIME, $this->creation_time);
		if ($this->isColumnModified(PrintHistoryPeer::TOTAL_TIME)) $criteria->add(PrintHistoryPeer::TOTAL_TIME, $this->total_time);
		if ($this->isColumnModified(PrintHistoryPeer::CREATED_AT)) $criteria->add(PrintHistoryPeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PrintHistoryPeer::DATABASE_NAME);

		$criteria->add(PrintHistoryPeer::ID, $this->id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setUserId($this->user_id);

		$copyObj->setUserIp($this->user_ip);

		$copyObj->setFileId($this->file_id);

		$copyObj->setSize($this->size);

		$copyObj->setNumDocuments($this->num_documents);

		$copyObj->setPages($this->pages);

		$copyObj->setCreationTime($this->creation_time);

		$copyObj->setTotalTime($this->total_time);

		$copyObj->setCreatedAt($this->created_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getPrintHistoryConfigurations() as $relObj) {
				$copyObj->addPrintHistoryConfiguration($relObj->copy($deepCopy));
			}

			foreach($this->getPrintHistoryGroups() as $relObj) {
				$copyObj->addPrintHistoryGroup($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new PrintHistoryPeer();
		}
		return self::$peer;
	}

	
	public function setsfGuardUserProfile($v)
	{


		if ($v === null) {
			$this->setUserId(NULL);
		} else {
			$this->setUserId($v->getId());
		}


		$this->asfGuardUserProfile = $v;
	}


	
	public function getsfGuardUserProfile($con = null)
	{
		if ($this->asfGuardUserProfile === null && ($this->user_id !== null)) {
						include_once 'lib/model/om/BasesfGuardUserProfilePeer.php';

			$this->asfGuardUserProfile = sfGuardUserProfilePeer::retrieveByPK($this->user_id, $con);

			
		}
		return $this->asfGuardUserProfile;
	}

	
	public function setFile($v)
	{


		if ($v === null) {
			$this->setFileId(NULL);
		} else {
			$this->setFileId($v->getId());
		}


		$this->aFile = $v;
	}


	
	public function getFile($con = null)
	{
		if ($this->aFile === null && ($this->file_id !== null)) {
						include_once 'lib/model/om/BaseFilePeer.php';

			$this->aFile = FilePeer::retrieveByPK($this->file_id, $con);

			
		}
		return $this->aFile;
	}

	
	public function initPrintHistoryConfigurations()
	{
		if ($this->collPrintHistoryConfigurations === null) {
			$this->collPrintHistoryConfigurations = array();
		}
	}

	
	public function getPrintHistoryConfigurations($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePrintHistoryConfigurationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPrintHistoryConfigurations === null) {
			if ($this->isNew()) {
			   $this->collPrintHistoryConfigurations = array();
			} else {

				$criteria->add(PrintHistoryConfigurationPeer::PRINT_HISTORY_ID, $this->getId());

				PrintHistoryConfigurationPeer::addSelectColumns($criteria);
				$this->collPrintHistoryConfigurations = PrintHistoryConfigurationPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PrintHistoryConfigurationPeer::PRINT_HISTORY_ID, $this->getId());

				PrintHistoryConfigurationPeer::addSelectColumns($criteria);
				if (!isset($this->lastPrintHistoryConfigurationCriteria) || !$this->lastPrintHistoryConfigurationCriteria->equals($criteria)) {
					$this->collPrintHistoryConfigurations = PrintHistoryConfigurationPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPrintHistoryConfigurationCriteria = $criteria;
		return $this->collPrintHistoryConfigurations;
	}

	
	public function countPrintHistoryConfigurations($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasePrintHistoryConfigurationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PrintHistoryConfigurationPeer::PRINT_HISTORY_ID, $this->getId());

		return PrintHistoryConfigurationPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPrintHistoryConfiguration(PrintHistoryConfiguration $l)
	{
		$this->collPrintHistoryConfigurations[] = $l;
		$l->setPrintHistory($this);
	}


	
	public function getPrintHistoryConfigurationsJoinLayout($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePrintHistoryConfigurationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPrintHistoryConfigurations === null) {
			if ($this->isNew()) {
				$this->collPrintHistoryConfigurations = array();
			} else {

				$criteria->add(PrintHistoryConfigurationPeer::PRINT_HISTORY_ID, $this->getId());

				$this->collPrintHistoryConfigurations = PrintHistoryConfigurationPeer::doSelectJoinLayout($criteria, $con);
			}
		} else {
									
			$criteria->add(PrintHistoryConfigurationPeer::PRINT_HISTORY_ID, $this->getId());

			if (!isset($this->lastPrintHistoryConfigurationCriteria) || !$this->lastPrintHistoryConfigurationCriteria->equals($criteria)) {
				$this->collPrintHistoryConfigurations = PrintHistoryConfigurationPeer::doSelectJoinLayout($criteria, $con);
			}
		}
		$this->lastPrintHistoryConfigurationCriteria = $criteria;

		return $this->collPrintHistoryConfigurations;
	}


	
	public function getPrintHistoryConfigurationsJoinFont($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePrintHistoryConfigurationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPrintHistoryConfigurations === null) {
			if ($this->isNew()) {
				$this->collPrintHistoryConfigurations = array();
			} else {

				$criteria->add(PrintHistoryConfigurationPeer::PRINT_HISTORY_ID, $this->getId());

				$this->collPrintHistoryConfigurations = PrintHistoryConfigurationPeer::doSelectJoinFont($criteria, $con);
			}
		} else {
									
			$criteria->add(PrintHistoryConfigurationPeer::PRINT_HISTORY_ID, $this->getId());

			if (!isset($this->lastPrintHistoryConfigurationCriteria) || !$this->lastPrintHistoryConfigurationCriteria->equals($criteria)) {
				$this->collPrintHistoryConfigurations = PrintHistoryConfigurationPeer::doSelectJoinFont($criteria, $con);
			}
		}
		$this->lastPrintHistoryConfigurationCriteria = $criteria;

		return $this->collPrintHistoryConfigurations;
	}

	
	public function initPrintHistoryGroups()
	{
		if ($this->collPrintHistoryGroups === null) {
			$this->collPrintHistoryGroups = array();
		}
	}

	
	public function getPrintHistoryGroups($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePrintHistoryGroupPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPrintHistoryGroups === null) {
			if ($this->isNew()) {
			   $this->collPrintHistoryGroups = array();
			} else {

				$criteria->add(PrintHistoryGroupPeer::PRINT_HISTORY_ID, $this->getId());

				PrintHistoryGroupPeer::addSelectColumns($criteria);
				$this->collPrintHistoryGroups = PrintHistoryGroupPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PrintHistoryGroupPeer::PRINT_HISTORY_ID, $this->getId());

				PrintHistoryGroupPeer::addSelectColumns($criteria);
				if (!isset($this->lastPrintHistoryGroupCriteria) || !$this->lastPrintHistoryGroupCriteria->equals($criteria)) {
					$this->collPrintHistoryGroups = PrintHistoryGroupPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPrintHistoryGroupCriteria = $criteria;
		return $this->collPrintHistoryGroups;
	}

	
	public function countPrintHistoryGroups($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasePrintHistoryGroupPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PrintHistoryGroupPeer::PRINT_HISTORY_ID, $this->getId());

		return PrintHistoryGroupPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPrintHistoryGroup(PrintHistoryGroup $l)
	{
		$this->collPrintHistoryGroups[] = $l;
		$l->setPrintHistory($this);
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BasePrintHistory:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BasePrintHistory::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 