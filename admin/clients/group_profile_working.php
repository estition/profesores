<?php include 'includes/constants.php'?>
<?php include 'includes/functions.php'?>
<?php include 'includes/database.php'?>
<?php include 'includes/authorize.php'?>
<?php

$message = "";
$name= $_POST["name"];
$cif= $_POST["cif"];
$telephone1= $_POST["telephone1"];
$telephone2 = $_POST["telephone2"];
$mobile = $_POST["mobile"];
$fax = $_POST["fax"];
$email = $_POST["email"];
$address1 = $_POST["address1"];
$address2 = $_POST["address2"];
$city = $_POST["city"];
$state = $_POST["state"];
$zip = $_POST["zip"];
$start = $_POST["start"];
$end = $_POST["end"];
$supplement = $_POST["supplement"];
$class_type = $_POST["class_type"];

$teacher_id = $_POST["teacher_id"];

if ($_REQUEST['id'] == "") {
	/* NEW PROFILE */

	$mode = "New";
	if ($_POST['action'] == "Save Changes") {
		
		if (strlen($name) < 5) {
			$message = $message . "The name 5 characters.<br>";
		}
		
		if ($_POST['supplement'] == "") {
			$supplement = 0;
		} else {
			$supplement = $_POST['supplement'];
		}
	
		
		if ($message == "") {
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
				$sql = "insert into groups (name, start, supplement, class_type) values ";
			$sql = $sql . "('" . escape($_POST['name']) . "', sysdate(), " . $supplement . ", " . $class_type . ");";

			//print $sql;
			mysql_query($sql) or die("Invalid query: " . mysql_error());
			$id = mysql_insert_id();
			

			$message = "<br>Client Group Profile Saved.";
		}
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

		
		if ($_POST['new_length'] == "") {
			$new_length = "null";
		} else {
			$new_length = "'" . $_POST['new_length'] . "'";
		}
	

	$sql = "insert into userGroup (user_id, group_id, start, length) ";
	$sql .= " values (" . $teacher_id . ", " . $id . ", " . $new_start . ", " . $new_length . ")";
	//print $sql;
	mysql_query($sql) or die("Invalid query: " . mysql_error());
}


if ($id != "" && $_POST['action'] == "Delete teacher") {
	foreach ($_POST['delete_teacher'] as $tid) {

   	$sql = 'delete from userGroup where id = ' . $tid;
   	mysql_query($sql) or die("Invalid query: " . mysql_error());
    $message = "<br>Teacher association deleted.";
	}
}


if ($id != "" && $_POST['action'] == "Delete client") {
	foreach ($_POST['delete_client'] as $dtid) {
   	$sql = 'delete from clients where id = ' . $dtid;
   	mysql_query($sql) or die("Invalid query: " . mysql_error());
    $message = "<br>Client deleted.";
	}
}

if ($id != "" && $_POST['action'] == "Update info") {
	$i = 0;
	foreach ($_POST['teacher'] as $utid) {
		if ($_POST['start_teacher'][$i] == "") {
			$start_teacher = "null";
		} else {
			$start_teacher = "'" . $_POST['start_teacher'][$i] . "'";
		}
		if ($_POST['end_teacher'][$i] == "") {
			$end_teacher = "null";
		} else {
			$end_teacher = "'" . $_POST['end_teacher'][$i] . "'";
		}
	
		if ($_POST['length_teacher'][$i] == "") {
			$length_teacher = "null";
		} else {
			$length_teacher = "'" . $_POST['length_teacher'][$i] . "'";
		}
	

   	//$sql = "update userGroup set start = ". $start_teacher . ", end = ". $end_teacher . ", class_type = " . $_POST['class_type'][$i] . ", length= " . $length_teacher . " where id = " . $utid;
   	$sql = "update userGroup set start = ". $start_teacher . ", end = ". $end_teacher . ", length= " . $length_teacher . " where id = " . $utid;
 
	//print $sql . "<br>";
   	mysql_query($sql) or die("Invalid query: " . mysql_error());
   	$i++;
    $message = "<br>Teacher association data updated.";
	}
}


if ($id != "" && $_POST['action'] == "Delete") {
	/*  Delete this client. */
	
	
	
}


if ($id != "" && $_POST['action'] == "Save Changes") {
/* EDIT EXISTING PROFILE */

	if (strlen($name) < 5) {
		$message = $message . "The name must be at least 5 characters.<br>";
	}

	if ($message == "") {
		if ($_POST['start'] == "") {
			$tstart = "null";
		} else {
			$tstart = "'" . $_POST['start'] . "'";
		}
		
		if ($_POST['end'] == "") {
			$tend = "null";
		} else {
			$tend = "'" . $_POST['end'] . "'";
		}		
		
		if ($_POST['supplement'] == "") {
			$supplement = 0;
		} else {
			$supplement = $_POST['supplement'];
		}
		
		/*
		$sql = "update groups set cif = '" . $_POST['cif'] . "', telephone1 = '" . $_POST['telephone1'] . "' ";
		$sql = $sql . ", telephone2 = '" . $_POST['telephone2'] . "', mobile = '" . $_POST['mobile'] . "' ";
		$sql = $sql . ", fax = '" . $_POST['fax'] . "', email = '" . $_POST['email'] . "', address1 = '" . $_POST['address1'] . "' ";
		$sql = $sql . ", address2 = '" . $_POST['address2'] . "', city = '" . $_POST['city'] . "' ";
		$sql = $sql . ", state = '" . $_POST['state'] . "', zip = '" . $_POST['zip'] . "' ";
		$sql = $sql . ", name = '" . $_POST['name'] . "', start = " . $tstart . ", end = " . $tend . " where id = " . $id;
*/
				$sql = "update groups set class_type = " . $class_type . ", name = '" . $_POST['name'] . "', start = " . $tstart . ", end = " . $tend . ", supplement = " . $supplement . " where id = " . $id;

		
		//print $sql;
		mysql_query($sql) or die("Invalid query: " . mysql_error());
		$message = "<br>Group Profile Saved.";
	}
}


if (($id != "") && (($message == "<br>Client Group Profile Saved.") || ($message == ""))) {
	$sql = "select * from groups where id = " . $id;
	$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
	if ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$name =  stripslashes($row["name"]);
		$cif =  stripslashes($row["cif"]);
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
		$end = $row["end"];
		$supplement = $row["supplement"];
		$class_type = $row["class_type"];
	} 
}

