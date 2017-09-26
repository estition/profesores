<?php include '../../../includes/constants.php'?>
<?php include '../../../includes/functions.php'?>
<?php include '../../../includes/database.php'?>
<?php include '../../../includes/authorize.php'?>
<?php

$v1 = $_REQUEST["valor1"];
$v2 =  $_REQUEST["valor2"];
$v3 = $_REQUEST["valor3"];


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
   
if ($v1 != "undefined" || $v2 != "undefined"){
      $section = dateconvert($v1, $v2); 
	  	
	$total = 0;
	$opciones = explode(',',$v3);

	
	  foreach($opciones as $c=>$v){
		  
		


	 switch ($opciones[$c]){
	 
	 case 'L':
	 
	 $l =  $section[0] ;
	 
		break;	
	 case 'M':
	 $m = $section[1];
	 
		 break;	
	 case 'X':
	  $x =  $section[2];
	    
		 break;	
	 case 'J':
	$j =  $section[3];
	 
	  break;
	 case 'V':
    $k = $section[4];
	  
	 break;
	 	 case 'S':
    $s = $section[5];
	  
	 break;}
	 
	 
	 

	}
		$sql = "select * from holidays where day >= '$v1' and day <= '$v2'";
			$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
			$numRows = mysqli_num_rows($result);
			
	if ($numRows > 0) {
		
	$dias = array('D','L','M','X','J','V','S');
	$i = 0;
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	$holiday[$i] = $row['day'];
	$dd = explode('-',$holiday[$i]);
	$ts = mktime(0,0,0,$dd[1],$dd[2],$dd[0]);
	$inicial_dia[] =  $dias[date('w',$ts)];
	
	++$i;
	
	
	}
	
	

	$dias = array_intersect($opciones, $inicial_dia);

	$sum = $l+$m+$x+$j+$k+$s-sizeof($dias);	
	}else {$sum = $l+$m+$x+$j+$k+$s;}	

	
	echo $sum;
	
}else echo "0";


 ?>