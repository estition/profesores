<?php
ini_set("default_charset", "utf-8");
?>

<strong></strong><?php require_once('calendar/tc_calendar.php'); 
?><head>

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
if($is_admin_a) {
$message = "";

$id = $_REQUEST["id"];
$name= $_POST["nombre"];
$cif= $_POST["cif"];
$telephone1= $_POST["telefono"];

$mobile = $_POST["movil"];

$email = escape($_POST["email"]);
$address1 = $_POST["direccion"];

$city = $_POST["ciudad"];

$zip = $_POST["cp"];

$returndate = $_POST["returndate"];

$Metro = $_POST["metro"];


//$fee = $_POST['fee'];


$teacher_id = $_POST["teacher_id"];

if ($id == "") {
	/* NEW PROFILE */

	$mode = "New";
	if ($_POST['action'] == "Save Changes") {
		
		$sql0 = "select * from companies where nombre = '". escape($_POST['nombre']). "'";
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
				$sql = "insert into companies (nombre, cif, telefono,  movil, email, direccion, ciudad, cp, returndate, metro) values ";
		
			$sql = $sql . "('" . escape($_POST['nombre']) . "'";
			$sql = $sql . ", '" . escape($_POST['cif']) ."'";
			$sql = $sql . ", '" . escape($_POST['telefono']) ."'";
			//$sql = $sql . ", '" . escape($_POST['telephone2']) ."'";
			$sql = $sql . ", '" . escape($_POST['movil']) . "', '" . escape($_POST['email']) ."'";
			$sql = $sql . ", '" . escape($_POST['direccion']) . "', '" . escape($_POST['ciudad']) ."'";
			$sql = $sql . ", '" . escape($_POST['cp']). "', '" . $_POST['returndate'] ."'";
			
			$sql = $sql . ", '" . escape($_POST['metro']) ."'";
			
		
			//$sql = $sql . ", '" . escape($_POST['fee']) ."'";
			$sql = $sql . ");";
			//print $sql;
			mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
			$id = mysql_insert_id();
			

			$message = "<br>Group Profile Saved.";
		}else {$message = "<br>Group already exist, try with another one";}
	}
} else {
	$mode = "Edit";
}

if ($id == "") {
	$id = $_REQUEST['id'];
}



   
if ($id != "" && $_POST['action'] == "Delete client") {
if (count($_POST['delete_client']) == 0) {$message = "<br>Must check the client first.";}
else{
	foreach ($_POST['delete_client'] as $dtid) {
   	$sql = 'delete from companies where id = ' . $dtid;
   	mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
    $message = "<br>Client deleted.";}
	}
}


if ($id != "" && $_POST['action'] == "Update Client") {


$email = escape($_POST["email"]);
 



   	//$sql = "update userGroup set start = ". $start_teacher . ", end = ". $end_teacher . ", class_type = " . $_POST['class_type'][$i] . ", length= " . $length_teacher . " where id = " . $utid;
   	$sql = "update companies set nombre = '".$_POST["nombre"]."',  cif = '".$_POST["cif"]."', telefono= '".$_POST["telefono"]."',  movil= '".$_POST["movil"]."', email= '".$email."', direccion= '".$_POST["direccion"]."', ciudad= '".$_POST["ciudad"]."', cp= '".$_POST["cp"]."', returndate= '".$_POST["returndate"]."',  metro= '".$_POST["metro"]."' where id = " . $id;
 
	//print $sql . "<br>";
   	mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
   
    $message = "<br>Client data updated.";
	}


if (($id != "") && (($message == "<br>Client Group Profile Saved.") || ($message == ""))) {


	$sql = "select * from companies where id = " . $id;
	$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));

	if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		//$id = $row["id"];
		$name =  stripslashes($row["nombre"]);
		$cif =  stripslashes($row["cif"]);
		$telephone1 = $row["telefono"];
		//$telephone2 = $row["telephone2"];
		$mobile = $row["movil"];

		$email = $row["email"];
		$address1 = $row["direccion"];
		//$address2 = $row["address2"];
		$city = $row["ciudad"];
		$zip = $row["cp"];
		$returndate = $row["returndate"];
		$Metro = $row["metro"];
		//$fee = $row["fee"];
		
			} 
	

}

//echo $id."HHHH";

			
?>


   

  
   <?php require_once('../../includes/top.php');?>
  
 <div style="position: relative;  top: 30px;"  align="center">  

<table class="pepe1"  bgcolor="#cccccc">
  <tr > 
          <td valign="top" width="25" align="left"> </td></tr>
          
            <tr width="35" > 
          <td valign="top" align="left" width="35"> </td></tr>
          
        <tr> 
        
        
          <td width="100%" valign="top" align="center">  
  
 <p><b>Company Profile &#8211; 
              <?php echo  $mode ?> <br><font color='#ff9900'><?php echo  $message ?></font></b></p>
            <!--start dynamic code -->
            <form name="associate" id="associate" method="post">
            	
            	  <input type="hidden" name="id" value="<?php echo $id;?>">
           	    
            	<table width="500" border="0" align="center" bgcolor="#cccccc">

  <tr>
    <td><B>Nombre: </B></td>
