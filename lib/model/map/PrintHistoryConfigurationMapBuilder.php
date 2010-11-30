<?php



class PrintHistoryConfigurationMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PrintHistoryConfigurationMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('print_history_configuration');
		$tMap->setPhpName('PrintHistoryConfiguration');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('LAYOUT_ID', 'LayoutId', 'int', CreoleTypes::INTEGER, 'layout', 'ID', false, null);

		$tMap->addForeignKey('FONT_ID', 'FontId', 'int', CreoleTypes::INTEGER, 'font', 'ID', true, null);

		$tMap->addColumn('SIZE', 'Size', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('COLOUR', 'Colour', 'string', CreoleTypes::VARCHAR, true, 16);

		$tMap->addColumn('OPACITY', 'Opacity', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('PRINT_HISTORY_ID', 'PrintHistoryId', 'int', CreoleTypes::INTEGER, 'print_history', 'ID', true, null);

	} 
} 