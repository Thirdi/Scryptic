<?php


abstract class BaseWatermarkImagePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'watermark_image';

	
	const CLASS_DEFAULT = 'lib.model.WatermarkImage';

	
	const NUM_COLUMNS = 7;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'watermark_image.ID';

	
	const ACCOUNT_ID = 'watermark_image.ACCOUNT_ID';

	
	const IMAGE_NAME = 'watermark_image.IMAGE_NAME';

	
	const CONTENT_TYPE = 'watermark_image.CONTENT_TYPE';

	
	const IS_DELETED = 'watermark_image.IS_DELETED';

	
	const WIDTH = 'watermark_image.WIDTH';

	
	const HEIGHT = 'watermark_image.HEIGHT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'AccountId', 'ImageName', 'ContentType', 'IsDeleted', 'Width', 'Height', ),
		BasePeer::TYPE_COLNAME => array (WatermarkImagePeer::ID, WatermarkImagePeer::ACCOUNT_ID, WatermarkImagePeer::IMAGE_NAME, WatermarkImagePeer::CONTENT_TYPE, WatermarkImagePeer::IS_DELETED, WatermarkImagePeer::WIDTH, WatermarkImagePeer::HEIGHT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'account_id', 'image_name', 'content_type', 'is_deleted', 'width', 'height', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'AccountId' => 1, 'ImageName' => 2, 'ContentType' => 3, 'IsDeleted' => 4, 'Width' => 5, 'Height' => 6, ),
		BasePeer::TYPE_COLNAME => array (WatermarkImagePeer::ID => 0, WatermarkImagePeer::ACCOUNT_ID => 1, WatermarkImagePeer::IMAGE_NAME => 2, WatermarkImagePeer::CONTENT_TYPE => 3, WatermarkImagePeer::IS_DELETED => 4, WatermarkImagePeer::WIDTH => 5, WatermarkImagePeer::HEIGHT => 6, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'account_id' => 1, 'image_name' => 2, 'content_type' => 3, 'is_deleted' => 4, 'width' => 5, 'height' => 6, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/WatermarkImageMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.WatermarkImageMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = WatermarkImagePeer::getTableMap();
			$columns = $map->getColumns();
			$nameMap = array();
			foreach ($columns as $column) {
				$nameMap[$column->getPhpName()] = $column->getColumnName();
			}
			self::$phpNameMap = $nameMap;
		}
		return self::$phpNameMap;
	}
	
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	
	public static function alias($alias, $column)
	{
		return str_replace(WatermarkImagePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(WatermarkImagePeer::ID);

		$criteria->addSelectColumn(WatermarkImagePeer::ACCOUNT_ID);

		$criteria->addSelectColumn(WatermarkImagePeer::IMAGE_NAME);

		$criteria->addSelectColumn(WatermarkImagePeer::CONTENT_TYPE);

		$criteria->addSelectColumn(WatermarkImagePeer::IS_DELETED);

		$criteria->addSelectColumn(WatermarkImagePeer::WIDTH);

		$criteria->addSelectColumn(WatermarkImagePeer::HEIGHT);

	}

	const COUNT = 'COUNT(watermark_image.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT watermark_image.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(WatermarkImagePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(WatermarkImagePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = WatermarkImagePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}
	
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = WatermarkImagePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return WatermarkImagePeer::populateObjects(WatermarkImagePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseWatermarkImagePeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseWatermarkImagePeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			WatermarkImagePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = WatermarkImagePeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinAccount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(WatermarkImagePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(WatermarkImagePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(WatermarkImagePeer::ACCOUNT_ID, AccountPeer::ID);

		$rs = WatermarkImagePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAccount(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		WatermarkImagePeer::addSelectColumns($c);
		$startcol = (WatermarkImagePeer::NUM_COLUMNS - WatermarkImagePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		AccountPeer::addSelectColumns($c);

		$c->addJoin(WatermarkImagePeer::ACCOUNT_ID, AccountPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = WatermarkImagePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = AccountPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getAccount(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addWatermarkImage($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initWatermarkImages();
				$obj2->addWatermarkImage($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(WatermarkImagePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(WatermarkImagePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(WatermarkImagePeer::ACCOUNT_ID, AccountPeer::ID);

		$rs = WatermarkImagePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		WatermarkImagePeer::addSelectColumns($c);
		$startcol2 = (WatermarkImagePeer::NUM_COLUMNS - WatermarkImagePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		AccountPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + AccountPeer::NUM_COLUMNS;

		$c->addJoin(WatermarkImagePeer::ACCOUNT_ID, AccountPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = WatermarkImagePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = AccountPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getAccount(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addWatermarkImage($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initWatermarkImages();
				$obj2->addWatermarkImage($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}

	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return WatermarkImagePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseWatermarkImagePeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseWatermarkImagePeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(WatermarkImagePeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseWatermarkImagePeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseWatermarkImagePeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseWatermarkImagePeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseWatermarkImagePeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(WatermarkImagePeer::ID);
			$selectCriteria->add(WatermarkImagePeer::ID, $criteria->remove(WatermarkImagePeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseWatermarkImagePeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseWatermarkImagePeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; 		try {
									$con->begin();
			$affectedRows += BasePeer::doDeleteAll(WatermarkImagePeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(WatermarkImagePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof WatermarkImage) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(WatermarkImagePeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public static function doValidate(WatermarkImage $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(WatermarkImagePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(WatermarkImagePeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(WatermarkImagePeer::DATABASE_NAME, WatermarkImagePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = WatermarkImagePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(WatermarkImagePeer::DATABASE_NAME);

		$criteria->add(WatermarkImagePeer::ID, $pk);


		$v = WatermarkImagePeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria();
			$criteria->add(WatermarkImagePeer::ID, $pks, Criteria::IN);
			$objs = WatermarkImagePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseWatermarkImagePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/WatermarkImageMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.WatermarkImageMapBuilder');
}
