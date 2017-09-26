<?php
ini_set("default_charset", "utf-8");
?>

<strong></strong><?php require_once('calendar/tc_calendar.php'); 
?>

<head>

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

function checkValue(linkemail) {
        
        if (linkemail) {
                   document.getElementById('hideInfo').style.display='block';
				   document.getElementById('hideInfo1').style.display='block';
				   
				   document.getElementById('hideInfo2').style.display='block';
				   document.getElementById('hideInfo3').style.display='block';
				
				
        } else {
             document.getElementById('hideInfo').style.display='none';
			  document.getElementById('hideInfo1').style.display='none';
			  
			  document.getElementById('hideInfo2').style.display='none';
			  document.getElementById('hideInfo3').style.display='none';
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
<?php include '../../includes/constants.php'?>
<?php include '../../includes/functions.php'?>
<?php include '../../includes/database.php'?>
<?php include '../../includes/authorize.php'?>
<?php if($is_admin_a) {

$message = "";
$selected = $_POST["my-select1"];
$name= $_POST["name"];
$id= $_REQUEST["id"];
$cif= $_POST["cif"];
$telephone1= $_POST["telephone1"];
$telephone2 = $_POST["telephone2"];
$mobile = $_POST["mobile"];
//$fax = $_POST["fax"];
$email = escape($_POST["email"]);
$address1 = $_POST["address1"];

//$city = $_POST["city"];

//$zip = $_POST["zip"];

$start = $_POST["start"];
$start1 = $_POST["start1"];
$end = $_POST["end"];
$returndate = $_POST["returndate"];
if ($_POST["supplement"] == "") {
			$supplement = 0;
		} else {
			$supplement = $_POST["supplement"];
		}
$class_type = $_POST["class_type"];
$price = $_POST["price"];
$array2string = $_POST["dias"];
/*if ($_POST["dias"] != ""){
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
*/

$Metro = $_POST["Metro"];
$Seguimiento = $_POST["Seguimiento"];
$Objetivos = $_POST["Objetivos"];
$alumnos = $_POST["Alumnos"];
$est_cli = $_POST["est_cli"];
$preferencias = $_POST["Preferencias"];
$Observaciones = $_POST["Observaciones"];
//$nino = $_POST["nino"];
/*$contry = $_POST["contry"]; 

switch($contry){

case "USA": $button1 = "checked";break;
case "UK":  $button2 = "checked";break;

	}
$gender = $_POST["gender"];


switch($gender){

case "H":  $button3 = "checked";break;
case "M":  $button4 = "checked";break;

	}*/
$nivel = $_POST["nivel"];
$enterprise = $_POST['enterprise'];
$fee = $_POST['fee'];
$teacher_id = $_POST["teacher_id"];

//query to make groups 

 
if ($_REQUEST['id'] == "") {
	/* NEW PROFILE */

	$mode = "New";
	if ($_POST['action'] == "Save Changes") {
		
	
		if ($_POST["supplement"] == "") {
			$supplement = 0;
		} else {
			$supplement = $_POST["supplement"];
		}
	
	
	$sql0 = "select * from groups where name = '". escape($_POST['name']). "'";
	$result0 = mysqli_query($link, $sql0) or die("Invalid query: " . mysqli_error());
	$numfilas = mysqli_num_rows($result0);

		
		if (($message == "") &&  ($numfilas == 0)) {
			
			
			$selected = $_POST["my-select1"];
	
	    foreach ($selected as $tag){
			// echo $tag."oooo";
			$rest = substr($tag, 0, 1); 
			$tag = substr($tag, 2);
			
			//echo $rest."XX";
			//echo $tag."VV";
			switch ($rest) {
    case "1": 
	$tag1[]  = $tag;
	 break;
    case "2":
	$tag2[]  .= $tag;
	 break;
	   case "3": 
	$tag3[]  = $tag;
	 break;
   
	
			}

           }
       // echo '</p>';
		//print_r($_POST['my-select']);
		if (empty($tag1)) {$tag1[] = " ";} 
		if (empty($tag2)) {$tag2[] = " ";} 
		if (empty($tag3)) {$tag3[] = " ";} 
		
		
		$tag1 = implode(",",$tag1);
		$tag2 = implode(",",$tag2); 
		$tag3 = implode(",",$tag3); 

				$sql = "insert into groups (old_id, name,  cif, telephone1, telephone2,  mobile, email, address1,  TIPO_CLIENTE,  returndate, start, fecha_inicio, supplement, class_type, days, metro, endtime, seguimiento, objetivos, observaciones, alumnos, ESTADO_CLIENTE, nivel, enterprise, fee, preferencia, price,  ZONAS) values ";
			$sql = $sql . "('" .   $client ."'";
			$sql = $sql . ", '" .  escape($_POST['name']) . "'";
			//$sql = $sql . ", '" .  escape($_POST['company']) . "'";
			$sql = $sql . ", '" . escape($_POST['cif']) ."'";
			$sql = $sql . ", '" . escape($_POST['telephone1']) ."'";
			$sql = $sql . ", '" . escape($_POST['telephone2']) ."'";
			$sql = $sql . ", '" . escape($_POST['mobile']) . "', '" . escape($_POST['email']) ."'";
			$sql = $sql . ", '" . escape($_POST['address1']) ."'";
			$sql = $sql . ", '" . escape($tag2) ."'";
			//$sql = $sql . ", '" . escape($_POST['zip'])."'";
			$sql = $sql . ", '" . escape($_POST['returndate']) ."'";
			$sql = $sql . ", '" . escape($_POST['start']) . "', '" . $_POST['start1'] ."'";
			$sql = $sql . ", '" . escape($_POST['supplement']) ."'";
			$sql = $sql . ", '" . escape($_POST['class_type']) ."'";
			$sql = $sql . ", '" . $tag3 . "', '" . escape($_POST['Metro']) ."'";
			$sql = $sql . ", '" . escape($_POST['hora_fin']) ."'";
			$sql = $sql . ", '" . escape($_POST['Seguimiento']) ."'";
			$sql = $sql . ", '" . escape($_POST['Objetivos']) . "', '" . escape($_POST['Observaciones']) ."'";
			$sql = $sql . ", '" . escape($_POST['Alumnos']) . "', '" . escape($_POST['est_cli']) ."'";
			$sql = $sql . ", '" . escape($_POST['nivel']) ."'";
			$sql = $sql . ", '" . escape($_POST['enterprise']) ."'";
			$sql = $sql . ", '" . escape($_POST['fee']) ."'";
			$sql = $sql . ", '" . escape($_POST['Preferencias']) . "', '". escape($_POST['price']) . "', '". escape($tag1)."');";
			
			//print $sql;
			mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error());
			$id = mysqli_insert_id();
			
			
			

			$message = "Group Profile Saved.";
		}else {$message = "Group already exist, try with another one";}
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
	$result1 = mysqli_query($link, $validation) or die("Invalid query: " . mysqli_error());

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
	
	$message = "Before to add a new teacher you must enter the end date!";
	
		
		
	} else{

	
     $sql1 = "update groups set active = 1, baja = 0 where id = " . $id;
	  mysqli_query($link, $sql1) or die("Invalid query: " . mysqli_error());

	$sql = "insert into userGroup (user_id, length, group_id, start, starttime, endtime) ";
	$sql .= " values (" . $teacher_id . "," . $new_length . ",  " . $id . "," . $new_start . " , " . $hora_ini0 . ", " . $hora_fin0 . ")";
	//print $sql;
	mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error());
	$message = "A new teacher was entered successfully!";}
	}

    if ($id != "" && $_POST['action'] == "Delete teacher") {
	
	foreach ($_POST['delete_teacher'] as $tid) {
	
	
   	$sql = 'delete from userGroup where id = ' . $tid;
   	mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error());
    
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
			mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error());
	}else {$sql = "update groups set active = 1, baja = 0 where id = " . $id;
			mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error());}
		$message = "Teacher association deleted.";
}


