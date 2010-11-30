<?php


abstract class BaseFile extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $user_id;


	
	protected $name;


	
	protected $file_hash;


	
	protected $size;


	
	protected $pages;


	
	protected $created_at;


	
	protected $deleted_at;


	
	protected $content_type;

	
	protected $asfGuardUserProfile;

	
	protected $collPrintHistorys;

	
	protected $lastPrintHistoryCriteria = null;

	
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

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getFileHash()
	{

		return $this->file_hash;
	}

	
	public function getSize()
	{

		return $this->size;
	}

	
	public function getPages()
	{

		return $this->pages;
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

	
	public function getDeletedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->deleted_at === null || $this->deleted_at === '') {
			return null;
		} elseif (!is_int($this->deleted_at)) {
						$ts = strtotime($this->deleted_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [deleted_at] as date/time value: " . var_export($this->deleted_at, true));
			}
		} else {
			$ts = $this->deleted_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getContentType()
	{

		return $this->content_type;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = FilePeer::ID;
		}

	} 
	
	public function setUserId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = FilePeer::USER_ID;
		}

		if ($this->asfGuardUserProfile !== null && $this->asfGuardUserProfile->getId() !== $v) {
			$this->asfGuardUserProfile = null;
		}

	} 
	
	public function setName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = FilePeer::NAME;
		}

	} 
	
	public function setFileHash($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->file_hash !== $v) {
			$this->file_hash = $v;
			$this->modifiedColumns[] = FilePeer::FILE_HASH;
		}

	} 
	
	public function setSize($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->size !== $v) {
			$this->size = $v;
			$this->modifiedColumns[] = FilePeer::SIZE;
		}

	} 
	
	public function setPages($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->pages !== $v) {
			$this->pages = $v;
			$this->modifiedColumns[] = FilePeer::PAGES;
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
			$this->modifiedColumns[] = FilePeer::CREATED_AT;
		}

	} 
	
	public function setDeletedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [deleted_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->deleted_at !== $ts) {
			$this->deleted_at = $ts;
			$this->modifiedColumns[] = FilePeer::DELETED_AT;
		}

	} 
	
	public function setContentType($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->content_type !== $v) {
			$this->content_type = $v;
			$this->modifiedColumns[] = FilePeer::CONTENT_TYPE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->user_id = $rs->getInt($startcol + 1);

			$this->name = $rs->getString($startcol + 2);

			$this->file_hash = $rs->getString($startcol + 3);

			$this->size = $rs->getInt($startcol + 4);

			$this->pages = $rs->getInt($startcol + 5);

			$this->created_at = $rs->getTimestamp($startcol + 6, null);

			$this->deleted_at = $rs->getTimestamp($startcol + 7, null);

			$this->content_type = $rs->getString($startcol + 8);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating File object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseFile:delete:pre') as $callable)
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
			$con = Propel::getConnection(FilePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			FilePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseFile:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseFile:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(FilePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(FilePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseFile:save:post') as $callable)
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = FilePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += FilePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collPrintHistorys !== null) {
				foreach($this->collPrintHistorys as $referrerFK) {
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


			if (($retval = FilePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collPrintHistorys !== null) {
					foreach($this->collPrintHistorys as $referrerFK) {
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
		$pos = FilePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getName();
				break;
			case 3:
				return $this->getFileHash();
				break;
			case 4:
				return $this->getSize();
				break;
			case 5:
				return $this->getPages();
				break;
			case 6:
				return $this->getCreatedAt();
				break;
			case 7:
				return $this->getDeletedAt();
				break;
			case 8:
				return $this->getContentType();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = FilePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getUserId(),
			$keys[2] => $this->getName(),
			$keys[3] => $this->getFileHash(),
			$keys[4] => $this->getSize(),
			$keys[5] => $this->getPages(),
			$keys[6] => $this->getCreatedAt(),
			$keys[7] => $this->getDeletedAt(),
			$keys[8] => $this->getContentType(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FilePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setName($value);
				break;
			case 3:
				$this->setFileHash($value);
				break;
			case 4:
				$this->setSize($value);
				break;
			case 5:
				$this->setPages($value);
				break;
			case 6:
				$this->setCreatedAt($value);
				break;
			case 7:
				$this->setDeletedAt($value);
				break;
			case 8:
				$this->setContentType($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = FilePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUserId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setFileHash($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setSize($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setPages($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCreatedAt($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setDeletedAt($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setContentType($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(FilePeer::DATABASE_NAME);

		if ($this->isColumnModified(FilePeer::ID)) $criteria->add(FilePeer::ID, $this->id);
		if ($this->isColumnModified(FilePeer::USER_ID)) $criteria->add(FilePeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(FilePeer::NAME)) $criteria->add(FilePeer::NAME, $this->name);
		if ($this->isColumnModified(FilePeer::FILE_HASH)) $criteria->add(FilePeer::FILE_HASH, $this->file_hash);
		if ($this->isColumnModified(FilePeer::SIZE)) $criteria->add(FilePeer::SIZE, $this->size);
		if ($this->isColumnModified(FilePeer::PAGES)) $criteria->add(FilePeer::PAGES, $this->pages);
		if ($this->isColumnModified(FilePeer::CREATED_AT)) $criteria->add(FilePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(FilePeer::DELETED_AT)) $criteria->add(FilePeer::DELETED_AT, $this->deleted_at);
		if ($this->isColumnModified(FilePeer::CONTENT_TYPE)) $criteria->add(FilePeer::CONTENT_TYPE, $this->content_type);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(FilePeer::DATABASE_NAME);

		$criteria->add(FilePeer::ID, $this->id);

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

		$copyObj->setName($this->name);

		$copyObj->setFileHash($this->file_hash);

		$copyObj->setSize($this->size);

		$copyObj->setPages($this->pages);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setDeletedAt($this->deleted_at);

		$copyObj->setContentType($this->content_type);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getPrintHistorys() as $relObj) {
				$copyObj->addPrintHistory($relObj->copy($deepCopy));
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
			self::$peer = new FilePeer();
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

	
	public function initPrintHistorys()
	{
		if ($this->collPrintHistorys === null) {
			$this->collPrintHistorys = array();
		}
	}

	
	public function getPrintHistorys($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePrintHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPrintHistorys === null) {
			if ($this->isNew()) {
			   $this->collPrintHistorys = array();
			} else {

				$criteria->add(PrintHistoryPeer::FILE_ID, $this->getId());

				PrintHistoryPeer::addSelectColumns($criteria);
				$this->collPrintHistorys = PrintHistoryPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PrintHistoryPeer::FILE_ID, $this->getId());

				PrintHistoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastPrintHistoryCriteria) || !$this->lastPrintHistoryCriteria->equals($criteria)) {
					$this->collPrintHistorys = PrintHistoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPrintHistoryCriteria = $criteria;
		return $this->collPrintHistorys;
	}

	
	public function countPrintHistorys($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasePrintHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PrintHistoryPeer::FILE_ID, $this->getId());

		return PrintHistoryPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPrintHistory(PrintHistory $l)
	{
		$this->collPrintHistorys[] = $l;
		$l->setFile($this);
	}


	
	public function getPrintHistorysJoinsfGuardUserProfile($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePrintHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPrintHistorys === null) {
			if ($this->isNew()) {
				$this->collPrintHistorys = array();
			} else {

				$criteria->add(PrintHistoryPeer::FILE_ID, $this->getId());

				$this->collPrintHistorys = PrintHistoryPeer::doSelectJoinsfGuardUserProfile($criteria, $con);
			}
		} else {
									
			$criteria->add(PrintHistoryPeer::FILE_ID, $this->getId());

			if (!isset($this->lastPrintHistoryCriteria) || !$this->lastPrintHistoryCriteria->equals($criteria)) {
				$this->collPrintHistorys = PrintHistoryPeer::doSelectJoinsfGuardUserProfile($criteria, $con);
			}
		}
		$this->lastPrintHistoryCriteria = $criteria;

		return $this->collPrintHistorys;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseFile:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseFile::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 