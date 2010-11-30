<?php


abstract class BasePrintConfigurationPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'print_configuration';

	
	const CLASS_DEFAULT = 'lib.model.PrintConfiguration';

	
	const NUM_COLUMNS = 9;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'print_configuration.ID';

	
	const ACCOUNT_ID = 'print_configuration.ACCOUNT_ID';

	
	const LAYOUT_ID = 'print_configuration.LAYOUT_ID';

	
	const WATERMARK_IMAGE_ID = 'print_configuration.WATERMARK_IMAGE_ID';

	
	const FONT_ID = 'print_configuration.FONT_ID';

	
	const SIZE = 'print_configuration.SIZE';

	
	const COLOUR = 'print_configuration.COLOUR';

	
	const OPACITY = 'print_configuration.OPACITY';

	
	const CREATED_AT = 'print_configuration.CREATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'AccountId', 'LayoutId', 'WatermarkImageId', 'FontId', 'Size', 'Colour', 'Opacity', 'CreatedAt', ),
		BasePeer::TYPE_COLNAME => array (PrintConfigurationPeer::ID, PrintConfigurationPeer::ACCOUNT_ID, PrintConfigurationPeer::LAYOUT_ID, PrintConfigurationPeer::WATERMARK_IMAGE_ID, PrintConfigurationPeer::FONT_ID, PrintConfigurationPeer::SIZE, PrintConfigurationPeer::COLOUR, PrintConfigurationPeer::OPACITY, PrintConfigurationPeer::CREATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'account_id', 'layout_id', 'watermark_image_id', 'font_id', 'size', 'colour', 'opacity', 'created_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'AccountId' => 1, 'LayoutId' => 2, 'WatermarkImageId' => 3, 'FontId' => 4, 'Size' => 5, 'Colour' => 6, 'Opacity' => 7, 'CreatedAt' => 8, ),
		BasePeer::TYPE_COLNAME => array (PrintConfigurationPeer::ID => 0, PrintConfigurationPeer::ACCOUNT_ID => 1, PrintConfigurationPeer::LAYOUT_ID => 2, PrintConfigurationPeer::WATERMARK_IMAGE_ID => 3, PrintConfigurationPeer::FONT_ID => 4, PrintConfigurationPeer::SIZE => 5, PrintConfigurationPeer::COLOUR => 6, PrintConfigurationPeer::OPACITY => 7, PrintConfigurationPeer::CREATED_AT => 8, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'account_id' => 1, 'layout_id' => 2, 'watermark_image_id' => 3, 'font_id' => 4, 'size' => 5, 'colour' => 6, 'opacity' => 7, 'created_at' => 8, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/PrintConfigurationMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.PrintConfigurationMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = PrintConfigurationPeer::getTableMap();
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
		return str_replace(PrintConfigurationPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(PrintConfigurationPeer::ID);

		$criteria->addSelectColumn(PrintConfigurationPeer::ACCOUNT_ID);

		$criteria->addSelectColumn(PrintConfigurationPeer::LAYOUT_ID);

		$criteria->addSelectColumn(PrintConfigurationPeer::WATERMARK_IMAGE_ID);

		$criteria->addSelectColumn(PrintConfigurationPeer::FONT_ID);

		$criteria->addSelectColumn(PrintConfigurationPeer::SIZE);

		$criteria->addSelectColumn(PrintConfigurationPeer::COLOUR);

		$criteria->addSelectColumn(PrintConfigurationPeer::OPACITY);

		$criteria->addSelectColumn(PrintConfigurationPeer::CREATED_AT);

	}

	const COUNT = 'COUNT(print_configuration.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT print_configuration.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PrintConfigurationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PrintConfigurationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = PrintConfigurationPeer::doSelectRS($criteria, $con);
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
		$objects = PrintConfigurationPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return PrintConfigurationPeer::populateObjects(PrintConfigurationPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BasePrintConfigurationPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BasePrintConfigurationPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			PrintConfigurationPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = PrintConfigurationPeer::getOMClass();
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
			$criteria->addSelectColumn(PrintConfigurationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PrintConfigurationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PrintConfigurationPeer::ACCOUNT_ID, AccountPeer::ID);

		$rs = PrintConfigurationPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinLayout(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PrintConfigurationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PrintConfigurationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PrintConfigurationPeer::LAYOUT_ID, LayoutPeer::ID);

		$rs = PrintConfigurationPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinWatermarkImage(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PrintConfigurationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PrintConfigurationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PrintConfigurationPeer::WATERMARK_IMAGE_ID, WatermarkImagePeer::ID);

		$rs = PrintConfigurationPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(PrintConfigurationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PrintConfigurationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PrintConfigurationPeer::FONT_ID, FontPeer::ID);

		$rs = PrintConfigurationPeer::doSelectRS($criteria, $con);
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

		PrintConfigurationPeer::addSelectColumns($c);
		$startcol = (PrintConfigurationPeer::NUM_COLUMNS - PrintConfigurationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		AccountPeer::addSelectColumns($c);

		$c->addJoin(PrintConfigurationPeer::ACCOUNT_ID, AccountPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PrintConfigurationPeer::getOMClass();

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
										$temp_obj2->addPrintConfiguration($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initPrintConfigurations();
				$obj2->addPrintConfiguration($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinLayout(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PrintConfigurationPeer::addSelectColumns($c);
		$startcol = (PrintConfigurationPeer::NUM_COLUMNS - PrintConfigurationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		LayoutPeer::addSelectColumns($c);

		$c->addJoin(PrintConfigurationPeer::LAYOUT_ID, LayoutPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PrintConfigurationPeer::getOMClass();

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
										$temp_obj2->addPrintConfiguration($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initPrintConfigurations();
				$obj2->addPrintConfiguration($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinWatermarkImage(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PrintConfigurationPeer::addSelectColumns($c);
		$startcol = (PrintConfigurationPeer::NUM_COLUMNS - PrintConfigurationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		WatermarkImagePeer::addSelectColumns($c);

		$c->addJoin(PrintConfigurationPeer::WATERMARK_IMAGE_ID, WatermarkImagePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PrintConfigurationPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = WatermarkImagePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getWatermarkImage(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addPrintConfiguration($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initPrintConfigurations();
				$obj2->addPrintConfiguration($obj1); 			}
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

		PrintConfigurationPeer::addSelectColumns($c);
		$startcol = (PrintConfigurationPeer::NUM_COLUMNS - PrintConfigurationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		FontPeer::addSelectColumns($c);

		$c->addJoin(PrintConfigurationPeer::FONT_ID, FontPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PrintConfigurationPeer::getOMClass();

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
										$temp_obj2->addPrintConfiguration($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initPrintConfigurations();
				$obj2->addPrintConfiguration($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PrintConfigurationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PrintConfigurationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PrintConfigurationPeer::ACCOUNT_ID, AccountPeer::ID);

		$criteria->addJoin(PrintConfigurationPeer::LAYOUT_ID, LayoutPeer::ID);

		$criteria->addJoin(PrintConfigurationPeer::WATERMARK_IMAGE_ID, WatermarkImagePeer::ID);

		$criteria->addJoin(PrintConfigurationPeer::FONT_ID, FontPeer::ID);

		$rs = PrintConfigurationPeer::doSelectRS($criteria, $con);
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

		PrintConfigurationPeer::addSelectColumns($c);
		$startcol2 = (PrintConfigurationPeer::NUM_COLUMNS - PrintConfigurationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		AccountPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + AccountPeer::NUM_COLUMNS;

		LayoutPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + LayoutPeer::NUM_COLUMNS;

		WatermarkImagePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + WatermarkImagePeer::NUM_COLUMNS;

		FontPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + FontPeer::NUM_COLUMNS;

		$c->addJoin(PrintConfigurationPeer::ACCOUNT_ID, AccountPeer::ID);

		$c->addJoin(PrintConfigurationPeer::LAYOUT_ID, LayoutPeer::ID);

		$c->addJoin(PrintConfigurationPeer::WATERMARK_IMAGE_ID, WatermarkImagePeer::ID);

		$c->addJoin(PrintConfigurationPeer::FONT_ID, FontPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PrintConfigurationPeer::getOMClass();


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
					$temp_obj2->addPrintConfiguration($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initPrintConfigurations();
				$obj2->addPrintConfiguration($obj1);
			}


					
			$omClass = LayoutPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getLayout(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addPrintConfiguration($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initPrintConfigurations();
				$obj3->addPrintConfiguration($obj1);
			}


					
			$omClass = WatermarkImagePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getWatermarkImage(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addPrintConfiguration($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initPrintConfigurations();
				$obj4->addPrintConfiguration($obj1);
			}


					
			$omClass = FontPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5 = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getFont(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addPrintConfiguration($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj5->initPrintConfigurations();
				$obj5->addPrintConfiguration($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptAccount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PrintConfigurationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PrintConfigurationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PrintConfigurationPeer::LAYOUT_ID, LayoutPeer::ID);

		$criteria->addJoin(PrintConfigurationPeer::WATERMARK_IMAGE_ID, WatermarkImagePeer::ID);

		$criteria->addJoin(PrintConfigurationPeer::FONT_ID, FontPeer::ID);

		$rs = PrintConfigurationPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptLayout(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PrintConfigurationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PrintConfigurationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PrintConfigurationPeer::ACCOUNT_ID, AccountPeer::ID);

		$criteria->addJoin(PrintConfigurationPeer::WATERMARK_IMAGE_ID, WatermarkImagePeer::ID);

		$criteria->addJoin(PrintConfigurationPeer::FONT_ID, FontPeer::ID);

		$rs = PrintConfigurationPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptWatermarkImage(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PrintConfigurationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PrintConfigurationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PrintConfigurationPeer::ACCOUNT_ID, AccountPeer::ID);

		$criteria->addJoin(PrintConfigurationPeer::LAYOUT_ID, LayoutPeer::ID);

		$criteria->addJoin(PrintConfigurationPeer::FONT_ID, FontPeer::ID);

		$rs = PrintConfigurationPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(PrintConfigurationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PrintConfigurationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PrintConfigurationPeer::ACCOUNT_ID, AccountPeer::ID);

		$criteria->addJoin(PrintConfigurationPeer::LAYOUT_ID, LayoutPeer::ID);

		$criteria->addJoin(PrintConfigurationPeer::WATERMARK_IMAGE_ID, WatermarkImagePeer::ID);

		$rs = PrintConfigurationPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptAccount(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PrintConfigurationPeer::addSelectColumns($c);
		$startcol2 = (PrintConfigurationPeer::NUM_COLUMNS - PrintConfigurationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		LayoutPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + LayoutPeer::NUM_COLUMNS;

		WatermarkImagePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + WatermarkImagePeer::NUM_COLUMNS;

		FontPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + FontPeer::NUM_COLUMNS;

		$c->addJoin(PrintConfigurationPeer::LAYOUT_ID, LayoutPeer::ID);

		$c->addJoin(PrintConfigurationPeer::WATERMARK_IMAGE_ID, WatermarkImagePeer::ID);

		$c->addJoin(PrintConfigurationPeer::FONT_ID, FontPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PrintConfigurationPeer::getOMClass();

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
					$temp_obj2->addPrintConfiguration($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initPrintConfigurations();
				$obj2->addPrintConfiguration($obj1);
			}

			$omClass = WatermarkImagePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getWatermarkImage(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addPrintConfiguration($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initPrintConfigurations();
				$obj3->addPrintConfiguration($obj1);
			}

			$omClass = FontPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getFont(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addPrintConfiguration($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initPrintConfigurations();
				$obj4->addPrintConfiguration($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptLayout(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PrintConfigurationPeer::addSelectColumns($c);
		$startcol2 = (PrintConfigurationPeer::NUM_COLUMNS - PrintConfigurationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		AccountPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + AccountPeer::NUM_COLUMNS;

		WatermarkImagePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + WatermarkImagePeer::NUM_COLUMNS;

		FontPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + FontPeer::NUM_COLUMNS;

		$c->addJoin(PrintConfigurationPeer::ACCOUNT_ID, AccountPeer::ID);

		$c->addJoin(PrintConfigurationPeer::WATERMARK_IMAGE_ID, WatermarkImagePeer::ID);

		$c->addJoin(PrintConfigurationPeer::FONT_ID, FontPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PrintConfigurationPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = AccountPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getAccount(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addPrintConfiguration($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initPrintConfigurations();
				$obj2->addPrintConfiguration($obj1);
			}

			$omClass = WatermarkImagePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getWatermarkImage(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addPrintConfiguration($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initPrintConfigurations();
				$obj3->addPrintConfiguration($obj1);
			}

			$omClass = FontPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getFont(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addPrintConfiguration($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initPrintConfigurations();
				$obj4->addPrintConfiguration($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptWatermarkImage(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PrintConfigurationPeer::addSelectColumns($c);
		$startcol2 = (PrintConfigurationPeer::NUM_COLUMNS - PrintConfigurationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		AccountPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + AccountPeer::NUM_COLUMNS;

		LayoutPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + LayoutPeer::NUM_COLUMNS;

		FontPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + FontPeer::NUM_COLUMNS;

		$c->addJoin(PrintConfigurationPeer::ACCOUNT_ID, AccountPeer::ID);

		$c->addJoin(PrintConfigurationPeer::LAYOUT_ID, LayoutPeer::ID);

		$c->addJoin(PrintConfigurationPeer::FONT_ID, FontPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PrintConfigurationPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = AccountPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getAccount(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addPrintConfiguration($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initPrintConfigurations();
				$obj2->addPrintConfiguration($obj1);
			}

			$omClass = LayoutPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getLayout(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addPrintConfiguration($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initPrintConfigurations();
				$obj3->addPrintConfiguration($obj1);
			}

			$omClass = FontPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getFont(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addPrintConfiguration($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initPrintConfigurations();
				$obj4->addPrintConfiguration($obj1);
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

		PrintConfigurationPeer::addSelectColumns($c);
		$startcol2 = (PrintConfigurationPeer::NUM_COLUMNS - PrintConfigurationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		AccountPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + AccountPeer::NUM_COLUMNS;

		LayoutPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + LayoutPeer::NUM_COLUMNS;

		WatermarkImagePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + WatermarkImagePeer::NUM_COLUMNS;

		$c->addJoin(PrintConfigurationPeer::ACCOUNT_ID, AccountPeer::ID);

		$c->addJoin(PrintConfigurationPeer::LAYOUT_ID, LayoutPeer::ID);

		$c->addJoin(PrintConfigurationPeer::WATERMARK_IMAGE_ID, WatermarkImagePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PrintConfigurationPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = AccountPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getAccount(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addPrintConfiguration($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initPrintConfigurations();
				$obj2->addPrintConfiguration($obj1);
			}

			$omClass = LayoutPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getLayout(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addPrintConfiguration($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initPrintConfigurations();
				$obj3->addPrintConfiguration($obj1);
			}

			$omClass = WatermarkImagePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getWatermarkImage(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addPrintConfiguration($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initPrintConfigurations();
				$obj4->addPrintConfiguration($obj1);
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
		return PrintConfigurationPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BasePrintConfigurationPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasePrintConfigurationPeer', $values, $con);
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

		$criteria->remove(PrintConfigurationPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BasePrintConfigurationPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BasePrintConfigurationPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BasePrintConfigurationPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasePrintConfigurationPeer', $values, $con);
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
			$comparison = $criteria->getComparison(PrintConfigurationPeer::ID);
			$selectCriteria->add(PrintConfigurationPeer::ID, $criteria->remove(PrintConfigurationPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BasePrintConfigurationPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BasePrintConfigurationPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(PrintConfigurationPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(PrintConfigurationPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof PrintConfiguration) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(PrintConfigurationPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(PrintConfiguration $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(PrintConfigurationPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(PrintConfigurationPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(PrintConfigurationPeer::DATABASE_NAME, PrintConfigurationPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = PrintConfigurationPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(PrintConfigurationPeer::DATABASE_NAME);

		$criteria->add(PrintConfigurationPeer::ID, $pk);


		$v = PrintConfigurationPeer::doSelect($criteria, $con);

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
			$criteria->add(PrintConfigurationPeer::ID, $pks, Criteria::IN);
			$objs = PrintConfigurationPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BasePrintConfigurationPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/PrintConfigurationMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.PrintConfigurationMapBuilder');
}