$sql = "select id, first, last1, last2 from users where is_active = 1 order by last1";
$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
$teachers .= "<option value='0'>Select teacher....</option>";
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	$teachers .= "<option " . $selected . " value='" . $row['id'] . "'>" . $row['last1'] . " " . $row['last2'] . ", " . $row['first'] . "</option>";
}
	
			
?>
<?php include 'includes/top.php'?>
<?php include 'includes/menu.php'?>
<?php require_once('calendar/tc_calendar.php'); ?>
      <table width="100%" border="0" cellpadding="10" cellspacing="0" id="body">
      <link href="calendar/calendar.css" rel="stylesheet" type="text/css" />
	  <script language="javascript" src="calendar/calendar.js"></script>

        <tr> 
          <td width="100%" valign="top"> <p><b>Client Profile &#8211; 
              <?php echo  $mode ?> <br><font color='#ff9900'><?php echo  $message ?></font></b></p>
            <!--start dynamic code -->
            <form name="associate" id="associate" method="post">
            	<input type="hidden" name="id" value="<?php echo $id;?>">
              <table border="0" cellpadding="5" cellspacing="0" width="80%">
                <tr valign="top"> 
                  <td colspan="2" bgcolor="#EEEEEE">&nbsp;</td>
                </tr>
                <tr valign="top"> 
                  <td bgcolor="#EEEEEE"></td>
                  <td bgcolor="#FFFFFF"><font>
                    General Info</font><br>
                     <table border="0" cellpadding="5" cellspacing="0" width="100%">
                      <tr> 
                        <td valign="top"><b>Name:</b></td>
                        <td><input size="35" name="name" type="text" value="<?php echo  $name;?>"></td>               
                      </tr>
                      <!--
                      <tr> 
                        <td valign="top"><b>Cif:</b></td>
                        <td><input name="cif" type="text" value="<?php echo  $cif;?>"></td>               
                     </tr>
                     <tr> 
                        <td valign="top"><b>Telephone:</b></td>
                        <td><input name="telephone1" type="text" value="<?php echo  $telephone1;?>"></td>
                      </tr>
                      <tr> 
                        <td valign="top"><b>Secondary Telephone:</b></td>
                        <td><input name="telephone2" type="text" value="<?php echo  $telephone2;?>"></td>
                      </tr>
                      <tr> 
                        <td valign="top"><b>Mobile:</b></td>
                        <td><input name="mobile" type="text" value="<?php echo  $mobile;?>"></td>
                      </tr>
                      <tr> 
                        <td valign="top"><b>Fax:</b></td>
                        <td><input name="fax" type="text" value="<?php echo  $fax;?>"></td>
                      </tr>
                      <tr> 
                        <td valign="top"><b>Email:</b></td>
                        <td><input name="email" type="text" value="<?php echo  $email;?>"></td>
                      </tr>
                      <tr> 
                        <td valign="top"><b>Address:</b></td>
                        <td><input name="address1" type="text" value="<?php echo  $address1;?>" size="35"><br>
                        		<input name="address2" type="text" value="<?php echo  $address2;?>" size="35"></td>
                      </tr>
                      <tr> 
                        <td valign="top"><b>City, State&nbsp; Zip:</b></td>
                        <td><input name="city" type="text" value="<?php echo  $city;?>">, <input name="state" type="text" value="<?php echo  $state;?>"> &nbsp;<input name="zip" type="text" value="<?php echo  $zip;?>" size="10">
                      </tr>
                      -->
                      <?php
                      
                      if (($mode == "Edit") || ($message == "<br>Client Group Profile Saved.")) {
                      	
                      ?>
                      
                      <tr> 
                        <td valign="top"><b>Start date:</b></td>
                        <td><input name="start" type="text" value="<?php echo  $start;?>"> (YYYY-MM-DD)</td>
                      </tr>
                      <tr> 
                        <td valign="top"><b>End date:</b></td>
                        <td><input name="end" type="text" value="<?php echo  $end;?>"> (YYYY-MM-DD) (Entering an end date <br>inactivates this client group.)</td>
                      </tr>
                     <?php
                     
                    }
                    ?>
                    <tr>
                    <td valign="top"><b>Class type:</b></td>
                    <td> <select name='class_type'>
										<?php
											if ($class_type == 1) {
												$selected  = "selected";
											} else {
												$selected  = "";
											}
											
											print "<option value='1' " . $selected . ">Individual Class</option>";
											
											if ($class_type == 2) {
												$selected  = "selected";
											}else {
												$selected  = "";
											}
											
											print "<option value='2' " . $selected . " title='2-3 adults or kids from different families'>Group Class I (2-3 adults/kids diff fam)</option>";
											
											//********************************************************************
											//***********************MODIFICADO POR SVI***************************
											//********************************************************************
											if ($class_type == 3) {
												$selected  = "selected";
											}else {
												$selected  = "";
											}
											
											print "<option value='4' " . $selected . " title='4-> adults or kids from different families'>Group Class II (4-> adults/kids diff fam)</option>";
											
											if ($class_type == 4) {
												$selected  = "selected";
											}else {
												$selected  = "";
											}
											
											print "<option value='2' " . $selected . " title='4-> adults special assigment, permited per James'>Group Class III (4-> adults sp assig, permited per James)</option>";
											
											//********************************************************************
											//********************FIN DE MODIFICACIÓN*****************************
											//********************************************************************
										
										
										?>
										</select></td>
					   </tr>
                    <tr> 
                        <td valign="top"><b>Supplement:</b></td>
                        <td><input name="supplement" size="5" type="text" value="<?php echo  $supplement;?>"> Supplement amount teachers recieve for this client.</td>
                    </tr>
                    </table></td>
                </tr>
                <tr valign="top"> 
                  <td colspan="2" bgcolor="#eeeeee">&nbsp; </td>
                </tr>
                <tr valign="top" bgcolor="#dddddd"> 
                  <td colspan="2" align="center"> <input name="action" type="submit" id="action" value="Save Changes"> 
                  </td>
                </tr>
              </table>
              
              
  <?php
