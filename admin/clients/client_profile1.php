<?php require_once('calendar/tc_calendar.php'); 
?><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script language="javascript" src="calendar/calendar.js"></script>
<link href="calendar/calendar.css" rel="stylesheet" type="text/css">
	 
      <script type="text/javascript">
	  
	  
	  function updateTeacher() 
{ 
var del; 

del = confirm('OJO: Si la fecha que ha introducido es anterior a la actual este cliente pasara a "No Asignados" de lo contrario seguira en activos, desea actualizar la fecha fin?'); 
if(del) 
{ 
return true;
} 
else 
return false; 
} 


	  function deleteTeacher() 
{ 
var del; 

del = confirm('Esta apunto de eliminar un profesor a este cliente, si al cliente no le quedan profesores vigentes, este cliente pasara a bajas, desea eliminarlo? '); 
if(del) 
{ 
return true;
} 
else 
return false; 
} 


function limitText(limitField, limitCount, limitNum) {

	
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		

		var info = document.getElementById(limitCount);
		
		info.innerHTML = limitNum - limitField.value.length;
	}
}
</script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>
<?php include 'includes/constants.php'?>
<?php include 'includes/functions.php'?>
<?php include 'includes/database.php'?>
<?php include 'includes/authorize.php'?>
<?php

$message = "";
$name= $_POST["name"];

$apellido2= $_POST["apellido2"];
$dni= $_POST["dni"];
$telephone1= $_POST["telephone1"];
$telephone2 = $_POST["telephone2"];
$mobile = $_POST["mobile"];
$fax = $_POST["fax"];
$email = escape($_POST["email"]);
$address1 = $_POST["address1"];
$address2 = $_POST["address2"];
$city = $_POST["city"];
$state = $_POST["state"];
$zip = $_POST["zip"];
$start = $_POST["start"];
$start1 = $_POST["start1"];
$end = $_POST["end"];
$returndate = $_POST["returndate"];
$supplement = $_POST["supplement"];
$class_type = $_POST["class_type"];
$price = $_POST["price"];
$fee = $_POST["fee"];
if ($_POST["dias"] != ""){
$array2string = $_POST["dias"];

foreach($array2string as $value1){

switch($value1){

case "L": $l = "L";break;
case "M": $m = "M";break;
case "X": $x = "X";break;
case "J": $j = "J";break;
case "V": $v = "V";break;
case "S": $s = "S";break;
	}
}

$dias = implode(",", $array2string);}


$hora_fin = $_POST["hora_fin"];
$Metro = $_POST["Metro"];
$Seguimiento = $_POST["Seguimiento"];
$Objetivos = $_POST["Objetivos"];
$nino = $_POST["nino"];
$contry = $_POST["contry"];

switch($contry){

case "USA": $button1 = "checked";break;
case "UK":  $button2 = "checked";break;

	}
$gender = $_POST["gender"];


switch($gender){

case "H":  $button3 = "checked";break;
case "M":  $button4 = "checked";break;

	}
$nivel = $_POST["nivel"];
$Preferencia = $_POST["Preferencia"];
$enterprise = $_POST['enterprise'];
$teacher_id = $_POST["teacher_id"];

	


if ($_REQUEST['id'] == "") {
	/* NEW PROFILE */

	$mode = "New";
	if ($_POST['action'] == "Save Changes") {
		
		
		if ($_POST['supplement'] == "") {
			$supplement = 0;
		} else {
			$supplement = $_POST['supplement'];
		}
	
		$sql0 = "select * from groups where name = '". escape($_POST['name']). "' ";
	$result0 = mysqli_query($link, $sql0) or die("Invalid query: " . mysqli_error($link));
	$numfilas = mysqli_num_rows($result0);

		
		if (($message == "") &&  ($numfilas == 0)) {
		
			/*
			$sql = "insert into groups (name, cif, ";
			$sql = $sql . "telephone1, telephone2, mobile, fax, email, address1, address2, city, state, zip, start) values ";
			$sql = $sql . "('" . escape($_POST['name']) . "', '" . escape($_POST['cif']) . "'";
			$sql = $sql . ", '" . escape($_POST['telephone1']) ."'";
			$sql = $sql . ", '" . escape($_POST['telephone2']) . "', '" . escape($_POST['mobile']) ."'";
			$sql = $sql . ", '" . escape($_POST['fax']) . "', '" . escape($_POST['email']) . "', '" . escape($_POST['address1']) ."'";
			$sql = $sql . ", '" . escape($_POST['address2']) . "', '" . escape($_POST['city']) ."'";
			$sql = $sql . ", '" . escape($_POST['state']) . "', '" . escape($_POST['zip']) ."', sysdate());";
*/
				$sql = "insert into groups (name, cif, telephone1, telephone2, mobile, email, address1, city, state, zip, returndate, start, fecha_inicio, supplement, class_type, gender, days, metro, endtime, seguimiento, objetivos, ninos, tcontry, nivel, enterprise, preferencia, price, fee, group_type) values ";
		
			$sql = $sql . "('" . escape($_POST['name']) . "'";
			
			$sql = $sql . ", '" . escape($_POST['dni']) ."'";
			$sql = $sql . ", '" . escape($_POST['telephone1']) ."'";
			$sql = $sql . ", '" . escape($_POST['telephone2']) ."'";
			$sql = $sql . ", '" . escape($_POST['mobile']) . "', '" . escape($_POST['email']) ."'";
			$sql = $sql . ", '" . escape($_POST['address1']) . "', '" . escape($_POST['city']) ."'";
			$sql = $sql . ", '" . escape($_POST['state']) . "', '" . escape($_POST['zip']) ."'";
			$sql = $sql . ", '" .$_POST['returndate'] . "', '" . escape($_POST['start']) . "', '" . $_POST['start1'] ."'";
			$sql = $sql . ", '" . escape($_POST['supplement']) ."'";
			$sql = $sql . ", '" . escape($_POST['class_type']) . "', '" . escape($_POST['gender']) ."'";
			$sql = $sql . ", '" . $dias . "', '" . escape($_POST['Metro']) ."'";
			$sql = $sql . ", '" . escape($_POST['hora_fin']) ."'";
			$sql = $sql . ", '" . escape($_POST['Seguimiento']) ."'";
			$sql = $sql . ", '" . escape($_POST['Objetivos']) . "', '" . escape($_POST['nino']) ."'";
			$sql = $sql . ", '" . escape($_POST['contry']) . "', '" . escape($_POST['nivel']) ."'";
			$sql = $sql . ", '" . escape($_POST['enterprise']) ."'";
			$sql = $sql . ", '" . escape($_POST['Preferencia']) . "', '". escape($_POST['price'])."'";
			$sql = $sql . ", '" . escape($_POST['fee']) ."'";
			$sql = $sql . ", 'Client');";
			//print $sql;
			mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
			$id = mysql_insert_id();
			

			$message = "<br>Client Profile Saved.";
		}else{$message = "<br>Client already exist, try with another one";}
	}
} else {
	$mode = "Edit";
}

