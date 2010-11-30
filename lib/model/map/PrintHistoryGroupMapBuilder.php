<?php



class PrintHistoryGroupMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PrintHistoryGroupMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('print_history_group');
		$tMap->setPhpName('PrintHistoryGroup');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('PRINT_HISTORY_ID', 'PrintHistoryId', 'int', CreoleTypes::INTEGER, 'print_history', 'ID', true, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, true, 64);

	} 
} 