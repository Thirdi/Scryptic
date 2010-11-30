<?php


abstract class BaseAccount extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $created_at;


	
	protected $deleted_at;


	
	protected $status = 1;


	
	protected $updated_at;

	
	protected $collActivationCodes;

	
	protected $lastActivationCodeCriteria = null;

	
	protected $collPrintConfigurations;

	
	protected $lastPrintConfigurationCriteria = null;

	
	protected $collsfGuardUserProfiles;

	
	protected $lastsfGuardUserProfileCriteria = null;

	
	protected $collWMGroups;

	
	protected $lastWMGroupCriteria = null;

	
	protected $collWatermarkImages;

	
	protected $lastWatermarkImageCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
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

	
	public function getStatus()
	{

		return $this->status;
	}

	
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->updated_at === null || $this->updated_at === '') {
			return null;
		} elseif (!is_int($this->updated_at)) {
						$ts = strtotime($this->updated_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [updated_at] as date/time value: " . var_export($this->updated_at, true));
			}
		} else {
			$ts = $this->updated_at;
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
			$this->modifiedColumns[] = AccountPeer::ID;
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
			$this->modifiedColumns[] = AccountPeer::CREATED_AT;
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
			$this->modifiedColumns[] = AccountPeer::DELETED_AT;
		}

	} 
	
	public function setStatus($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->status !== $v || $v === 1) {
			$this->status = $v;
			$this->modifiedColumns[] = AccountPeer::STATUS;
		}

	} 
	
	public function setUpdatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [updated_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->updated_at !== $ts) {
			$this->updated_at = $ts;
			$this->modifiedColumns[] = AccountPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->created_at = $rs->getTimestamp($startcol + 1, null);

			$this->deleted_at = $rs->getTimestamp($startcol + 2, null);

			$this->status = $rs->getInt($startcol + 3);

			$this->updated_at = $rs->getTimestamp($startcol + 4, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Account object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseAccount:delete:pre') as $callable)
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
			$con = Propel::getConnection(AccountPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			AccountPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseAccount:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseAccount:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(AccountPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(AccountPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(AccountPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseAccount:save:post') as $callable)
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = AccountPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += AccountPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collActivationCodes !== null) {
				foreach($this->collActivationCodes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPrintConfigurations !== null) {
				foreach($this->collPrintConfigurations as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collsfGuardUserProfiles !== null) {
				foreach($this->collsfGuardUserProfiles as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collWMGroups !== null) {
				foreach($this->collWMGroups as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collWatermarkImages !== null) {
				foreach($this->collWatermarkImages as $referrerFK) {
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


			if (($retval = AccountPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collActivationCodes !== null) {
					foreach($this->collActivationCodes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPrintConfigurations !== null) {
					foreach($this->collPrintConfigurations as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collsfGuardUserProfiles !== null) {
					foreach($this->collsfGuardUserProfiles as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collWMGroups !== null) {
					foreach($this->collWMGroups as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collWatermarkImages !== null) {
					foreach($this->collWatermarkImages as $referrerFK) {
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
		$pos = AccountPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getCreatedAt();
				break;
			case 2:
				return $this->getDeletedAt();
				break;
			case 3:
				return $this->getStatus();
				break;
			case 4:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AccountPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCreatedAt(),
			$keys[2] => $this->getDeletedAt(),
			$keys[3] => $this->getStatus(),
			$keys[4] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AccountPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setCreatedAt($value);
				break;
			case 2:
				$this->setDeletedAt($value);
				break;
			case 3:
				$this->setStatus($value);
				break;
			case 4:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AccountPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCreatedAt($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDeletedAt($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setStatus($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setUpdatedAt($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(AccountPeer::DATABASE_NAME);

		if ($this->isColumnModified(AccountPeer::ID)) $criteria->add(AccountPeer::ID, $this->id);
		if ($this->isColumnModified(AccountPeer::CREATED_AT)) $criteria->add(AccountPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(AccountPeer::DELETED_AT)) $criteria->add(AccountPeer::DELETED_AT, $this->deleted_at);
		if ($this->isColumnModified(AccountPeer::STATUS)) $criteria->add(AccountPeer::STATUS, $this->status);
		if ($this->isColumnModified(AccountPeer::UPDATED_AT)) $criteria->add(AccountPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(AccountPeer::DATABASE_NAME);

		$criteria->add(AccountPeer::ID, $this->id);

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

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setDeletedAt($this->deleted_at);

		$copyObj->setStatus($this->status);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getActivationCodes() as $relObj) {
				$copyObj->addActivationCode($relObj->copy($deepCopy));
			}

			foreach($this->getPrintConfigurations() as $relObj) {
				$copyObj->addPrintConfiguration($relObj->copy($deepCopy));
			}

			foreach($this->getsfGuardUserProfiles() as $relObj) {
				$copyObj->addsfGuardUserProfile($relObj->copy($deepCopy));
			}

			foreach($this->getWMGroups() as $relObj) {
				$copyObj->addWMGroup($relObj->copy($deepCopy));
			}

			foreach($this->getWatermarkImages() as $relObj) {
				$copyObj->addWatermarkImage($relObj->copy($deepCopy));
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
			self::$peer = new AccountPeer();
		}
		return self::$peer;
	}

	
	public function initActivationCodes()
	{
		if ($this->collActivationCodes === null) {
			$this->collActivationCodes = array();
		}
	}

	
	public function getActivationCodes($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseActivationCodePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collActivationCodes === null) {
			if ($this->isNew()) {
			   $this->collActivationCodes = array();
			} else {

				$criteria->add(ActivationCodePeer::ACCOUNT_ID, $this->getId());

				ActivationCodePeer::addSelectColumns($criteria);
				$this->collActivationCodes = ActivationCodePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ActivationCodePeer::ACCOUNT_ID, $this->getId());

				ActivationCodePeer::addSelectColumns($criteria);
				if (!isset($this->lastActivationCodeCriteria) || !$this->lastActivationCodeCriteria->equals($criteria)) {
					$this->collActivationCodes = ActivationCodePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastActivationCodeCriteria = $criteria;
		return $this->collActivationCodes;
	}

	
	public function countActivationCodes($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseActivationCodePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ActivationCodePeer::ACCOUNT_ID, $this->getId());

		return ActivationCodePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addActivationCode(ActivationCode $l)
	{
		$this->collActivationCodes[] = $l;
		$l->setAccount($this);
	}

	
	public function initPrintConfigurations()
	{
		if ($this->collPrintConfigurations === null) {
			$this->collPrintConfigurations = array();
		}
	}

	
	public function getPrintConfigurations($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePrintConfigurationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPrintConfigurations === null) {
			if ($this->isNew()) {
			   $this->collPrintConfigurations = array();
			} else {

				$criteria->add(PrintConfigurationPeer::ACCOUNT_ID, $this->getId());

				PrintConfigurationPeer::addSelectColumns($criteria);
				$this->collPrintConfigurations = PrintConfigurationPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PrintConfigurationPeer::ACCOUNT_ID, $this->getId());

				PrintConfigurationPeer::addSelectColumns($criteria);
				if (!isset($this->lastPrintConfigurationCriteria) || !$this->lastPrintConfigurationCriteria->equals($criteria)) {
					$this->collPrintConfigurations = PrintConfigurationPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPrintConfigurationCriteria = $criteria;
		return $this->collPrintConfigurations;
	}

	
	public function countPrintConfigurations($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasePrintConfigurationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PrintConfigurationPeer::ACCOUNT_ID, $this->getId());

		return PrintConfigurationPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPrintConfiguration(PrintConfiguration $l)
	{
		$this->collPrintConfigurations[] = $l;
		$l->setAccount($this);
	}


	
	public function getPrintConfigurationsJoinLayout($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePrintConfigurationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPrintConfigurations === null) {
			if ($this->isNew()) {
				$this->collPrintConfigurations = array();
			} else {

				$criteria->add(PrintConfigurationPeer::ACCOUNT_ID, $this->getId());

				$this->collPrintConfigurations = PrintConfigurationPeer::doSelectJoinLayout($criteria, $con);
			}
		} else {
									
			$criteria->add(PrintConfigurationPeer::ACCOUNT_ID, $this->getId());

			if (!isset($this->lastPrintConfigurationCriteria) || !$this->lastPrintConfigurationCriteria->equals($criteria)) {
				$this->collPrintConfigurations = PrintConfigurationPeer::doSelectJoinLayout($criteria, $con);
			}
		}
		$this->lastPrintConfigurationCriteria = $criteria;

		return $this->collPrintConfigurations;
	}


	
	public function getPrintConfigurationsJoinWatermarkImage($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePrintConfigurationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPrintConfigurations === null) {
			if ($this->isNew()) {
				$this->collPrintConfigurations = array();
			} else {

				$criteria->add(PrintConfigurationPeer::ACCOUNT_ID, $this->getId());

				$this->collPrintConfigurations = PrintConfigurationPeer::doSelectJoinWatermarkImage($criteria, $con);
			}
		} else {
									
			$criteria->add(PrintConfigurationPeer::ACCOUNT_ID, $this->getId());

			if (!isset($this->lastPrintConfigurationCriteria) || !$this->lastPrintConfigurationCriteria->equals($criteria)) {
				$this->collPrintConfigurations = PrintConfigurationPeer::doSelectJoinWatermarkImage($criteria, $con);
			}
		}
		$this->lastPrintConfigurationCriteria = $criteria;

		return $this->collPrintConfigurations;
	}


	
	public function getPrintConfigurationsJoinFont($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePrintConfigurationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPrintConfigurations === null) {
			if ($this->isNew()) {
				$this->collPrintConfigurations = array();
			} else {

				$criteria->add(PrintConfigurationPeer::ACCOUNT_ID, $this->getId());

				$this->collPrintConfigurations = PrintConfigurationPeer::doSelectJoinFont($criteria, $con);
			}
		} else {
									
			$criteria->add(PrintConfigurationPeer::ACCOUNT_ID, $this->getId());

			if (!isset($this->lastPrintConfigurationCriteria) || !$this->lastPrintConfigurationCriteria->equals($criteria)) {
				$this->collPrintConfigurations = PrintConfigurationPeer::doSelectJoinFont($criteria, $con);
			}
		}
		$this->lastPrintConfigurationCriteria = $criteria;

		return $this->collPrintConfigurations;
	}

	
	public function initsfGuardUserProfiles()
	{
		if ($this->collsfGuardUserProfiles === null) {
			$this->collsfGuardUserProfiles = array();
		}
	}

	
	public function getsfGuardUserProfiles($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasesfGuardUserProfilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfGuardUserProfiles === null) {
			if ($this->isNew()) {
			   $this->collsfGuardUserProfiles = array();
			} else {

				$criteria->add(sfGuardUserProfilePeer::ACCOUNT_ID, $this->getId());

				sfGuardUserProfilePeer::addSelectColumns($criteria);
				$this->collsfGuardUserProfiles = sfGuardUserProfilePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(sfGuardUserProfilePeer::ACCOUNT_ID, $this->getId());

				sfGuardUserProfilePeer::addSelectColumns($criteria);
				if (!isset($this->lastsfGuardUserProfileCriteria) || !$this->lastsfGuardUserProfileCriteria->equals($criteria)) {
					$this->collsfGuardUserProfiles = sfGuardUserProfilePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastsfGuardUserProfileCriteria = $criteria;
		return $this->collsfGuardUserProfiles;
	}

	
	public function countsfGuardUserProfiles($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasesfGuardUserProfilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(sfGuardUserProfilePeer::ACCOUNT_ID, $this->getId());

		return sfGuardUserProfilePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addsfGuardUserProfile(sfGuardUserProfile $l)
	{
		$this->collsfGuardUserProfiles[] = $l;
		$l->setAccount($this);
	}


	
	public function getsfGuardUserProfilesJoinsfGuardUser($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasesfGuardUserProfilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfGuardUserProfiles === null) {
			if ($this->isNew()) {
				$this->collsfGuardUserProfiles = array();
			} else {

				$criteria->add(sfGuardUserProfilePeer::ACCOUNT_ID, $this->getId());

				$this->collsfGuardUserProfiles = sfGuardUserProfilePeer::doSelectJoinsfGuardUser($criteria, $con);
			}
		} else {
									
			$criteria->add(sfGuardUserProfilePeer::ACCOUNT_ID, $this->getId());

			if (!isset($this->lastsfGuardUserProfileCriteria) || !$this->lastsfGuardUserProfileCriteria->equals($criteria)) {
				$this->collsfGuardUserProfiles = sfGuardUserProfilePeer::doSelectJoinsfGuardUser($criteria, $con);
			}
		}
		$this->lastsfGuardUserProfileCriteria = $criteria;

		return $this->collsfGuardUserProfiles;
	}

	
	public function initWMGroups()
	{
		if ($this->collWMGroups === null) {
			$this->collWMGroups = array();
		}
	}

	
	public function getWMGroups($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseWMGroupPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWMGroups === null) {
			if ($this->isNew()) {
			   $this->collWMGroups = array();
			} else {

				$criteria->add(WMGroupPeer::ACCOUNT_ID, $this->getId());

				WMGroupPeer::addSelectColumns($criteria);
				$this->collWMGroups = WMGroupPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(WMGroupPeer::ACCOUNT_ID, $this->getId());

				WMGroupPeer::addSelectColumns($criteria);
				if (!isset($this->lastWMGroupCriteria) || !$this->lastWMGroupCriteria->equals($criteria)) {
					$this->collWMGroups = WMGroupPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastWMGroupCriteria = $criteria;
		return $this->collWMGroups;
	}

	
	public function countWMGroups($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseWMGroupPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(WMGroupPeer::ACCOUNT_ID, $this->getId());

		return WMGroupPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addWMGroup(WMGroup $l)
	{
		$this->collWMGroups[] = $l;
		$l->setAccount($this);
	}

	
	public function initWatermarkImages()
	{
		if ($this->collWatermarkImages === null) {
			$this->collWatermarkImages = array();
		}
	}

	
	public function getWatermarkImages($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseWatermarkImagePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWatermarkImages === null) {
			if ($this->isNew()) {
			   $this->collWatermarkImages = array();
			} else {

				$criteria->add(WatermarkImagePeer::ACCOUNT_ID, $this->getId());

				WatermarkImagePeer::addSelectColumns($criteria);
				$this->collWatermarkImages = WatermarkImagePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(WatermarkImagePeer::ACCOUNT_ID, $this->getId());

				WatermarkImagePeer::addSelectColumns($criteria);
				if (!isset($this->lastWatermarkImageCriteria) || !$this->lastWatermarkImageCriteria->equals($criteria)) {
					$this->collWatermarkImages = WatermarkImagePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastWatermarkImageCriteria = $criteria;
		return $this->collWatermarkImages;
	}

	
	public function countWatermarkImages($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseWatermarkImagePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(WatermarkImagePeer::ACCOUNT_ID, $this->getId());

		return WatermarkImagePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addWatermarkImage(WatermarkImage $l)
	{
		$this->collWatermarkImages[] = $l;
		$l->setAccount($this);
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseAccount:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseAccount::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 