if ($id != "" && $_POST['action'] == "Delete client") {
if (count($_POST['delete_client']) == 0) {$message = "Must check the client first.";}
else{
	foreach ($_POST['delete_client'] as $dtid) {
   	$sql = 'delete from clients where id = ' . $dtid;
   	mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error());
    $message = "Client deleted.";}
	}
}


if ($id != "" && $_POST['action'] == "Update Client") {


$email = escape($_POST["email"]);


	$selected = $_POST["my-select1"];
	
	    foreach ($selected as $tag){
			// echo $tag."oooo";
			$rest = substr($tag, 0, 1); 
			$tag = substr($tag, 2);
			
			//echo $rest."XX";
			//echo $tag."VV";
			switch ($rest) {
    case "1": 
	$tag1[]  = $tag;
	 break;
    case "2":
	$tag2[]  .= $tag;
	 break;
	   case "3": 
	$tag3[]  = $tag;
	 break;
   
	
			}

           }
        echo '</p>';
		//print_r($_POST['my-select']);
		if (empty($tag1)) {$tag1[] = " ";} 
		if (empty($tag2)) {$tag2[] = " ";} 
		if (empty($tag3)) {$tag3[] = " ";} 
		
		
		$tag1 = implode(",",$tag1);
		$tag2 = implode(",",$tag2); 
		$tag3 = implode(",",$tag3); 
		
 $sql = "update groups set name = '".$_POST["name"]."', cif = '".$_POST["cif"]."', telephone1= '".$_POST["telephone1"]."',  telephone2= '".$_POST["telephone2"]."', mobile= '".$_POST["mobile"]."', email= '".$email."', address1= '".$_POST["address1"]."', TIPO_CLIENTE= '".$tag2."', returndate= '".$_POST["returndate"]."', start= '".$_POST["start"]."', fecha_inicio= '".$_POST["start1"]."', supplement= '".$_POST["supplement"]."', class_type= '".$_POST["class_type"]."', days= '".$tag3."', metro= '".$_POST["Metro"]."',  endtime= '".$hora_fin."', objetivos= '".$_POST["Objetivos"]."', seguimiento= '".$_POST['Seguimiento']."', observaciones= '".$_POST["Observaciones"]."', alumnos= '".$_POST["Alumnos"]."', ESTADO_CLIENTE= '".$_POST["est_cli"]."', nivel= '".$_POST["nivel"]."', enterprise= '".$_POST["enterprise"]."', fee= '".$_POST["fee"]."', preferencia= '".$_POST["Preferencias"]."', ZONAS= '".$tag1."', price= ".$_POST["price"]." where id = " . $id;
 
	//print $sql . "<br>";
   	mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error());
   
	
    $message = "Client data updated.";
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
	
       
   	$sql = "update userGroup set start = ". $start_teacher . ", end = ". $end_teacher . ", starttime = ".$hora_ini1.", endtime = ".$hora_fin1.", length= " . $length_teacher . " where id = " . $utid;
 
	//print $sql . "<br>";
   	mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error());
   	$i++;
    $message = "Teacher association data updated.";
	}
	
	if ($act_teacher){
		
			
			$sql = "update groups set active = 0, baja = 0 where id = " . $id;
			mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error());
	}else {	

	$sql = "update groups set active = 1, baja = 0 where id = " . $id;
			mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error());}
}


