<?php include 'includes/constants.php'?>
<?php include 'includes/functions.php'?>
<?php include 'includes/database.php'?>
<?php include 'includes/authorize.php'?>
<?php include 'iniRoot.php'?>

<?php


if ($_POST['teacher_id'] != "") {
	// we've entered as admin
	$teacher = $_POST['teacher_id'];
} else {
	$teacher = $_COOKIE["user_id"];
}


$sql = "select id from users where user_id = '" . $teacher . "'";
$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	$theid = $row['id'];
}
	
if ($_REQUEST['h_current_day'] == "") {
	$current_day = (int) date('d', time());
} else {
	$current_day = $_REQUEST['h_current_day'];
}

if ($_REQUEST['h_month'] == "") {
	$month = (int) date('n', time());
} else {
	$month = $_REQUEST['h_month'];
}

if ($_REQUEST['h_year'] == "") {
	$year = (int) date('Y', time());
} else {
	$year = $_REQUEST['h_year'];
}

if (!function_exists('cal_days_in_month')) 
{ 
    function cal_days_in_month($calendar, $month, $year) 
    { 
        return date('t', mktime(0, 0, 0, $month, 1, $year)); 
    } 
} 
if (!defined('CAL_GREGORIAN')) 
    define('CAL_GREGORIAN', 1); 

$days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
$fromday = $year . "-" . $month . "-01";
$today = $year . "-" . $month . "-" . $days;
/*$sql = "select * from paysheet where day = '" . $fromday . "' and user_id = " . $theid;
$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$paysheet_id = $row['id'];
//print $paysheet_id;
if ($paysheet_id != "") {
	$disabled = "disabled";
	$msg = "The month you have selected has already been paid.<br>  You may not make modifications to this month.";
}*/


if ($_REQUEST['action'] == 'INSERT') {


	$sql = "insert into entry (user_id, group_id, day, concept_id, hours, observations, class_type, supplement_entry) values ";
	$sql .= "(" . $theid . ", " .$_REQUEST['assoc'] . ", '" . $year . "-" . $month . "-" . $current_day . "', " . $_REQUEST['concept'] . ", " . $_REQUEST['hours'] . ", '" . $_REQUEST['observations'] . "'," . $_REQUEST['class_type'] . " ," . $_REQUEST['supplement_entry'] . ")";
	
	
	
	mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
	//print $sql;
	//update the class type.
	$sql = "update groups set class_type = " . $_REQUEST['class_type'] . " where id = " . $_REQUEST['assoc'];
	mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
	
	//update the class length.
	$sql = "update userGroup set length = " . $_REQUEST['hours'] . " where group_id = " . $_REQUEST['assoc'];
	
	mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
}



if ($_REQUEST['action'] == 'DELETE') {
	$sql = "delete from entry where id = " . $_REQUEST['deleteid'];
	//print '###############'.$sql;
	mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
	
}

/*
$sql = "select a.end, b.id, a.name, class_type, length from groups a, userGroup b, users c ";
$sql = $sql . "where a.id = b.group_id and b.user_id = c.id and '". $year . "-" . $month . "-" . $current_day . "' >= b.start and ";
$sql = $sql . " (('". $year . "-" . $month . "-" . $current_day . "' <= b.end) or (b.end is null)) and a.end is null and c.user_id = '" . $teacher .  "' order by a.name";
*/

$sql = "select c.id, c.name, c.class_type, a.start, a.end from userGroup a, users b, groups c  where  a.user_id = b.id and  group_id = c.id and (a.end is null or a.end > '".date('Y')."-".date('m')."-".date('d')."') and b.user_id = '" . $teacher .  "' and c.baja = '0' and c.historical = '0' order by name";
				

//print $sql;
$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	if ($first_client == "") { //print '1';
		$first_client = $row['class_type'];
		$first_length = $row['length'];
		
	}
	if ($_REQUEST['assoc'] == $row['id']) { //print '2';
		$selected = "selected";
		$class_type = $row['class_type'];
		$class_length = $row['length'];
		//print '->('.$_POST['class_type'].')';
	} else {
		$selected = "";
	}
	$clients = $clients . "<option value='" . $row["id"] . "' " . $selected . " >" . $row["name"].  $row['end'] . "</option>";
	}
if ($class_type == "") { //print '3';
	$class_type = $first_client;
	$class_length = $first_length;
}


