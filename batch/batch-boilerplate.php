<?php
define('SF_ROOT_DIR',      realpath(dirname(__file__).'/..'));
define('SF_APP',           'backend');
define('SF_ENVIRONMENT',   'cli');
define('SF_DEBUG',          false);
 
require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');
 
// initialize database manager
$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();
$ctx = sfContext::getInstance();
?>