if ($id != "") {

	$sql = "select * from groups where id = " . $id;
	$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error());

	if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$client = $row["old_id"];
		$name =  stripslashes($row["name"]);
		
		$cif =  stripslashes($row["cif"]);
		$telephone1 = $row["telephone1"];
		$telephone2 = $row["telephone2"];
		$mobile = $row["mobile"];
		$client_type = $row["client_type"];
		$email = $row["email"];
		$address1 = $row["address1"];
	
		$client_type = $row["TIPO_CLIENTE"];

		//$zip = $row["zip"];
	
		$start = $row["start"];
		
		$returndate = $row["returndate"];
		
	
		 
		If ($row["supplement"] == "") {
			$supplement = 0;
		} else {
			$supplement = $row["supplement"];
		}
		$start1 = $row["fecha_inicio"];
		$class_type = $row["class_type"];
	
		$price = $row["price"];
		$dias = $row["days"];
		
		$hora_fin = substr($row["endtime"], 0, 5);
		$Metro = $row["metro"];
		$Seguimiento = $row["seguimiento"];
		$Objetivos = $row["objetivos"];
		$Observaciones = $row["observaciones"];
		$alumnos = $row["alumnos"];
		$est_cli = $row["ESTADO_CLIENTE"];
		$contry = $row["tcontry"];
		//$gender = $row["gender"];
		$enterprise = $row["enterprise"];
		$fee = $row["fee"];
		
	
		$nivel = $row["nivel"];
		$preferencias = $row["preferencia"];
		$zones = $row["ZONAS"];
		

	} 


}


$sql = "select id, first from users where baja = 0 order by first";
$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error());
$teachers .= "<option value=''>Select teacher....</option>";
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	$teachers .= "<option value='" . $row['id'] . "'>" . $row['first'] . "</option>";
}
	
			
?>

<?php include '../../includes/top.php';  $pepe = "pepe2";?>
    
    <div style="position: relative;" align="center"> 
    
<p><b>Group/Individual Profile &#8211; <?php echo  $mode; ?> &#8211; <font color='#ff9900'><?php echo  $message ?></font></b></p>
<table width="100%"  border="0" class="<?php echo $pepe;?>"  cellpadding="10" cellspacing="0" id="body">
     
        <tr> 
          <td width="100%" valign="top">  
 

            <!--start dynamic code -->
            <form name="associate" id="associate" method="post">
            	
            	  <input type="hidden" name="id" value="<?php echo $id;?>">
           	    
            	<table border="0" width="100%" class="<?php echo $pepe;?>" align="center" bgcolor="#cccccc">

  <tr>
    <td width="93"><B>Nombre:</B> </td>
<td><span id="sprytextfield02">
  
  <label><span class="style10">  
    </span>
    <input name="name" type="text" size="60" value="<?php echo  $name;?>">
    </label>
  <span class="textfieldRequiredMsg"><font size="2">Required</font></span></span></td>
    <td width="235" rowspan="17" align="center"><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
      
      <label><strong>Profesores:</strong><span id="countdown002"></span>
      
    
        <textarea name="Seguimiento" id="Seguimiento" cols="35" rows="5"  onKeyDown="limitText(this.form.Seguimiento,'countdown002',1000);" 
