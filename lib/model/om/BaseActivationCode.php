<?php


abstract class BaseActivationCode extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $code;


	
	protected $created_at;


	
	protected $verified_at;


	
	protected $account_id;

	
	protected $aAccount;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getCode()
	{

		return $this->code;
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

	
	public function getVerifiedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->verified_at === null || $this->verified_at === '') {
			return null;
		} elseif (!is_int($this->verified_at)) {
						$ts = strtotime($this->verified_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [verified_at] as date/time value: " . var_export($this->verified_at, true));
			}
		} else {
			$ts = $this->verified_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getAccountId()
	{

		return $this->account_id;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ActivationCodePeer::ID;
		}

	} 
	
	public function setCode($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->code !== $v) {
			$this->code = $v;
			$this->modifiedColumns[] = ActivationCodePeer::CODE;
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
			$this->modifiedColumns[] = ActivationCodePeer::CREATED_AT;
		}

	} 
	
	public function setVerifiedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [verified_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->verified_at !== $ts) {
			$this->verified_at = $ts;
			$this->modifiedColumns[] = ActivationCodePeer::VERIFIED_AT;
		}

	} 
	
	public function setAccountId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->account_id !== $v) {
			$this->account_id = $v;
			$this->modifiedColumns[] = ActivationCodePeer::ACCOUNT_ID;
		}

		if ($this->aAccount !== null && $this->aAccount->getId() !== $v) {
			$this->aAccount = null;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->code = $rs->getString($startcol + 1);

			$this->created_at = $rs->getTimestamp($startcol + 2, null);

			$this->verified_at = $rs->getTimestamp($startcol + 3, null);

			$this->account_id = $rs->getInt($startcol + 4);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating ActivationCode object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseActivationCode:delete:pre') as $callable)
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
			$con = Propel::getConnection(ActivationCodePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ActivationCodePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseActivationCode:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseActivationCode:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(ActivationCodePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ActivationCodePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseActivationCode:save:post') as $callable)
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ActivationCodePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ActivationCodePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

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


			if (($retval = ActivationCodePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ActivationCodePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getCode();
				break;
			case 2:
				return $this->getCreatedAt();
				break;
			case 3:
				return $this->getVerifiedAt();
				break;
			case 4:
				return $this->getAccountId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ActivationCodePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCode(),
			$keys[2] => $this->getCreatedAt(),
			$keys[3] => $this->getVerifiedAt(),
			$keys[4] => $this->getAccountId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ActivationCodePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setCode($value);
				break;
			case 2:
				$this->setCreatedAt($value);
				break;
			case 3:
				$this->setVerifiedAt($value);
				break;
			case 4:
				$this->setAccountId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ActivationCodePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCode($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCreatedAt($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setVerifiedAt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setAccountId($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ActivationCodePeer::DATABASE_NAME);

		if ($this->isColumnModified(ActivationCodePeer::ID)) $criteria->add(ActivationCodePeer::ID, $this->id);
		if ($this->isColumnModified(ActivationCodePeer::CODE)) $criteria->add(ActivationCodePeer::CODE, $this->code);
		if ($this->isColumnModified(ActivationCodePeer::CREATED_AT)) $criteria->add(ActivationCodePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ActivationCodePeer::VERIFIED_AT)) $criteria->add(ActivationCodePeer::VERIFIED_AT, $this->verified_at);
		if ($this->isColumnModified(ActivationCodePeer::ACCOUNT_ID)) $criteria->add(ActivationCodePeer::ACCOUNT_ID, $this->account_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ActivationCodePeer::DATABASE_NAME);

		$criteria->add(ActivationCodePeer::ID, $this->id);

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

		$copyObj->setCode($this->code);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setVerifiedAt($this->verified_at);

		$copyObj->setAccountId($this->account_id);


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
			self::$peer = new ActivationCodePeer();
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


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseActivationCode:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseActivationCode::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 