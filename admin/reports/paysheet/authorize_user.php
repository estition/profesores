
<?php

class authorize_user{


function authorizeUser($link){
  $sql = "select id, first, user_id from users where is_active=1 and baja=0 order by first";
$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
//**************************modificado por svi***************************

if ($_REQUEST["teacher_id"]==""){
$teachers .= "<option value=''>Select teacher....</option>";
} else {

$sql1="select id, first from users where id='".$_REQUEST["teacher_id"]."' order by first";
$resultado = mysqli_query($link, $sql1) or die("Invalid query: " . mysqli_error($link));
$row1 = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
$selected = "selected";
$teachers.= "<option " . $selected . " value='" . $row1['id'] . "'>". $row1['first'] . "</option>";
}
//**************************termina modificación***************************

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	if ($_POST['teacher_id'] == $row['id']) {
		$selected = "selected";
	} else {
		$selected = "";
	}
	
	$teachers .= "<option " . $selected . " value='" . $row['id'] . "'>" . $row['first'] . "</option>";
	
	
	
	}
	return $teachers;
}

}?>
