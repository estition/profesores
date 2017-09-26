<?php include '../../../includes/constants.php'?>
<?php include '../../../includes/functions.php'?>
<?php include '../../../includes/database.php'?>
<?php include '../../../includes/authorize.php'?>
<?php

$v1 = $_REQUEST["valor1"];
$v2 =  $_REQUEST["valor2"];

$v3 = $_REQUEST["valor3"];

/*$v1 = "2012-11-01";
$v2 =  "2012-11-30";

$v3 = "1005";*/





		$sql = "select bills_codes, start from comp_groups where start >= '$v1' and start <= '$v2' and groups_id = '$v3'";
			$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
			$numRows = mysqli_num_rows($result);
			
	if ($numRows > 0) {
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$year = explode( '-', $row['start'] );
	$code = explode( '/', $row['bills_codes'] );
	if($year[0] == $code[2])
	echo $row['bill_code'];
	else {$new_code = $code[0] + 1;  echo $new_code."/".$year[0];}
	//explode $v1 & $row['start'] when equal add ++1 to explode-code and append year if not set explode-code to cero
	}else echo $numRows."/".date("Y");

 ?>