<?php include '../../../includes/constants.php'?>

<?php include '../../../includes/database.php'?>


<?php
$v1 = $_REQUEST["valor1"];
$v2 =  $_REQUEST["valor2"];
$v3 =  $_REQUEST["valor3"];


$sql1 = "SELECT observations FROM  entry_users WHERE  user_id = '".$v3."' and group_id = '".$v1."' and startt like '%".$v2."%'";
	$result1 = mysqli_query($link, $sql1) or die("Invalid query: " . mysqli_error($link));
//print($sql1);
$numRows = mysqli_num_rows($result1);
if ($numRows > 0) {
 while($row1[$i] = mysqli_fetch_assoc($result1)) {
   if($data != ")"){
	$data = $data." | ".$row1[$i]["observations"];
	$i++;}}
   
 echo $data;}else echo " ";
   
   ?>