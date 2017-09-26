<?php

//require_once "Google/Client.php";
//require_once "Google/Service/Calendar.php";
require_once 'google-api-php-client-master/autoload.php'; 
// Service Account info
$client_id = '895182433477-rn9l8l33eup83kompcaenjfafatdiago.apps.googleusercontent.com';
$service_account_name = '895182433477-rn9l8l33eup83kompcaenjfafatdiago@developer.gserviceaccount.com';
$key_file_location = 'certificates/cepayappoitment-d304559862fd.p12';

// Calendar id
$calName = 'richardinglesadomicilio@gmail.com';

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

//$cals = $service->calendarList->listCalendarList();
//$pepe = $service->events->listEvents($calName, array());
echo "<pre>";
//print_r($pepe);
//print_r($cals);
echo"</pre>";
//exit;

// Convert recurring events to single events
// Look for events in the next week - now to now+1week
$datetimeclass = new DateTime('2014-11-03');
$datetimeclass1 = new DateTime('2014-11-31');
$params = array(
 'singleEvents' => TRUE,
 'timeMin' => $datetimeclass->format(DateTime::RFC3339),
 'timeMax' => $datetimeclass1->format(DateTime::RFC3339),
 'q' => '172967-Lee Mitchell',
 'orderBy' => 'startTime',
);

//print_r($params);
$events = $service->events->listEvents($calName, $params);

foreach ($events->getItems() as $event) {
	echo "<pre>";
 echo "Summary11111:  ", $event->getSummary(), "\n";
 echo "Location: ", $event->getLocation(), "\n";
 echo "Start:    ", fmt_gdate($event->getStart()), "\n";
 echo "End:      ", fmt_gdate($event->getEnd()), "\n";
 echo "id:      ", $event->getId(), "\n";
 echo "<pre>";
}

function fmt_gdate( $gdate ) {

  if ($val = $gdate->getDate()) {
	 $newdate =  new DateTime($val);

    return $newdate->format( 'd/m/Y H:i' );
  } else if ($val = $gdate->getDateTime()) {
	  $newdate =  new DateTime($val);

    return $newdate->format( 'd/m/Y H:i' );
  }
}


?>