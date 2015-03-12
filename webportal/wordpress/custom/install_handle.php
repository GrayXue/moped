<?php
require_once("globalVariables.php");

	 
function invoke_install_webservice($app_id, $jvm) {
  global $client;
		
  try  
    {  
      $vin = getVIN();
      $client->install($vin, $app_id, $jvm);
      for ($i=0; $i<30; $i++) {
	$ret = $client->get_ack_status($vin, $app_id);

	if ($ret) {
	  echo "<font color='green'>Installation complete</font><br/>";
	  break;
	}
	else {
	  sleep(1);
	}
      }
			
      if (!$ret) {
	echo "<font color='red'>Installation failed</font>";
      }
			
      return $ret;
    } catch (SoapFault $exception) {  
    print $exception;
    return false;
  }
}
	
	
?>