if ($id == "") {
	$id = $_REQUEST['id'];
}
if ($id != "" && $_POST['action'] == "Add teacher") {
	
	
	  if ($_POST['new_start'] == "") {
			$new_start = "null";
		} else {
			$new_start = "'" . $_POST['new_start'] . "'";
		}

		
		if ($_POST['hora_ini0'] == "") {
			$hora_ini0 = "null";
		} else {
			$hora_ini0 = "'" . $_POST['hora_ini0'] . "'";
		}
		
		  if ($_POST['hora_fin0'] == "") {
			$hora_fin0 = "null";
		} else {
			$hora_fin0 = "'" . $_POST['hora_fin0'] . "'";
		}
  
  		
		if ($_POST['new_length'] == "") {
			$new_length = "null";
		} else {
			$new_length = "'" . $_POST['new_length'] . "'";
		}
	

	$validation = "select a.end from userGroup a, users b where a.user_id = b.id and group_id = " . $id;
	$result1 = mysqli_query($link, $validation) or die("Invalid query: " . mysqli_error($link));

    $numfilas = mysqli_num_rows($result1);
	
	$swich = false;
	if ($numfilas > 0) {
	while ($row = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
	
	if ($row["end"] == ""){
	$swich = true;
	}
	
	}
	}
	if($swich){
	$message = "<br>Before to add a new teacher you must enter the end date!";
	} else{
	
	 $sql1 = "update groups set active = 1, baja = 0 where id = " . $id;
	  mysqli_query($link, $sql1) or die("Invalid query: " . mysqli_error($link));
	  
$sql = "insert into userGroup (user_id, length, group_id, start, starttime, endtime) ";
	$sql .= " values (" . $teacher_id . "," . $new_length . ",  " . $id . "," . $new_start . " , " . $hora_ini0 . ", " . $hora_fin0 . ")";
	//print $sql;
	mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
	$message = "<br>A new teacher was entered successfully!";}
	}

    if ($id != "" && $_POST['action'] == "Delete teacher") {
	foreach ($_POST['delete_teacher'] as $tid) {

   	$sql = 'delete from userGroup where id = ' . $tid;
   	mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));

	}
	
	$i = 0;
	$act_teacher1 = true; 
	$currentDate = date('Y').date('m').date('d');
	

	foreach ($_POST['teacher'] as $utid) {
	$enddatebbdd = str_replace("-", "", $_POST['end_teacher'][$i] );
	
		if ($enddatebbdd > $currentDate ) {
		
			
			$act_teacher1 = false; 
			break;
		}
		$i++; 
	}	
		if ($act_teacher1){
			$sql = "update groups set active = 0, baja = 0 where id = " . $id;
			mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
	}else {$sql = "update groups set active = 1, baja = 0 where id = " . $id;
			mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));}
		$message = "<br>Teacher association deleted.";
}




if ($id != "" && $_POST['action'] == "Delete client") {
if (count($_POST['delete_client']) == 0) {$message = "<br>Must check the client first.";}
else{
	foreach ($_POST['delete_client'] as $dtid) {
   	$sql = 'delete from clients where id = ' . $dtid;
   	mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
    $message = "<br>Client deleted.";}
	}
}



if ($id != "" && $_POST['action'] == "Update Client") {

$email = escape($_POST["email"]);
 
if ($_POST["dias"] != ""){
$array2string = $_POST["dias"];

$dias = implode(",", $array2string);}


		
$hora_fin = substr($_POST["hora_fin"], 0, 5);

		
   	//$sql = "update userGroup set start = ". $start_teacher . ", end = ". $end_teacher . ", class_type = " . $_POST['class_type'][$i] . ", length= " . $length_teacher . " where id = " . $utid;
   	  	$sql = "update groups set name = '".escape($_POST["name"])."', cif = '".escape($_POST["dni"])."', telephone1= '".escape($_POST["telephone1"])."', telephone2= '".escape($_POST["telephone2"])."', mobile= '".escape($_POST["mobile"])."', email= '".$email."', address1= '".escape($_POST["address1"])."', city= '".escape($_POST["city"])."', state= '".escape($_POST["state"])."', zip= '".escape($_POST["zip"])."', start= '".escape($_POST["start"])."', returndate= '".escape($_POST["returndate"])."', fecha_inicio= '".escape($_POST["start1"])."', supplement= '".escape($_POST["supplement"])."', class_type= '".escape($_POST["class_type"])."', gender= '".escape($_POST["gender"])."', days= '".$dias."', metro= '".escape($_POST["Metro"])."', endtime= '".$hora_fin."', objetivos= '".escape($_POST["Objetivos"])."', seguimiento= '".escape($_POST['Seguimiento'])."', ninos= '".escape($_POST["nino"])."', tcontry= '".escape($_POST["contry"])."', nivel= '".escape($_POST["nivel"])."', enterprise= '".$_POST["enterprise"]."', fee= '".escape($_POST["fee"])."', preferencia= '".escape($_POST["Preferencia"])."', price= ".$_POST["price"].", group_type= 'Client' where id = " . $id;
 
	//print $sql . "<br>";
     	mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
   
    $message = "<br>Client data updated.";
	}

if ($id != "" && $_POST['action'] == "Update info") {
	$i = 0;
	$act_teacher = true;
	$currentDate = date('Y').date('m').date('d');
	
	foreach ($_POST['teacher'] as $utid) {
		if ($_POST['start_teacher'][$i] == "") {
			$start_teacher = "null";
		} else {
			$start_teacher = "'" . $_POST['start_teacher'][$i] . "'";
		}
		
        $enddatebbdd1 = str_replace("-", "", $_POST['end_teacher'][$i] );
		
		if (empty($_POST['end_teacher'][$i]) || ($enddatebbdd1 > $currentDate )){
		$act_teacher = false;
		}else if ($enddatebbdd1 < $currentDate ){$act_teacher = true;}
		if ($_POST['end_teacher'][$i] == "")  {
		
			
			
			$end_teacher = "null";
		} else {
			$end_teacher = "'" . $_POST['end_teacher'][$i] . "'";
		}
	
		if ($_POST['length_teacher'][$i] == "") {
			$length_teacher = "null";
		} else {
			$length_teacher = "'" . $_POST['length_teacher'][$i] . "'";
		}
		if ($_POST['hora_ini1'][$i] == "") {
			$hora_ini1 = "null";
		} else {
			$hora_ini1 = "'" . $_POST['hora_ini1'][$i] . "'";
		}
		if ($_POST['hora_fin1'][$i] == "") {
			$hora_fin1 = "null";
		} else {
			$hora_fin1 = "'" . $_POST['hora_fin1'][$i] . "'";
		}
	
	

   	//$sql = "update userGroup set start = ". $start_teacher . ", end = ". $end_teacher . ", class_type = " . $_POST['class_type'][$i] . ", length= " . $length_teacher . " where id = " . $utid;
   	$sql = "update userGroup set start = ". $start_teacher . ", end = ". $end_teacher . ", starttime = ".$hora_ini1.", endtime = ".$hora_fin1.", length = " . $length_teacher . " where id = " . $utid;
 
	//print $sql . "<br>";
   	mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
   	$i++;
    $message = "<br>Teacher association data updated.";
	}
	if ($act_teacher){
			$sql = "update groups set active = 0, baja = 0 where id = " . $id;
			mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
	}else {$sql = "update groups set active = 1, baja = 0 where id = " . $id;
			mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));}
}