onKeyUp="limitText(this.form.Seguimiento,'countdown002',1000);"><?php echo  $Seguimiento;?></textarea>
        </label>
      <br />
      
      <label><strong>Alumnos:</strong><span id="countdown001"></span>
        
        <textarea name="Alumnos" id="Alumnos" cols="35" rows="5" onKeyDown="limitText(this.form.Alumnos,'countdown001',1000);" 
onKeyUp="limitText(this.form.Alumnos,'countdown001',1000);"><?php echo  $alumnos;?></textarea>
        </label>
      <br />
      
      
      <label><strong>Objetivos:</strong><span id="countdown003"></span>
        
        <textarea name="Objetivos" id="Objetivos" cols="35" rows="5" onKeyDown="limitText(this.form.Objetivos,'countdown003',1000);" 
onKeyUp="limitText(this.form.Objetivos,'countdown003',1000);"><?php echo  $Objetivos;?></textarea>
        </label>
      <br />
      
      
      <label><strong>Preferencias:</strong><span id="countdown004"></span>
        
        <textarea name="Preferencias" id="Preferencias" cols="35" rows="5"  
   onKeyDown="limitText(this.form.Preferencias,'countdown004',1000);" 
onKeyUp="limitText(this.form.Preferencias,'countdown004',1000);"><?php echo  $preferencias;?></textarea>
        </label>
      <br />
      
      
      <label><strong>Observaciones:</strong><span id="countdown005"></span>
        
        <textarea name="Observaciones" id="Observaciones" cols="35" rows="5" onKeyDown="limitText(this.form.Observaciones,'countdown005',1000);" 
onKeyUp="limitText(this.form.Observaciones,'countdown005',1000);"><?php echo  $Observaciones;?></textarea>
        </label>
    </td>
  </tr>
  <tr>
    <td><B>Dni/Cif</B>:</td>
    <td>
   						<label><span class="style10">
  						</span>
    <input name="cif" type="text" value="<?php echo  $cif;?>">
      </label>		  </td>
    </tr>
  <tr>
     <td width="93"><B>Telefono 1:</B></td>
<td>
   
   						<label>
                        <input name="telephone1" type="text" value="<?php echo  $telephone1;?>">
              </label>   </td>
</tr>
  <tr>
    <td width="93"><B>Telefono 2:</B></td>
    <td> <input name="telephone2" type="text" value="<?php echo  $telephone2;?>"></td>
     </tr>
  <tr>
    <td><B>Movil:</B></td>
    <td>
                      <label>
                        <input name="mobile" type="text" value="<?php echo  $mobile;?>">
                    </label>					    </td>
                  </tr>
  <tr>
    <td><B>E-mail:</B></td>
    <td><span id="sprytextfield05">
   
   						<label><span class="style10">
  						</span>
                        <input name="email" size="60" type="text" value="<?php echo  $email;?>">
                        </label>
		    <span class="textfieldRequiredMsg"><font size="2">Required</font></span></span><B></B></td>
            </tr>
  <tr>
    <td><strong>Metro/Otros Medios:  
  </strong></td>
    <td> <span id="sprytextfield00">
      <label>
        <input name="Metro" size="60" type="text" id="Metro" maxlength="100" value="<?php echo  $Metro;?>" />
        </label>
      <span class="textfieldRequiredMsg"><font size="2">Required</font></span>
    </span>      <B></B></td>
     </tr>  
  
  <tr>
    <td><B>Domicilio:</B></td>
    <td><span id="sprytextfield06">
   
  				 		<label><span class="style10"> 
  						</span>
                        <input name="address1"  type="text"   value="<?php echo  $address1;?>" size="60"> </label>
		    <span class="textfieldRequiredMsg"><font size="2">Required</font></span></span></td>
  </tr>
  
  <tr>
    <td><strong>Nivel</strong></td>
    <td><?php 
function is_selected3($arg) {

global $nivel; 


   if (isset($nivel) && $arg == $nivel) { 
      echo ' selected="selected"'; 
   } 
} 
?> 

 <span id="spryselect06">
 <label>
 <select name="nivel" size="1" id="nivel" accesskey="L" tabindex="0">
 
   <option value="">------------------------</option>
  
   <option value="False Beginner"<?php is_selected3('False Beginner'); ?>>False Beginner</option>
   <option value="Escolar"<?php is_selected3('Escolar'); ?>>Escolar</option>
   <option value="Lower Elementary"<?php is_selected3('Lower Elementary'); ?>>Lower Elementary</option>
    <option value="Elementary"<?php is_selected3('Elementary'); ?>>Elementary</option>
   <option value="Elementary Upper"<?php is_selected3('Elementary Upper'); ?>>Elementary Upper</option>
  
   <option value="Lower Intermediate"<?php is_selected3('Lower Intermediate'); ?>>Lower Intermediate</option>
   <option value="Intermediate"<?php is_selected3('Intermediate'); ?>>Intermediate</option>
   <option value="Upper Intermediate"<?php is_selected3('Upper Intermediate'); ?>>Upper Intermediate</option>
   <option value="Advanced Level 1"<?php is_selected3('Advanced Level 1'); ?>>Advanced Level 1</option>
   <option value="Advanced Level 2"<?php is_selected3('Advanced Level 2'); ?>>Advanced Level 2</option>
   <option value="Advanced Level 3"<?php is_selected3('Advanced Level 3'); ?>>Advanced Level 3</option>
 </select>
 </label>
 <span class="selectRequiredMsg"><font size="2">Required</font></span></span> </td>
  </tr>
  <tr>
    <td><B>Estado del Cliente:</B></td>
    <td>
    
    <?php function is_selected4($arg) {

global $est_cli; 


   if (isset($est_cli) && $arg == $est_cli) { 
      echo ' selected="selected"'; 
   } 
} 




