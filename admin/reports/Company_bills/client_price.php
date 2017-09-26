<?php include '../../../includes/constants.php'?>
<?php include '../../../includes/functions.php'?>
<?php include '../../../includes/database.php'?>
<?php include '../../../includes/authorize.php'?>

<?php
$sql1 = "select a.id, b.name,  a.hours, c.totalrt from entry a, groups b,  entry_users c ";
$sql1 .= "where a.day >=  '2008-04-01' and a.group_id = b.id and a.group_id = c.group_id and a.user_id = 1366"; 

	
	$result1 = mysqli_query($link, $sql1) or die("Invalid query: " . mysqli_error($link));
	$row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
   
   echo  $row1["b.name"]."vvv";
   echo  $row1["hours"]."rrr";
   echo  $row1["days"]."eee";
   echo  $row1["totalrt"]."sss";
  
   
   ?>