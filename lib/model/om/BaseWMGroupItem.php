<?php


abstract class BaseWMGroupItem extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $wm_group_id;


	
	protected $value;


	
	protected $alt_value;


	
	protected $created_at;

	
	protected $aWMGroup;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getWmGroupId()
	{

		return $this->wm_group_id;
	}

	
	public function getValue()
	{

		return $this->value;
	}

	
	public function getAltValue()
	{

		return $this->alt_value;
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
			$this->modifiedColumns[] = WMGroupItemPeer::ID;
		}

	} 
	
	public function setWmGroupId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->wm_group_id !== $v) {
			$this->wm_group_id = $v;
			$this->modifiedColumns[] = WMGroupItemPeer::WM_GROUP_ID;
		}

		if ($this->aWMGroup !== null && $this->aWMGroup->getId() !== $v) {
			$this->aWMGroup = null;
		}

	} 
	
	public function setValue($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->value !== $v) {
			$this->value = $v;
			$this->modifiedColumns[] = WMGroupItemPeer::VALUE;
		}

	} 
	
	public function setAltValue($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->alt_value !== $v) {
			$this->alt_value = $v;
			$this->modifiedColumns[] = WMGroupItemPeer::ALT_VALUE;
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
			$this->modifiedColumns[] = WMGroupItemPeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->wm_group_id = $rs->getInt($startcol + 1);

			$this->value = $rs->getString($startcol + 2);

			$this->alt_value = $rs->getString($startcol + 3);

			$this->created_at = $rs->getTimestamp($startcol + 4, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating WMGroupItem object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseWMGroupItem:delete:pre') as $callable)
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
			$con = Propel::getConnection(WMGroupItemPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			WMGroupItemPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseWMGroupItem:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseWMGroupItem:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(WMGroupItemPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(WMGroupItemPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseWMGroupItem:save:post') as $callable)
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


												
			if ($this->aWMGroup !== null) {
				if ($this->aWMGroup->isModified()) {
					$affectedRows += $this->aWMGroup->save($con);
				}
				$this->setWMGroup($this->aWMGroup);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = WMGroupItemPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += WMGroupItemPeer::doUpdate($this, $con);
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


												
			if ($this->aWMGroup !== null) {
				if (!$this->aWMGroup->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aWMGroup->getValidationFailures());
				}
			}


			if (($retval = WMGroupItemPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = WMGroupItemPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getWmGroupId();
				break;
			case 2:
				return $this->getValue();
				break;
			case 3:
				return $this->getAltValue();
				break;
			case 4:
				return $this->getCreatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = WMGroupItemPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getWmGroupId(),
			$keys[2] => $this->getValue(),
			$keys[3] => $this->getAltValue(),
			$keys[4] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = WMGroupItemPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setWmGroupId($value);
				break;
			case 2:
				$this->setValue($value);
				break;
			case 3:
				$this->setAltValue($value);
				break;
			case 4:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = WMGroupItemPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setWmGroupId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setValue($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setAltValue($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCreatedAt($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(WMGroupItemPeer::DATABASE_NAME);

		if ($this->isColumnModified(WMGroupItemPeer::ID)) $criteria->add(WMGroupItemPeer::ID, $this->id);
		if ($this->isColumnModified(WMGroupItemPeer::WM_GROUP_ID)) $criteria->add(WMGroupItemPeer::WM_GROUP_ID, $this->wm_group_id);
		if ($this->isColumnModified(WMGroupItemPeer::VALUE)) $criteria->add(WMGroupItemPeer::VALUE, $this->value);
		if ($this->isColumnModified(WMGroupItemPeer::ALT_VALUE)) $criteria->add(WMGroupItemPeer::ALT_VALUE, $this->alt_value);
		if ($this->isColumnModified(WMGroupItemPeer::CREATED_AT)) $criteria->add(WMGroupItemPeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(WMGroupItemPeer::DATABASE_NAME);

		$criteria->add(WMGroupItemPeer::ID, $this->id);

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

		$copyObj->setWmGroupId($this->wm_group_id);

		$copyObj->setValue($this->value);

		$copyObj->setAltValue($this->alt_value);

		$copyObj->setCreatedAt($this->created_at);


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
			self::$peer = new WMGroupItemPeer();
		}
		return self::$peer;
	}

	
	public function setWMGroup($v)
	{


		if ($v === null) {
			$this->setWmGroupId(NULL);
		} else {
			$this->setWmGroupId($v->getId());
		}


		$this->aWMGroup = $v;
	}


	
	public function getWMGroup($con = null)
	{
		if ($this->aWMGroup === null && ($this->wm_group_id !== null)) {
						include_once 'lib/model/om/BaseWMGroupPeer.php';

			$this->aWMGroup = WMGroupPeer::retrieveByPK($this->wm_group_id, $con);

			
		}
		return $this->aWMGroup;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseWMGroupItem:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseWMGroupItem::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 