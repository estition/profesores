<?php include '../../../includes/constants.php'?>
<?php include '../../../includes/functions.php'?>
<?php include '../../../includes/database.php'?>
<?php include '../../../includes/authorize.php'?>
<?php

$v1 = $_REQUEST["valor1"];
$v2 =  $_REQUEST["valor2"];

$v3 = $_REQUEST["valor3"];


if ($v1 != "undefined" || $v2 != "undefined"){
      
	  	//print_r($section);
	$total = 0;
	$opciones = explode(',',$v3);

	
		  foreach($opciones as $c=>$v){


	 switch ($opciones[$c]){
	 
	 case 'L':
	 
	 $weeks[1] =  "L" ;
	 
		break;	
	 case 'M':
	$weeks[2] =  "M" ;
	 
		 break;	
	 case 'X':
	  $weeks[3]=  "X" ;
	    
		 break;	
	 case 'J':
	$weeks[4]=  "J" ;
	 
	  break;
	 case 'V':
   $weeks[5]=  "V" ;
	  
	 break;
	 	 case 'S':
    $weeks[6]=  "S" ;
	  
	 break;}


	}
	
	//print_r($weeks);
	//Create an instance of now
//This is used to determine the current month and also to calculate the first and last day of the month
$now = new DateTime( 'now' );
//Create a DateTime representation of the first day of the current month based off of "now"
$start = new DateTime( $now->format('m/01/Y') );
//Create a DateTime representation of the last day of the current month based off of "now"
$end = new DateTime( $now->format('m/t/Y') );
$end = $end->modify( '+1 day' );
//Define our interval (1 Day)
$interval = new DateInterval('P1D');
//Setup a DatePeriod instance to iterate between the start and end date by the interval
$period = new DatePeriod( $start, $interval, $end );

/*
function dateconvert($date1, $date2) {
 
       list($year, $month, $day) = split('[-.]', $date1); 
       $date1Conv = "$day-$month-$year";
	   
	    list($year, $month, $day) = split('[-.]', $date2); 
       $date2Conv = "$day-$month-$year";
	   
	   	   
			    
										
				
				for($i=strtotime($date1Conv); $i <= strtotime($date2Conv); $i+=86400){
					
					   
$numerodiasemana = date('w', mktime(0,0,0,intval(substr(date("d-m-Y", $i),3,2)),
							intval(substr(date("d-m-Y", $i),0,2)),intval(substr(date("d-m-Y", $i),6,4)))); 
		
									$section[$numerodiasemana]++;
									  
									//echo $numerodiasemana;
																   	
				 } 
					return $section;
}


$period = dateconvert($v1, $v2); */



		$sql = "select * from holidays where day >= '$v1' and day <= '$v2'";
			$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
			$numRows = mysqli_num_rows($result);
			
	if ($numRows > 0) {
		
		$i = 0;
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	$holiday[$i] = $row['day'];
	++$i;
	
	
	}
}else $holiday[0] = "";
foreach( $period as $date ){
	//Make sure the day displayed is greater than or equal to today
	//Make sure the day displayed is NOT sunday.
	//print gettype($date{date})."SSS";
	$date2array = (array)$date;
	
	
	
	$monthdays = substr_replace($date2array["date"], ',', 10, 9);
	list($year, $month, $day) = split('[/.,-]', $monthdays);
	
	foreach($holiday as $holly){
	
	list($year1, $month1, $day1) = split('[/.,-]', $holly);
	if($day1 == $day)
	$day = "";
		
	}
	if( $year."-".$month."-".$day >= $v1 && $date->format('w') != 0 ){
		foreach($weeks as $weeknum => $weekletter ){
			
			
		if($weeknum == $date->format( 'w' ).PHP_EOL)
		$datess .= $day." ";
		//echo $date->format( 'w' ).PHP_EOL;
		}
		
	}
}echo $datess;

	
}else echo "0";


 ?>