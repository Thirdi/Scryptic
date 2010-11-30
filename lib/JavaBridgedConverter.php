<?php
$bridge_endpoint = sfConfig::get('app_java_php_bridge_connection_endpoint', '127.0.0.1:8181');
define ("JAVA_HOSTS", $bridge_endpoint);

require_once ("java/Java.inc");
java_autoload(jod_classpath()."converter.jar;util.jar");

class JavaBridgedConverter 
{
  public function convert($from_name, $to_name)
  {
    $converter = new Java("converter.DocumentConverter");
    $from = new Java("java.lang.String", $from_name);
    $to = new Java("java.lang.String", $to_name);
    $converter->convert($from, $to);

    $this->changePermission($to_name, '0777'); // RD-131: need to change permission of file because pdf is created under different user
    unlink($from_name);
  }

  private function changePermission($filename, $perm)
  {
    java("util.FileUtil")->chmod($filename, $perm);  
  }
}

function jod_classpath() 
{
  $jod_jars = array('juh-3.0.1.jar', 
                    'jurt-3.0.1.jar', 
                    'jodconverter-2.2.2.jar', 
                    'commons-io-1.4.jar', 
                    'ridl-3.0.1.jar', 
                    'unoil-3.0.1.jar', 
                    'xstream-1.3.1.jar', 
                    'slf4j-api-1.5.6.jar', 
                    'slf4j-jdk14-1.5.6.jar');
  $jod_classpath = '';
  foreach ($jod_jars as $jod_jar) 
  {
    $jod_classpath .= 'jodconverter-2.2.2/lib/'.$jod_jar.';';  
  }
  return $jod_classpath;  
}
?>
