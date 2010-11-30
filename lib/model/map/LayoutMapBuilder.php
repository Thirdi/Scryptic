<?php



class LayoutMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.LayoutMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('layout');
		$tMap->setPhpName('Layout');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, true, 32);

		$tMap->addColumn('IMAGE', 'Image', 'string', CreoleTypes::VARCHAR, true, 64);

		$tMap->addColumn('PHP_OBJ', 'PhpObj', 'string', CreoleTypes::VARCHAR, true, 128);

	} 
} 