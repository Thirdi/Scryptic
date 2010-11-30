<?php
class InputHelper
{
  /**
   * Sanitizes input from user to rid of any malicious code.
   *
   * This function should be called when getting input from request, ideally in the action class.
   */
  public static function sanitize($v)
  {
    if (empty($v))
    {
      return $v;
    }

    $encoding = 'UTF-8';
    $quote_escape = ENT_QUOTES;
    if (is_array($v))
    {
      $escaped = array();
      foreach ($v as $key => $value)
      {
      	$escaped[$key] = htmlentities($value, $quote_escape, $encoding);
      }
      return $escaped;
    }
    else
    {
      return htmlentities($v, $quote_escape, $encoding);
    }
  }
}
