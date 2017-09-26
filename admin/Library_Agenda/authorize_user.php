
<?php

class authorize_user{

 function authorize_user(){
 }	




function authorizeUser(){
  $sql = "select id, first, last1, last2, user_id from users where is_active=1 and baja=0 order by last1";
$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
//**************************modificado por svi***************************

if ($_REQUEST["teacher_id"]==""){
$teachers .= "<option value=''>Select teacher....</option>";
} else {

$sql1="select id, first, last1, last2 from users where id='".$_REQUEST["teacher_id"]."' order by last1";
$resultado = mysqli_query($link, $sql1) or die("Invalid query: " . mysqli_error($link));
$row1 = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
$selected = "selected";
$teachers.= "<option " . $selected . " value='" . $row1['id'] . "'>" . $row1['last1'] . " " . $row1['last2'] . ", " . $row1['first'] . "</option>";
}
//**************************termina modificación***************************

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	if ($_POST['teacher_id'] == $row['id']) {
		$selected = "selected";
	} else {
		$selected = "";
	}
	
	$teachers .= "<option " . $selected . " value='" . $row['id'] . "-" . $row['first']." ".$row['last1']." ".$row['last2'] .  "'>" . $row['last1'] . " " . $row['last2'] . ", " . $row['first'] . "</option>";
	
	
	
	}
	return $teachers;
}

}?>
