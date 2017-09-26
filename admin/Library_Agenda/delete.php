<?php include 'includes/constants.php'?>
<?php include 'includes/functions.php'?>
<?php include 'includes/database.php'?>
<?php include 'includes/authorize.php'?>
<?php include '../../includes/top.php'?>
   
    <?php
   
		
    require_once 'Zend/Loader.php';
    Zend_Loader::loadClass('Zend_Gdata');
    Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
    Zend_Loader::loadClass('Zend_Gdata_Calendar');
    Zend_Loader::loadClass('Zend_Http_Client');
    
    // connect to service
    $gcal = Zend_Gdata_Calendar::AUTH_SERVICE_NAME;
    $user = "digital.library.org@gmail.com";
  $pass = "hercules";
    $client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $gcal);
    $gcal = new Zend_Gdata_Calendar($client);
      
    // if event ID is present
    // get event object from feed
    // delete event  
	echo "<h1>Delete a library Appointment</h1>";
    if (isset($_GET['id'])) {
      try {          
          $event = $gcal->getCalendarEventEntry('http://www.google.com/calendar/feeds/default/private/full/' . $_GET['id']);
          $event->delete();
        } catch (Zend_Gdata_App_Exception $e) {
          echo "Error: " . $e->getResponse();
      }        
      echo '<h3>Appointment successfully deleted!</h3>';  
    } else {
      echo '<h3>No event ID available</h3>';  
    }
    ?>