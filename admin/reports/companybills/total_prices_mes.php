<?php include '../../../includes/constants.php'?>
<?php include '../../../includes/functions.php'?>
<?php include '../../../includes/database.php'?>
<?php include '../../../includes/authorize.php'?>

<?php
$v1 = $_REQUEST["valor1"];
$v2 =  $_REQUEST["valor2"];
$v3 =  $_REQUEST["valor3"];

$daterange = explode(" -> ", $v2);

	$sql1 = "SELECT totalr FROM  entry_users WHERE  user_id = '".$v3."' and group_id = '".$v1."' and startt >= '".$daterange[0]."' and startt <= '".$daterange[1]."'";
	$result1 = mysqli_query($link, $sql1) or die("Invalid query: " . mysqli_error($link));


 while($row1[$i] = mysqli_fetch_assoc($result1)) {

	$data += $row1[$i]["totalr"];
	$i++;}
   
 echo $data;
   
   ?>