<?php

$v1 = $_REQUEST["valor1"];
$v2 =  $_REQUEST["valor2"];

$v3 = $_REQUEST["valor3"];


function dateconvert($date1, $date2) {
 
       list($year, $month, $day) = split('[-.]', $date1); 
       $date1Conv = "$day-$month-$year";
	   
	    list($year, $month, $day) = split('[-.]', $date2); 
       $date2Conv = "$day-$month-$year";
	   
				
				for($i=strtotime($date1Conv); $i<=strtotime($date2Conv); $i+=86400){
					
					   
$numerodiasemana = date('w', mktime(0,0,0,intval(substr(date("d-m-Y", $i),3,2)),intval(substr(date("d-m-Y", $i),0,2)),intval(substr(date("d-m-Y", $i),6,4)))); 
									
						  /*if ($numerodiasemana == 0) 
      	 						$numerodiasemana = 6; 
  							 	else 
    							  	 $numerodiasemana--; */
						
									 
									  $section[$numerodiasemana]++;
									  
									 // echo $numerodiasemana."QQQ";
																   	
				 } 
					return $section;
}


   
if ($v1 != "undefined" || $v2 != "undefined"){
      $section = dateconvert($v1, $v2); 
    
	
		$total = 0;
	$opciones = explode(',',$v3);
									
	
	  foreach($section as $c=>$v){

	 switch ($opciones[$c]){
	 
	 case 'L':
	
	 $l =  $section[1];
	 
		break;	
	 case 'M':
	 $m = $section[2];
	 
		 break;	
	 case 'X':
	  $x =  $section[3];
	    
		 break;	
	 case 'J':
	$j =  $section[4];
	 
	  break;
	 case 'V':
    $k = $section[5];
	  
	 break;}

	}
	 
	$sum = $l+$m+$x+$j+$k;
	echo $sum;
	
}else echo "0";


 ?>