if (($id != "") && (($message == "<br>Client Group Profile Saved.") || ($message == ""))) {

	$sql = "select * from groups where id = " . $id;
	$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));

	if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$name =  stripslashes($row["name"]);
		
		$dni =  stripslashes($row["cif"]);
		$telephone1 = $row["telephone1"];
		$telephone2 = $row["telephone2"];
		$mobile = $row["mobile"];
		$fax = $row["fax"];
		$email = $row["email"];
		$address1 = $row["address1"];
		$address2 = $row["address2"];
		$city = $row["city"];
		$state = $row["state"];
		$zip = $row["zip"];
		$start = $row["start"];
		$start1 = $row["fecha_inicio"];
		$returndate = $row["returndate"];
			 
		If ($row["supplement"] == "") {
			$supplement = 0;
		} else {
			$supplement = $row["supplement"];
		}
		$class_type = $row["class_type"];
	
		$price = $row["price"];
		$fee = $row["fee"];
		$diasString = $row["days"];
		
		$dias = explode(',',$diasString);
		
		
		$hora_fin = substr($row["endtime"], 0, 5);
		$Metro = $row["metro"];
		$Seguimiento = $row["seguimiento"];
		$Objetivos = $row["objetivos"];
		$nino = $row["ninos"];
		$contry = $row["tcontry"];
		$gender = $row["gender"];
		
		
		
		switch($gender){

case "H":  $button3 = "checked";break;
case "M":  $button4 = "checked";break;

	}
		$nivel = $row["nivel"];
		$enterprise = $row["enterprise"];
		$Preferencia = $row["preferencia"];
		
			foreach($dias as $value){

switch($value){

case "L": $l = "L";break;
case "M": $m = "M";break;
case "X": $x = "X";break;
case "J": $j = "J";break;
case "V": $v = "V";break;
case "S": $s = "S";break;
	}
}

switch($contry){

case "USA": $button1 = "checked";break;
case "UK":  $button2 = "checked";break;

	}
switch($gender){

case "H": $button3 = "checked";break;
case "F":  $button4 = "checked";break;

	}


	} 
	

}


$sql = "select id, first from users where baja = 0 order by first";
$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
$teachers .= "<option value=''>Select teacher....</option>";
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	$teachers .= "<option value='" . $row['id'] . "'>" . $row['first'] . "</option>";
}
	
			
?>

 
<?php include '../../includes/top.php'?>
    
   

<table width="100%" border="0" cellpadding="10" cellspacing="0" id="body">
     
        <tr> 
          <td width="100%" valign="top">  
 
 <p align="center"><b>Client Profile &#8211; 
              <?php echo  $mode ?> <br><font color='#ff9900'><?php echo  $message ?></font></b></p>
            <!--start dynamic code -->
            <form name="associate" id="associate" method="post">
            	<input type="hidden" name="id" value="<?php echo $id;?>">
            
<table border="0" align="center" bgcolor="#eeeeee">

    <tr>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
      <td width="252" rowspan="14"> 
         <fieldset>
    <span id="sprytextfield01">
  <label><span class="style10"><strong>Metro/Others methods:  
  </strong></span> <span class="textfieldRequiredMsg"><font size="2">Required</font></span><br /> 
  <input name="Metro" type="text" id="Metro" size="35" maxlength="100" value="<?php echo  $Metro;?>" />
  </label>
 </span>
    </fieldset>    <fieldset>
 
   <label><span class="style9"><strong>Follow-up:</strong><span id="countdown002"></span>
   <textarea name="Seguimiento" id="Seguimiento" cols="35" rows="5"  onKeyDown="limitText(this.form.Seguimiento,'countdown002',1000);" 
onKeyUp="limitText(this.form.Seguimiento,'countdown002',1000);"><?php echo  $Seguimiento;?></textarea>
   </label>
  </span><br />
            <span id="sprytextarea0">
              
              <label><span class="style9"><strong>Objective:</strong><span id="countdown001"></span>
              <div class="textareaRequiredMsg"><font size="2">Required</font></div></span><br />
            <textarea name="Objetivos" id="Objetivos" cols="35" rows="6" onKeyDown="limitText(this.form.Objetivos,'countdown001',1000);" 
onKeyUp="limitText(this.form.Objetivos,'countdown001',1000);"><?php echo  $Objetivos;?></textarea>
            </label>
            </span>
            </fieldset> <fieldset>
 <label><span class="style7 style9 style6"><strong>Kids?</strong></span>
 
 <input type="checkbox" name="nino" value="1" <?php  if($nino == "1") echo 'checked="checked"' ?>  />
 </label> 
 
 <label><span class="style7 style9 style6"><strong>USA</strong></span>
 
 <input name="contry" <?php echo  $button1;?> type="radio" value="USA" /> 
 </label>

 <label><span class="style7 style9 style6"><strong>UK</strong></span>
 
 <input name="contry" <?php echo  $button2;?> type="radio" value="UK" /> 
 </label>
 
 <label><span class="style7 style9 style6"><strong>H</strong></span>
 
 <input name="gender" <?php echo  $button3;?> type="radio" value="H"/> 
 </label>  
 
 <label><span class="style7 style9 style6"><strong>M</strong></span>
 
 <input name="gender" <?php echo  $button4;?> type="radio" value="M"/> 
 </label>
 
 <br />
  <br />
 <?php 
function is_selected3($arg) {

global $nivel; 


   if (isset($nivel) && $arg == $nivel) { 
      echo ' selected="selected"'; 
   } 
} 
?> 

 <span id="spryselect06">
 <label><span class="style7 style9 style6"><strong>Nivel</strong></span>
 <select name="nivel" size="1" id="nivel" accesskey="L" tabindex="0">
 
   <option value="">------------------------</option>
      <option value="Escolar"<?php is_selected3('Escolar'); ?>>Escolar</option>
   <option value="False Beginner"<?php is_selected3('False Beginner'); ?>>False Beginner</option>
   <option value="Elementary Upper"<?php is_selected3('Elementary Upper'); ?>>Elementary Upper</option>
   <option value="Elementary"<?php is_selected3('Elementary'); ?>>Elementary</option>
   <option value="Lower Intermediate"<?php is_selected3('Lower Intermediate'); ?>>Lower Intermediate</option>
   <option value="Intermediate"<?php is_selected3('Intermediate'); ?>>Intermediate</option>
   <option value="Upper Intermediate"<?php is_selected3('Upper Intermediate'); ?>>Upper Intermediate</option>
   <option value="Advanced Level 1"<?php is_selected3('Advanced Level 1'); ?>>Advanced Level 1</option>
   <option value="Advanced Level 2"<?php is_selected3('Advanced Level 2'); ?>>Advanced Level 2</option>
   <option value="Advanced Level 3"<?php is_selected3('Advanced Level 3'); ?>>Advanced Level 3</option>
 </select>
 </label>
 <span class="selectRequiredMsg"><font size="2">Required</font></span></span>  
 <br />
  <br />
  
 
 <span id="sprytextarea2">
   
   <label><span class="style9"><strong>Preference:</strong><span id="countdown003"></span>
   <div class="textareaRequiredMsg"><font size="2">Required</font></div><br />
   </span>
   <textarea name="Preferencia" id="Preferencia" cols="35" rows="7"  
   onKeyDown="limitText(this.form.Preferencia,'countdown003',1000);" 
