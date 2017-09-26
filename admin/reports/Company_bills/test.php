<?php
/*
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
//Iterate over the DatePeriod instance

$weekdays = array('1'=>'L', '5'=>'V');

foreach( $period as $date ){
	//Make sure the day displayed is greater than or equal to today
	//Make sure the day displayed is NOT sunday.
	if( $date->format('w') != 0 ){
		foreach($weekdays as $weeknum => $weekletter ){
			
			
		if($weeknum == $date->format( 'w' ).PHP_EOL)
		$datess .= $date->format( 'd' ).PHP_EOL;
		//echo $date->format( 'w' ).PHP_EOL;
		}
	}
}

print_r($datess);*/
phpinfo(); ?>