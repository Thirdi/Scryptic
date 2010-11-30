<?php
function input_ajaxsafe_file_tag($name, $options = array()) {
$logger = sfContext::getInstance()->getLogger();
$logger->info('!! inside AjaxUploaderHelper. input_ajaxsafe_file_tag!');

// this magic only works IF the check for isXmlHttpRequest() is removed

//  if(sfContext::getInstance()->getRequest()->isXmlHttpRequest()) {
//$logger->info('!! 1');
    // magic
    return tag("iframe", array("src"=>url_for("ajaxUploader/uploader") . "?name=$name", "name"=>"ajaxUploader", "frameborder"=>0, "width"=>250, "height"=>28), true)
      . tag("/iframe") . input_hidden_tag($name);
//  } else {
//$logger->info('!! 2');
//    return input_file_tag($name, $options);
//  }  
}

?>