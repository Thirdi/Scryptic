<?php


abstract class BasePrintHistoryConfiguration extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $layout_id;


	
	protected $font_id = 1;


	
	protected $size = 16;


	
	protected $colour = '0';


	
	protected $opacity = 50;


	
	protected $print_history_id;

	
	protected $aLayout;

	
	protected $aFont;

	
	protected $aPrintHistory;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getLayoutId()
	{

		return $this->layout_id;
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

	
	public function getPrintHistoryId()
	{

		return $this->print_history_id;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = PrintHistoryConfigurationPeer::ID;
		}

	} 
	
	public function setLayoutId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->layout_id !== $v) {
			$this->layout_id = $v;
			$this->modifiedColumns[] = PrintHistoryConfigurationPeer::LAYOUT_ID;
		}

		if ($this->aLayout !== null && $this->aLayout->getId() !== $v) {
			$this->aLayout = null;
		}

	} 
	
	public function setFontId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->font_id !== $v || $v === 1) {
			$this->font_id = $v;
			$this->modifiedColumns[] = PrintHistoryConfigurationPeer::FONT_ID;
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
			$this->modifiedColumns[] = PrintHistoryConfigurationPeer::SIZE;
		}

	} 
	
	public function setColour($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->colour !== $v || $v === '0') {
			$this->colour = $v;
			$this->modifiedColumns[] = PrintHistoryConfigurationPeer::COLOUR;
		}

	} 
	
	public function setOpacity($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->opacity !== $v || $v === 50) {
			$this->opacity = $v;
			$this->modifiedColumns[] = PrintHistoryConfigurationPeer::OPACITY;
		}

	} 
	
	public function setPrintHistoryId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->print_history_id !== $v) {
			$this->print_history_id = $v;
			$this->modifiedColumns[] = PrintHistoryConfigurationPeer::PRINT_HISTORY_ID;
		}

		if ($this->aPrintHistory !== null && $this->aPrintHistory->getId() !== $v) {
			$this->aPrintHistory = null;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->layout_id = $rs->getInt($startcol + 1);

			$this->font_id = $rs->getInt($startcol + 2);

			$this->size = $rs->getInt($startcol + 3);

			$this->colour = $rs->getString($startcol + 4);

			$this->opacity = $rs->getInt($startcol + 5);

			$this->print_history_id = $rs->getInt($startcol + 6);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating PrintHistoryConfiguration object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BasePrintHistoryConfiguration:delete:pre') as $callable)
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
			$con = Propel::getConnection(PrintHistoryConfigurationPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PrintHistoryConfigurationPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BasePrintHistoryConfiguration:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BasePrintHistoryConfiguration:save:pre') as $callable)
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
			$con = Propel::getConnection(PrintHistoryConfigurationPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BasePrintHistoryConfiguration:save:post') as $callable)
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


												
			if ($this->aLayout !== null) {
				if ($this->aLayout->isModified()) {
					$affectedRows += $this->aLayout->save($con);
				}
				$this->setLayout($this->aLayout);
			}

			if ($this->aFont !== null) {
				if ($this->aFont->isModified()) {
					$affectedRows += $this->aFont->save($con);
				}
				$this->setFont($this->aFont);
			}

			if ($this->aPrintHistory !== null) {
				if ($this->aPrintHistory->isModified()) {
					$affectedRows += $this->aPrintHistory->save($con);
				}
				$this->setPrintHistory($this->aPrintHistory);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = PrintHistoryConfigurationPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += PrintHistoryConfigurationPeer::doUpdate($this, $con);
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


												
			if ($this->aLayout !== null) {
				if (!$this->aLayout->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aLayout->getValidationFailures());
				}
			}

			if ($this->aFont !== null) {
				if (!$this->aFont->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aFont->getValidationFailures());
				}
			}

			if ($this->aPrintHistory !== null) {
				if (!$this->aPrintHistory->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPrintHistory->getValidationFailures());
				}
			}


			if (($retval = PrintHistoryConfigurationPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PrintHistoryConfigurationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getLayoutId();
				break;
			case 2:
				return $this->getFontId();
				break;
			case 3:
				return $this->getSize();
				break;
			case 4:
				return $this->getColour();
				break;
			case 5:
				return $this->getOpacity();
				break;
			case 6:
				return $this->getPrintHistoryId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PrintHistoryConfigurationPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getLayoutId(),
			$keys[2] => $this->getFontId(),
			$keys[3] => $this->getSize(),
			$keys[4] => $this->getColour(),
			$keys[5] => $this->getOpacity(),
			$keys[6] => $this->getPrintHistoryId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PrintHistoryConfigurationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setLayoutId($value);
				break;
			case 2:
				$this->setFontId($value);
				break;
			case 3:
				$this->setSize($value);
				break;
			case 4:
				$this->setColour($value);
				break;
			case 5:
				$this->setOpacity($value);
				break;
			case 6:
				$this->setPrintHistoryId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PrintHistoryConfigurationPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setLayoutId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setFontId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setSize($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setColour($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setOpacity($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setPrintHistoryId($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PrintHistoryConfigurationPeer::DATABASE_NAME);

		if ($this->isColumnModified(PrintHistoryConfigurationPeer::ID)) $criteria->add(PrintHistoryConfigurationPeer::ID, $this->id);
		if ($this->isColumnModified(PrintHistoryConfigurationPeer::LAYOUT_ID)) $criteria->add(PrintHistoryConfigurationPeer::LAYOUT_ID, $this->layout_id);
		if ($this->isColumnModified(PrintHistoryConfigurationPeer::FONT_ID)) $criteria->add(PrintHistoryConfigurationPeer::FONT_ID, $this->font_id);
		if ($this->isColumnModified(PrintHistoryConfigurationPeer::SIZE)) $criteria->add(PrintHistoryConfigurationPeer::SIZE, $this->size);
		if ($this->isColumnModified(PrintHistoryConfigurationPeer::COLOUR)) $criteria->add(PrintHistoryConfigurationPeer::COLOUR, $this->colour);
		if ($this->isColumnModified(PrintHistoryConfigurationPeer::OPACITY)) $criteria->add(PrintHistoryConfigurationPeer::OPACITY, $this->opacity);
		if ($this->isColumnModified(PrintHistoryConfigurationPeer::PRINT_HISTORY_ID)) $criteria->add(PrintHistoryConfigurationPeer::PRINT_HISTORY_ID, $this->print_history_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PrintHistoryConfigurationPeer::DATABASE_NAME);

		$criteria->add(PrintHistoryConfigurationPeer::ID, $this->id);

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

		$copyObj->setLayoutId($this->layout_id);

		$copyObj->setFontId($this->font_id);

		$copyObj->setSize($this->size);

		$copyObj->setColour($this->colour);

		$copyObj->setOpacity($this->opacity);

		$copyObj->setPrintHistoryId($this->print_history_id);


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
			self::$peer = new PrintHistoryConfigurationPeer();
		}
		return self::$peer;
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


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BasePrintHistoryConfiguration:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BasePrintHistoryConfiguration::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 