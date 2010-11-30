<?php
require_once 'PHPUnit/Framework.php';

define('SF_ROOT_DIR',      realpath(dirname(__file__).'/../..'));
define('SF_APP',           'frontend');
define('SF_ENVIRONMENT',   'cli');
define('SF_DEBUG',          false);

$req = SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php';
require_once($req);
?>
