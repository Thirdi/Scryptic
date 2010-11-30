<?php

// include project configuration
include(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

// symfony bootstraping
require_once($sf_symfony_lib_dir.'/util/sfCore.class.php');
sfCore::bootstrap($sf_symfony_lib_dir, $sf_symfony_data_dir);

// setting the user file directory
sfConfig::add(array(
  'sf_upload_dir_name'  => $sf_upload_dir_name = 'account_files',
  'sf_upload_dir'       => sfConfig::get('sf_root_dir').DIRECTORY_SEPARATOR.$sf_upload_dir_name,      
));   