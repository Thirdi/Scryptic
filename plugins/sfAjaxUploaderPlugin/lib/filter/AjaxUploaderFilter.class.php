<?php

class AjaxUploaderFilter extends sfFilter {
  const namespace = "sfAjaxUploaderPlugin";

  public function execute ($filterChain) {

    $context = sfContext::getInstance();
$logger = $context->getLogger();
$module_name = $context->getModuleName();
$logger->info('AjaxUploaderFilter called: 1. module name='.$context->getModuleName().' comp value='.strcasecmp("ajaxUploader", $module_name));
    if(strcasecmp("ajaxUploader", $module_name) != 0) {
//    if($context->getModuleName() != "ajaxUploader") {
$logger->info('AjaxUploaderFilter called: 2');
      $user = $context->getUser();
      $request = $context->getRequest();
//$logger->info('Request dump='.var_export($request,true),'info');
//print_r($request);
      
      foreach ($user->getAttributeHolder()->getAll(self::namespace) as $name=>$value) {
$logger->info('AjaxUploaderFilter called: 3');
        if(is_array($value) && $request->hasParameter($name) && is_array($request->getParameter($name))) {
$logger->info('AjaxUploaderFilter called: 4');
          $oldValue = $request->getParameter($name);
          foreach ($value as $key=>$val) {
$logger->info('AjaxUploaderFilter called: 5');
            $oldValue[$key] = $val;
          }
$logger->info('AjaxUploaderFilter called: 6');
          $request->setParameter($name, $oldValue);
        } else {
$logger->info('AjaxUploaderFilter called: 7');
          $request->setParameter($name, $value);
        }
      }
$logger->info('AjaxUploaderFilter called: 8');
      $user->getAttributeHolder()->removeNamespace(self::namespace);
    }

$logger->info('AjaxUploaderFilter called: 9');
    $filterChain->execute();

  }

}
