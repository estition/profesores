<?php
class gbasis  {
	
	// Service Account info
	var $client_id = '895182433477-rn9l8l33eup83kompcaenjfafatdiago.apps.googleusercontent.com';
	var $service_account_name = '895182433477-rn9l8l33eup83kompcaenjfafatdiago@developer.gserviceaccount.com';
	var $key_file_location = 'certificates/cepayappoitment-d304559862fd.p12';	
 // Calendar id
	var $calName = 'richardinglesadomicilio@gmail.com';

function gbasis() {

$client = new Google_Client();
$client->setApplicationName("cepayappoitment");

$client->setClientId($client_id);
//$service = new Google_Service_Calendar($client);

$key = file_get_contents($key_file_location);
$cred = new Google_Auth_AssertionCredentials(
 $service_account_name,
 array('https://www.googleapis.com/auth/calendar'),
 $key
);

$client->setAssertionCredentials($cred);

$service = new Google_Service_Calendar($client);

}
}