//################################################################################################################
//################################################################################################################

if ($clients == "") {//print '6';
	$disabled = "disabled";
	$msg = "You don't have any clients assiged for this date.<br>  Please contact an administrator.";
}

// check for holidays
$sql = "select id from holidays where day = '" . $year . "-" . $month . "-" . $current_day . "'";
$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
//print $sql;
if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	$msg .= "<br>The day you have selected is a holiday.<br>  Please double check that you taught a class on that day.";
}
	
if ($is_admin_a) {
	//$sql = "select * from concepts order by id";		//original, mayo 2009
	$sql = "select * from concepts where id not in (6, 7) order by id";		//no se utilizan concepts (6 y 7)
} else {
	$sql = "select * from concepts where is_admin = 0 order by id";
}
$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    if ($_POST['concept'] == $row["id"])	{
											$selected  = "selected";
										} else {
											$selected  = "";
										}
	$concepts = $concepts . "<option value='" . $row["id"] . "' " . $selected . ">" . $row["concept"]. "</option>";
}

$bg = "#FFFFFF";
$sql = "select a.id, c.name, a.observations, a.hours, d.concept, a.supplement_entry from entry a, users b, groups c, concepts d  where  a.user_id = b.id and a.group_id = c.id and a.concept_id = d.id and b.user_id = '" . $teacher .  "' and day = '" . $year . "-" . $month . "-" . $current_day . "' order by name";

$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	if ($bg == "#FFFFFF") {
		$bg = "#B6C5F2";
	} else {
		$bg = "#FFFFFF";
	}
	
	$entries = $entries . "<tr bgcolor='" . $bg . "' style='cursor:pointer'>";
	$entries = $entries . "<td onClick=\"javascript:details(" . $row['id'] . ");\">&nbsp;</td>";
	$entries = $entries . "<td onClick=\"javascript:details(" . $row['id'] . ");\" align=\"center\">" . $row['hours'] . "</td>";
	$entries = $entries . "<td onClick=\"javascript:details(" . $row['id'] . ");\">&nbsp;</td>";
	$entries = $entries . "<td onClick=\"javascript:details(" . $row['id'] . ");\">" . $row['name'] . "</td>";
	$entries = $entries . "<td onClick=\"javascript:details(" . $row['id'] . ");\">&nbsp;</td>";
	$entries = $entries . "<td onClick=\"javascript:details(" . $row['id'] . ");\">" . $row['concept'] . "</td>";
	$entries = $entries . "<td onClick=\"javascript:details(" . $row['id'] . ");\">&nbsp;</td>";
	$entries = $entries . "<td onClick=\"javascript:details(" . $row['id'] . ");\">" . $row['observations'] . "</td>";
	$entries = $entries . "<td onClick=\"javascript:details(" . $row['id'] . ");\">&nbsp;</td>";
	$entries = $entries . "<td onClick=\"javascript:details(" . $row['id'] . ");\">" . $row['supplement_entry'] * 0.025. "</td>";
	if ($paysheet_id == "") {
		$entries = $entries . "<td><a href=\"javascript:remove(" .$row['id'] . ");\"><b>X</b></a></td>";
	} else {
		$entries = $entries . "<td></td>";
	}
	$entries = $entries . "</tr>";
}

$entries_exist = true;
if ($entries == "") {
	$entries_exist = false;
	$entries = "There are no entries for the selected date.";
}



