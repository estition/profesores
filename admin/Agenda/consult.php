<?php

 class consult {

 

function ver_reg($seek, $service){

	
	
			  include_once("datemoves.php");
			  $calName = 'richardinglesadomicilio@gmail.com';
			  $showdays=new datemoves;
			  $next_month1 = date('m');
			$next_month2 = date('m') + 1;
			$year2 = date('Y');
			if($next_month2 <= 9)
			$next_month2 = "0".$next_month2;
			if(date('m') == 12){$next_month1 = "12";$next_month2 = "01"; $year2 = date('Y')+1;}
			$lista = $showdays->consultar(date('Y')."-".$next_month1."-01", date('Y')."-".$next_month2."-31");
      if  ( $lista == true )  {
		  
		  $blockedday = false;
		  $movedate = false;
			while($rowBlock = mysqli_fetch_array($lista)){
		
		if($rowBlock["fechas1"] == $rowBlock["fechas2"]){  $blockedday = true;}else{
			 $movedate = true;	
			 
	if(date('Y')."-".date('m')."-".date('d') >= $rowBlock["fechas1"])
	$dare10 = date('Y')."-".date('m')."-".date('d');
	else $dare10 = $rowBlock["fechas1"];
		 
		
		$yy = intval(substr($rowBlock["fechas2"],0,4));

		$mm = intval(substr($rowBlock["fechas2"],5,2));

		$dd = intval(substr($rowBlock["fechas2"],8,2));
		
		$dd1 = $dd + 1;
		
			if($dd <= 9) $dd = "0".$dd;
		$dare20 = $yy."-".$mm."-".$dd1;
		}
			}
			}else{
				
			 $offday = date('d');
		     $offday1 = 29;
			
			
			 $dare10 = date('Y')."-".$next_month1."-".date('d');
			 $dare20 = $year2."-".$next_month2."-".$offday1;
			 }
			 if($blockedday && !$movedate){
			$dare10 = date('Y')."-".date('m')."-".date('d');
			 $dare20 = date('Y')."-".date('m')."-16";}
 //echo $dare10."fffff";
 //echo $dare20."sssss";
  //echo $seek."NNNNN";
  //$dare20 = $yy."-".$next_month2."-".$dd;
  $datetimeclass = new DateTime($Sdare10);
  $datetimeclass1 = new DateTime($dare20);
  $params = array(
 'singleEvents' => TRUE,
 'timeMin' => $datetimeclass->format(DateTime::RFC3339),
 'timeMax' => $datetimeclass1->format(DateTime::RFC3339),
  'q' => $seek,
 'orderBy' => 'startTime',
);

$events = $service->events->listEvents($calName, $params);



	return $events;
	
}

function ver_reg_fecha($start, $end, $service){
	//echo $start."DDD".$end;
  $calName = 'richardinglesadomicilio@gmail.com';
  $datetimeclass = new DateTime($start);
  $datetimeclass1 = new DateTime($end);
  //echo $datetimeclass->format(DateTime::RFC3339)."FFFFFFFFFFF";
  $params = array(
 'singleEvents' => TRUE,
 'timeMin' => $datetimeclass->format(DateTime::RFC3339),
 'timeMax' => $datetimeclass1->format(DateTime::RFC3339),
 'orderBy' => 'startTime',
);

$events = $service->events->listEvents($calName, $params);



	return $events;
 	

  
}


function ver_reg_fecha_user($start, $end, $seek, $service){
  $calName = 'richardinglesadomicilio@gmail.com';
  $datetimeclass = new DateTime($start);
  $datetimeclass1 = new DateTime($end);
  $params = array(
 'singleEvents' => TRUE,
 'timeMin' => $datetimeclass->format(DateTime::RFC3339),
 'timeMax' => $datetimeclass1->format(DateTime::RFC3339),
  'q' => $seek,
 'orderBy' => 'startTime',

);

$events = $service->events->listEvents($calName, $params);



	return $events;
 	
	

}

function deleteEvent($eventId, $service) 
  {
	echo "<h1>Delete AppointmentFF</h1>";
	
    if (isset($eventId)) {
		
	    $calName = 'richardinglesadomicilio@gmail.com';  
	      $service->events->delete($calName, $eventId);      
          
      echo '<h3>Appointment successfully deleted!</h3>';  
    } else {
      echo '<h3>No event ID available</h3>';  
    }
	  
  }

}

?>