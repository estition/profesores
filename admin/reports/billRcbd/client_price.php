<?php include '../../../includes/constants.php'?>
<?php include '../../../includes/functions.php'?>
<?php include '../../../includes/database.php'?>
<?php include '../../../includes/authorize.php'?>

<?php
$v1 = $_REQUEST["valor1"];
$v2 =  $_REQUEST["valor2"];


	$sql1 = "SELECT client_price FROM prices WHERE  type = '".$v1."' and hours = '".$v2."'";
	$result1 = mysqli_query($link, $sql1) or die("Invalid query: " . mysqli_error($link));
	$row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
    
    
   echo  $row1["client_price"];
   
   ?>