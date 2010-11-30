<?php


abstract class BasePrintHistoryPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'print_history';

	
	const CLASS_DEFAULT = 'lib.model.PrintHistory';

	
	const NUM_COLUMNS = 10;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'print_history.ID';

	
	const USER_ID = 'print_history.USER_ID';

	
	const USER_IP = 'print_history.USER_IP';

	
	const FILE_ID = 'print_history.FILE_ID';

	
	const SIZE = 'print_history.SIZE';

	
	const NUM_DOCUMENTS = 'print_history.NUM_DOCUMENTS';

	
	const PAGES = 'print_history.PAGES';

	
	const CREATION_TIME = 'print_history.CREATION_TIME';

	
	const TOTAL_TIME = 'print_history.TOTAL_TIME';

	
	const CREATED_AT = 'print_history.CREATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'UserId', 'UserIp', 'FileId', 'Size', 'NumDocuments', 'Pages', 'CreationTime', 'TotalTime', 'CreatedAt', ),
		BasePeer::TYPE_COLNAME => array (PrintHistoryPeer::ID, PrintHistoryPeer::USER_ID, PrintHistoryPeer::USER_IP, PrintHistoryPeer::FILE_ID, PrintHistoryPeer::SIZE, PrintHistoryPeer::NUM_DOCUMENTS, PrintHistoryPeer::PAGES, PrintHistoryPeer::CREATION_TIME, PrintHistoryPeer::TOTAL_TIME, PrintHistoryPeer::CREATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'user_id', 'user_ip', 'file_id', 'size', 'num_documents', 'pages', 'creation_time', 'total_time', 'created_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'UserId' => 1, 'UserIp' => 2, 'FileId' => 3, 'Size' => 4, 'NumDocuments' => 5, 'Pages' => 6, 'CreationTime' => 7, 'TotalTime' => 8, 'CreatedAt' => 9, ),
		BasePeer::TYPE_COLNAME => array (PrintHistoryPeer::ID => 0, PrintHistoryPeer::USER_ID => 1, PrintHistoryPeer::USER_IP => 2, PrintHistoryPeer::FILE_ID => 3, PrintHistoryPeer::SIZE => 4, PrintHistoryPeer::NUM_DOCUMENTS => 5, PrintHistoryPeer::PAGES => 6, PrintHistoryPeer::CREATION_TIME => 7, PrintHistoryPeer::TOTAL_TIME => 8, PrintHistoryPeer::CREATED_AT => 9, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'user_id' => 1, 'user_ip' => 2, 'file_id' => 3, 'size' => 4, 'num_documents' => 5, 'pages' => 6, 'creation_time' => 7, 'total_time' => 8, 'created_at' => 9, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/PrintHistoryMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.PrintHistoryMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = PrintHistoryPeer::getTableMap();
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
		return str_replace(PrintHistoryPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(PrintHistoryPeer::ID);

		$criteria->addSelectColumn(PrintHistoryPeer::USER_ID);

		$criteria->addSelectColumn(PrintHistoryPeer::USER_IP);

		$criteria->addSelectColumn(PrintHistoryPeer::FILE_ID);

		$criteria->addSelectColumn(PrintHistoryPeer::SIZE);

		$criteria->addSelectColumn(PrintHistoryPeer::NUM_DOCUMENTS);

		$criteria->addSelectColumn(PrintHistoryPeer::PAGES);

		$criteria->addSelectColumn(PrintHistoryPeer::CREATION_TIME);

		$criteria->addSelectColumn(PrintHistoryPeer::TOTAL_TIME);

		$criteria->addSelectColumn(PrintHistoryPeer::CREATED_AT);

	}

	const COUNT = 'COUNT(print_history.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT print_history.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PrintHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PrintHistoryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = PrintHistoryPeer::doSelectRS($criteria, $con);
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
		$objects = PrintHistoryPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return PrintHistoryPeer::populateObjects(PrintHistoryPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BasePrintHistoryPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BasePrintHistoryPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			PrintHistoryPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = PrintHistoryPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinsfGuardUserProfile(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PrintHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PrintHistoryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PrintHistoryPeer::USER_ID, sfGuardUserProfilePeer::ID);

		$rs = PrintHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinFile(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PrintHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PrintHistoryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PrintHistoryPeer::FILE_ID, FilePeer::ID);

		$rs = PrintHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinsfGuardUserProfile(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PrintHistoryPeer::addSelectColumns($c);
		$startcol = (PrintHistoryPeer::NUM_COLUMNS - PrintHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		sfGuardUserProfilePeer::addSelectColumns($c);

		$c->addJoin(PrintHistoryPeer::USER_ID, sfGuardUserProfilePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PrintHistoryPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = sfGuardUserProfilePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getsfGuardUserProfile(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addPrintHistory($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initPrintHistorys();
				$obj2->addPrintHistory($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinFile(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PrintHistoryPeer::addSelectColumns($c);
		$startcol = (PrintHistoryPeer::NUM_COLUMNS - PrintHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		FilePeer::addSelectColumns($c);

		$c->addJoin(PrintHistoryPeer::FILE_ID, FilePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PrintHistoryPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = FilePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getFile(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addPrintHistory($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initPrintHistorys();
				$obj2->addPrintHistory($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PrintHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PrintHistoryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PrintHistoryPeer::USER_ID, sfGuardUserProfilePeer::ID);

		$criteria->addJoin(PrintHistoryPeer::FILE_ID, FilePeer::ID);

		$rs = PrintHistoryPeer::doSelectRS($criteria, $con);
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

		PrintHistoryPeer::addSelectColumns($c);
		$startcol2 = (PrintHistoryPeer::NUM_COLUMNS - PrintHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		sfGuardUserProfilePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + sfGuardUserProfilePeer::NUM_COLUMNS;

		FilePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + FilePeer::NUM_COLUMNS;

		$c->addJoin(PrintHistoryPeer::USER_ID, sfGuardUserProfilePeer::ID);

		$c->addJoin(PrintHistoryPeer::FILE_ID, FilePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PrintHistoryPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = sfGuardUserProfilePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getsfGuardUserProfile(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addPrintHistory($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initPrintHistorys();
				$obj2->addPrintHistory($obj1);
			}


					
			$omClass = FilePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getFile(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addPrintHistory($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initPrintHistorys();
				$obj3->addPrintHistory($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptsfGuardUserProfile(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PrintHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PrintHistoryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PrintHistoryPeer::FILE_ID, FilePeer::ID);

		$rs = PrintHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptFile(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PrintHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PrintHistoryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PrintHistoryPeer::USER_ID, sfGuardUserProfilePeer::ID);

		$rs = PrintHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptsfGuardUserProfile(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PrintHistoryPeer::addSelectColumns($c);
		$startcol2 = (PrintHistoryPeer::NUM_COLUMNS - PrintHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		FilePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + FilePeer::NUM_COLUMNS;

		$c->addJoin(PrintHistoryPeer::FILE_ID, FilePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PrintHistoryPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = FilePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getFile(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addPrintHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initPrintHistorys();
				$obj2->addPrintHistory($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptFile(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PrintHistoryPeer::addSelectColumns($c);
		$startcol2 = (PrintHistoryPeer::NUM_COLUMNS - PrintHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		sfGuardUserProfilePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + sfGuardUserProfilePeer::NUM_COLUMNS;

		$c->addJoin(PrintHistoryPeer::USER_ID, sfGuardUserProfilePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PrintHistoryPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = sfGuardUserProfilePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getsfGuardUserProfile(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addPrintHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initPrintHistorys();
				$obj2->addPrintHistory($obj1);
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
		return PrintHistoryPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BasePrintHistoryPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasePrintHistoryPeer', $values, $con);
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

		$criteria->remove(PrintHistoryPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BasePrintHistoryPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BasePrintHistoryPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BasePrintHistoryPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasePrintHistoryPeer', $values, $con);
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
			$comparison = $criteria->getComparison(PrintHistoryPeer::ID);
			$selectCriteria->add(PrintHistoryPeer::ID, $criteria->remove(PrintHistoryPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BasePrintHistoryPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BasePrintHistoryPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(PrintHistoryPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(PrintHistoryPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof PrintHistory) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(PrintHistoryPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(PrintHistory $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(PrintHistoryPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(PrintHistoryPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(PrintHistoryPeer::DATABASE_NAME, PrintHistoryPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = PrintHistoryPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(PrintHistoryPeer::DATABASE_NAME);

		$criteria->add(PrintHistoryPeer::ID, $pk);


		$v = PrintHistoryPeer::doSelect($criteria, $con);

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
			$criteria->add(PrintHistoryPeer::ID, $pks, Criteria::IN);
			$objs = PrintHistoryPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BasePrintHistoryPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/PrintHistoryMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.PrintHistoryMapBuilder');
}