?> 

 <label>
 <select name="est_cli" size="1" id="est_cli" accesskey="L" tabindex="0">
   <option value="">---------------------------</option>
   <option value="No asignado"<?php is_selected4('No asignado'); ?> >No asignado</option>
   <option value="Sustitucion"<?php is_selected4('Sustitucion'); ?>>Sustitución</option>
  
    </select>   
    </label>
  </td>
  </tr>
  <tr>
    <td><B>Pagos Profesores:</B></td>
    <td><?php 
function is_selected2($arg) {

global $class_type; 


   if (isset($class_type) && $arg == $class_type) { 
      echo ' selected="selected"'; 
   } 
} 




?> 
 <span id="spryselect4">
 <label>
 <select name="class_type" size="1" id="class_type" accesskey="L" tabindex="0">
   <option value="">---------------------------</option>
   <option value="1"<?php is_selected2('1'); ?> >Individual   13 euros</option>
   <option value="5"<?php is_selected2('5'); ?> >Individual TE   12 euros</option>
   <option value="2"<?php is_selected2('2'); ?>>Grupo I   15 euros</option>
   <option value="3"<?php is_selected2('3'); ?>>Grupo II   18 euros</option>
    </select>   
    </label>
 <span class="selectRequiredMsg"><font size="2">Required</font></span></span> </td>
  </tr>
  <tr>
    <td><B>Suplemento:  </B>     </td>
    <td><input name="supplement" id="supplement" size="5" type="text" value="<?php echo  $supplement;?>">
     </td>
    </tr>
  <tr>
  <td height="21"><B>Precio:</B></td>
    <td><span id="sprytextfield01">
   
   <label><span class="style10">
  </span>
   <input name="price" type="text" id="price" size="5" maxlength="4" value="<?php echo  $price;?>" />
   </label>
    <span class="textfieldRequiredMsg"><font size="2">Required</font></span></span> </td>
  </tr>
  <tr>
    <td colspan="2">  
	 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
                        
                        <link href="css/multi-select.css" media="screen" rel="stylesheet" type="text/css">
	<?php 
