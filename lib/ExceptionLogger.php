<?php
class ExceptionLogger {
  public static function log($message, $exc) {
    $logger = sfContext::getInstance()->getLogger();
    $logger->err($message.' Reason: '.$exc->getMessage()."\nSTACKTRACE:\n".$exc->getTraceAsString());
  }
}
?>