onKeyUp="limitText(this.form.Preferencia,'countdown003',1000);"><?php echo  $Preferencia;?></textarea>
   </label>
   </span>
    </fieldset></td>
    <br />
    </tr>
    <tr>
    <td width="101" rowspan="2">Name: </td>
<td width="174"><span id="sprytextfield00">
   
<label><span class="style10">  
  						 </span>
                        <input name="name" type="text" value="<?php echo  $name;?>">
                    </label>
            <span class="textfieldRequiredMsg"><font size="2">Required</font></span></span></td>
    <td width="174"> 
     <strong>Return :</strong>
 <?php
     if ($id != '') {  
		
	$yy = intval(substr($returndate,0,4));
	   
	$mm = intval(substr($returndate,5,2));

	$dd = intval(substr($returndate,8,2));
		
		
	  $myCalendar = new tc_calendar("returndate", true);
	  $myCalendar->showInput(false);
	  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
	  $myCalendar->setDate($dd, $mm, $yy);
	  $myCalendar->setPath("calendar/");
	  $myCalendar->setYearInterval(2000, 2012);
	  $myCalendar->dateAllow('2009-05-13', '2012-12-31');
	  $myCalendar->setDateFormat('j F Y');
	  $myCalendar->writeScript();}
	  ?>      
    
  </td>
    </tr>
  <tr>
    <td colspan="2"></td>
  </tr>
  
  <tr>
    <td>DNI:</td>
    <td>
   
   						<label><span class="style10">
  						</span>
    <input name="dni" type="text" value="<?php echo  $dni;?>">
      </label>		    </td> 
    <td><label><span class="style6 style9 style7"><strong>Fee:</strong></span>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="fee" value="1" <?php  if($fee == "1") echo 'checked="checked"' ?>  />
    </label>&nbsp;</td>
  
  </tr>
  <tr>
     <td width="101">Telephone 1:</td>
<td>
   
   						<label><span class="style10">
  						</span>
                        <input name="telephone1" type="text" value="<?php echo  $telephone1;?>">
              </label>		    </td>
<td>  <label><span class="style6 style9 style7"><strong>Factura?</strong></span>
 
 <input type="checkbox" name="enterprise" value="1" <?php  if($enterprise == "1") echo 'checked="checked"' ?>  />
 </label></td>
  </tr>
  <tr>
    <td width="101">Telephone 2:</td>
    <td colspan="2"> <input name="telephone2" type="text" value="<?php echo  $telephone2;?>"></td>
    </tr>
  <tr>
   <td>Mobile:</td>
    <td colspan="2">
                      <label><span class="style10">  						
                      </span>
                        
                        <input name="mobile" type="text" value="<?php echo  $mobile;?>">
                    </label>					   </td>
  </tr>
  <tr>
    <td>Email:</td><td colspan="2"><span id="sprytextfield06">
   
   						<label><span class="style10">
  						</span>
                        <input name="email" type="text" value="<?php echo  $email;?>">
                        </label>
		    <span class="textfieldRequiredMsg"><font size="2">Required</font></span></span></td>
  </tr>
  <tr>
    <td>City:</td><?php if ($city == ""){$city = "Madrid";}?>
    <td colspan="2"> <span id="sprytextfield07">
   
   <label><span class="style10"> 
  </span>
                        <input name="city" type="text" value="<?php echo  $city;?>"></label>
		    <span class="textfieldRequiredMsg"><font size="2">Required</font></span></span><br>      </td>
  </tr>  
  <tr>
    <td>State & Zip:</td>    
   <td colspan="2">
  <span id="sprytextfield08">
   <label><span class="style10">  
  </span><input name="state" type="text" value="<?php echo  $state;?>"></label>
  <span class="textfieldRequiredMsg"><font size="2">Required</font></span></span>  & 
  <span id="sprytextfield12">
   <label><span class="style10">  
  </span><input name="zip" type="text" value="<?php echo  $zip;?>" size="10"></label>
  <span class="textfieldRequiredMsg"><font size="2">Required</font></span></span>    </td>
  </tr>
  <tr>
    <td>Address:</td>
    <td colspan="2"><span id="sprytextfield09">
   
  				 		<label><span class="style10"> 
  						</span>
                        <input name="address1" type="text" value="<?php echo  $address1;?>" size="43"> </label>
		    <span class="textfieldRequiredMsg"><font size="2">Required</font></span></span><br></td>
  </tr>
  <tr>
    <td>Class type:</td>
   
    <td colspan="2">
     <?php 
function is_selected2($arg) {

global $class_type; 


   if (isset($class_type) && $arg == $class_type) { 
      echo ' selected="selected"'; 
   } 
} 




?> 
 <span id="spryselect4">
 <label><span class="style7 style9 style6"></span>
 <select name="class_type" size="1" id="class_type" accesskey="L" tabindex="0">
   <option value="">-----------------------------------------------</option>
   <option value="1"<?php is_selected2('1'); ?> >Individual Class</option>
   <option value="2"<?php is_selected2('2'); ?>>Group Class I (2-3 -> adults/kids)</option>
   <option value="3"<?php is_selected2('3'); ?>>Group Class II (4-5 -> adults/kids)</option>
   </select>
 </label>
 <span class="selectRequiredMsg"><font size="2">Required</font></span></span>                   </td>
  </tr>
  <tr>
    <td>Supplement:       </td>
    <td colspan="2"><input name="supplement" size="5" type="text" value="<?php echo  $supplement;?>">
      Amount teachers recieve for this client.</td>
    </tr>
  <tr>
  <td height="21">Price:</td>
    <td colspan="2"><span id="sprytextfield10">
   
   <label><span class="style10">
  </span>
   <input name="price" type="text" id="price" size="5" maxlength="4" value="<?php echo  $price;?>" />
   </label>
   please do not use "," use "." for fractional prices
  <span class="textfieldRequiredMsg"><font size="2">Required</font></span></span> </td>
  </tr>
  
  <tr>
    <td height="21" colspan="3"><fieldset>
    
  
      <label><span class="style7 style9 style6"><strong>Mon</strong>
       <input type="checkbox" name="dias[]" value="L"   <?php  if($l == "L") echo 'checked="checked"' ?> />