$days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
$spelled = date('F', strtotime($year . '-' . $month . '-' . 1));
$day = date('l', strtotime($year . '-' . $month . '-' . $current_day));


	if (date('D', strtotime($year . '-' . $month . '-' . 1)) == "Mon") {
		$offset = 0;
	} elseif (date('D', strtotime($year . '-' . $month . '-' . 1)) == "Tue") {
		$offset = 1;
	} elseif (date('D', strtotime($year . '-' . $month . '-' . 1)) == "Wed") {
		$offset = 2;
	} elseif (date('D', strtotime($year . '-' . $month . '-' . 1)) == "Thu") {
		$offset = 3;
	} elseif (date('D', strtotime($year . '-' . $month . '-' . 1)) == "Fri") {
		$offset = 4;
	} elseif (date('D', strtotime($year . '-' . $month . '-' . 1)) == "Sat") {
		$offset = 5;
	} elseif (date('D', strtotime($year . '-' . $month . '-' . 1)) == "Sun") {
		$offset = 6;
	}
	
	if (date('D', strtotime($year . '-' . $month . '-' . $days)) == "Mon") {
		$backset = 6;
	} elseif (date('D', strtotime($year . '-' . $month . '-' . $days)) == "Tue") {
		$backset = 5;
	} elseif (date('D', strtotime($year . '-' . $month . '-' . $days)) == "Wed") {
		$backset = 4;
	} elseif (date('D', strtotime($year . '-' . $month . '-' . $days)) == "Thu") {
		$backset = 3;
	} elseif (date('D', strtotime($year . '-' . $month . '-' . $days)) == "Fri") {
		$backset = 2;
	} elseif (date('D', strtotime($year . '-' . $month . '-' . $days)) == "Sat") {
		$backset = 1;
	} elseif (date('D', strtotime($year . '-' . $month . '-' . $days)) == "Sun") {
		$backset = 0;
	}
	
	$cal = $cal . "<tr align=\"center\">";
	for ($j = 0; $j < $offset; $j++) {
		$cal = $cal . "<td width=\"40\" height=\"40\" bgcolor=\"#BBBBBB\">&nbsp;</td>";
	}
	
	for ($j = 0; $j < $days; $j++) {
		if (($j+ $offset) % 7 == 0) {
			$cal = $cal . "</tr>";
			$cal = $cal . "<tr align=\"center\">";
		}
		
		if (date('D', strtotime($year . '-' . $month . '-' . ($j + 1))) == "Sat") {
			$color = "#738FE6";
		} elseif (date('D', strtotime($year . '-' . $month . '-' . ($j + 1))) == "Sun") {
			$color = "#738FE6";
		} else {
			// paint holidays different
			$sql = "select id from holidays where day = '" . $year . '-' . $month . '-' . ($j + 1) . "'";
			$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
			if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$color = "#ff9900";
			} else {
				$color = "#B6C5F2";
			}	
		}
		
		$sql = "select id from entry where day = '" . $year . '-' . $month . '-' . ($j + 1) . "' and user_id = " . $theid;
		//print $sql;
		$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
		if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$color = "#FFE6BF";
		}
		
		$selectedcolor = "ffffff";
		if (($year . '-' . $month . '-' . ($j + 1)) == ($year . '-' . $month . '-' . $current_day)) {
			$cal = $cal . "<td width=\"40\" height=\"40\" class=\"textB\" bordercolor=\"#ff9900\" onClick=\"javascript:day(" . ($j + 1) . ");\" style=\"cursor:pointer\" bgcolor=\"" . $selectedcolor . "\"><b>" . ($j + 1) . "</b></td>";
		} else {
			$cal = $cal . "<td width=\"40\" height=\"40\" class=\"textB\" onClick=\"javascript:day(" . ($j + 1) . ");\" style=\"cursor:pointer\" bgcolor=\"" . $color . "\">" . ($j + 1) . "</td>";
		}
	}
	
	
	for ($j = 1; $j <= $backset; $j++) {
		$cal = $cal . "<td width=\"40\" height=\"40\" bgcolor=\"#BBBBBB\">&nbsp;</td>";
	}
	$cal = $cal . "</tr>";

//**************************************************
$sql = "select id, first, user_id from users where is_active = 1 and baja=0 order by first";
$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
$teachers .= "<option value='0'>Select teacher....</option>";
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	if ($_POST['teacher_id'] == $row['user_id']) {
		$selected = "selected";
	} else {
		$selected = "";
	}
	
	$teachers .= "<option " . $selected . " value='" . $row['user_id'] . "'>" . $row['first'] . "</option>";
}



$page_name = "main";
?>


<?php include 'includes/top.php'?>
<h1 align="center">
     My Hours</h1>

<div style="position: relative;" align="center">  


