<?php


abstract class BasePrintHistoryGroup extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $print_history_id;


	
	protected $name;

	
	protected $aPrintHistory;

	
	protected $collPrintHistoryGroupItems;

	
	protected $lastPrintHistoryGroupItemCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getPrintHistoryId()
	{

		return $this->print_history_id;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = PrintHistoryGroupPeer::ID;
		}

	} 
	
	public function setPrintHistoryId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->print_history_id !== $v) {
			$this->print_history_id = $v;
			$this->modifiedColumns[] = PrintHistoryGroupPeer::PRINT_HISTORY_ID;
		}

		if ($this->aPrintHistory !== null && $this->aPrintHistory->getId() !== $v) {
			$this->aPrintHistory = null;
		}

	} 
	
	public function setName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = PrintHistoryGroupPeer::NAME;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->print_history_id = $rs->getInt($startcol + 1);

			$this->name = $rs->getString($startcol + 2);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating PrintHistoryGroup object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BasePrintHistoryGroup:delete:pre') as $callable)
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
			$con = Propel::getConnection(PrintHistoryGroupPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PrintHistoryGroupPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BasePrintHistoryGroup:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BasePrintHistoryGroup:save:pre') as $callable)
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
			$con = Propel::getConnection(PrintHistoryGroupPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BasePrintHistoryGroup:save:post') as $callable)
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


												
			if ($this->aPrintHistory !== null) {
				if ($this->aPrintHistory->isModified()) {
					$affectedRows += $this->aPrintHistory->save($con);
				}
				$this->setPrintHistory($this->aPrintHistory);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = PrintHistoryGroupPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += PrintHistoryGroupPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collPrintHistoryGroupItems !== null) {
				foreach($this->collPrintHistoryGroupItems as $referrerFK) {
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


												
			if ($this->aPrintHistory !== null) {
				if (!$this->aPrintHistory->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPrintHistory->getValidationFailures());
				}
			}


			if (($retval = PrintHistoryGroupPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collPrintHistoryGroupItems !== null) {
					foreach($this->collPrintHistoryGroupItems as $referrerFK) {
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
		$pos = PrintHistoryGroupPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getPrintHistoryId();
				break;
			case 2:
				return $this->getName();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PrintHistoryGroupPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getPrintHistoryId(),
			$keys[2] => $this->getName(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PrintHistoryGroupPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setPrintHistoryId($value);
				break;
			case 2:
				$this->setName($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PrintHistoryGroupPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPrintHistoryId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setName($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PrintHistoryGroupPeer::DATABASE_NAME);

		if ($this->isColumnModified(PrintHistoryGroupPeer::ID)) $criteria->add(PrintHistoryGroupPeer::ID, $this->id);
		if ($this->isColumnModified(PrintHistoryGroupPeer::PRINT_HISTORY_ID)) $criteria->add(PrintHistoryGroupPeer::PRINT_HISTORY_ID, $this->print_history_id);
		if ($this->isColumnModified(PrintHistoryGroupPeer::NAME)) $criteria->add(PrintHistoryGroupPeer::NAME, $this->name);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PrintHistoryGroupPeer::DATABASE_NAME);

		$criteria->add(PrintHistoryGroupPeer::ID, $this->id);

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

		$copyObj->setPrintHistoryId($this->print_history_id);

		$copyObj->setName($this->name);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getPrintHistoryGroupItems() as $relObj) {
				$copyObj->addPrintHistoryGroupItem($relObj->copy($deepCopy));
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
			self::$peer = new PrintHistoryGroupPeer();
		}
		return self::$peer;
	}

	
	public function setPrintHistory($v)
	{


		if ($v === null) {
			$this->setPrintHistoryId(NULL);
		} else {
			$this->setPrintHistoryId($v->getId());
		}


		$this->aPrintHistory = $v;
	}


	
	public function getPrintHistory($con = null)
	{
		if ($this->aPrintHistory === null && ($this->print_history_id !== null)) {
						include_once 'lib/model/om/BasePrintHistoryPeer.php';

			$this->aPrintHistory = PrintHistoryPeer::retrieveByPK($this->print_history_id, $con);

			
		}
		return $this->aPrintHistory;
	}

	
	public function initPrintHistoryGroupItems()
	{
		if ($this->collPrintHistoryGroupItems === null) {
			$this->collPrintHistoryGroupItems = array();
		}
	}

	
	public function getPrintHistoryGroupItems($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePrintHistoryGroupItemPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPrintHistoryGroupItems === null) {
			if ($this->isNew()) {
			   $this->collPrintHistoryGroupItems = array();
			} else {

				$criteria->add(PrintHistoryGroupItemPeer::PRINT_HISTORY_GROUP_ID, $this->getId());

				PrintHistoryGroupItemPeer::addSelectColumns($criteria);
				$this->collPrintHistoryGroupItems = PrintHistoryGroupItemPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PrintHistoryGroupItemPeer::PRINT_HISTORY_GROUP_ID, $this->getId());

				PrintHistoryGroupItemPeer::addSelectColumns($criteria);
				if (!isset($this->lastPrintHistoryGroupItemCriteria) || !$this->lastPrintHistoryGroupItemCriteria->equals($criteria)) {
					$this->collPrintHistoryGroupItems = PrintHistoryGroupItemPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPrintHistoryGroupItemCriteria = $criteria;
		return $this->collPrintHistoryGroupItems;
	}

	
	public function countPrintHistoryGroupItems($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasePrintHistoryGroupItemPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PrintHistoryGroupItemPeer::PRINT_HISTORY_GROUP_ID, $this->getId());

		return PrintHistoryGroupItemPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPrintHistoryGroupItem(PrintHistoryGroupItem $l)
	{
		$this->collPrintHistoryGroupItems[] = $l;
		$l->setPrintHistoryGroup($this);
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BasePrintHistoryGroup:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BasePrintHistoryGroup::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 