if ($id != '') {              
?>   
							<br>            
              <table border="0" cellpadding="5" cellspacing="0" width="80%">
                <tr valign="top"> 
                  <td colspan="2" bgcolor="#EEEEEE">&nbsp;</td>
                </tr>
                <tr valign="top"> 
                  <td bgcolor="#EEEEEE"></td>
                  
                  <td bgcolor="#FFFFFF"><font>
                   New Teacher</font><br><table border="0" cellpadding="5" cellspacing="0" width="100%">
                      <tr> 
                        <td valign="top"><b>Teacher:</b></td>
                        <td><select name="teacher_id"><?php echo $teachers?></select> </td>               
                      </tr>
                      <tr> 
                      
                      
                      
                            <table border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td><strong>Date :</strong></td>
                    <td>
    <?php
	  $myCalendar = new tc_calendar("date5", true, false);
	  $myCalendar->SetPicture("calendar/images/iconCalendar.gif");
	  $myCalendar->setDate(date('d'), date('m'), date('Y'));
	  $myCalendar->setPath("calendar/");
	  $myCalendar->setYearSelect(1945, date('Y'));
	  $myCalendar->dateAllow('1945-01-01', date('Y-m-d'));
	   $myCalendar->setDateFormat('j F Y');
	  $myCalendar->writeScript();
	  ?>
	  		</td>
               <td></td>
             </tr>
        </table>
                      
                      
                      
                      
                      
                        <td valign="top"><b>Start date:</b></td>
                        <td><input name="new_start" type="text"> (YYYY-MM-DD)</td>
                      </tr>
                      <tr> 
                        <td valign="top"><b>Class Type:</b></td>
                        <td><select name="new_type">
                        			<option value="1">Individual Class</option>
  <option value="2" title='2-3 adults or kids from different families'>Group Class I (2-3 adults/kids diff fam)</option>
  <option value="3" title='4-> adults or kids from different families'>Group Class II (4-> adults/kids diff fam)</option>
  <option value="4" title='4-> adults sp assig, permited per James'>Group Class III(4-> adults special assigment, permited per James)</option>
                        		</select>
                        </td>
                      </tr>
                      <tr> 
                        <td valign="top"><b>Class Length:</b></td>
                        <td><input name="new_length" size="4" type="text">
                        </td>
                      </tr>
                      
                    </table>
                  </td>
                </tr>
                
                <tr valign="top" bgcolor="#dddddd"> 
                  <td colspan="2" align="center"> <input name="action" type="submit" id="action" value="Add teacher">
                    </td>
                </tr>
                <tr valign="top"> 
                  <td colspan="2" bgcolor="#eeeeee">&nbsp;  </td>
                </tr>
              </table>
		
      			<br>
      			<font>Teacher Info</font><br>
              <table border="0" cellpadding="1" cellspacing="0" bgcolor="#CCCCCC" id="border" width="80%">
                <tr> 
                  <td>
                  <table border="0" cellpadding="2" cellspacing="0" bgcolor="#FFFFFF" id="listing" width="100%">
                       <tr>
                      	<td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Name</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Start</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>End</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Delete?</b></font></td>
                      </tr>
                 
<?php

$sql = "select a.id, b.id as user, first, last1, last2, a.start, a.end from userGroup a, users b where a.user_id = b.id and group_id = " . $id;
//print $sql;
$result = mysql_query($sql) or die("Invalid query: " . mysql_error());

$numRows = mysql_NumRows($result);
 
if ($numRows > 0) {
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		
		if ($bg == "#FFFFFF") {
			$bg = "#B6C5F2";
		} else {
			$bg = "#FFFFFF";
		}
		
		print "<tr>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		print "<td bgcolor='" . $bg ."'><a href='/admin/users/profile.php?id=" . $row["user"] . "'>" . $row['last1'] . " " . $row['last2'] . ", " . $row['first'] . "</a></td>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		print "<td bgcolor='" . $bg ."'><input size='8' name='start_teacher[]' type='input' id='start_teacher' value='" . $row["start"] . "'></td>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		print "<td bgcolor='" . $bg ."'><input size='8' name='end_teacher[]' type='input' id='end_teacher' value='" . $row["end"] . "'></td>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	
  	print "<td bgcolor='" . $bg ."'><input name='delete_teacher[]' type='checkbox' id='delete_teacher' value='" . $row["id"] . "'><input name='teacher[]' type='hidden' id='teacher' value='" . $row["id"] . "'></td>";
		print "</tr>";
	}
} else {
		print "<tr>";
		print "<td colspan='4'>There are no teachers currently associated with this group.</td>";
		print "</tr>";
}            
?> 
                    <tr> 
                      <td bgcolor="#eeeeee">&nbsp;</td>
                      <td bgcolor="#eeeeee">&nbsp;</td>
                      <td bgcolor="#eeeeee">&nbsp;</td>

                      <td bgcolor="#eeeeee" align="right" colspan="11"> <input name="action" type="submit" id="action" value="Update info"> <input name="action" type="submit" id="action" value="Delete teacher"> 
                        <br>
                        checked items</td>
                    </tr>
                  </table>
    
				  </td>
              </tr>
            </table>
            
            <br>
      			<font>Client Info</font>
              <table border="0" cellpadding="1" cellspacing="0" bgcolor="#CCCCCC" id="border" width="80%">
                <tr> 
                  <td><table border="0" cellpadding="2" cellspacing="0" bgcolor="#FFFFFF" id="listing" width="100%">
                      <tr>
                      	<td colspan="4" align="right"><a href="client_profile.php?group_id=<?php echo $id?>"><b>Add a client</b></a> to this group.</td>
                      </tr>
                      <tr>
                      	<td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Name</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee" align="center"><font size="-1" width="40"><b>Delete?</b></font></td>
                      </tr>
                 
<?php

$sql = "select * from clients where group_id = " . $id;
$result = mysql_query($sql) or die("Invalid query: " . mysql_error());

$numRows = mysql_NumRows($result);
 
if ($numRows > 0) {
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		
		if ($bg == "#FFFFFF") {
			$bg = "#B6C5F2";
		} else {
			$bg = "#FFFFFF";
		}
		
		print "<tr>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		print "<td bgcolor='" . $bg ."'><a href='client_profile.php?id=" . $row["id"] . "'>" . $row["name"] . "</a></td>";
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
                      <td bgcolor="#eeeeee">&nbsp;</td>
                      <td bgcolor="#eeeeee">&nbsp;</td>
                      <td bgcolor="#eeeeee">&nbsp;</td>

                      <td bgcolor="#eeeeee" align="right"><input name="action" type="submit" id="action" value="Delete client"> 
                        <br>
                        checked items</td>
                    </tr>
                    </table>
                    
<?php

}
?>
      </form>
      						</td>
                </tr>
              </table>
                  <!--end dynamic content -->
            Return to <a href="index.php">Group/Client List</a></td>
        </tr>
      </table>
      </td>
  </tr>
</table>
<?php include 'includes/foot.php'?>
