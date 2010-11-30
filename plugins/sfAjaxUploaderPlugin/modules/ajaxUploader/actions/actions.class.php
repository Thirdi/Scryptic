<?php

class ajaxUploaderActions extends sfActions {
  public function preExecute() {
    sfConfig::set('sf_web_debug', false);
  }

  public function executeUploader() {
    $this->name = $this->getRequestParameter('name', 'filename');
  }

  private function keyGen($length = 10) {
    $keychars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    
    if($length < 0) {
      $length = 0;
    }
    
    $max=strlen($keychars)-1;
    $key = '';
    
    for ($i=0; $i<$length; $i++) {
      $key .= substr($keychars, rand(0, $max), 1);
    }
    
    return $key;
  }
  
  public function executeSubmit() {
    $uploadDir = sfConfig::get('sf_upload_dir');
    foreach ($this->getRequest()->getFileNames() as $filename) {
      if($filename == "upload") {
        if(!$this->getRequest()->getFileError($filename)) {
          $this->filename = $this->keyGen() . $filename . '___' . $this->getRequest()->getFileName($filename);
          $this->getRequest()->moveFile($filename, $uploadDir. DIRECTORY_SEPARATOR .$this->filename);

          foreach($this->getRequest()->getParameterHolder()->getAll() as $name=>$value) {
            if(!in_array($name, array('module', 'action'))) {
              if($value == "__fieldname") {
                $value =  $this->filename;
              } elseif (is_array($value)) {
                $keys = array_keys($value);
                if(count($keys)) {
                  if($this->getUser()->hasAttribute($name, AjaxUploaderFilter::namespace) && is_array($this->getUser()->getAttribute($name, null, AjaxUploaderFilter::namespace))) {
                    $value = $this->getUser()->getAttribute($name, null, AjaxUploaderFilter::namespace);
                  }
                  
                  $value[$keys[0]] = $this->filename;
                }
              }
              $this->getUser()->setAttribute($name, $value, AjaxUploaderFilter::namespace);
              break;
            }
          }

        }
      }

      break;
    }
  }
}