</label>-
       <label><span class="style7 style9 style6"><strong>Tue</strong>
         <input type="checkbox" name="dias[]" value="M" <?php  if($m == "M") echo 'checked="checked"' ?>/> 
         </label>-
       <label><span class="style7 style9 style6"><strong>Wed</strong>
         <input type="checkbox" name="dias[]" value="X" <?php  if($x == "X") echo 'checked="checked"' ?>/> 
         </label>-
       <label><span class="style7 style9 style6"><strong>Thu</strong>
         <input type="checkbox" name="dias[]" value="J" <?php  if($j == "J") echo 'checked="checked"' ?>/> 
         </label>-
       <label><span class="style7 style9 style6"><strong>Fri</strong>
         <input type="checkbox" name="dias[]" value="V" <?php  if($v == "V") echo 'checked="checked"' ?>/> 
         </label>-
         <label><span class="style7 style9 style6"><strong>Sat</strong>
         <input type="checkbox" name="dias[]" value="S" <?php  if($s == "S") echo 'checked="checked"' ?>/> 
         </label>
       <br />
       <br />
       <strong><strong>Registered time</strong></strong>
 <?php
     
		
	$yy = intval(substr($start,0,4));
	   
	$mm = intval(substr($start,5,2));

	$dd = intval(substr($start,8,2));
		
		
	  $myCalendar = new tc_calendar("start", true);
	  $myCalendar->showInput(false);
	  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
	  $myCalendar->setDate($dd, $mm, $yy);
	  $myCalendar->setPath("calendar/");
	  $myCalendar->setYearInterval(2000, 2012);
	  $myCalendar->dateAllow('2009-05-13', '2012-12-31');
	  $myCalendar->setDateFormat('j F Y');
	  $myCalendar->writeScript();
	  ?>
      <?php 

 function is_selected_i($arg) {

global $hora_ini0; 

   if (isset($hora_ini0) && $arg == $hora_ini0) { 
      echo ' selected="selected"'; 
   } 
} 

function is_selected_f($arg) {

global $hora_fin0; 

   if (isset($hora_fin0) && $arg == $hora_fin0) { 
      echo ' selected="selected"'; 
   } 
} 
 
?> 
      	 <br /><br /> 		
      	 <strong>When the client start :</strong>
 <?php
     
		
	$yy1 = intval(substr($start1,0,4));
	   
	$mm1 = intval(substr($start1,5,2));

	$dd1 = intval(substr($start1,8,2));
		
		
	  $myCalendar = new tc_calendar("start1", true);
	  $myCalendar->showInput(false);
	  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
	  $myCalendar->setDate($dd1, $mm1, $yy1);
	  $myCalendar->setPath("calendar/");
	  $myCalendar->setYearInterval(2000, 2012);
	  $myCalendar->dateAllow('2009-05-13', '2012-12-31');
	  $myCalendar->setDateFormat('j F Y');
	  $myCalendar->writeScript();
	  ?>
      	  		
                         
         
  <tr>
    <td colspan="4"  bgcolor="#eeeeee"><div align="center">
    
    
     <?php
if ($id == '') {              
?>  
      <input name="action" type="submit" id="action" value="Save Changes">
      
      <?php } else if(($message == "<br>Client data updated.") || ($id != '')){ ?>
	    <input name="action" type="submit" id="action" value="Update Client">
	 <?php } ?>
    </div></td>
  </tr>

    </fieldset></td>
    </tr>
  
  
  <tr>
    <td colspan="4" >
         
  <?php
 
if ($id != '' || $message == "<br>Client Group Profile Saved.") { 


?>  
  
 <fieldset>
                        <b>Teacher:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; </b> 
                   
   <select name="teacher_id">
     <?php echo $teachers?><br />
   </select>
   
                        <br />
                        <br />
                         <b>Start date:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
                          <?php
	  $myCalendar3 = new tc_calendar("new_start", true, false);
	  $myCalendar3->SetPicture("calendar/images/iconCalendar.gif");
	  $myCalendar3->setDate(date('d'), date('m'), date('Y'));
	  $myCalendar3->setPath("calendar/");
	  $myCalendar3->setYearSelect(2008, 2012);
	  $myCalendar3->dateAllow('2008-01-01', '2012-12-31');
	  $myCalendar3->setDateFormat('j F Y');
	  $myCalendar3->writeScript();
	  ?>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <label><span class="style6 style9 style7"><strong>Start time</strong></span>
                            <select name="hora_ini0" size="1" id="hora_ini0" accesskey="I" tabindex="0">
                                <option value="">-----</option>
                                
                                 <option value="08:00">08:00</option>
                                <option value="08:15">08:15</option>
                                <option value="08:30">08:30</option>
                                <option value="08:45">08:45</option>
                               
                                <option value="09:00">09:00</option>
                                <option value="09:15">09:15</option>
                                <option value="09:30">09:30</option>
                                <option value="09:45">09:45</option>
                                <option value="10:00">10:00</option>
                                <option value="10:15">10:15</option>
                                <option value="10:30">10:30</option>
                                <option value="10:45">10:45</option>
                                <option value="11:00">11:00</option>
                                <option value="11:15">11:15</option>
                                <option value="11:30">11:30</option>
                                <option value="11:45">11:45</option>
                                <option value="12:00">12:00</option>
                                <option value="12:15">12:15</option>
                                <option value="12:30">12:30</option>
                                <option value="12:45">12:45</option>
                                <option value="13:00">13:00</option>
                                <option value="13:15">13:15</option>
                                <option value="13:30">13:30</option>
                                <option value="13:45">13:45</option>
                                <option value="14:00">14:00</option>
                                <option value="14:15">14:15</option>
                                <option value="14:30">14:30</option>
                                <option value="14:45">14:45</option>
                                <option value="15:00">15:00</option>
                                <option value="15:15">15:15</option>
                                <option value="15:30">15:30</option>
                                <option value="15:45">15:45</option>
                                <option value="16:00">16:00</option>
                                <option value="16:15">16:15</option>
                                
                                <option value="16:30">16:30</option>
                                <option value="16:45">16:45</option>
                                <option value="17:00">17:00</option>
                                <option value="17:15">17:15</option>
                                <option value="17:30">17:30</option>
                                <option value="17:45">17:45</option>
                                <option value="18:00">18:00</option>
                                
                                <option value="18:15">18:15</option>
                                <option value="18:30">18:30</option>
                                <option value="18:45">18:45</option>
                                <option value="19:00">19:00</option>
                                <option value="19:15">19:15</option>
                                <option value="19:30">19:30</option>
                                <option value="19:45">19:45</option>
                                
                                <option value="20:00">20:00</option>
                                <option value="20:15">20:15</option>
                                <option value="20:30">20:30</option>
                                <option value="20:45">20:45</option>
                                <option value="21:00">21:00</option>
                            </select>
                    </label>
                  
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    
                            <label><span class="style6 style9 style7"><strong>End time</strong></span>
                            <select name="hora_fin0" size="1" id="hora_fin" accesskey="I" tabindex="0">
                              <option value="">-----</option>
                                <option value="08:00">08:00</option>
                                <option value="08:15">08:15</option>
                                <option value="08:30">08:30</option>
                                <option value="08:45">08:45</option>
                               
                                <option value="09:00">09:00</option>
                                <option value="09:15">09:15</option>
                                <option value="09:30">09:30</option>
                                <option value="09:45">09:45</option>
                                <option value="10:00">10:00</option>
                                <option value="10:15">10:15</option>
                                <option value="10:30">10:30</option>
                                <option value="10:45">10:45</option>
                                <option value="11:00">11:00</option>
                                <option value="11:15">11:15</option>
                                <option value="11:30">11:30</option>
                                <option value="11:45">11:45</option>
                                <option value="12:00">12:00</option>
                                <option value="12:15">12:15</option>
                                <option value="12:30">12:30</option>
                                <option value="12:45">12:45</option>
                                <option value="13:00">13:00</option>
                                <option value="13:15">13:15</option>
                                <option value="13:30">13:30</option>
                                <option value="13:45">13:45</option>
                                <option value="14:00">14:00</option>
                                <option value="14:15">14:15</option>
                                <option value="14:30">14:30</option>
                                <option value="14:45">14:45</option>
                                <option value="15:00">15:00</option>
                                <option value="15:15">15:15</option>
                                <option value="15:30">15:30</option>
                                <option value="15:45">15:45</option>
                                <option value="16:00">16:00</option>
                                <option value="16:15">16:15</option>
                                
                                <option value="16:30">16:30</option>
                                <option value="16:45">16:45</option>
                                <option value="17:00">17:00</option>
                                <option value="17:15">17:15</option>
                                <option value="17:30">17:30</option>
                                <option value="17:45">17:45</option>
                                <option value="18:00">18:00</option>
                                
                                <option value="18:15">18:15</option>
                                <option value="18:30">18:30</option>
                                <option value="18:45">18:45</option>
                                <option value="19:00">19:00</option>
                                <option value="19:15">19:15</option>
                                <option value="19:30">19:30</option>
                                <option value="19:45">19:45</option>
                                
                                <option value="20:00">20:00</option>
                                <option value="20:15">20:15</option>
                                <option value="20:30">20:30</option>
                                <option value="20:45">20:45</option>
                                <option value="21:00">21:00</option>
                            </select>
                    </label>
                            
          <br />
                        <br /> 
       
   <label><span class="style7 style9 style6"> <b>Class Length:&nbsp;</b> </span>
  <select name="new_length">
  <option value="">----------</option>
  <option value=1.00  title='1.00'>1.00 </option>
  <option value=1.25  title='1.25'>1.25 </option>
  <option value=1.50  title='1.50'>1.50 </option>
  <option value=1.75  title='1.75'>1.75 </option>
  <option value=2.00  title='2.00'>2.00 </option>
  <option value=2.25  title='2.25'>2.25 </option>
  <option value=2.50  title='2.50'>2.50 </option>
  <option value=2.75  title='2.75'>2.75 </option>
  <option value=3.00  title='3.00'>3.00 </option>
  <option value=3.25  title='3.25'>3.25 </option>
  <option value=3.50  title='3.50'>3.50 </option>
  <option value=3.75  title='3.75'>3.75 </option>
  <option value=4.00  title='4.00'>4.00 </option>
  </select>  
                    </label>
                    
                    <br />
                        <br /> 
             <div align="center">                  
 <input name="action" type="submit" class="boldText" id="action" value="Add teacher" />      
                    </div>
                    </fieldset>           </td>
  </tr>
    <tr>
                      	<td bgcolor="#eeeeee" colspan="5"><table width="665" border="0" align="center" bgcolor="#eeeeee">
                <tr> 
                  <td><b>Teacher's Info</b>
                   <fieldset>
                  <table border="0" cellpadding="2" cellspacing="0" bgcolor="#FFFFFF" id="listing" width="100%">
                  
                       <tr>
                      
                      	<td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Name</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Start</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>End</b></font></td>
                          <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Start time</b></font></td>
                          <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>End time</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Class Length</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Delete?</b></font></td>
                         
                          <td bgcolor="#eeeeee"></td>
                              <td bgcolor="#eeeeee" align="right"><font size="-1"><b>Print?</b></font></td>
                        <td bgcolor="#eeeeee"></td>
                      </tr>
<?php

$sql = "select a.id, a.length, b.id as user, first, a.start, a.end, a.starttime, a.endtime from userGroup a, users b where a.user_id = b.id and group_id = " . $id. " order by a.id asc";
//print $sql;
$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));

