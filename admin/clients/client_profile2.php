<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<script>
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

<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />

<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style2 {font-size: 12pt}
.style6 {font-weight: bold}
-->
</style>
</head>
<?php include 'includes/constants.php'?>
<?php include 'includes/functions.php'?>
<?php include 'includes/database.php'?>
<?php include 'includes/authorize.php'?>
<?php

$message = "";
$name= $_POST["name"];
$apellido1= $_POST["apellido1"];
$age = escape($_POST["age"]);
$nivel = $_POST["nivel"];
$gender = $_POST["gender"];


switch($gender){

case "H":  $button3 = "checked";break;
case "M":  $button4 = "checked";break;

	}



$group_id = $_REQUEST["group_id"];




if ($_REQUEST['id'] == "") {
	/* NEW PROFILE */

	$mode = "New";
	
	if ($_POST['action'] == "Save Changes") {

	if ($message == "") {
		
				$sql = "insert into clients (group_id, name, apellido1, age, nivel, gender) values ";
		
		
			$sql = $sql . "('" . escape($_REQUEST["group_id"]) . "'";
			$sql = $sql . ", '" . escape($_POST['name']) ."'";
			$sql = $sql . ", '" . escape($_POST['apellido1']) ."'";
			$sql = $sql . ", '" . escape($_POST['age']) ."'";
			$sql = $sql . ", '" . escape($_POST['nivel']) ."'";
			$sql = $sql . ",  '" .escape($_POST['gender'])  ."');";
			
			//print $sql;
			mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
			$id = mysql_insert_id();
			

			$message = "Client Profile Saved.";
			}
	}
} else {
	$mode = "Edit Client";
}

if ($id == "") {
	$id = $_REQUEST['id'];
}

if ($id != "" && $_POST['action2'] == "Update Client") {

$email = escape($_POST["email"]);
 
   	$sql = "update clients set  group_id = '".$_REQUEST["group_id"]."', name = '".escape($_POST["name"])."',  apellido1 = '".escape($_POST["apellido1"])."', age= '".$age."', nivel= '".escape($_POST["nivel"])."', gender= '".escape($_POST["gender"])."' where id = " . $id;
 
	//print $sql . "<br>";
   	mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
   
    $message = "Client data updated.";
	}

$sql = "select id, name from groups order by name";
$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
$groups .= "<option value=''>Select group....</option>";
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	if ($group_id == $row['id']) {
		$selected = "selected";
	} else {
		$selected = "";
	}
	$groups .= "<option " . $selected . " value='" . $row['id'] . "'>" . $row['name'] . "</option>";
}


if (($id != "") && (($message == "Client data updated.") || ($message == ""))) {

	$sql = "select name, apellido1, age, nivel, gender from clients where id = " . $id;
	$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));

	if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$name =  stripslashes($row["name"]);
		$apellido1 =  stripslashes($row["apellido1"]);
		
		$age = $row["age"];
		$nivel = $row["nivel"];
		$gender = $row["gender"];
				
		
switch($gender){

case "H": $button3 = "checked";break;
case "M":  $button4 = "checked";break;

}


	} 


}
		
?>

 <?php require_once('../../includes/top.php');?>
  
 <div style="position: relative;  top: 30px;"  align="center"> 
 
 <p align="center"><b>Client Profile &#8211; 
              <?php echo  $mode ?> <font color='#ff9900'><?php echo  $message ?></font></b></p> 

<table width="100%" class="pepe1" border="0" cellpadding="5" cellspacing="0" id="body">
     
        <tr> 
          <td width="100%" valign="top">  
 
 
            <!--start dynamic code -->
            <form name="associate" id="associate" method="post">
            	<input type="hidden" name="id" value="<?php echo $id;?>">
            
<table width="481" class="pepe1" border="0" align="center" bgcolor="#cccccc">

  <tr>
    <td width="187"><strong>Name:</strong> </td>
<td colspan="2" >
   <span id="sprytextfield00">
   
<label><span class="style10">  
  						 </span>
                        <input name="name" type="text" value="<?php echo  $name;?>">
                    </label>
            <span class="textfieldRequiredMsg"><font size="2">Required</font></span></span>         </td>
    </tr>
  <tr>
  
    <td><strong>Surname</strong></td>
    <td colspan="2">
 <span id="sprytextfield02">
   
<label><span class="style10">  
  						 </span>
                        <input name="apellido1" type="text" value="<?php echo  $apellido1;?>">
                    </label>
            <span class="textfieldRequiredMsg"><font size="2">Required</font></span></span> </td>
    </tr>
  
  <tr>
    <td><strong>Age:</strong></td>
    <td colspan="2">
     <span id="sprytextfield03">
   
<label><span class="style10">  
  						 </span>
        <label>  <input name="age" type="text" value="<?php echo  $age;?>">
                        </label>	 <span class="textfieldRequiredMsg"><font size="2">Required</font></span></span> 	    </td>
    </tr>

  <tr>
    <td><strong>Level:</strong></td>
    <td colspan="2"> <?php 
function is_selected3($arg) {

global $nivel; 


   if (isset($nivel) && $arg == $nivel) { 
      echo ' selected="selected"'; 
   } 
} 
?> 

 <span id="spryselect00">
 <label><span class="style6 style9 style7"></span>
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
 <span class="selectRequiredMsg"><font size="2">Required</font></span></span>  </td>
  </tr>
  <tr>
    <td><strong>Belong to:</strong></td>
    <td> <select name="group_id">
                        	<?php echo  $groups; ?>
                  </select>   </td>
    </tr>
  <tr>
    <td><strong>Gender:</strong></td>
    <td width="67"><fieldset>

 
 <label>F </label> 
 
 <input name="gender" <?php echo  $button3;?> type="radio" value="H"/> 
 
 
 <label>M</label>
 
 <input name="gender" <?php echo  $button4;?> type="radio" value="M"/> 
 
    </fieldset></td>
    <td width="213">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
<td colspan="3">
    
    
     <div align="center">
       <?php
if ($id == '') {              
?>  
       <input name="action" type="submit" id="action" value="Save Changes">
       
       <?php } else if(($message == "Client data updated.") || ($id != '')){ ?>
       <input name="action2" type="submit" id="action2" value="Update Client" />
       <?php } ?>
         </div>  
     </div></td>
</tr>
</table>
     </form> 
          	</td>
        </tr>
</table>

 </div>  
       
                  <div align="center">
                    <!--end dynamic content -->                  
                    <span class="boldText"><strong>Return to</strong> <strong><a href="index.php">Group/Client List</a>
                    <?php
              if (($group_id != "") && ($id != "")) {
            ?>
                    <br>
                    <br>
                    View this client's</strong> <strong><a href="group_profile.php?id=<?php echo $group_id ?>" class="boldText">Group</a>
                    
                    <br>
                    <br>
                    Add another </strong> <strong><a href="client_profile2.php?group_id=<?php echo $group_id ?>" class="boldText"> client</a> to this group
                    <?php
          	}
            ?>
                        </strong> </span></div>
        
<?php include 'includes/foot.php'?>
<script type="text/javascript">
<!--
var spryselect00 = new Spry.Widget.ValidationSelect("spryselect00");
var sprytextfield00 = new Spry.Widget.ValidationTextField("sprytextfield00");
var sprytextfield02 = new Spry.Widget.ValidationTextField("sprytextfield02");
var sprytextfield03 = new Spry.Widget.ValidationTextField("sprytextfield03");



//-->
</script>