<table class="pepe1" border="0" cellpadding="10" width="1000" height="500" cellspacing="0" id="body" align="center" bgcolor="#eeeeee">
						<tr><td>
							<script>
							function newAjax(){
   									 var xmlhttp=false;
    									try {
    										xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    															} catch (e) {
    										try {
												xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
												} catch (E) {
												xmlhttp = false;
												}
												}
											 
												if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
												xmlhttp = new XMLHttpRequest();
										}
										
										
		function class_type(id){
			
			 
			if (id != null){
   			 oAjax=newAjax();
         oAjax.open("POST", "class.bills.php?valor1="+v1+"&valor2="+v2+"&valor3="+v3,false);
					//ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
                  oAjax.send(null);
                  decode =oAjax.responseText;
 				
				return decode;}else return 0;
			}
							return xmlhttp;
							} 
								function day(d) {
									var h_current_day = document.getElementById("h_current_day");
									var action = document.getElementById("action");
									h_current_day.value = d;
									action.value="SELECT";
									document.forms.myform.submit();
								}
								
								function selTeacher(d) {
									var action = document.getElementById("action");
									action.value="SELECT_TEACHER";
									document.forms.myform.submit();
								}
								
								function details(id) {
									window.open("details.php?id=" + id, "Details", "width=400, height=300, location=no, menubar=no, status=no, toolbar=no, scrollbars=auto, resizable=no");
								}
								
								function paysheet(user_id, fromday, today) {
									window.open("preview.php?teacher_id=" + user_id + "&fromday=" + fromday + "&today=" + today, "Paysheet", "width=800, height=600, location=no, menubar=no, status=no, toolbar=no, scrollbars=yes, resizable=yes");
								}
								
								function remove(id) {
									var confirmed = false;
									confirmed = confirm("Are you sure you want to delete this entry?");
									if (confirmed) {
										var action = document.getElementById("action");
										var deleteid = document.getElementById("deleteid");
										action.value="DELETE";
										deleteid.value=id;
										document.forms.myform.submit();
									}
								}
								
								function isNumeric(sText) {
								   var ValidChars = "0123456789.";
								   var IsNumber=true;
								   var Char;
								
								 
								   for (i = 0; i < sText.length && IsNumber == true; i++) { 
								      Char = sText.charAt(i); 
								      if (ValidChars.indexOf(Char) == -1) {
								         IsNumber = false;
								      }
								   }
								   return IsNumber;
								}

								function validate() {
									var msg = "";								
																		
									var hours = document.getElementById("hours").value;
									if ((hours == "") || (! isNumeric(hours))) {
										msg = msg + "You must enter a number for your hours.\n";
									}
									
									if (hours == "0") {
										msg = msg + "Your hours cannot be 0.\n";
									}
									
									var type = document.getElementById("class_type").value;
									if (type == 0) {
										msg = msg + "You must select a class type for this class.\n";
									}
									
									var obs = document.getElementById("observations").value;
									var concept = document.getElementById("concept").value;
									if ((obs == "") && (concept != 1)) {
										msg = msg + "You must enter an observation for this concept.\n";
									}									
									
									
									if (msg != "") {
										alert(msg);
										return false;
									} else {
										return true;
									}
								}
									
								
								function yearBack() {
									var year = document.getElementById("h_year");
									var action = document.getElementById("action");
									action.value="SCROLL";
									year.value = year.value - 1;
									document.forms.myform.submit();
								}
								
								function yearForward() {
									var year = document.getElementById("h_year");
									var action = document.getElementById("action");
									action.value="SCROLL";
									year.value = year.value - 0 + 1;
									document.forms.myform.submit();
								}
								
								function monthBack() {
									var month = document.getElementById("h_month");
									var year = document.getElementById("h_year");
									var action = document.getElementById("action");
									action.value="SCROLL";
										
									if (parseInt(month.value) == 1) {

										month.value = 12;
										year.value = year.value - 0 - 1;
									} else {
										month.value = month.value - 0 - 1;
									}

									document.forms.myform.submit();
								}
								
								function monthForward() {
									var month = document.getElementById("h_month");
									var year = document.getElementById("h_year");
									var action = document.getElementById("action");
									action.value="SCROLL";
									
									if (parseInt(month.value) > 11) {

										month.value = 1;
										year.value = year.value - 0 + 1;
									} else {

										month.value = month.value - 0 + 1;
									}
									document.forms.myform.submit();
								}
								
								function selClient() {
									var action = document.getElementById("action");
									action.value="SELECT_CLIENT";
									document.forms.myform.submit();
								}
							</script>
							<form method="post" name="myform" onSubmit="return validate();">
							<?php 
							
							if ($is_admin_a) {
								
							?>
							
							<select name="teacher_id" onChange="javascript:selTeacher(this)"><?php echo  $teachers; ?></select><br>
							
							<?php
							}
							?>
							
							<b><font color='#ff9900'><?php echo  $msg ?></font></b>
							<input type="hidden" id="h_current_day" name="h_current_day" value="<?php echo $current_day?>">
							<input type="hidden" id="h_month" name="h_month" value="<?php echo $month?>">
							<input type="hidden" id="h_year" name="h_year" value="<?php echo $year?>">
							<input type="hidden" name="action" id="action" value="INSERT">
							<input type="hidden" name="deleteid" id="deleteid" value="">
							<!--calendar-->
							<table width="100%" cellspacing="5">
							 <tr bgcolor="#eeeeee" align="center">
									<td width="40" height="5"><a href="javascript:yearBack();" class="textB"><b><<</b></a></td>
									<td width="40" ><a href="javascript:monthBack();" class="textB"><b><</b></a></td>
									<td colspan="3" align="center"><font size="2"><?php echo  $spelled . " " . $year?></font></td>
									<td width="40" ><a href="javascript:monthForward();" class="textB"><b>></b></a></td>
									<td width="40" ><a href="javascript:yearForward();" class="textB"><b>> ></b></a></td>
								</tr>
								<tr bgcolor="#eeeeee" align="center">
									<td width="40" height="5">Mon.</td>
									<td width="40" >Tues.</td>
									<td width="40" >Wed.</td>
									<td width="40" >Thur.</td>
									<td width="40" >Fri.</td>
									<td width="40" >Sat.</td>
									<td width="40" >Sun.</td>
								</tr>
							</table>
							
							<table width="100%" cellspacing="5" border="1" bordercolor="172244" bgcolor="DDDDDD" >
								<?php echo $cal; ?>
							</table>
						</td>
						<td  valign="bottom">
							<table width="100%" cellpadding="4" cellspacing="0" border="0" bgcolor="B6C5F2">
								<tr bgcolor="0033CC">
									<td colspan="2" class="textW" height="10">
										<b>Input hours for <?php echo $day . ", " . $spelled . " " . $current_day?></b>
									</td>
								</tr>
								<tr>
									<td height="6" colspan="2" bgcolor="FFFFFF">
									</td>
								</tr>
								<tr>
									<td>Client:</td>
									<td>
                                   					<select name="assoc" <?php echo $disabled?> onChange="javascript:selClient();">
											<?php echo  $clients; ?>
										</select>	
									</td>
								</tr>
								<tr>
									<td id="class type">Class type:</td>
                                  
                                   		
									<?php 
									
									switch ($class_type) {
											case 1:
												$selected  = "Individual";
												break;
											case 2:
											    $selected  = "Group Class I(2-3 adults/kids diff fam)";
												break;
											case 3:
											    $selected  = "Group Class II (4 adults/kids diff fam)";
												break;
												default:
        										$selected  = "No defined yet...";
									}
										
								?>
                               <td><fieldset> <input name="class type" type="hidden" value=<?php echo $class_type;?> />
                               
                               <label title="Class type" for="class type"><b><?php echo $selected;?></b></label></fieldset></td>
                               </tr>
								<tr>
									<td>Concept:</td>
									<td>
										<select id="concept" name="concept" <?php echo $disabled?>>
											<?php echo  $concepts; ?>
										</select>	
									</td>
								</tr>
								<tr>
									<td>Hours: </td>
									<td>
									    
										<select id="hours" name="hours" <?php echo $disabled?>>
										<?php
									   
									   //JBT
									   if ($_REQUEST['action'] == 'SELECT') {
									    $class_length=$_POST['hours'];
										}
									   ///
									   
										for ($i = 1; $i <=3; $i += .25) {
											if ($class_length == $i) {
											//if ($_POST['hours'] == $i) {
												$selected = "selected";
											} else {
												$selected = "";
											}
											print "<option value=\"" . $i . "\" " . $selected . ">" . $i . " hours</option>";
										}
										
											?>
										</select>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										Observations:<br>
										<textarea cols="30" rows="4" id="observations" name="observations" <?php echo $disabled?>></textarea>
									</td>
								</tr>
                                <tr>
									<td colspan="2">
										Photocopies:<br>
									
                                    <select id="supplement_entry" name="supplement_entry" <?php echo $disabled?>>
										<?php
									   
									 
									   
										for ($i = 0; $i <=30; $i++) {
											
											print "<option value=\"" . $i . "\" " . $selected . ">" . $i . " copy</option>";
										}
										
											?>
										</select>
                                    
                                   
									</td>
								</tr>
								<tr>
									<td colspan="2" align="right">
										<input type="submit" class="submit-button" value="Input" <?php echo $disabled?>>
									</td>
								</tr>
							</table>
						</td>
						</tr>
						<tr>
						<td>
							<table align="right">
								<tr>
									<td>Inputted Day:</td>
									<td><table width="15" bgcolor="FFE6BF"><tr height="10"><td></td></tr></table></td>
									<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
									<td>Weekday:</td>
									<td><table width="15" bgcolor="B6C5F2"><tr height="10"><td></td></tr></table></td>
									<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
									<td>Weekend:</td>
									<td><table width="15" bgcolor="738FE6"><tr height="10"><td></td></tr></table></td>
									<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
									<td>Holiday:</td>
									<td><table width="15" bgcolor="ff9900"><tr height="10"><td></td></tr></table></td>
							 	</tr>
							</table>
						</td>
						<td>Click here for <b><a href="javascript:paysheet(<?php echo $theid?>,'<?php echo $fromday?>','<?php echo $today?>');">Paysheet Preview</a></b></td>				
						</tr>
						<tr bgcolor="0033CC">
							<td colspan="2" class="textW" height="10">
								<b>Hours already inputted for <?php echo  $day . ", " . $spelled . " " . $current_day?></b>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<?php
									if ($entries_exist) {
								?>
								<table cellspacing="0" width="100%">
									<tr>
										<td class="heading">&nbsp;</td>
										<td class="heading" width="10" align="center">Hours</td>
										<td class="heading">&nbsp;</td>
										<td class="heading">Client</td>
										<td class="heading">&nbsp;</td>
										<td class="heading">Concept</td>
										<td class="heading">&nbsp;</td>
										<td class="heading">Observations</td>
										<td class="heading">&nbsp;</td>
                                        <td class="heading">Supplements</td>
										<td class="heading">&nbsp;</td>
									</tr>
									
								<?php } ?>
								
								<?php echo  $entries; ?>
									
								<?php
									if ($entries_exist) {
								?>
								
									</table>
								
								<?php } ?>
							</td> 
						</tr>
					</table>
                     </div>  
       
         
            <br /><br />
            <table with="100%" class="pepe1" border="0" align="center">

  <tr>
      <td bordercolor="#000000">
      <p><strong><font COLOR=red>
            The Basics: My Hours Input<br /><br /> </font></strong>
             <strong><font COLOR=blue>
