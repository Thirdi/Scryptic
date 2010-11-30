<?php
/**
 * Static utility class for mundate stuff.
 */
class Util
{
  public static function getLogger()
  {
    return sfContext::getInstance()->getLogger();
  }

}