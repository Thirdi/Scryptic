<?php



class PrintHistoryMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PrintHistoryMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('print_history');
		$tMap->setPhpName('PrintHistory');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('USER_ID', 'UserId', 'int', CreoleTypes::INTEGER, 'sf_guard_user_profile', 'ID', true, null);

		$tMap->addColumn('USER_IP', 'UserIp', 'string', CreoleTypes::VARCHAR, true, 32);

		$tMap->addForeignKey('FILE_ID', 'FileId', 'int', CreoleTypes::INTEGER, 'file', 'ID', true, null);

		$tMap->addColumn('SIZE', 'Size', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('NUM_DOCUMENTS', 'NumDocuments', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PAGES', 'Pages', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATION_TIME', 'CreationTime', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('TOTAL_TIME', 'TotalTime', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 