1. Teacher Cancellation</br>

- You cancel class, student is not required to do a makeup (try anyway)</br></br>

2. Late Student Cancellation (student cancels on class day)</br>

- You are paid (occasionally there are exceptions)</br>

- No makeup necessary (but preferable unless they do it often)</br></br>

3. Student Cancellation (up to 10 pm night before)</br>

- Student has 1 month to makeup the class.</br>

- You are paid after class is made up.</br></br>

4. How to Input a Student Cancellation (SC)</br>

- In Class Record, input: Student Cancellation (Only if not made up by end 

of month)</br></br>

5. Makeup Class: 2 kinds: </br></br>

a) Makeup Class 1, SAME Month: A student (or you) cancels a class and 

you make it up with the student sometime during the SAME month. In 

My Hours you input the class in Class Record as Class Taught (class date 

taught), i.e. the day that the class was scheduled to take place (this avoids 

confusion on pay day.)</br> </br>

b) Makeup Class 2, FOLLOWING Month: A student (or you) cancels 

a class and you make it up with the student sometime during the 

FOLLOWING month. In My Hours, you input the class in Class Record as 

Student Cancellation (the day that it was cancelled.) The next month, after 

it is made up, you input the class in My Hours as Makeup Class Taught.</br></br> 

6. How to Input a Makeup Class Done in Half or Quarter Hours.
- When a class is finally made up (E.g. You have finished the last half or quarter of the class), then you enter it as a whole class as a:</br></br>

a) Class Taught: On the day that the class was scheduled to take place (If in SAME month.)</br></br>

b) Makeup Class Taught: On the actual day you finished the last half or quarter of the class (If in the FOLLOWING month.) Don't forget that in this case, the original class that was cancelled needs to be inputted as a Student Cancellation.
     </font></strong></p></td>
  </tr>
 
</table>
         
					</form>
<?php //include 'foot.php'?>
<?php 
include 'includes/foot.php'?>
