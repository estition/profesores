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


$event = new Google_Service_Calendar_Event();
$event->setSummary("test title");
$event->setLocation("test location");
$start = new Google_Service_Calendar_EventDateTime();
$datetimeclass1 = new DateTime('25-11-2014');
$datetimeclass2 = new DateTime('25-11-2014');
$pepe1 = $datetimeclass1->format(DateTime::RFC3339);
$pepe2 = $datetimeclass2->format(DateTime::RFC3339);
$start->setDateTime($pepe1);
$event->setStart($start);
$end = new Google_Service_Calendar_EventDateTime();
$end->setDateTime($pepe2);
$event->setEnd($end);

//$attendee1 = new EventAttendee();
//$attendee1->setEmail('email@email.com');
//$attendees = array($attendee1);
//$event->attendees = $attendees;
$createdEvent = $service->events->insert('richardinglesadomicilio@gmail.com', $event);

echo $createdEvent->getId();


?>