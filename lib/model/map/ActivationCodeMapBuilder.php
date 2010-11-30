<?php



class ActivationCodeMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ActivationCodeMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('activation_code');
		$tMap->setPhpName('ActivationCode');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CODE', 'Code', 'string', CreoleTypes::VARCHAR, false, 128);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('VERIFIED_AT', 'VerifiedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addForeignKey('ACCOUNT_ID', 'AccountId', 'int', CreoleTypes::INTEGER, 'account', 'ID', true, null);

	} 
} 