<?php



class WMGroupItemMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.WMGroupItemMapBuilder';

	
	private $dbMap;

	
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('wm_group_item');
		$tMap->setPhpName('WMGroupItem');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('WM_GROUP_ID', 'WmGroupId', 'int', CreoleTypes::INTEGER, 'wm_group', 'ID', true, null);

		$tMap->addColumn('VALUE', 'Value', 'string', CreoleTypes::VARCHAR, true, 128);

		$tMap->addColumn('ALT_VALUE', 'AltValue', 'string', CreoleTypes::VARCHAR, false, 128);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 