$numRows = mysqli_num_rows($result);


	function is_selected_ini($arg) {

global $starttime; 

   if ($arg == $starttime) { 
       return  ' selected="selected"'; 
   } 
} 

function is_selected_fin($arg) {

global $endtime; 

   if ( $arg == $endtime) { 
       return  ' selected="selected"'; 
   } 
} 
 
	
	function is_selected5($arg) {
 
global $length; 

			if ( $arg == $length) { 
			
      return  ' selected="selected"'; 
   } 

} 
	
 
if ($numRows > 0) {
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	
	$length = $row["length"];
	$starttime = substr($row["starttime"], 0, 5);
	$endtime = substr($row["endtime"], 0, 5);
	//global $user_id;
	
	//$user_id = $row["user"];
	
	 
		if ($bg == "#FFFFFF") {
			$bg = "#B6C5F2";
		} else {
			$bg = "#FFFFFF";
		}
		
		print "<tr>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		print "<td bgcolor='" . $bg ."'><a href='/profesores/admin/users/profile.php?id=" . $row["user"] . "'>" . $row['first'] . "</a></td>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		print "<td bgcolor='" . $bg ."'><input size='8' name='start_teacher[]' type='input' id='start_teacher' value='" . $row["start"] . "'></td>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		print "<td bgcolor='" . $bg ."'><input size='8' name='end_teacher[]' type='input' id='end_teacher' onblur=\"return updateTeacher();\" value='" . $row["end"] . "'></td>";
		
	   print "<td bgcolor='" . $bg ."'>&nbsp;</td>";	
			print "<td bgcolor='" . $bg ."'>
 
  
   								<select name='hora_ini1[]' size='1' id='hora_ini1' accesskey='I' tabindex='0'>
                                <option value=''<?php '".is_selected_ini('')."'>---</option>
								<option value=08:00 '".is_selected_ini('08:00')."'>08:00</option>
                                <option value=08:15 '".is_selected_ini('08:15')."'>08:15</option>
                                <option value=08:30 '".is_selected_ini('08:30')."'>08:30</option>
                                <option value=08:45 '".is_selected_ini('08:45')."'>08:45</option>
                                <option value=09:00 '".is_selected_ini('09:00')."'>09:00</option>
                                <option value=09:15 '".is_selected_ini('09:15')."'>09:15</option>
                                <option value=09:30 '".is_selected_ini('09:30')."'>09:30</option>
                                <option value=09:45 '".is_selected_ini('09:45')."'>09:45</option>
                                <option value=10:00 '".is_selected_ini('10:00')."'>10:00</option>
                                <option value=10:15 '".is_selected_ini('10:15')."'>10:15</option>
                                <option value=10:30 '".is_selected_ini('10:30')."'>10:30</option>
                                <option value=10:45 '".is_selected_ini('10:45')."'>10:45</option>
                                <option value=11:00 '".is_selected_ini('11:00')."'>11:00</option>
                                <option value=11:15 '".is_selected_ini('11:15')."'>11:15</option>
                                <option value=11:30 '".is_selected_ini('11:30')."'>11:30</option>
                                <option value=11:45 '".is_selected_ini('11:45')."'>11:45</option>
                                <option value=12:00 '".is_selected_ini('12:00')."'>12:00</option>
                                <option value=12:15 '".is_selected_ini('12:15')."'>12:15</option>
                                <option value=12:30 '".is_selected_ini('12:30')."'>12:30</option>
                                <option value=12:45 '".is_selected_ini('12:45')."'>12:45</option>
                                <option value=13:00 '".is_selected_ini('13:00')."'>13:00</option>
                                <option value=13:15 '".is_selected_ini('13:15')."'>13:15</option>
                                <option value=13:30 '".is_selected_ini('13:30')."'>13:30</option>
                                <option value=13:45 '".is_selected_ini('13:45')."'>13:45</option>
                                <option value=14:00 '".is_selected_ini('14:00')."'>14:00</option>
                                <option value=14:15 '".is_selected_ini('14:15')."'>14:15</option>
                                <option value=14:30 '".is_selected_ini('14:30')."'>14:30</option>
                                <option value=14:45 '".is_selected_ini('14:45')."'>14:45</option>
                                <option value=15:00 '".is_selected_ini('15:00')."'>15:00</option>
                                <option value=15:15 '".is_selected_ini('15:15')."'>15:15</option>
                                <option value=15:30 '".is_selected_ini('15:30')."'>15:30</option>
                                <option value=15:45 '".is_selected_ini('15:45')."'>15:45</option>
                                <option value=16:00 '".is_selected_ini('16:00')."'>16:00</option>
                                <option value=16:15 '".is_selected_ini('16:15')."'>16:15</option>
                                
                                <option value=16:30 '".is_selected_ini('16:30')."'>16:30</option>
                                <option value=16:45 '".is_selected_ini('16:45')."'>16:45</option>
                                <option value=17:00 '".is_selected_ini('17:00')."'>17:00</option>
                                <option value=17:15 '".is_selected_ini('17:15')."'>17:15</option>
                                <option value=17:30 '".is_selected_ini('17:30')."'>17:30</option>
                                <option value=17:45 '".is_selected_ini('17:45')."'>17:45</option>
                                <option value=18:00 '".is_selected_ini('18:00')."'>18:00</option>
								
								<option value=18:15 '".is_selected_ini('18:15')."'>18:15</option>
                                <option value=18:30 '".is_selected_ini('18:30')."'>18:30</option>
                                <option value=18:45 '".is_selected_ini('18:45')."'>18:45</option>
                                <option value=19:00 '".is_selected_ini('19:00')."'>19:00</option>
                                <option value=19:15 '".is_selected_ini('19:15')."'>19:15</option>
                                <option value=19:30 '".is_selected_ini('19:30')."'>19:30</option>
                                <option value=19:45 '".is_selected_ini('19:45')."'>19:45</option>
                                <option value=20:00 '".is_selected_ini('20:00')."'>20:00</option>
                                <option value=20:15 '".is_selected_ini('20:15')."'>20:15</option>
								<option value=20:30 '".is_selected_ini('20:30')."'>20:30</option>
                                <option value=20:45 '".is_selected_ini('20:45')."'>20:45</option>
                                <option value=21:00 '".is_selected_ini('21:00')."'>21:00</option>
                                </select></td>";
  
	
	   print "<td bgcolor='" . $bg ."'>&nbsp;</td>";	
			print "<td bgcolor='" . $bg ."'>
 
   
   							   <select name='hora_fin1[]' id='hora_fin1' >
                               <option value=''<?php '".is_selected_fin('')."'>---</option>
							   <option value=08:00 '".is_selected_fin('08:00')."'>08:00</option>
                                <option value=08:15 '".is_selected_fin('08:15')."'>08:15</option>
                                <option value=08:30 '".is_selected_fin('08:30')."'>08:30</option>
                                <option value=08:45 '".is_selected_fin('08:45')."'>08:45</option>
							   <option value=09:00 '".is_selected_fin('09:00')."'>09:00</option>
                                <option value=09:15 '".is_selected_fin('09:15')."'>09:15</option>
                                <option value=09:30 '".is_selected_fin('09:30')."'>09:30</option>
                                <option value=09:45 '".is_selected_fin('09:45')."'>09:45</option>
                                <option value=10:00 '".is_selected_fin('10:00')."'>10:00</option>
                                <option value=10:15 '".is_selected_fin('10:15')."'>10:15</option>
                                <option value=10:30 '".is_selected_fin('10:30')."'>10:30</option>
                                <option value=10:45 '".is_selected_fin('10:45')."'>10:45</option>
                                <option value=11:00 '".is_selected_fin('11:00')."'>11:00</option>
                                <option value=11:15 '".is_selected_fin('11:15')."'>11:15</option>
                                <option value=11:30 '".is_selected_fin('11:30')."'>11:30</option>
                                <option value=11:45 '".is_selected_fin('11:45')."'>11:45</option>
                                <option value=12:00 '".is_selected_fin('12:00')."'>12:00</option>
                                <option value=12:15 '".is_selected_fin('12:15')."'>12:15</option>
                                <option value=12:30 '".is_selected_fin('12:30')."'>12:30</option>
                                <option value=12:45 '".is_selected_fin('12:45')."'>12:45</option>
                                <option value=13:00 '".is_selected_fin('13:00')."'>13:00</option>
                                <option value=13:15 '".is_selected_fin('13:15')."'>13:15</option>
                                <option value=13:30 '".is_selected_fin('13:30')."'>13:30</option>
                                <option value=13:45 '".is_selected_fin('13:45')."'>13:45</option>
                                <option value=14:00 '".is_selected_fin('14:00')."'>14:00</option>
                                <option value=14:15 '".is_selected_fin('14:15')."'>14:15</option>
                                <option value=14:30 '".is_selected_fin('14:30')."'>14:30</option>
                                <option value=14:45 '".is_selected_fin('14:45')."'>14:45</option>
                                <option value=15:00 '".is_selected_fin('15:00')."'>15:00</option>
                                <option value=15:15 '".is_selected_fin('15:15')."'>15:15</option>
                                <option value=15:30 '".is_selected_fin('15:30')."'>15:30</option>
                                <option value=15:45 '".is_selected_fin('15:45')."'>15:45</option>
                                <option value=16:00 '".is_selected_fin('16:00')."'>16:00</option>
                                <option value=16:15 '".is_selected_fin('16:15')."'>16:15</option>
                                
                                <option value=16:30 '".is_selected_fin('16:30')."'>16:30</option>
                                <option value=16:45 '".is_selected_fin('16:45')."'>16:45</option>
                                <option value=17:00 '".is_selected_fin('17:00')."'>17:00</option>
                                <option value=17:15 '".is_selected_fin('17:15')."'>17:15</option>
                                <option value=17:30 '".is_selected_fin('17:30')."'>17:30</option>
                                <option value=17:45 '".is_selected_fin('17:45')."'>17:45</option>
                                <option value=18:00 '".is_selected_fin('18:00')."'>18:00</option>
								
								<option value=18:15 '".is_selected_fin('18:15')."'>18:15</option>
                                <option value=18:30 '".is_selected_fin('18:30')."'>18:30</option>
                                <option value=18:45 '".is_selected_fin('18:45')."'>18:45</option>
                                <option value=19:00 '".is_selected_fin('19:00')."'>19:00</option>
                                <option value=19:15 '".is_selected_fin('19:15')."'>19:15</option>
                                <option value=19:30 '".is_selected_fin('19:30')."'>19:30</option>
                                <option value=19:45 '".is_selected_fin('19:45')."'>19:45</option>
                                <option value=20:00 '".is_selected_fin('20:00')."'>20:00</option>
                                <option value=20:15 '".is_selected_fin('20:15')."'>20:15</option>
								  <option value=20:30 '".is_selected_fin('20:30')."'>20:30</option>
                                <option value=20:45 '".is_selected_fin('20:45')."'>20:45</option>
                                <option value=21:00 '".is_selected_fin('21:00')."'>21:00</option>
                                </select></td>";
  
		
  
		
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		
			print "<td bgcolor='" . $bg ."'>
 <select name='length_teacher[]' id='length_teacher'>
 <option value=''<?php '".is_selected5('')."'>---</option>
  <option value=1.00  '".is_selected5('1')."'  	   title='1.00'>1.00 </option>
  <option value=1.25  '".is_selected5('1.25')."'   title='1.25'>1.25 </option>
  <option value=1.50  '".is_selected5('1.50')."'   title='1.50'>1.50 </option>
  <option value=1.75  '".is_selected5('1.75')."'   title='1.75'>1.75 </option>
  <option value=2.00  '".is_selected5('2').   "'   title='2.00'>2.00 </option>
  <option value=2.25  '".is_selected5('2.25')."'   title='2.25'>2.25 </option>
  <option value=2.50  '".is_selected5('2.50')."'   title='2.50'>2.50 </option>
  <option value=2.75  '".is_selected5('2.75')."'   title='2.75'>2.75 </option>
  <option value=3.00  '".is_selected5('3').   "'   title='3.00'>3.00 </option>
  <option value=3.25  '".is_selected5('3.25')."'   title='3.25'>3.25 </option>
  <option value=3.50  '".is_selected5('3.50')."'   title='3.50'>3.50 </option>
  <option value=3.75  '".is_selected5('3.75')."'   title='3.75'>3.75 </option>
  <option value=4.00  '".is_selected5('4') .  "'   title='4.00'>4.00 </option>
  </select> </td>";
		
		
  
     print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
  	   print "<td bgcolor='" . $bg ."'><input name='delete_teacher[]' type='checkbox' id='delete_teacher' value='" . $row["id"] . "'><input name='teacher[]' type='hidden' id='teacher' value='" . $row["id"] . "'></td>";
		
			if($_POST['action'] == "Update info"  or $_POST['action'] == "Update Client"){
		$dias2string =  implode("-",$array2string);
		}else{$dias2string =  implode("-",$dias);}
	   print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
  	   print "<td bgcolor='" . $bg ."'><a href='PDFcreator/client_info.php?group_id=".$id."&iduser=".$user_id."&name=" . $name . "&telephone1=" . $telephone1. "&mobile=" . $mobile . "&email=" . $email . "&address1=" . $address1. "&zip=" .  $zip.  "&dias=" .$dias2string. "&Metro=" . $Metro. "&starttime=" .  $starttime. "&Objetivos=" . $Objetivos."&Seguimiento=" .  $Seguimiento."&Preferencia=".$Preferencia."&nivel=" . $nivel. "&start=" . $row['start']. "&end=" . $row['end']. "&endtime=" .  $endtime. "&length=" .  $length. "&teacher=".$teacher."&price=".$price."&supplement=".$supplement. "' target='_blank'><img src='image/printer_off1.png'/></a></td>"; 
	   
	  
			    print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	   	
		print "</tr>";
	}
} else {

		$dias2string =  implode("-",$dias);
		print "<tr>";
		print "<td colspan='16'>There are no teachers currently associated with this group. Print the client Info here  <a href='PDFcreator/client_info.php?group_id=".$id."&iduser=".$user_id."&name=" . $name . "&telephone1=" . $telephone1. "&mobile=" . $mobile . "&email=" . $email . "&address1=" . $address1. "&zip=" .  $zip.  "&dias=" .$dias2string. "&Metro=" . $Metro."&Objetivos=" . $Objetivos."&Seguimiento=" .  $Seguimiento."&Preferencia=".$Preferencia."&nivel=" . $nivel."&price=".$price."&supplement=".$supplement. "' target='_blank'><img align='right' src='image/printer_off1.png'/></a></td>";
		
		print "</tr>";
} 
         