<td width="300"><span id="sprytextfield02">
   
<label><span class="style10">  
  						 </span>
                        <input name="nombre" type="text" value="<?php echo  $name;?>">
                    </label>
            <span class="textfieldRequiredMsg"><font size="2">Required</font></span></span></td>
    <td width="220">
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
  	  $myCalendar->setYearSelect(2012, 2030);
	  $myCalendar->dateAllow('2012-01-01', '2030-12-31');
	  $myCalendar->setDateFormat('j F Y');
	  $myCalendar->writeScript();}
	  ?>   
       
    
    </td>
    
  </tr>
  <tr>
    <td><B>CIF:</B></td>
    <td>
   						<label><span class="style10">
  						</span>
    <input name="cif" type="text" value="<?php echo  $cif;?>">
      </label>		  </td>
    
  </tr>
  <tr>
     <td><B>Telefono:</B></td>
<td>
   
   						<label>
                        <input name="telefono" type="text" value="<?php echo  $telephone1;?>">
              </label>		    </td>
<td>
  </td>
  </tr>
  <tr>
    <td><B>Movil:</B></td>
    <td colspan="2">
                      <label>
                        <input name="movil" type="text" value="<?php echo  $mobile;?>">
                    </label>					    </td>
  </tr>
  <tr>
    <td><B>Email:</B></td>
    <td colspan="2"><span id="sprytextfield05">
   
   						<label><span class="style10">
  						</span>
                        <input name="email" type="text" value="<?php echo  $email;?>">
                        </label>
		    <span class="textfieldRequiredMsg"><font size="2">Required</font></span></span></td>
  </tr>
  <tr>
    <td><B>Dirección:</B></td>
    <td colspan="2"><span id="sprytextfield06">
   
  				 		<label><span class="style10"> 
  						</span>
                        <input name="direccion" type="text" value="<?php echo  $address1;?>" size="43"> </label>
		    <span class="textfieldRequiredMsg"><font size="2">Required</font></span></span><br></td>
            
  </tr>
  <tr>
    <td><B>Ciudad:</B></td><?php if ($city == ""){$city = "Madrid";}?>
    <td colspan="2"> <span id="sprytextfield08">
   
   <label><span class="style10"> 
  </span>
                        <input name="ciudad" type="text" value="<?php echo  $city;?>"></label>
		    <span class="textfieldRequiredMsg"><font size="2">Required</font></span></span><br>      </td>
  </tr>  
  
  <tr>
    <td><B>C.P.:</B></td>    
   <td colspan="2">
 
  <span id="sprytextfield12">
   <label><span class="style10">  
  </span><input name="cp" type="text" value="<?php echo  $zip;?>" size="10"></label>
  <span class="textfieldRequiredMsg"><font size="2">Required</font></span></span></td>
  </tr>
  <tr>
    <td><strong>Metro/Otros medios:  
  </strong></td>
  <td colspan="3">
    
        <span id="sprytextfield00">
          <label><span class="style10"></span> <span class="textfieldRequiredMsg"><font size="2">Required</font></span><br /> 
            <input name="metro" type="text" id="metro" size="35" maxlength="100" value="<?php echo  $Metro;?>" />
            </label>
          </span>
           </td>
  
  <tr>
    <td> </td>
    <td colspan="2"></td>
    </tr>
  <tr>
    <td colspan="3">      </td>
  </tr>
  <tr>
    <td colspan="4"  bgcolor="#cccccc"><div align="center">
    
    
     <?php
if ($id == '') {              
?>  
      <input name="action" type="submit" id="action" value="Save Changes">
      
      <?php } else if(($message == "<br>Client data updated.") || ($id != '')){ ?>
	    <input name="action" type="submit" id="action" value="Update Client">
	 <?php } ?>
    </div></td>
  </tr>

  <tr>
    <td height="21" colspan="4">
       <?php if ($id != '' || $message == "<br>Client Group Profile Saved.") { ?></td>
    
    <td colspan="4" >&nbsp;</td>
  </tr>
    <tr>
                      	<td colspan="4" bgcolor="#cccccc"> 

    
     <?php
}

?>   


 <?php
		// echo $id."GGGGGGGGG";
		
