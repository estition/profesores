<?php include '../../../includes/constants.php'?>
<?php include '../../../includes/functions.php'?>
<?php include '../../../includes/database.php'?>
<?php include '../../../includes/authorize.php'?>

<?php
$v1 = $_REQUEST["valor1"];
$v2 = $_REQUEST["valor2"];
$v3 =  $_REQUEST["valor3"];
$day1 = $v2."-01";
	  
$newdate = strtotime ( '-4 month' , strtotime ( $day1 ) ) ;
$newdate = date ( 'Y-m-j' , $newdate );

   //pageno starts with 1 instead of 0
 $sql1 = "SELECT a.concept_id, a.day, count(a.day) as numer, a.group_id, a.hours FROM entry a, groups b WHERE a.group_id = b.id  and a.group_id = '".$v1."' and a.user_id = '".$v3."' and a.day >  '".$newdate."' and (a.concept_id = 2  or a.concept_id = 5) GROUP BY  a.concept_id, a.group_id, a.hours ";
 //print($sql1);
	$result1 = mysqli_query($link, $sql1) or die("Invalid query: " . mysqli_error($link));

  $data = 0;
 while($row1[$i] = mysqli_fetch_assoc($result1)) {
  
	 if($row1[$i]["concept_id"] == 5 )
	$data += $row1[$i]["numer"];
	elseif($row1[$i]["concept_id"] == 2)  $data -= $row1[$i]["numer"];
	$i++;
	}
   
 echo $data;
   
   ?>