?> 
                    <tr> 
                       <td bgcolor="#eeeeee">&nbsp;</td>
                      <td bgcolor="#eeeeee">&nbsp;</td>
                      <td bgcolor="#eeeeee">&nbsp;</td>
                      
                        <td bgcolor="#eeeeee">&nbsp;</td>
                      <td bgcolor="#eeeeee">&nbsp;</td>
                         <td bgcolor="#eeeeee">&nbsp;</td>
                      <td bgcolor="#eeeeee">&nbsp;</td>
                       <td bgcolor="#eeeeee">&nbsp;</td>
                         <td bgcolor="#eeeeee">&nbsp;</td>

                      <td bgcolor="#eeeeee" align="right" colspan="11">
                       <input name="action" type="submit" id="action" value="Update info"> 
                       <input name="action" type="submit" id="action" value="Delete teacher" onclick= "return deleteTeacher() ;"> 
                        <br>
                        checked items</td>
                    </tr>
                  </table>	
                   </fieldset>			  </td>
              </tr>
            </table>
                    
<?php

}
?></td>
  </tr>
 
 <tr>
    <td colspan="5"><a href="reporteAlumnoAdultoPDF.php?group_id=<?php echo $id?>&iduser=<?php echo $user_id ?>"><b>Print client profile</b></a> </td>
  </tr>
