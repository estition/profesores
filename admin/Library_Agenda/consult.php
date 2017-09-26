<?php

class consult{



  
	
	
 function consult(){
 require_once 'Zend/Loader.php';
    Zend_Loader::loadClass('Zend_Gdata');
    Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
    Zend_Loader::loadClass('Zend_Gdata_Calendar');
    Zend_Loader::loadClass('Zend_Http_Client');
    
    
 }	


function ver_reg($seek){
  $gdataCal = Zend_Gdata_Calendar::AUTH_SERVICE_NAME;
  $user = "digital.library.org@gmail.com";
  $pass = "hercules";
  $client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $gdataCal);
  $gdataCal = new Zend_Gdata_Calendar($client);
  $query = $gdataCal->newEventQuery();
  $query->setUser('default');
  $query->setVisibility('private');
  $query->setProjection('full');
  $query->setOrderby('starttime');
  $query->setSortOrder('ascending');
   /*if ((date('d') == 1) || (date('d') == 2) || (date('d') == 3) || (date('d') == 4)){
		   
		   $offday = 5;
		   $offday1 = 20;}
		   else { $offday = date('d');
		          $offday1 = 21;}
		  
	    if (date('d') > 20) {
	
		
		  		$offday  = 19;
	   			$offday1 = 21;}*/
  
  $last = date('d', mktime(0, 0, 0, (date('m') + 1), 0, date('Y')));
  
  $start1 = date("Y")."-".date("m")."-01";
  $end1 =   date("Y")."-".date("m")."-".$last;
  $query->setStartMin($start1);
  $query->setStartMax($end1);
  $query->setQuery($seek);
  $eventFeed = $gdataCal->getCalendarEventFeed($query);

	return $eventFeed;
	
}


function ver_reg_fecha($start, $end){
  $gdataCal = Zend_Gdata_Calendar::AUTH_SERVICE_NAME;
  $user = "digital.library.org@gmail.com";
  $pass = "hercules";
  $client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $gdataCal);
  $gdataCal = new Zend_Gdata_Calendar($client);
  $query1 = $gdataCal->newEventQuery();
  $query1->setUser('default');
  $query1->setVisibility('private');
  $query1->setProjection('full');
  $query1->setOrderby('starttime');

  //$month1 = date("m");
   
  //$start1 = date("Y")."-".$month1."-".'01';
  //$end1 =   date("Y")."-".$month1."-".'31';
  
	// $query1->setQuery($start); 
  $query1->setStartMin($start);
  $query1->setStartMax($end);
   $eventFeed = $gdataCal->getCalendarEventFeed($query1);   
	
	return $eventFeed;
	
  
}

function ver_reg_User_fecha($seek, $start, $end){
  $gdataCal = Zend_Gdata_Calendar::AUTH_SERVICE_NAME;
  $user = "digital.library.org@gmail.com";
  $pass = "hercules";
  $client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $gdataCal);
  $gdataCal = new Zend_Gdata_Calendar($client);
  $query1 = $gdataCal->newEventQuery();
  $query1->setUser('default');
  $query1->setVisibility('private');
  $query1->setProjection('full');
  $query1->setOrderby('starttime');

  //$month1 = date("m");
   
  //$start1 = date("Y")."-".$month1."-".'01';
  //$end1 =   date("Y")."-".$month1."-".'31';
  
	// $query1->setQuery($start); 
  $query1->setStartMin($start);
  $query1->setStartMax($end);
  $query1->setQuery($seek);
   $eventFeed = $gdataCal->getCalendarEventFeed($query1);   
	
	return $eventFeed;
	
  
}

function deleteEvent($eventId) 
  {$gdataCal = Zend_Gdata_Calendar::AUTH_SERVICE_NAME;
  $user = "digital.library.org@gmail.com";
  $pass = "hercules";
  $client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $gdataCal);
  $gdataCal = new Zend_Gdata_Calendar($client);
  	//if ($eventOld = $gdataCal->getEvent($client, $eventId)){
    if ($eventOld = $gdataCal->getCalendarEventEntry('http://www.google.com/calendar/feeds/default/private/full/'.$eventId)) {
      
      try {
       $eventOld->delete();
      } catch (Zend_Gdata_App_Exception $e) {
        var_dump($e);
        return null;
      }
     
     
    } else {
      return null;
    }
}

}

?>