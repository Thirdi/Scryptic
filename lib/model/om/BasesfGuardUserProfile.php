<?php


abstract class BasesfGuardUserProfile extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $account_id;


	
	protected $first_name;


	
	protected $last_name;


	
	protected $user_id;


	
	protected $is_deleted;


	
	protected $force_password_change = 0;

	
	protected $aAccount;

	
	protected $asfGuardUser;

	
	protected $collFiles;

	
	protected $lastFileCriteria = null;

	
	protected $collPrintHistorys;

	
	protected $lastPrintHistoryCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getAccountId()
	{

		return $this->account_id;
	}

	
	public function getFirstName()
	{

		return $this->first_name;
	}

	
	public function getLastName()
	{

		return $this->last_name;
	}

	
	public function getUserId()
	{

		return $this->user_id;
	}

	
	public function getIsDeleted()
	{

		return $this->is_deleted;
	}

	
	public function getForcePasswordChange()
	{

		return $this->force_password_change;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::ID;
		}

	} 
	
	public function setAccountId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->account_id !== $v) {
			$this->account_id = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::ACCOUNT_ID;
		}

		if ($this->aAccount !== null && $this->aAccount->getId() !== $v) {
			$this->aAccount = null;
		}

	} 
	
	public function setFirstName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->first_name !== $v) {
			$this->first_name = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::FIRST_NAME;
		}

	} 
	
	public function setLastName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->last_name !== $v) {
			$this->last_name = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::LAST_NAME;
		}

	} 
	
	public function setUserId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::USER_ID;
		}

		if ($this->asfGuardUser !== null && $this->asfGuardUser->getId() !== $v) {
			$this->asfGuardUser = null;
		}

	} 
	
	public function setIsDeleted($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->is_deleted !== $v) {
			$this->is_deleted = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::IS_DELETED;
		}

	} 
	
	public function setForcePasswordChange($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->force_password_change !== $v || $v === 0) {
			$this->force_password_change = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::FORCE_PASSWORD_CHANGE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->account_id = $rs->getInt($startcol + 1);

			$this->first_name = $rs->getString($startcol + 2);

			$this->last_name = $rs->getString($startcol + 3);

			$this->user_id = $rs->getInt($startcol + 4);

			$this->is_deleted = $rs->getInt($startcol + 5);

			$this->force_password_change = $rs->getInt($startcol + 6);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating sfGuardUserProfile object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BasesfGuardUserProfile:delete:pre') as $callable)
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
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			sfGuardUserProfilePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BasesfGuardUserProfile:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BasesfGuardUserProfile:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BasesfGuardUserProfile:save:post') as $callable)
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


												
			if ($this->aAccount !== null) {
				if ($this->aAccount->isModified()) {
					$affectedRows += $this->aAccount->save($con);
				}
				$this->setAccount($this->aAccount);
			}

			if ($this->asfGuardUser !== null) {
				if ($this->asfGuardUser->isModified()) {
					$affectedRows += $this->asfGuardUser->save($con);
				}
				$this->setsfGuardUser($this->asfGuardUser);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = sfGuardUserProfilePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += sfGuardUserProfilePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collFiles !== null) {
				foreach($this->collFiles as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

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


												
			if ($this->aAccount !== null) {
				if (!$this->aAccount->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAccount->getValidationFailures());
				}
			}

			if ($this->asfGuardUser !== null) {
				if (!$this->asfGuardUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfGuardUser->getValidationFailures());
				}
			}


			if (($retval = sfGuardUserProfilePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collFiles !== null) {
					foreach($this->collFiles as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
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
		$pos = sfGuardUserProfilePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getAccountId();
				break;
			case 2:
				return $this->getFirstName();
				break;
			case 3:
				return $this->getLastName();
				break;
			case 4:
				return $this->getUserId();
				break;
			case 5:
				return $this->getIsDeleted();
				break;
			case 6:
				return $this->getForcePasswordChange();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = sfGuardUserProfilePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getAccountId(),
			$keys[2] => $this->getFirstName(),
			$keys[3] => $this->getLastName(),
			$keys[4] => $this->getUserId(),
			$keys[5] => $this->getIsDeleted(),
			$keys[6] => $this->getForcePasswordChange(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = sfGuardUserProfilePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setAccountId($value);
				break;
			case 2:
				$this->setFirstName($value);
				break;
			case 3:
				$this->setLastName($value);
				break;
			case 4:
				$this->setUserId($value);
				break;
			case 5:
				$this->setIsDeleted($value);
				break;
			case 6:
				$this->setForcePasswordChange($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = sfGuardUserProfilePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setAccountId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setFirstName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setLastName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setUserId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setIsDeleted($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setForcePasswordChange($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(sfGuardUserProfilePeer::DATABASE_NAME);

		if ($this->isColumnModified(sfGuardUserProfilePeer::ID)) $criteria->add(sfGuardUserProfilePeer::ID, $this->id);
		if ($this->isColumnModified(sfGuardUserProfilePeer::ACCOUNT_ID)) $criteria->add(sfGuardUserProfilePeer::ACCOUNT_ID, $this->account_id);
		if ($this->isColumnModified(sfGuardUserProfilePeer::FIRST_NAME)) $criteria->add(sfGuardUserProfilePeer::FIRST_NAME, $this->first_name);
		if ($this->isColumnModified(sfGuardUserProfilePeer::LAST_NAME)) $criteria->add(sfGuardUserProfilePeer::LAST_NAME, $this->last_name);
		if ($this->isColumnModified(sfGuardUserProfilePeer::USER_ID)) $criteria->add(sfGuardUserProfilePeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(sfGuardUserProfilePeer::IS_DELETED)) $criteria->add(sfGuardUserProfilePeer::IS_DELETED, $this->is_deleted);
		if ($this->isColumnModified(sfGuardUserProfilePeer::FORCE_PASSWORD_CHANGE)) $criteria->add(sfGuardUserProfilePeer::FORCE_PASSWORD_CHANGE, $this->force_password_change);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(sfGuardUserProfilePeer::DATABASE_NAME);

		$criteria->add(sfGuardUserProfilePeer::ID, $this->id);

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

		$copyObj->setAccountId($this->account_id);

		$copyObj->setFirstName($this->first_name);

		$copyObj->setLastName($this->last_name);

		$copyObj->setUserId($this->user_id);

		$copyObj->setIsDeleted($this->is_deleted);

		$copyObj->setForcePasswordChange($this->force_password_change);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getFiles() as $relObj) {
				$copyObj->addFile($relObj->copy($deepCopy));
			}

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
			self::$peer = new sfGuardUserProfilePeer();
		}
		return self::$peer;
	}

	
	public function setAccount($v)
	{


		if ($v === null) {
			$this->setAccountId(NULL);
		} else {
			$this->setAccountId($v->getId());
		}


		$this->aAccount = $v;
	}


	
	public function getAccount($con = null)
	{
		if ($this->aAccount === null && ($this->account_id !== null)) {
						include_once 'lib/model/om/BaseAccountPeer.php';

			$this->aAccount = AccountPeer::retrieveByPK($this->account_id, $con);

			
		}
		return $this->aAccount;
	}

	
	public function setsfGuardUser($v)
	{


		if ($v === null) {
			$this->setUserId(NULL);
		} else {
			$this->setUserId($v->getId());
		}


		$this->asfGuardUser = $v;
	}


	
	public function getsfGuardUser($con = null)
	{
		if ($this->asfGuardUser === null && ($this->user_id !== null)) {
						include_once 'plugins/sfGuardPlugin/lib/model/om/BasesfGuardUserPeer.php';

			$this->asfGuardUser = sfGuardUserPeer::retrieveByPK($this->user_id, $con);

			
		}
		return $this->asfGuardUser;
	}

	
	public function initFiles()
	{
		if ($this->collFiles === null) {
			$this->collFiles = array();
		}
	}

	
	public function getFiles($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseFilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFiles === null) {
			if ($this->isNew()) {
			   $this->collFiles = array();
			} else {

				$criteria->add(FilePeer::USER_ID, $this->getId());

				FilePeer::addSelectColumns($criteria);
				$this->collFiles = FilePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(FilePeer::USER_ID, $this->getId());

				FilePeer::addSelectColumns($criteria);
				if (!isset($this->lastFileCriteria) || !$this->lastFileCriteria->equals($criteria)) {
					$this->collFiles = FilePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFileCriteria = $criteria;
		return $this->collFiles;
	}

	
	public function countFiles($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseFilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(FilePeer::USER_ID, $this->getId());

		return FilePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addFile(File $l)
	{
		$this->collFiles[] = $l;
		$l->setsfGuardUserProfile($this);
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

				$criteria->add(PrintHistoryPeer::USER_ID, $this->getId());

				PrintHistoryPeer::addSelectColumns($criteria);
				$this->collPrintHistorys = PrintHistoryPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PrintHistoryPeer::USER_ID, $this->getId());

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

		$criteria->add(PrintHistoryPeer::USER_ID, $this->getId());

		return PrintHistoryPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPrintHistory(PrintHistory $l)
	{
		$this->collPrintHistorys[] = $l;
		$l->setsfGuardUserProfile($this);
	}


	
	public function getPrintHistorysJoinFile($criteria = null, $con = null)
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

				$criteria->add(PrintHistoryPeer::USER_ID, $this->getId());

				$this->collPrintHistorys = PrintHistoryPeer::doSelectJoinFile($criteria, $con);
			}
		} else {
									
			$criteria->add(PrintHistoryPeer::USER_ID, $this->getId());

			if (!isset($this->lastPrintHistoryCriteria) || !$this->lastPrintHistoryCriteria->equals($criteria)) {
				$this->collPrintHistorys = PrintHistoryPeer::doSelectJoinFile($criteria, $con);
			}
		}
		$this->lastPrintHistoryCriteria = $criteria;

		return $this->collPrintHistorys;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BasesfGuardUserProfile:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BasesfGuardUserProfile::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 