</table>

            
     </form>
      
      	</td>
        </tr>
</table>
                  <div align="center">
              <!--end dynamic content -->
            Return to <a href="index.php">Group/Client List</a></div></td>
        
<?php include 'includes/foot.php'?>
<script type="text/javascript">
<!--
var spryselect4 = new Spry.Widget.ValidationSelect("spryselect4");
var spryselect06 = new Spry.Widget.ValidationSelect("spryselect06");

var sprytextarea0 = new Spry.Widget.ValidationTextarea("sprytextarea0");

var sprytextarea2 = new Spry.Widget.ValidationTextarea("sprytextarea2");


var sprytextfield00 = new Spry.Widget.ValidationTextField("sprytextfield00");
var sprytextfield01 = new Spry.Widget.ValidationTextField("sprytextfield01"); 
var sprytextfield06 = new Spry.Widget.ValidationTextField("sprytextfield06");
var sprytextfield07 = new Spry.Widget.ValidationTextField("sprytextfield07");
var sprytextfield08 = new Spry.Widget.ValidationTextField("sprytextfield08");
var sprytextfield09 = new Spry.Widget.ValidationTextField("sprytextfield09");
var sprytextfield10 = new Spry.Widget.ValidationTextField("sprytextfield10");

var sprytextfield12 = new Spry.Widget.ValidationTextField("sprytextfield12");

//-->
</script>
