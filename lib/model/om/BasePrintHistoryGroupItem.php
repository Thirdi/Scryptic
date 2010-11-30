<?php


abstract class BasePrintHistoryGroupItem extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $print_history_group_id;


	
	protected $value;

	
	protected $aPrintHistoryGroup;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getPrintHistoryGroupId()
	{

		return $this->print_history_group_id;
	}

	
	public function getValue()
	{

		return $this->value;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = PrintHistoryGroupItemPeer::ID;
		}

	} 
	
	public function setPrintHistoryGroupId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->print_history_group_id !== $v) {
			$this->print_history_group_id = $v;
			$this->modifiedColumns[] = PrintHistoryGroupItemPeer::PRINT_HISTORY_GROUP_ID;
		}

		if ($this->aPrintHistoryGroup !== null && $this->aPrintHistoryGroup->getId() !== $v) {
			$this->aPrintHistoryGroup = null;
		}

	} 
	
	public function setValue($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->value !== $v) {
			$this->value = $v;
			$this->modifiedColumns[] = PrintHistoryGroupItemPeer::VALUE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->print_history_group_id = $rs->getInt($startcol + 1);

			$this->value = $rs->getString($startcol + 2);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating PrintHistoryGroupItem object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BasePrintHistoryGroupItem:delete:pre') as $callable)
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
			$con = Propel::getConnection(PrintHistoryGroupItemPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PrintHistoryGroupItemPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BasePrintHistoryGroupItem:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BasePrintHistoryGroupItem:save:pre') as $callable)
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
			$con = Propel::getConnection(PrintHistoryGroupItemPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BasePrintHistoryGroupItem:save:post') as $callable)
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


												
			if ($this->aPrintHistoryGroup !== null) {
				if ($this->aPrintHistoryGroup->isModified()) {
					$affectedRows += $this->aPrintHistoryGroup->save($con);
				}
				$this->setPrintHistoryGroup($this->aPrintHistoryGroup);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = PrintHistoryGroupItemPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += PrintHistoryGroupItemPeer::doUpdate($this, $con);
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


												
			if ($this->aPrintHistoryGroup !== null) {
				if (!$this->aPrintHistoryGroup->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPrintHistoryGroup->getValidationFailures());
				}
			}


			if (($retval = PrintHistoryGroupItemPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PrintHistoryGroupItemPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getPrintHistoryGroupId();
				break;
			case 2:
				return $this->getValue();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PrintHistoryGroupItemPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getPrintHistoryGroupId(),
			$keys[2] => $this->getValue(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PrintHistoryGroupItemPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setPrintHistoryGroupId($value);
				break;
			case 2:
				$this->setValue($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PrintHistoryGroupItemPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPrintHistoryGroupId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setValue($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PrintHistoryGroupItemPeer::DATABASE_NAME);

		if ($this->isColumnModified(PrintHistoryGroupItemPeer::ID)) $criteria->add(PrintHistoryGroupItemPeer::ID, $this->id);
		if ($this->isColumnModified(PrintHistoryGroupItemPeer::PRINT_HISTORY_GROUP_ID)) $criteria->add(PrintHistoryGroupItemPeer::PRINT_HISTORY_GROUP_ID, $this->print_history_group_id);
		if ($this->isColumnModified(PrintHistoryGroupItemPeer::VALUE)) $criteria->add(PrintHistoryGroupItemPeer::VALUE, $this->value);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PrintHistoryGroupItemPeer::DATABASE_NAME);

		$criteria->add(PrintHistoryGroupItemPeer::ID, $this->id);

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

		$copyObj->setPrintHistoryGroupId($this->print_history_group_id);

		$copyObj->setValue($this->value);


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
			self::$peer = new PrintHistoryGroupItemPeer();
		}
		return self::$peer;
	}

	
	public function setPrintHistoryGroup($v)
	{


		if ($v === null) {
			$this->setPrintHistoryGroupId(NULL);
		} else {
			$this->setPrintHistoryGroupId($v->getId());
		}


		$this->aPrintHistoryGroup = $v;
	}


	
	public function getPrintHistoryGroup($con = null)
	{
		if ($this->aPrintHistoryGroup === null && ($this->print_history_group_id !== null)) {
						include_once 'lib/model/om/BasePrintHistoryGroupPeer.php';

			$this->aPrintHistoryGroup = PrintHistoryGroupPeer::retrieveByPK($this->print_history_group_id, $con);

			
		}
		return $this->aPrintHistoryGroup;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BasePrintHistoryGroupItem:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BasePrintHistoryGroupItem::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 