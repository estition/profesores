<?php include '../../includes/constants.php'?>
<?php include '../../includes/functions.php'?>
<?php include '../../includes/database.php'?>
<?php include '../../includes/authorize.php'?>
<?php include '../../includes/top.php'?>
<?php require_once 'google-api-php-client-master/autoload.php'?> 
    <?php
 
		
   
    // if event ID is present
    // get event object from feed
    // delete event  
	echo "<h1>Delete Appointment</h1>";
    if (isset($_GET['id'])) {
		$eventId = $_GET['id'];
          $client_id = '895182433477-rn9l8l33eup83kompcaenjfafatdiago.apps.googleusercontent.com';
$service_account_name = '895182433477-rn9l8l33eup83kompcaenjfafatdiago@developer.gserviceaccount.com';
$key_file_location = 'certificates/cepayappoitment-d304559862fd.p12';	
 // Calendar id

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
	    $calName = 'richardinglesadomicilio@gmail.com'; 
		//echo  $eventId."IIIIIII";
	    $service->events->delete($calName, $eventId);      
          
      echo '<h3>Appointment successfully deleted!</h3>';  
    } else {
      echo '<h3>No event ID available</h3>';  
    }
    ?>