<?php



class WatermarkImageMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.WatermarkImageMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('watermark_image');
		$tMap->setPhpName('WatermarkImage');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('ACCOUNT_ID', 'AccountId', 'int', CreoleTypes::INTEGER, 'account', 'ID', true, null);

		$tMap->addColumn('IMAGE_NAME', 'ImageName', 'string', CreoleTypes::VARCHAR, true, 64);

		$tMap->addColumn('CONTENT_TYPE', 'ContentType', 'string', CreoleTypes::VARCHAR, true, 32);

		$tMap->addColumn('IS_DELETED', 'IsDeleted', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('WIDTH', 'Width', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('HEIGHT', 'Height', 'int', CreoleTypes::INTEGER, true, null);

	} 
} 