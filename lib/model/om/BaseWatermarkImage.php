<?php


abstract class BaseWatermarkImage extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $account_id;


	
	protected $image_name;


	
	protected $content_type;


	
	protected $is_deleted;


	
	protected $width = 0;


	
	protected $height = 0;

	
	protected $aAccount;

	
	protected $collPrintConfigurations;

	
	protected $lastPrintConfigurationCriteria = null;

	
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

	
	public function getImageName()
	{

		return $this->image_name;
	}

	
	public function getContentType()
	{

		return $this->content_type;
	}

	
	public function getIsDeleted()
	{

		return $this->is_deleted;
	}

	
	public function getWidth()
	{

		return $this->width;
	}

	
	public function getHeight()
	{

		return $this->height;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = WatermarkImagePeer::ID;
		}

	} 
	
	public function setAccountId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->account_id !== $v) {
			$this->account_id = $v;
			$this->modifiedColumns[] = WatermarkImagePeer::ACCOUNT_ID;
		}

		if ($this->aAccount !== null && $this->aAccount->getId() !== $v) {
			$this->aAccount = null;
		}

	} 
	
	public function setImageName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->image_name !== $v) {
			$this->image_name = $v;
			$this->modifiedColumns[] = WatermarkImagePeer::IMAGE_NAME;
		}

	} 
	
	public function setContentType($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->content_type !== $v) {
			$this->content_type = $v;
			$this->modifiedColumns[] = WatermarkImagePeer::CONTENT_TYPE;
		}

	} 
	
	public function setIsDeleted($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->is_deleted !== $v) {
			$this->is_deleted = $v;
			$this->modifiedColumns[] = WatermarkImagePeer::IS_DELETED;
		}

	} 
	
	public function setWidth($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->width !== $v || $v === 0) {
			$this->width = $v;
			$this->modifiedColumns[] = WatermarkImagePeer::WIDTH;
		}

	} 
	
	public function setHeight($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->height !== $v || $v === 0) {
			$this->height = $v;
			$this->modifiedColumns[] = WatermarkImagePeer::HEIGHT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->account_id = $rs->getInt($startcol + 1);

			$this->image_name = $rs->getString($startcol + 2);

			$this->content_type = $rs->getString($startcol + 3);

			$this->is_deleted = $rs->getInt($startcol + 4);

			$this->width = $rs->getInt($startcol + 5);

			$this->height = $rs->getInt($startcol + 6);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating WatermarkImage object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseWatermarkImage:delete:pre') as $callable)
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
			$con = Propel::getConnection(WatermarkImagePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			WatermarkImagePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseWatermarkImage:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseWatermarkImage:save:pre') as $callable)
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
			$con = Propel::getConnection(WatermarkImagePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseWatermarkImage:save:post') as $callable)
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
					$pk = WatermarkImagePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += WatermarkImagePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collPrintConfigurations !== null) {
				foreach($this->collPrintConfigurations as $referrerFK) {
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


			if (($retval = WatermarkImagePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collPrintConfigurations !== null) {
					foreach($this->collPrintConfigurations as $referrerFK) {
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
		$pos = WatermarkImagePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getImageName();
				break;
			case 3:
				return $this->getContentType();
				break;
			case 4:
				return $this->getIsDeleted();
				break;
			case 5:
				return $this->getWidth();
				break;
			case 6:
				return $this->getHeight();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = WatermarkImagePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getAccountId(),
			$keys[2] => $this->getImageName(),
			$keys[3] => $this->getContentType(),
			$keys[4] => $this->getIsDeleted(),
			$keys[5] => $this->getWidth(),
			$keys[6] => $this->getHeight(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = WatermarkImagePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setImageName($value);
				break;
			case 3:
				$this->setContentType($value);
				break;
			case 4:
				$this->setIsDeleted($value);
				break;
			case 5:
				$this->setWidth($value);
				break;
			case 6:
				$this->setHeight($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = WatermarkImagePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setAccountId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setImageName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setContentType($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setIsDeleted($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setWidth($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setHeight($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(WatermarkImagePeer::DATABASE_NAME);

		if ($this->isColumnModified(WatermarkImagePeer::ID)) $criteria->add(WatermarkImagePeer::ID, $this->id);
		if ($this->isColumnModified(WatermarkImagePeer::ACCOUNT_ID)) $criteria->add(WatermarkImagePeer::ACCOUNT_ID, $this->account_id);
		if ($this->isColumnModified(WatermarkImagePeer::IMAGE_NAME)) $criteria->add(WatermarkImagePeer::IMAGE_NAME, $this->image_name);
		if ($this->isColumnModified(WatermarkImagePeer::CONTENT_TYPE)) $criteria->add(WatermarkImagePeer::CONTENT_TYPE, $this->content_type);
		if ($this->isColumnModified(WatermarkImagePeer::IS_DELETED)) $criteria->add(WatermarkImagePeer::IS_DELETED, $this->is_deleted);
		if ($this->isColumnModified(WatermarkImagePeer::WIDTH)) $criteria->add(WatermarkImagePeer::WIDTH, $this->width);
		if ($this->isColumnModified(WatermarkImagePeer::HEIGHT)) $criteria->add(WatermarkImagePeer::HEIGHT, $this->height);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(WatermarkImagePeer::DATABASE_NAME);

		$criteria->add(WatermarkImagePeer::ID, $this->id);

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

		$copyObj->setImageName($this->image_name);

		$copyObj->setContentType($this->content_type);

		$copyObj->setIsDeleted($this->is_deleted);

		$copyObj->setWidth($this->width);

		$copyObj->setHeight($this->height);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getPrintConfigurations() as $relObj) {
				$copyObj->addPrintConfiguration($relObj->copy($deepCopy));
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
			self::$peer = new WatermarkImagePeer();
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

				$criteria->add(PrintConfigurationPeer::WATERMARK_IMAGE_ID, $this->getId());

				PrintConfigurationPeer::addSelectColumns($criteria);
				$this->collPrintConfigurations = PrintConfigurationPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PrintConfigurationPeer::WATERMARK_IMAGE_ID, $this->getId());

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

		$criteria->add(PrintConfigurationPeer::WATERMARK_IMAGE_ID, $this->getId());

		return PrintConfigurationPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPrintConfiguration(PrintConfiguration $l)
	{
		$this->collPrintConfigurations[] = $l;
		$l->setWatermarkImage($this);
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

				$criteria->add(PrintConfigurationPeer::WATERMARK_IMAGE_ID, $this->getId());

				$this->collPrintConfigurations = PrintConfigurationPeer::doSelectJoinAccount($criteria, $con);
			}
		} else {
									
			$criteria->add(PrintConfigurationPeer::WATERMARK_IMAGE_ID, $this->getId());

			if (!isset($this->lastPrintConfigurationCriteria) || !$this->lastPrintConfigurationCriteria->equals($criteria)) {
				$this->collPrintConfigurations = PrintConfigurationPeer::doSelectJoinAccount($criteria, $con);
			}
		}
		$this->lastPrintConfigurationCriteria = $criteria;

		return $this->collPrintConfigurations;
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

				$criteria->add(PrintConfigurationPeer::WATERMARK_IMAGE_ID, $this->getId());

				$this->collPrintConfigurations = PrintConfigurationPeer::doSelectJoinLayout($criteria, $con);
			}
		} else {
									
			$criteria->add(PrintConfigurationPeer::WATERMARK_IMAGE_ID, $this->getId());

			if (!isset($this->lastPrintConfigurationCriteria) || !$this->lastPrintConfigurationCriteria->equals($criteria)) {
				$this->collPrintConfigurations = PrintConfigurationPeer::doSelectJoinLayout($criteria, $con);
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

				$criteria->add(PrintConfigurationPeer::WATERMARK_IMAGE_ID, $this->getId());

				$this->collPrintConfigurations = PrintConfigurationPeer::doSelectJoinFont($criteria, $con);
			}
		} else {
									
			$criteria->add(PrintConfigurationPeer::WATERMARK_IMAGE_ID, $this->getId());

			if (!isset($this->lastPrintConfigurationCriteria) || !$this->lastPrintConfigurationCriteria->equals($criteria)) {
				$this->collPrintConfigurations = PrintConfigurationPeer::doSelectJoinFont($criteria, $con);
			}
		}
		$this->lastPrintConfigurationCriteria = $criteria;

		return $this->collPrintConfigurations;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseWatermarkImage:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseWatermarkImage::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 