if ($id != '') {   
           
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>

<script type="text/javascript">

jQuery.noConflict();
jQuery(document).ready(function() {

	//##### send add record Ajax request to response.php #########
	jQuery("#FormSubmit").click(function (e) {
			e.preventDefault();
			if(jQuery("#contentText").val()==='')
			{
				alert("Please enter some text!");
				return false;
			}		
			//ssalert(myData)
		 	var myData = 'content_txt='+ jQuery("#contentText").val()+'&content_id='+jQuery("#contentId").val(); //build a post data structure
			//alert(myData);
			jQuery.ajax({
			type: "POST", // HTTP method POST or GET
			url: "response.php", //Where to make Ajax calls
			dataType:"text", // Data type, HTML, json etc.
			data:myData, //Form variables
			success:function(response){
				jQuery("#responds").append(response);
				jQuery("#contentText").val(''); //empty text field on successful
			},
			error:function (xhr, ajaxOptions, thrownError){
				alert(thrownError+myData);
			}
			});
	});

		//##### Send delete Ajax request to response.php #########
	jQuery("body").on("click", "#responds .del_button", function(e) {
		 e.returnValue = false;
		 var clickedID = this.id.split('-'); //Split string (Split works as PHP explode)
		 var DbNumberID = clickedID[1]; //and get number from array
		 var myData = 'recordToDelete='+ DbNumberID; //build a post data structure
		 
			jQuery.ajax({
			type: "POST", // HTTP method POST or GET
			url: "response.php", //Where to make Ajax calls
			dataType:"text", // Data type, HTML, json etc.
			data:myData, //Form variables
			success:function(response){
				//on success, hide  element user wants to delete.
				jQuery('#item_'+DbNumberID).fadeOut("slow");
			},
			error:function (xhr, ajaxOptions, thrownError){
				//On error, we alert user
				alert(thrownError);
			}
			});
	});

});
</script><link href="css_group/style.css" rel="stylesheet" type="text/css" />

<body>
<div class="content_wrapper">
<ul id="responds">
<?php
//include db configuration file
//include_once("config.php");

//MySQL query
$Result = mysqli_query($link, "SELECT id,name, nivel FROM groups where old_id = ".$id) or die("Invalid query1: " . mysqli_error($link));

//get all records from add_delete_record table

while($row = mysqli_fetch_array($Result))
{

 
	//$client_id = $row["id"];
  echo '<li id="item_'.$row["id"].'">';
  echo '<div class="del_wrapper"><a href="#" class="del_button" id="del-'.$row["id"].'">';
  echo '<img src="images_group/icon_del.gif" border="0" />';
   echo '</a></div>';
   
   //echo '<br>';
   
	echo '<a href="group_profile.php?id='.$row["id"].'" ><img src="images_group/customer.gif" border="0"/></a>';
 // echo ''.$row["name"].'</li>';
  echo '<b>'.$row["name"].'</b> <br> Nivel: '.$row["nivel"].'</li>';
 
}

//close db connection
//mysql_close($link);
$sqlClients ="select c.id, c.old_id, c.name, (select count(id) from clients d where group_id = c.id) as num from groups c  where  c.enterprise = '1' and c.baja = '0' and c.historical = '0' order by name";
		  
$resultClients = mysqli_query($link, $sqlClients) or die("Invalid query2: " . mysqli_error($link));
$clientsOptions="";
while ($rowClients = mysqli_fetch_array($resultClients, MYSQLI_ASSOC)) {
	if ($id == $rowClients['old_id']) {
		$selected = "selected=\"selected\"";
	} else {
		$selected = "";
	}
	$clientsOptions .= "\n<option " . $selected . " value=\"" . $rowClients['id'] ."\">" . $rowClients['name'] . " (".$rowClients['num'].")</option>";
}
mysql_close($link);
?>
</ul>
    <div class="form_style">
     <select name="content_txt" id="contentText" >
                        	<?php echo  $clientsOptions; ?>
                        </select>
    <input type="hidden" name="content_id"  id="contentId" value="<?php echo  $id; ?>">
    <button id="FormSubmit">Add record</button>
    </div>
</div>

</body>


               
<?php

}?>  

             
 </td>
                  </tr>
                    
  <tr>
    <td colspan="4">  
</td>
	</td>
     Return to <a href="index.php">Group/Client List</a>
  </tr>
</table>
     </form>      
        </tr>
              </table>
             
                  <!--end dynamic content -->
          </div>  
       
         
         
<?php include 'includes/foot.php';?>
<?php } else { echo "NOT AUTHORIZED TO SEE THIS PAGE, PLEASE RETURN BACK"; }?>

<script type="text/javascript">
<!--


var sprytextfield02 = new Spry.Widget.ValidationTextField("sprytextfield02");
var sprytextfield05 = new Spry.Widget.ValidationTextField("sprytextfield05");
var sprytextfield06 = new Spry.Widget.ValidationTextField("sprytextfield06");

var sprytextfield08 = new Spry.Widget.ValidationTextField("sprytextfield08");

var sprytextfield12 = new Spry.Widget.ValidationTextField("sprytextfield12");

//-->
</script>
