<?php



class PrintConfigurationMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PrintConfigurationMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('print_configuration');
		$tMap->setPhpName('PrintConfiguration');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('ACCOUNT_ID', 'AccountId', 'int', CreoleTypes::INTEGER, 'account', 'ID', true, null);

		$tMap->addForeignKey('LAYOUT_ID', 'LayoutId', 'int', CreoleTypes::INTEGER, 'layout', 'ID', false, null);

		$tMap->addForeignKey('WATERMARK_IMAGE_ID', 'WatermarkImageId', 'int', CreoleTypes::INTEGER, 'watermark_image', 'ID', true, null);

		$tMap->addForeignKey('FONT_ID', 'FontId', 'int', CreoleTypes::INTEGER, 'font', 'ID', true, null);

		$tMap->addColumn('SIZE', 'Size', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('COLOUR', 'Colour', 'string', CreoleTypes::VARCHAR, true, 16);

		$tMap->addColumn('OPACITY', 'Opacity', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 