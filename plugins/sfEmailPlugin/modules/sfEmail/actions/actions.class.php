<?php

/**
 * sfEmail actions.
 *
 * @package    sfEmail
 * @author     Voznyak Nazar <voznyaknazar@gmail.com>
 * @website    http://narkozateam.com
 */

class sfEmailActions extends sfActions
{

  public function executeIndex()
  {
    if ($files = sfFinder::type('file')->name("*.eml")->relative()->prune('om')->ignore_version_control()->in(SF_ROOT_DIR.'/log/mail'))
    {
      $this->path = SF_ROOT_DIR.'/log/mail';
      $this->files = $files;
    }    
  }


  private function retrieveFile()
  {
    if(!$filename = str_replace('%%', '.', $this->getRequestParameter('filename')))
    {
      return false;
    }    
    $file = realpath(SF_ROOT_DIR.'/log/mail/'.$filename);
    $this->logMessage($file, 'debug');
    if(!(0 === strpos($file, SF_ROOT_DIR) && file_exists($file)))
    {
      return false;
    }
    $this->filename = $filename;
    $file = '<pre>'.htmlentities(file_get_contents($file), ENT_QUOTES, 'UTF-8').'</pre>';
    $this->file = $file;
    return true;
  }

  public function executeShowFile()
  {
    $this->forward404Unless($this->retrieveFile());
  }

}
