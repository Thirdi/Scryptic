<?php



class PrintHistoryGroupItemMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PrintHistoryGroupItemMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('print_history_group_item');
		$tMap->setPhpName('PrintHistoryGroupItem');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('PRINT_HISTORY_GROUP_ID', 'PrintHistoryGroupId', 'int', CreoleTypes::INTEGER, 'print_history_group', 'ID', true, null);

		$tMap->addColumn('VALUE', 'Value', 'string', CreoleTypes::VARCHAR, true, 128);

	} 
} 