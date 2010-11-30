<?php


abstract class BasePrintHistoryConfigurationPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'print_history_configuration';

	
	const CLASS_DEFAULT = 'lib.model.PrintHistoryConfiguration';

	
	const NUM_COLUMNS = 7;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'print_history_configuration.ID';

	
	const LAYOUT_ID = 'print_history_configuration.LAYOUT_ID';

	
	const FONT_ID = 'print_history_configuration.FONT_ID';

	
	const SIZE = 'print_history_configuration.SIZE';

	
	const COLOUR = 'print_history_configuration.COLOUR';

	
	const OPACITY = 'print_history_configuration.OPACITY';

	
	const PRINT_HISTORY_ID = 'print_history_configuration.PRINT_HISTORY_ID';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'LayoutId', 'FontId', 'Size', 'Colour', 'Opacity', 'PrintHistoryId', ),
		BasePeer::TYPE_COLNAME => array (PrintHistoryConfigurationPeer::ID, PrintHistoryConfigurationPeer::LAYOUT_ID, PrintHistoryConfigurationPeer::FONT_ID, PrintHistoryConfigurationPeer::SIZE, PrintHistoryConfigurationPeer::COLOUR, PrintHistoryConfigurationPeer::OPACITY, PrintHistoryConfigurationPeer::PRINT_HISTORY_ID, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'layout_id', 'font_id', 'size', 'colour', 'opacity', 'print_history_id', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'LayoutId' => 1, 'FontId' => 2, 'Size' => 3, 'Colour' => 4, 'Opacity' => 5, 'PrintHistoryId' => 6, ),
		BasePeer::TYPE_COLNAME => array (PrintHistoryConfigurationPeer::ID => 0, PrintHistoryConfigurationPeer::LAYOUT_ID => 1, PrintHistoryConfigurationPeer::FONT_ID => 2, PrintHistoryConfigurationPeer::SIZE => 3, PrintHistoryConfigurationPeer::COLOUR => 4, PrintHistoryConfigurationPeer::OPACITY => 5, PrintHistoryConfigurationPeer::PRINT_HISTORY_ID => 6, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'layout_id' => 1, 'font_id' => 2, 'size' => 3, 'colour' => 4, 'opacity' => 5, 'print_history_id' => 6, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/PrintHistoryConfigurationMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.PrintHistoryConfigurationMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = PrintHistoryConfigurationPeer::getTableMap();
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
		return str_replace(PrintHistoryConfigurationPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(PrintHistoryConfigurationPeer::ID);

		$criteria->addSelectColumn(PrintHistoryConfigurationPeer::LAYOUT_ID);

		$criteria->addSelectColumn(PrintHistoryConfigurationPeer::FONT_ID);

		$criteria->addSelectColumn(PrintHistoryConfigurationPeer::SIZE);

		$criteria->addSelectColumn(PrintHistoryConfigurationPeer::COLOUR);

		$criteria->addSelectColumn(PrintHistoryConfigurationPeer::OPACITY);

		$criteria->addSelectColumn(PrintHistoryConfigurationPeer::PRINT_HISTORY_ID);

	}

	const COUNT = 'COUNT(print_history_configuration.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT print_history_configuration.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PrintHistoryConfigurationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PrintHistoryConfigurationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = PrintHistoryConfigurationPeer::doSelectRS($criteria, $con);
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
		$objects = PrintHistoryConfigurationPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return PrintHistoryConfigurationPeer::populateObjects(PrintHistoryConfigurationPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BasePrintHistoryConfigurationPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BasePrintHistoryConfigurationPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			PrintHistoryConfigurationPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = PrintHistoryConfigurationPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinLayout(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PrintHistoryConfigurationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PrintHistoryConfigurationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PrintHistoryConfigurationPeer::LAYOUT_ID, LayoutPeer::ID);

		$rs = PrintHistoryConfigurationPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinFont(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PrintHistoryConfigurationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PrintHistoryConfigurationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PrintHistoryConfigurationPeer::FONT_ID, FontPeer::ID);

		$rs = PrintHistoryConfigurationPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinPrintHistory(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PrintHistoryConfigurationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PrintHistoryConfigurationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PrintHistoryConfigurationPeer::PRINT_HISTORY_ID, PrintHistoryPeer::ID);

		$rs = PrintHistoryConfigurationPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinLayout(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PrintHistoryConfigurationPeer::addSelectColumns($c);
		$startcol = (PrintHistoryConfigurationPeer::NUM_COLUMNS - PrintHistoryConfigurationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		LayoutPeer::addSelectColumns($c);

		$c->addJoin(PrintHistoryConfigurationPeer::LAYOUT_ID, LayoutPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PrintHistoryConfigurationPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = LayoutPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getLayout(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addPrintHistoryConfiguration($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initPrintHistoryConfigurations();
				$obj2->addPrintHistoryConfiguration($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinFont(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PrintHistoryConfigurationPeer::addSelectColumns($c);
		$startcol = (PrintHistoryConfigurationPeer::NUM_COLUMNS - PrintHistoryConfigurationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		FontPeer::addSelectColumns($c);

		$c->addJoin(PrintHistoryConfigurationPeer::FONT_ID, FontPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PrintHistoryConfigurationPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = FontPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getFont(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addPrintHistoryConfiguration($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initPrintHistoryConfigurations();
				$obj2->addPrintHistoryConfiguration($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinPrintHistory(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PrintHistoryConfigurationPeer::addSelectColumns($c);
		$startcol = (PrintHistoryConfigurationPeer::NUM_COLUMNS - PrintHistoryConfigurationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PrintHistoryPeer::addSelectColumns($c);

		$c->addJoin(PrintHistoryConfigurationPeer::PRINT_HISTORY_ID, PrintHistoryPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PrintHistoryConfigurationPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = PrintHistoryPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getPrintHistory(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addPrintHistoryConfiguration($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initPrintHistoryConfigurations();
				$obj2->addPrintHistoryConfiguration($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PrintHistoryConfigurationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PrintHistoryConfigurationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PrintHistoryConfigurationPeer::LAYOUT_ID, LayoutPeer::ID);

		$criteria->addJoin(PrintHistoryConfigurationPeer::FONT_ID, FontPeer::ID);

		$criteria->addJoin(PrintHistoryConfigurationPeer::PRINT_HISTORY_ID, PrintHistoryPeer::ID);

		$rs = PrintHistoryConfigurationPeer::doSelectRS($criteria, $con);
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

		PrintHistoryConfigurationPeer::addSelectColumns($c);
		$startcol2 = (PrintHistoryConfigurationPeer::NUM_COLUMNS - PrintHistoryConfigurationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		LayoutPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + LayoutPeer::NUM_COLUMNS;

		FontPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + FontPeer::NUM_COLUMNS;

		PrintHistoryPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + PrintHistoryPeer::NUM_COLUMNS;

		$c->addJoin(PrintHistoryConfigurationPeer::LAYOUT_ID, LayoutPeer::ID);

		$c->addJoin(PrintHistoryConfigurationPeer::FONT_ID, FontPeer::ID);

		$c->addJoin(PrintHistoryConfigurationPeer::PRINT_HISTORY_ID, PrintHistoryPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PrintHistoryConfigurationPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = LayoutPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getLayout(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addPrintHistoryConfiguration($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initPrintHistoryConfigurations();
				$obj2->addPrintHistoryConfiguration($obj1);
			}


					
			$omClass = FontPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getFont(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addPrintHistoryConfiguration($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initPrintHistoryConfigurations();
				$obj3->addPrintHistoryConfiguration($obj1);
			}


					
			$omClass = PrintHistoryPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getPrintHistory(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addPrintHistoryConfiguration($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initPrintHistoryConfigurations();
				$obj4->addPrintHistoryConfiguration($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptLayout(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PrintHistoryConfigurationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PrintHistoryConfigurationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PrintHistoryConfigurationPeer::FONT_ID, FontPeer::ID);

		$criteria->addJoin(PrintHistoryConfigurationPeer::PRINT_HISTORY_ID, PrintHistoryPeer::ID);

		$rs = PrintHistoryConfigurationPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptFont(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PrintHistoryConfigurationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PrintHistoryConfigurationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PrintHistoryConfigurationPeer::LAYOUT_ID, LayoutPeer::ID);

		$criteria->addJoin(PrintHistoryConfigurationPeer::PRINT_HISTORY_ID, PrintHistoryPeer::ID);

		$rs = PrintHistoryConfigurationPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptPrintHistory(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PrintHistoryConfigurationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PrintHistoryConfigurationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PrintHistoryConfigurationPeer::LAYOUT_ID, LayoutPeer::ID);

		$criteria->addJoin(PrintHistoryConfigurationPeer::FONT_ID, FontPeer::ID);

		$rs = PrintHistoryConfigurationPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptLayout(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PrintHistoryConfigurationPeer::addSelectColumns($c);
		$startcol2 = (PrintHistoryConfigurationPeer::NUM_COLUMNS - PrintHistoryConfigurationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		FontPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + FontPeer::NUM_COLUMNS;

		PrintHistoryPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PrintHistoryPeer::NUM_COLUMNS;

		$c->addJoin(PrintHistoryConfigurationPeer::FONT_ID, FontPeer::ID);

		$c->addJoin(PrintHistoryConfigurationPeer::PRINT_HISTORY_ID, PrintHistoryPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PrintHistoryConfigurationPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = FontPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getFont(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addPrintHistoryConfiguration($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initPrintHistoryConfigurations();
				$obj2->addPrintHistoryConfiguration($obj1);
			}

			$omClass = PrintHistoryPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getPrintHistory(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addPrintHistoryConfiguration($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initPrintHistoryConfigurations();
				$obj3->addPrintHistoryConfiguration($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptFont(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PrintHistoryConfigurationPeer::addSelectColumns($c);
		$startcol2 = (PrintHistoryConfigurationPeer::NUM_COLUMNS - PrintHistoryConfigurationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		LayoutPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + LayoutPeer::NUM_COLUMNS;

		PrintHistoryPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PrintHistoryPeer::NUM_COLUMNS;

		$c->addJoin(PrintHistoryConfigurationPeer::LAYOUT_ID, LayoutPeer::ID);

		$c->addJoin(PrintHistoryConfigurationPeer::PRINT_HISTORY_ID, PrintHistoryPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PrintHistoryConfigurationPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = LayoutPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getLayout(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addPrintHistoryConfiguration($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initPrintHistoryConfigurations();
				$obj2->addPrintHistoryConfiguration($obj1);
			}

			$omClass = PrintHistoryPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getPrintHistory(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addPrintHistoryConfiguration($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initPrintHistoryConfigurations();
				$obj3->addPrintHistoryConfiguration($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptPrintHistory(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PrintHistoryConfigurationPeer::addSelectColumns($c);
		$startcol2 = (PrintHistoryConfigurationPeer::NUM_COLUMNS - PrintHistoryConfigurationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		LayoutPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + LayoutPeer::NUM_COLUMNS;

		FontPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + FontPeer::NUM_COLUMNS;

		$c->addJoin(PrintHistoryConfigurationPeer::LAYOUT_ID, LayoutPeer::ID);

		$c->addJoin(PrintHistoryConfigurationPeer::FONT_ID, FontPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PrintHistoryConfigurationPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = LayoutPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getLayout(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addPrintHistoryConfiguration($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initPrintHistoryConfigurations();
				$obj2->addPrintHistoryConfiguration($obj1);
			}

			$omClass = FontPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getFont(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addPrintHistoryConfiguration($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initPrintHistoryConfigurations();
				$obj3->addPrintHistoryConfiguration($obj1);
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
		return PrintHistoryConfigurationPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BasePrintHistoryConfigurationPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasePrintHistoryConfigurationPeer', $values, $con);
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

		$criteria->remove(PrintHistoryConfigurationPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BasePrintHistoryConfigurationPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BasePrintHistoryConfigurationPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BasePrintHistoryConfigurationPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasePrintHistoryConfigurationPeer', $values, $con);
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
			$comparison = $criteria->getComparison(PrintHistoryConfigurationPeer::ID);
			$selectCriteria->add(PrintHistoryConfigurationPeer::ID, $criteria->remove(PrintHistoryConfigurationPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BasePrintHistoryConfigurationPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BasePrintHistoryConfigurationPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(PrintHistoryConfigurationPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(PrintHistoryConfigurationPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof PrintHistoryConfiguration) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(PrintHistoryConfigurationPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(PrintHistoryConfiguration $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(PrintHistoryConfigurationPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(PrintHistoryConfigurationPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(PrintHistoryConfigurationPeer::DATABASE_NAME, PrintHistoryConfigurationPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = PrintHistoryConfigurationPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(PrintHistoryConfigurationPeer::DATABASE_NAME);

		$criteria->add(PrintHistoryConfigurationPeer::ID, $pk);


		$v = PrintHistoryConfigurationPeer::doSelect($criteria, $con);

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
			$criteria->add(PrintHistoryConfigurationPeer::ID, $pks, Criteria::IN);
			$objs = PrintHistoryConfigurationPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BasePrintHistoryConfigurationPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/PrintHistoryConfigurationMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.PrintHistoryConfigurationMapBuilder');
}