function is_selected1($arg, $arg2) {
   
   
   $arg2 = explode(",", $arg2);

	   foreach($arg2 as $arg1){
		 
	    if($arg == $arg1) { 
      echo ' selected="selected"'; 
	  }
   }

} 
?>                          <select multiple="multiple" id="my-select" name="my-select1[]">
                           
                            <optgroup label='TIPO DE CLASE'>
                              <option value='2.Company'<?php is_selected1('Company', $client_type); ?>>Empresa</option>
                              <option value='2.Kids'<?php is_selected1('Kids', $client_type); ?>>Niños</option>
                              <option value='2.Teenagers'<?php is_selected1('Teenagers', $client_type); ?>>Adolecentes</option>
                              <option value='2.Adults'<?php is_selected1('Adults', $client_type); ?>>Adultos</option>
                              </optgroup>
                                            
                                                        
                            <optgroup label='DIAS DE CLASES'>
                              <option value='3.L'<?php is_selected1('L', $dias); ?>>Lunes</option>
                              <option value='3.M'<?php is_selected1('M', $dias); ?>>Martes</option>
                              <option value='3.X'<?php is_selected1('X', $dias); ?>>Miercoles</option>
                              <option value='3.J'<?php is_selected1('J', $dias); ?>>Jueves</option>
                              
                              <option value='3.V'<?php is_selected1('V', $dias); ?>>Viernes</option>
                              <option value='3.S'<?php is_selected1('S', $dias); ?>>Sabado</option>
                              
                            </optgroup>
                                          
                                          
                                           <optgroup label='ZONAS'>
                              <option value="1.7N" <?php is_selected1('7N', $zones);  ?> >7N (L7 North)</option>
                              <option value="1.PC" <?php is_selected1('PC', $zones); ?>>PC (Plaza Castilla)</option>
                              <option value="1.N"<?php is_selected1('N', $zones); ?>>N (North)</option>
                              <option value="1.4NE"<?php is_selected1('4NE', $zones); ?>>4NE (L4 North East)</option>
                              <option value="1.8E"<?php is_selected1('8E', $zones); ?>>8E (L8 East)</option>
                              <option value="1.7E"<?php is_selected1('7E', $zones); ?>>7E (L7 East)</option>
                              <option value="1.5E"<?php is_selected1('5E', $zones); ?>>5E (L5 East)</option>
                              <option value="1.2E"<?php is_selected1('2E', $zones); ?>>2E (L2 East)</option>
                              <option value="1.9E"<?php is_selected1('9E', $zones); ?>>9E (L9 East)</option>
                              
                              <option value="1.1S"<?php is_selected1('1S', $zones); ?>>1S (L1 South)</option>
                              <option value="1.3S"<?php is_selected1('3S', $zones); ?>>3S (L3 South)</option>
                              <option value="1.11"<?php is_selected1('11', $zones); ?>>11 (L11)</option>
                              <option value="1.SW"<?php is_selected1('SW', $zones); ?>>SW (South West)</option>
                              <option value="1.SE"<?php is_selected1('SE', $zones); ?>>SE (South East)</option>
                              <option value="1.CNE"<?php is_selected1('CNE', $zones); ?>>CNE (Central North East)</option>
                              <option value="1.CE"<?php is_selected1('CE', $zones); ?>>CE (Central East)</option>
                              <option value="1.CSE"<?php is_selected1('CSE', $zones); ?>>CSE (Central South East)</option>
                              <option value="1.CS"<?php is_selected1('CS', $zones); ?>>CS (Central South)</option>
                              
                              <option value="1.CW"<?php is_selected1('CW', $zones); ?>>CW (Central West)</option>
                              <option value="1.CN"<?php is_selected1('CN', $zones); ?>>CN (Central North)</option>
                              <option value="1.12B1"<?php is_selected1('12B1', $zones); ?>>12B1 (L12 South East)</option>
                              <option value="1.12B2"<?php is_selected1('12B2', $zones); ?>>12B2 (L12 South West)</option>
                              <option value="1.ML2"<?php is_selected1('ML2', $zones); ?>>ML2 (Metro Ligero 2)</option>
                              <option value="1.ML3"<?php is_selected1('ML3', $zones); ?>>ML3 (Metro Ligero 3)</option>
                              <option value="1.A"<?php is_selected1('A', $zones); ?>>A (Aravaca)</option>
                              
                               <option value="1.NB1"<?php is_selected1('NB1', $zones); ?>>NB1</option>
                              <option value="1.7B1"<?php is_selected1('7B1', $zones); ?>>7B1</option>
                              <option value="1.9B"<?php is_selected1('9B', $zones); ?>>9B</option>
                            
                              </optgroup>
                              
                                              
                </select>
                          
                                                
                          
                          
                          <script src="js/jquery.multi-select.js" type="text/javascript"></script>
                          
                          
                          
                          <script  type="text/javascript">
		 jQuery.noConflict();  
		
		(function($){
      jQuery('#my-select').multiSelect({ selectableOptgroup: true });
	})(jQuery);
    </script></td>    
   </tr>
  <tr>
    <td ></td>
    <td> </td>
  </tr>
  <tr>
    <td height="21" colspan="2"><fieldset>
    
  
       <strong><strong>La Ficha ha sido ha sido introducida?</strong></strong>
 <?php

 
     
		
	$yy = intval(substr($start,0,4));
	   
	$mm = intval(substr($start,5,2));

	$dd = intval(substr($start,8,2));
		
		
	  $myCalendar = new tc_calendar("start", true);
	  $myCalendar->showInput(false);
	  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
	  $myCalendar->setDate($dd, $mm, $yy);
	  $myCalendar->setPath("calendar/");
	  $myCalendar->setYearSelect(2012, 2030);
	  $myCalendar->dateAllow('2012-01-01', '2030-12-31');
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
<strong>Cuendo empieza la primera clase? :</strong>
 <?php
     
		
	$yy1 = intval(substr($start1,0,4));
	   
	$mm1 = intval(substr($start1,5,2));

	$dd1 = intval(substr($start1,8,2));
		
		
	  $myCalendar = new tc_calendar("start1", true);
	  $myCalendar->showInput(false);
	  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
	  $myCalendar->setDate($dd1, $mm1, $yy1);
	  $myCalendar->setPath("calendar/");
      $myCalendar->setYearSelect(2012, 2030);
	  $myCalendar->dateAllow('2012-01-01', '2030-12-31');
	  $myCalendar->setDateFormat('j F Y');
	  $myCalendar->writeScript();
	  ?>
      	  		
            <br />
       <br />
       
 <?php
     if ($id != '') {  ?>
		
        <strong>Este cliente retorna ? :</strong>
              
 <?php
	$yy = intval(substr($returndate,0,4));
	   
	$mm = intval(substr($returndate,5,2));

	$dd = intval(substr($returndate,8,2));
		
		
	  $myCalendar = new tc_calendar("returndate", true);
	  $myCalendar->showInput(false);
	  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
	  $myCalendar->setDate($dd, $mm, $yy);
	  $myCalendar->setPath("calendar/");
  	  $myCalendar->setYearSelect(2011, 2030);
	  $myCalendar->dateAllow('2012-01-01', '2030-12-31');
	  $myCalendar->setDateFormat('j F Y');
	  $myCalendar->writeScript();}
	  ?>   
        <br />
       <label><span class="style6 style9 style7"><strong>Matricula:</strong></span>
        &nbsp;
        <input type="checkbox" name="fee" value="1" <?php  if($fee == "1") echo 'checked="checked"' ?>  />
    </label>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     <label><span class="style6 style9 style7"><strong>Factura?</strong></span>
 &nbsp;
