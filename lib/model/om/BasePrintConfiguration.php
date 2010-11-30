<?php


abstract class BasePrintConfiguration extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $account_id;


	
	protected $layout_id;


	
	protected $watermark_image_id;


	
	protected $font_id = 1;


	
	protected $size = 16;


	
	protected $colour = '0';


	
	protected $opacity = 50;


	
	protected $created_at;

	
	protected $aAccount;

	
	protected $aLayout;

	
	protected $aWatermarkImage;

	
	protected $aFont;

	
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

	
	public function getLayoutId()
	{

		return $this->layout_id;
	}

	
	public function getWatermarkImageId()
	{

		return $this->watermark_image_id;
	}

	
	public function getFontId()
	{

		return $this->font_id;
	}

	
	public function getSize()
	{

		return $this->size;
	}

	
	public function getColour()
	{

		return $this->colour;
	}

	
	public function getOpacity()
	{

		return $this->opacity;
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
			$this->modifiedColumns[] = PrintConfigurationPeer::ID;
		}

	} 
	
	public function setAccountId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->account_id !== $v) {
			$this->account_id = $v;
			$this->modifiedColumns[] = PrintConfigurationPeer::ACCOUNT_ID;
		}

		if ($this->aAccount !== null && $this->aAccount->getId() !== $v) {
			$this->aAccount = null;
		}

	} 
	
	public function setLayoutId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->layout_id !== $v) {
			$this->layout_id = $v;
			$this->modifiedColumns[] = PrintConfigurationPeer::LAYOUT_ID;
		}

		if ($this->aLayout !== null && $this->aLayout->getId() !== $v) {
			$this->aLayout = null;
		}

	} 
	
	public function setWatermarkImageId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->watermark_image_id !== $v) {
			$this->watermark_image_id = $v;
			$this->modifiedColumns[] = PrintConfigurationPeer::WATERMARK_IMAGE_ID;
		}

		if ($this->aWatermarkImage !== null && $this->aWatermarkImage->getId() !== $v) {
			$this->aWatermarkImage = null;
		}

	} 
	
	public function setFontId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->font_id !== $v || $v === 1) {
			$this->font_id = $v;
			$this->modifiedColumns[] = PrintConfigurationPeer::FONT_ID;
		}

		if ($this->aFont !== null && $this->aFont->getId() !== $v) {
			$this->aFont = null;
		}

	} 
	
	public function setSize($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->size !== $v || $v === 16) {
			$this->size = $v;
			$this->modifiedColumns[] = PrintConfigurationPeer::SIZE;
		}

	} 
	
	public function setColour($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->colour !== $v || $v === '0') {
			$this->colour = $v;
			$this->modifiedColumns[] = PrintConfigurationPeer::COLOUR;
		}

	} 
	
	public function setOpacity($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->opacity !== $v || $v === 50) {
			$this->opacity = $v;
			$this->modifiedColumns[] = PrintConfigurationPeer::OPACITY;
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
			$this->modifiedColumns[] = PrintConfigurationPeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->account_id = $rs->getInt($startcol + 1);

			$this->layout_id = $rs->getInt($startcol + 2);

			$this->watermark_image_id = $rs->getInt($startcol + 3);

			$this->font_id = $rs->getInt($startcol + 4);

			$this->size = $rs->getInt($startcol + 5);

			$this->colour = $rs->getString($startcol + 6);

			$this->opacity = $rs->getInt($startcol + 7);

			$this->created_at = $rs->getTimestamp($startcol + 8, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating PrintConfiguration object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BasePrintConfiguration:delete:pre') as $callable)
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
			$con = Propel::getConnection(PrintConfigurationPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PrintConfigurationPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BasePrintConfiguration:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BasePrintConfiguration:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(PrintConfigurationPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PrintConfigurationPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BasePrintConfiguration:save:post') as $callable)
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

			if ($this->aLayout !== null) {
				if ($this->aLayout->isModified()) {
					$affectedRows += $this->aLayout->save($con);
				}
				$this->setLayout($this->aLayout);
			}

			if ($this->aWatermarkImage !== null) {
				if ($this->aWatermarkImage->isModified()) {
					$affectedRows += $this->aWatermarkImage->save($con);
				}
				$this->setWatermarkImage($this->aWatermarkImage);
			}

			if ($this->aFont !== null) {
				if ($this->aFont->isModified()) {
					$affectedRows += $this->aFont->save($con);
				}
				$this->setFont($this->aFont);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = PrintConfigurationPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += PrintConfigurationPeer::doUpdate($this, $con);
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

			if ($this->aLayout !== null) {
				if (!$this->aLayout->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aLayout->getValidationFailures());
				}
			}

			if ($this->aWatermarkImage !== null) {
				if (!$this->aWatermarkImage->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aWatermarkImage->getValidationFailures());
				}
			}

			if ($this->aFont !== null) {
				if (!$this->aFont->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aFont->getValidationFailures());
				}
			}


			if (($retval = PrintConfigurationPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PrintConfigurationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getLayoutId();
				break;
			case 3:
				return $this->getWatermarkImageId();
				break;
			case 4:
				return $this->getFontId();
				break;
			case 5:
				return $this->getSize();
				break;
			case 6:
				return $this->getColour();
				break;
			case 7:
				return $this->getOpacity();
				break;
			case 8:
				return $this->getCreatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PrintConfigurationPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getAccountId(),
			$keys[2] => $this->getLayoutId(),
			$keys[3] => $this->getWatermarkImageId(),
			$keys[4] => $this->getFontId(),
			$keys[5] => $this->getSize(),
			$keys[6] => $this->getColour(),
			$keys[7] => $this->getOpacity(),
			$keys[8] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PrintConfigurationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setLayoutId($value);
				break;
			case 3:
				$this->setWatermarkImageId($value);
				break;
			case 4:
				$this->setFontId($value);
				break;
			case 5:
				$this->setSize($value);
				break;
			case 6:
				$this->setColour($value);
				break;
			case 7:
				$this->setOpacity($value);
				break;
			case 8:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PrintConfigurationPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setAccountId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setLayoutId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setWatermarkImageId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setFontId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setSize($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setColour($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setOpacity($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCreatedAt($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PrintConfigurationPeer::DATABASE_NAME);

		if ($this->isColumnModified(PrintConfigurationPeer::ID)) $criteria->add(PrintConfigurationPeer::ID, $this->id);
		if ($this->isColumnModified(PrintConfigurationPeer::ACCOUNT_ID)) $criteria->add(PrintConfigurationPeer::ACCOUNT_ID, $this->account_id);
		if ($this->isColumnModified(PrintConfigurationPeer::LAYOUT_ID)) $criteria->add(PrintConfigurationPeer::LAYOUT_ID, $this->layout_id);
		if ($this->isColumnModified(PrintConfigurationPeer::WATERMARK_IMAGE_ID)) $criteria->add(PrintConfigurationPeer::WATERMARK_IMAGE_ID, $this->watermark_image_id);
		if ($this->isColumnModified(PrintConfigurationPeer::FONT_ID)) $criteria->add(PrintConfigurationPeer::FONT_ID, $this->font_id);
		if ($this->isColumnModified(PrintConfigurationPeer::SIZE)) $criteria->add(PrintConfigurationPeer::SIZE, $this->size);
		if ($this->isColumnModified(PrintConfigurationPeer::COLOUR)) $criteria->add(PrintConfigurationPeer::COLOUR, $this->colour);
		if ($this->isColumnModified(PrintConfigurationPeer::OPACITY)) $criteria->add(PrintConfigurationPeer::OPACITY, $this->opacity);
		if ($this->isColumnModified(PrintConfigurationPeer::CREATED_AT)) $criteria->add(PrintConfigurationPeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PrintConfigurationPeer::DATABASE_NAME);

		$criteria->add(PrintConfigurationPeer::ID, $this->id);

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

		$copyObj->setLayoutId($this->layout_id);

		$copyObj->setWatermarkImageId($this->watermark_image_id);

		$copyObj->setFontId($this->font_id);

		$copyObj->setSize($this->size);

		$copyObj->setColour($this->colour);

		$copyObj->setOpacity($this->opacity);

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
			self::$peer = new PrintConfigurationPeer();
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

	
	public function setLayout($v)
	{


		if ($v === null) {
			$this->setLayoutId(NULL);
		} else {
			$this->setLayoutId($v->getId());
		}


		$this->aLayout = $v;
	}


	
	public function getLayout($con = null)
	{
		if ($this->aLayout === null && ($this->layout_id !== null)) {
						include_once 'lib/model/om/BaseLayoutPeer.php';

			$this->aLayout = LayoutPeer::retrieveByPK($this->layout_id, $con);

			
		}
		return $this->aLayout;
	}

	
	public function setWatermarkImage($v)
	{


		if ($v === null) {
			$this->setWatermarkImageId(NULL);
		} else {
			$this->setWatermarkImageId($v->getId());
		}


		$this->aWatermarkImage = $v;
	}


	
	public function getWatermarkImage($con = null)
	{
		if ($this->aWatermarkImage === null && ($this->watermark_image_id !== null)) {
						include_once 'lib/model/om/BaseWatermarkImagePeer.php';

			$this->aWatermarkImage = WatermarkImagePeer::retrieveByPK($this->watermark_image_id, $con);

			
		}
		return $this->aWatermarkImage;
	}

	
	public function setFont($v)
	{


		if ($v === null) {
			$this->setFontId('1');
		} else {
			$this->setFontId($v->getId());
		}


		$this->aFont = $v;
	}


	
	public function getFont($con = null)
	{
		if ($this->aFont === null && ($this->font_id !== null)) {
						include_once 'lib/model/om/BaseFontPeer.php';

			$this->aFont = FontPeer::retrieveByPK($this->font_id, $con);

			
		}
		return $this->aFont;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BasePrintConfiguration:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BasePrintConfiguration::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 