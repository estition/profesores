<?php header("Content-Type: text/html;charset=ISO-8859-1");  ?>
<?php include '../../../includes/constants.php'?>
<?php include '../../../includes/functions.php'?>
<?php include '../../../includes/database.php'?>
<?php include '../../../includes/authorize.php'?>

<?php



$v1 = $_REQUEST["valor1"];
$v2 =  $_REQUEST["valor2"];

	$sql = "SELECT    o2.observations, o1.max_id, o2.id max_id
FROM      (
             SELECT group_id, observations, MAX(id) max_id
             FROM `entry_users`
             GROUP BY group_id
          ) o1
JOIN      `entry_users` o2 ON (o2.id = o1.max_id AND o2.group_id = '".$v2."'  and o2.user_id = '".$v1."' )
GROUP BY  o1.group_id";
	
	$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	echo $row['observations'];
	 ?>