<input type="checkbox" name="enterprise" value="1" onclick="return  checkValue(this.form.enterprise.checked);" <?php  if($enterprise == "1") echo 'checked="checked"' ?>  />
 </label>
     
  <tr>
    <td colspan="4"  bgcolor="#cccccc"><div align="center">
    
    
     <?php
if ($id == '') {              
?>  
      <input name="action" type="submit" id="action" value="Save Changes">
      
      <?php } else if(($message == "Client data updated.") || ($id != '')){ ?>
	    <input name="action" type="submit" id="action" value="Update Client">
	 <?php } ?>
    </div></td>
  </tr>

    </fieldset></td>
    </tr>
  <tr>
    <td height="21" colspan="4">
         <?php
if ($id != '') {              
?>  <fieldset>
    <table border="0" cellpadding="2" cellspacing="0" bgcolor="#eeeeee" id="listing" width="100%">
      
                      <tr>
                      	<td colspan="4" align="right"><a href="client_profile2.php?group_id=<?php echo $id?>"><b>Add a client</b></a> to this group.</td>
                      </tr>
                      <tr>
                      	<td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Name</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Age</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Level</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee" align="center"><font size="-1" width="40"><b>Delete?</b></font></td>
                      </tr>
                      
                 
<?php

$sql = "select * from clients where group_id = " . $id;
$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error());

$numRows = mysqli_num_rows($result);
 
if ($numRows > 0) {
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		
		if ($bg == "#FFFFFF") {
			$bg = "#B6C5F2";
		} else {
			$bg = "#FFFFFF";
		}
		
		print "<tr>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		print "<td bgcolor='" . $bg ."'><a href='client_profile2.php?id=" . $row["id"]."&group_id=".$id."'>" . $row["name"]." ".$row["apellido1"] . "</a></td>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		print "<td bgcolor='" . $bg ."'>" . $row["age"]. "</td>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
			print "<td bgcolor='" . $bg ."'>" . $row["nivel"]. "</td>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		print "<td align='center' bgcolor='" . $bg ."' align='right'><input name='delete_client[]' type='checkbox' id='delete_client' value='" . $row["id"] . "'></td>";
		print "</tr>";
	}
} else {
		print "<tr>";
		print "<td colspan='4'>There are no clients currently associated with this group.</td>";
		print "</tr>";
}            
?> 
                      <tr> 
                     <tr>
                        <td colspan="8" bgcolor="#eeeeee"><div align="right">
                          <input name="action" type="submit" id="action" value="Delete client">                        
                        </div></td>
                      </tr>      
                    </table> 
         </fieldset><?php } ?></td>
    </tr>
 
  
  <tr>
    <td colspan="3" >
         
  <?php
