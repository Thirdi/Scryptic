<?php


abstract class BaseWMGroup extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $account_id;


	
	protected $name;


	
	protected $created_at;

	
	protected $aAccount;

	
	protected $collWMGroupItems;

	
	protected $lastWMGroupItemCriteria = null;

	
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

	
	public function getName()
	{

		return $this->name;
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
			$this->modifiedColumns[] = WMGroupPeer::ID;
		}

	} 
	
	public function setAccountId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->account_id !== $v) {
			$this->account_id = $v;
			$this->modifiedColumns[] = WMGroupPeer::ACCOUNT_ID;
		}

		if ($this->aAccount !== null && $this->aAccount->getId() !== $v) {
			$this->aAccount = null;
		}

	} 
	
	public function setName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = WMGroupPeer::NAME;
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
			$this->modifiedColumns[] = WMGroupPeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->account_id = $rs->getInt($startcol + 1);

			$this->name = $rs->getString($startcol + 2);

			$this->created_at = $rs->getTimestamp($startcol + 3, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating WMGroup object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseWMGroup:delete:pre') as $callable)
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
			$con = Propel::getConnection(WMGroupPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			WMGroupPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseWMGroup:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseWMGroup:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(WMGroupPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(WMGroupPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseWMGroup:save:post') as $callable)
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
					$pk = WMGroupPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += WMGroupPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collWMGroupItems !== null) {
				foreach($this->collWMGroupItems as $referrerFK) {
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


			if (($retval = WMGroupPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collWMGroupItems !== null) {
					foreach($this->collWMGroupItems as $referrerFK) {
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
		$pos = WMGroupPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getName();
				break;
			case 3:
				return $this->getCreatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = WMGroupPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getAccountId(),
			$keys[2] => $this->getName(),
			$keys[3] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = WMGroupPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setName($value);
				break;
			case 3:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = WMGroupPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setAccountId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCreatedAt($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(WMGroupPeer::DATABASE_NAME);

		if ($this->isColumnModified(WMGroupPeer::ID)) $criteria->add(WMGroupPeer::ID, $this->id);
		if ($this->isColumnModified(WMGroupPeer::ACCOUNT_ID)) $criteria->add(WMGroupPeer::ACCOUNT_ID, $this->account_id);
		if ($this->isColumnModified(WMGroupPeer::NAME)) $criteria->add(WMGroupPeer::NAME, $this->name);
		if ($this->isColumnModified(WMGroupPeer::CREATED_AT)) $criteria->add(WMGroupPeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(WMGroupPeer::DATABASE_NAME);

		$criteria->add(WMGroupPeer::ID, $this->id);

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

		$copyObj->setName($this->name);

		$copyObj->setCreatedAt($this->created_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getWMGroupItems() as $relObj) {
				$copyObj->addWMGroupItem($relObj->copy($deepCopy));
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
			self::$peer = new WMGroupPeer();
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

	
	public function initWMGroupItems()
	{
		if ($this->collWMGroupItems === null) {
			$this->collWMGroupItems = array();
		}
	}

	
	public function getWMGroupItems($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseWMGroupItemPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWMGroupItems === null) {
			if ($this->isNew()) {
			   $this->collWMGroupItems = array();
			} else {

				$criteria->add(WMGroupItemPeer::WM_GROUP_ID, $this->getId());

				WMGroupItemPeer::addSelectColumns($criteria);
				$this->collWMGroupItems = WMGroupItemPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(WMGroupItemPeer::WM_GROUP_ID, $this->getId());

				WMGroupItemPeer::addSelectColumns($criteria);
				if (!isset($this->lastWMGroupItemCriteria) || !$this->lastWMGroupItemCriteria->equals($criteria)) {
					$this->collWMGroupItems = WMGroupItemPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastWMGroupItemCriteria = $criteria;
		return $this->collWMGroupItems;
	}

	
	public function countWMGroupItems($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseWMGroupItemPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(WMGroupItemPeer::WM_GROUP_ID, $this->getId());

		return WMGroupItemPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addWMGroupItem(WMGroupItem $l)
	{
		$this->collWMGroupItems[] = $l;
		$l->setWMGroup($this);
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseWMGroup:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseWMGroup::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 