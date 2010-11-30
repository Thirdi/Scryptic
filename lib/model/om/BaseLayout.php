<?php


abstract class BaseLayout extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $name;


	
	protected $image;


	
	protected $php_obj;

	
	protected $collPrintConfigurations;

	
	protected $lastPrintConfigurationCriteria = null;

	
	protected $collPrintHistoryConfigurations;

	
	protected $lastPrintHistoryConfigurationCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getImage()
	{

		return $this->image;
	}

	
	public function getPhpObj()
	{

		return $this->php_obj;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = LayoutPeer::ID;
		}

	} 
	
	public function setName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = LayoutPeer::NAME;
		}

	} 
	
	public function setImage($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->image !== $v) {
			$this->image = $v;
			$this->modifiedColumns[] = LayoutPeer::IMAGE;
		}

	} 
	
	public function setPhpObj($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->php_obj !== $v) {
			$this->php_obj = $v;
			$this->modifiedColumns[] = LayoutPeer::PHP_OBJ;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->name = $rs->getString($startcol + 1);

			$this->image = $rs->getString($startcol + 2);

			$this->php_obj = $rs->getString($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Layout object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseLayout:delete:pre') as $callable)
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
			$con = Propel::getConnection(LayoutPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			LayoutPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseLayout:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseLayout:save:pre') as $callable)
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
			$con = Propel::getConnection(LayoutPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseLayout:save:post') as $callable)
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
					$pk = LayoutPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += LayoutPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collPrintConfigurations !== null) {
				foreach($this->collPrintConfigurations as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPrintHistoryConfigurations !== null) {
				foreach($this->collPrintHistoryConfigurations as $referrerFK) {
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


			if (($retval = LayoutPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collPrintConfigurations !== null) {
					foreach($this->collPrintConfigurations as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPrintHistoryConfigurations !== null) {
					foreach($this->collPrintHistoryConfigurations as $referrerFK) {
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
		$pos = LayoutPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getName();
				break;
			case 2:
				return $this->getImage();
				break;
			case 3:
				return $this->getPhpObj();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = LayoutPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getImage(),
			$keys[3] => $this->getPhpObj(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = LayoutPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setName($value);
				break;
			case 2:
				$this->setImage($value);
				break;
			case 3:
				$this->setPhpObj($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = LayoutPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setImage($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPhpObj($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(LayoutPeer::DATABASE_NAME);

		if ($this->isColumnModified(LayoutPeer::ID)) $criteria->add(LayoutPeer::ID, $this->id);
		if ($this->isColumnModified(LayoutPeer::NAME)) $criteria->add(LayoutPeer::NAME, $this->name);
		if ($this->isColumnModified(LayoutPeer::IMAGE)) $criteria->add(LayoutPeer::IMAGE, $this->image);
		if ($this->isColumnModified(LayoutPeer::PHP_OBJ)) $criteria->add(LayoutPeer::PHP_OBJ, $this->php_obj);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(LayoutPeer::DATABASE_NAME);

		$criteria->add(LayoutPeer::ID, $this->id);

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

		$copyObj->setName($this->name);

		$copyObj->setImage($this->image);

		$copyObj->setPhpObj($this->php_obj);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getPrintConfigurations() as $relObj) {
				$copyObj->addPrintConfiguration($relObj->copy($deepCopy));
			}

			foreach($this->getPrintHistoryConfigurations() as $relObj) {
				$copyObj->addPrintHistoryConfiguration($relObj->copy($deepCopy));
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
			self::$peer = new LayoutPeer();
		}
		return self::$peer;
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

				$criteria->add(PrintConfigurationPeer::LAYOUT_ID, $this->getId());

				PrintConfigurationPeer::addSelectColumns($criteria);
				$this->collPrintConfigurations = PrintConfigurationPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PrintConfigurationPeer::LAYOUT_ID, $this->getId());

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

		$criteria->add(PrintConfigurationPeer::LAYOUT_ID, $this->getId());

		return PrintConfigurationPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPrintConfiguration(PrintConfiguration $l)
	{
		$this->collPrintConfigurations[] = $l;
		$l->setLayout($this);
	}


	
	public function getPrintConfigurationsJoinAccount($criteria = null, $con = null)
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

				$criteria->add(PrintConfigurationPeer::LAYOUT_ID, $this->getId());

				$this->collPrintConfigurations = PrintConfigurationPeer::doSelectJoinAccount($criteria, $con);
			}
		} else {
									
			$criteria->add(PrintConfigurationPeer::LAYOUT_ID, $this->getId());

			if (!isset($this->lastPrintConfigurationCriteria) || !$this->lastPrintConfigurationCriteria->equals($criteria)) {
				$this->collPrintConfigurations = PrintConfigurationPeer::doSelectJoinAccount($criteria, $con);
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

				$criteria->add(PrintConfigurationPeer::LAYOUT_ID, $this->getId());

				$this->collPrintConfigurations = PrintConfigurationPeer::doSelectJoinWatermarkImage($criteria, $con);
			}
		} else {
									
			$criteria->add(PrintConfigurationPeer::LAYOUT_ID, $this->getId());

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

				$criteria->add(PrintConfigurationPeer::LAYOUT_ID, $this->getId());

				$this->collPrintConfigurations = PrintConfigurationPeer::doSelectJoinFont($criteria, $con);
			}
		} else {
									
			$criteria->add(PrintConfigurationPeer::LAYOUT_ID, $this->getId());

			if (!isset($this->lastPrintConfigurationCriteria) || !$this->lastPrintConfigurationCriteria->equals($criteria)) {
				$this->collPrintConfigurations = PrintConfigurationPeer::doSelectJoinFont($criteria, $con);
			}
		}
		$this->lastPrintConfigurationCriteria = $criteria;

		return $this->collPrintConfigurations;
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

				$criteria->add(PrintHistoryConfigurationPeer::LAYOUT_ID, $this->getId());

				PrintHistoryConfigurationPeer::addSelectColumns($criteria);
				$this->collPrintHistoryConfigurations = PrintHistoryConfigurationPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PrintHistoryConfigurationPeer::LAYOUT_ID, $this->getId());

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

		$criteria->add(PrintHistoryConfigurationPeer::LAYOUT_ID, $this->getId());

		return PrintHistoryConfigurationPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPrintHistoryConfiguration(PrintHistoryConfiguration $l)
	{
		$this->collPrintHistoryConfigurations[] = $l;
		$l->setLayout($this);
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

				$criteria->add(PrintHistoryConfigurationPeer::LAYOUT_ID, $this->getId());

				$this->collPrintHistoryConfigurations = PrintHistoryConfigurationPeer::doSelectJoinFont($criteria, $con);
			}
		} else {
									
			$criteria->add(PrintHistoryConfigurationPeer::LAYOUT_ID, $this->getId());

			if (!isset($this->lastPrintHistoryConfigurationCriteria) || !$this->lastPrintHistoryConfigurationCriteria->equals($criteria)) {
				$this->collPrintHistoryConfigurations = PrintHistoryConfigurationPeer::doSelectJoinFont($criteria, $con);
			}
		}
		$this->lastPrintHistoryConfigurationCriteria = $criteria;

		return $this->collPrintHistoryConfigurations;
	}


	
	public function getPrintHistoryConfigurationsJoinPrintHistory($criteria = null, $con = null)
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

				$criteria->add(PrintHistoryConfigurationPeer::LAYOUT_ID, $this->getId());

				$this->collPrintHistoryConfigurations = PrintHistoryConfigurationPeer::doSelectJoinPrintHistory($criteria, $con);
			}
		} else {
									
			$criteria->add(PrintHistoryConfigurationPeer::LAYOUT_ID, $this->getId());

			if (!isset($this->lastPrintHistoryConfigurationCriteria) || !$this->lastPrintHistoryConfigurationCriteria->equals($criteria)) {
				$this->collPrintHistoryConfigurations = PrintHistoryConfigurationPeer::doSelectJoinPrintHistory($criteria, $con);
			}
		}
		$this->lastPrintHistoryConfigurationCriteria = $criteria;

		return $this->collPrintHistoryConfigurations;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseLayout:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseLayout::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 