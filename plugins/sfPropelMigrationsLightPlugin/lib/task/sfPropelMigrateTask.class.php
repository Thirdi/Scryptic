<?php

/*
 * This file is part of the sfPropelMigrationsLightPlugin package.
 * (c) 2006-2008 Martin Kreidenweis <sf@kreidenweis.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * A symfony 1.1 port for the pake migrate task.
 * 
 * @package     sfPropelMigrationsLightPlugin
 * @subpackage  task
 * @author      Martin Kreidenweis <sf@kreidenweis.com>
 * @version     SVN: $Id: sfPropelMigrateTask.class.php 10345 2008-07-17 21:21:13Z Kris.Wallsmith $
 */
class sfPropelMigrateTask extends sfPropelBaseTask
{
  protected function configure()
  {
    $this->addArguments(array(
      new sfCommandArgument('application', sfCommandArgument::REQUIRED, 'The application name'),
    ));

    $this->addOptions(array(
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('schema-version', 'v', sfCommandOption::PARAMETER_REQUIRED, 'The target schema version'),
    ));

    $this->aliases = array('migrate');
    $this->namespace = 'propel';
    $this->name = 'migrate';
    $this->briefDescription = 'Migrates the database schema to another version';
  }

  protected function execute($arguments = array(), $options = array())
  {
    $autoloader = sfSimpleAutoload::getInstance();
    $autoloader->addDirectory(sfConfig::get('sf_plugins_dir').'/sfPropelMigrationsLightPlugin/lib');

    $configuration = ProjectConfiguration::getApplicationConfiguration($arguments['application'], $options['env'], true);

    $databaseManager = new sfDatabaseManager($configuration);

    $migrator = new sfMigrator;

    if (isset($options['schema-version']) && ctype_digit($options['schema-version']))
    {
      $runMigrationsCount = $migrator->migrate((int) $options['schema-version']);
    }
    else
    {
      $runMigrationsCount = $migrator->migrate();
    }

    $currentVersion = $migrator->getCurrentVersion();

    $this->logSection('migrations', 'migrated '.$runMigrationsCount.' step(s)');
    $this->logSection('migrations', 'current database version: '.$currentVersion);
  }
}