if ($id != '' || $message == "Client Group Profile Saved.") { 


?>  
  
 <fieldset>
                        <b>Teacher:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; </b> 
                   
   <select name="teacher_id">
     <?php echo $teachers?>
   </select>
   
                        <br />
                        <br />
                         <b>Start date:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
                          <?php
	  $myCalendar3 = new tc_calendar("new_start", true, false);
	  $myCalendar3->SetPicture("calendar/images/iconCalendar.gif");
	  $myCalendar3->setDate(date('d'), date('m'), date('Y'));
	  $myCalendar3->setPath("calendar/");
	  $myCalendar3->setYearSelect(2012, 2030);
	  $myCalendar3->dateAllow('2012-01-01', '2030-12-31');
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
                                      <option value="21:15">21:15</option>
                                      <option value="21:30">21:30</option>
                                <option value="22:00">22:00</option>
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
                                  <option value="21:15">21:15</option>
                                      <option value="21:30">21:30</option>
                                <option value="22:00">22:00</option>
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
    <tr width="100">
                      	<td bgcolor="#ccc"  colspan="3" ><table width="100%"  border="0" align="center" bgcolor="#eeeeee">
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
                         
                          <td bgcolor="#eeeeee" align="right"><font size="-1"><b>Print?</b></font></td>
                              <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"></td>
                      </tr>
                 
<?php

$sql = "select a.id,a.length, b.id as user, first, a.start, a.end, a.starttime, a.endtime from userGroup a, users b where a.user_id = b.id and group_id = " . $id . " order by a.id asc";
//print $sql;
$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error());

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
	global $user_id;
	
	$user_id = $row["user"];
	
	 
		if ($bg == "#FFFFFF") {
			$bg = "#B6C5F2";
		} else {
			$bg = "#FFFFFF";
		}
		
		$teacher =  $row['first'];
		
		print "<tr>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		print "<td bgcolor='" . $bg ."'><a href='/profesores/admin/users/profile.php?id=" . $row["user"] . "'>" .$teacher. "</a></td>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		print "<td bgcolor='" . $bg ."'><input size='8' name='start_teacher[]' type='input' id='start_teacher' value='" . $row["start"] . "'></td>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		print "<td bgcolor='" . $bg ."'><input size='8' name='end_teacher[]' type='input' id='end_teacher'  onblur=\"return updateTeacher();\" value='" . $row["end"] . "'></td>";  
		
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
								 <option value=21:15 '".is_selected_ini('21:15')."'>21:15</option>
								  <option value=21:30 '".is_selected_ini('21:30')."'>21:30</option>
								  <option value=21:45 '".is_selected_ini('21:45')."'>21:45</option>
                                <option value=22:00 '".is_selected_ini('22:00')."'>22:00</option>
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
									 <option value=21:15 '".is_selected_ini('21:15')."'>21:15</option>
								  <option value=21:30 '".is_selected_ini('21:30')."'>21:30</option>
								  <option value=21:45 '".is_selected_ini('21:45')."'>21:45</option>
                                <option value=22:00 '".is_selected_ini('22:00')."'>22:00</option>
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
	
	   print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
  	   print "<td bgcolor='" . $bg ."'><a href='PDFcreator/client_info.php?group_id=".$id."&iduser=".$user_id."&name=" . $name . "&telephone1=" . $telephone1. "&mobile=" . $mobile . "&email=" . $email . "&address1=" . $address1. "&zip=" .  $zip.  "&dias=" .$dias. "&Metro=" . $Metro. "&starttime=" .  $starttime. "&Objetivos=" . $Objetivos."&Seguimiento=" .  $Seguimiento."&Preferencia=".$preferencias."&nivel=" . $nivel. "&start=" . $row['start']. "&end=" . $row['end']. "&endtime=" .  $endtime. "&length=" .  $length. "&teacher=".$teacher."&price=".$price."&alumnos=" . $alumnos."&class_type=" . $class_type."&supplement=".$supplement. "' target='_blank'><img src='image/printer_off1.png'/></a></td>"; 
	   
	  
	   
	   
	   

	

 
		  


			    print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	   	
		print "</tr>";
	}
} else {

		
		
		print "<tr>";
		print "<td colspan='15'>There are no teachers currently associated with this group. Print the client Info here  <a href='PDFcreator/client_info.php?group_id=".$id."&iduser=".$user_id."&name=" . $name . "&telephone1=" . $telephone1. "&mobile=" . $mobile . "&email=" . $email . "&address1=" . $address1. "&zip=" .  $zip.  "&dias=" .$dias2string. "&Metro=" . $Metro."&Objetivos=" . $Objetivos."&Seguimiento=" .  $Seguimiento."&Preferencia=".$preferencias."&class_type=" . $class_type."&nivel=" . $nivel."&alumnos=" . $alumnos."&price=".$price."&supplement=".$supplement. "' target='_blank'><img align='right' src='image/printer_off1.png'/></a></td>";
		
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
            </table></td>
                  </tr>
                    
  <tr>
    <td colspan="3"> 

    
                 
                    
<?php

}

?>    </td>
  </tr>


 
  <tr>
    <td colspan="3"></td>
  </tr>
</table>
     </form>      	</td>
        </tr>
              </table>
         
          </div>
                  <!--end dynamic content -->
            Return to <a href="index.php">Group/Client List</a></td>
        
<?php include 'includes/foot.php';?>
<?php } else { echo "NOT AUTHORIZED TO SEE THIS PAGE, PLEASE RETURN BACK"; }?>
<script type="text/javascript">


<!--

var spryselect06 = new Spry.Widget.ValidationSelect("spryselect06");

var spryselect4 = new Spry.Widget.ValidationSelect("spryselect4");



var sprytextfield00 = new Spry.Widget.ValidationTextField("sprytextfield00");
var sprytextfield01 = new Spry.Widget.ValidationTextField("sprytextfield01");
var sprytextfield02 = new Spry.Widget.ValidationTextField("sprytextfield02");
var sprytextfield05 = new Spry.Widget.ValidationTextField("sprytextfield05");
var sprytextfield06 = new Spry.Widget.ValidationTextField("sprytextfield06");

//-->
</script>
