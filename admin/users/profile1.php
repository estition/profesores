<strong></strong><?php require_once('calendar/tc_calendar.php'); 
?>


	 

<head>
<script src="../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />

<script language="javascript" src="calendar/calendar.js"></script>
<link href="calendar/calendar.css" rel="stylesheet" type="text/css">
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
</head>
<?php include '../../includes/constants.php'?>
<?php include '../../includes/functions.php'?>
<?php include '../../includes/database.php'?>
<?php include '../../includes/authorize.php'?>
<?php include '../../iniRoot.php';?>
<?php include '../../includes/top.php'?>
<?php

$message = "";


$first = $_POST["first"];
$selected = $_POST["my-select1"];

$user_id = $_POST["user_id"];
$password = $_POST["password"];
$changePassword = $_POST["changePassword"];
$has_privileges = $_POST["has_privileges"];
$is_admin = $_POST["is_admin"];
$is_active = $_POST["is_active"];
$telephone1= $_POST["telephone1"];
$mobile = $_POST["mobile"];
$email = $_POST["email"];
	$spanish_level = $_POST["spanish_level"];	 	 	 	 	 	 	 
	$preferences = $_POST["preferences"];		 	 	 	 	 	 	 
	$metro = $_POST["metro"];		 	 	 	 	 	 	 
	
	$startdate = $_POST["startdate"];		 	 	 	 	 	
	$enddate = $_POST["enddate"]; 
	

if ($_REQUEST['id'] == "") {
	/* NEW PROFILE */

	$mode = "New User";
	if ($_POST['action'] == "Save Changes") {
		
		if (strlen($user_id) < 5) {
			$message = $message . "The user id must be at least 5 characters.";
		}
		
		if (strpos($user_id, " ") ) {
			$message = $message . "The user id may not contain spaces.";
		}
		
		if (strlen($password) < 5) {
			$message = $message . "The password must be at least 5 characters.";
		}
		
		if (strpos($password, " ") ) {
			$message = $message . "The password may not contain spaces.";
		}
		
		$sql = "select * from users where user_id = '" . $_POST['user_id'] . "'";
		$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
		if (mysql_num_rows($result) > 0) {
			$message = $message . "The user name you have selected is in use.";
		}
				
		if ($message == "") {
			
			$selected = $_POST["my-select1"];
			//print_r($selected);
			//echo $_POST["my-select"]."MMM";
			//$selected = explode(",", $selected);
	//sanitize post value, PHP filter FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH Strip tags, encode special characters.
	//$contentToSave = filter_var($_POST["content_txt"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH); 
	//$id = filter_var($_POST["content_id"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
	//echo $id."pepe";
	//echo $contentToSave."PEPE2";
	// Insert sanitize string in record
	//print_r($contentToSave."DDDD");
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
    case "4":
	$tag4[]  = $tag;
	break;
	   case "5": 
	$tag5[] = $tag;
	 break;
	 case "6": 
	$tag6[]  = $tag;
	 break;
	  case "7": 
	$tag7[] = $tag;
	 break;
	
			}

           }
        echo '</p>';
		//print_r($_POST['my-select']);
		if (empty($tag1)) {$tag1[] = " ";} 
		if (empty($tag2)) {$tag2[] = " ";} 
		if (empty($tag3)) {$tag3[] = " ";} 
		if (empty($tag4)) {$tag4[] = " ";} 
		if (empty($tag5)) {$tag5[] = " ";} 
		if (empty($tag6)) {$tag6[] = " ";} 
	    if (empty($tag7)) {$tag7[] = " ";} 
		
		$tag1 = implode(",",$tag1);
		$tag2 = implode(",",$tag2); 
		$tag3 = implode(",",$tag3); 
		$tag4 = implode(",",$tag4); 
		$tag5 = implode(",",$tag5); 
		$tag6 = implode(",",$tag6);
		$tag7 = implode(",",$tag7); 
	
			
			
			
			
			
			
			
			$sql = "insert into users (user_id, password, is_admin, is_active, changePassword, first, country, mobile, email,  CURRICULUM, spanish_level,  metro, startdate, enddate, ZONES, CERTIFICATION, CLASS_TYPE, GENDER,  AVAILABILITY) values";
			$sql = $sql . "('" . escape($_POST['user_id']) . "', '" . escape($_POST['password']) . "', ";
			$sql = $sql . $_POST['is_admin']. ", " . $_POST['is_active']. ", " . $_POST['changePassword'];
			$sql = $sql . ", '" . escape($_POST['first']) ."'";
			$sql = $sql . ", '" . escape($tag7) ."'";
			//$sql = $sql . ", '" . escape($_POST['telephone1']) ."'";
			$sql = $sql . ", '" . escape($_POST['mobile'])."'"; 
			$sql = $sql . ", '" . escape($_POST['email']) ."'"; 
			
			
			
			
			$sql = $sql . ", '" .escape($_POST['experience']) . "', '" . escape($tag6)."'";
			$sql = $sql . ", '" .escape($_POST['metro'])."'";
			//$sql = $sql . ", '" . escape($_POST['july']) . "', '" . escape($_POST['august'])."'";
			$sql = $sql . ", '" . escape($_POST['startdate'])."'";
			$sql = $sql . ", '" . escape($_POST['enddate'])."'";
	$sql = $sql . ", '" . escape($tag1)."'";		
	$sql = $sql . ", '" . escape($tag2)."'";	
	$sql = $sql . ", '" . escape($tag3)."'"; 	
	$sql = $sql . ", '" . escape($tag4)."'";	
	$sql = $sql . ", '" . escape($tag5)."')"; 	
		
	

			//print $sql;
			mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
			$id = mysql_insert_id();	

			$message = "User Profile Saved.";
		}
	}
} else {
	$mode = "Edit User";
}

if ($id == "") {
	$id = $_REQUEST['id'];
}

if ($id != "" && $_POST['action'] == "Save Changes") {
/* EDIT EXISTING PROFILE */

	if (strlen($password) < 5) {
		$message = $message . "The password must be at least 5 characters.";
	}
	
	if (strpos($password, " ") ) {
		$message = $message . "The password may not contain spaces.";
	}
	
	
	if ($message == "") {
		
		$selected = $_POST["my-select1"];
			//print_r($selected);
			//echo $_POST["my-select"]."MMM";
			//$selected = explode(",", $selected);
	//sanitize post value, PHP filter FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH Strip tags, encode special characters.
	//$contentToSave = filter_var($_POST["content_txt"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH); 
	//$id = filter_var($_POST["content_id"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
	//echo $id."pepe";
	//echo $contentToSave."PEPE2";
	// Insert sanitize string in record
	//print_r($contentToSave."DDDD");
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
    case "4":
	$tag4[]  = $tag;
	break;
	   case "5": 
	$tag5[] = $tag;
	 break;
	 case "6": 
	$tag6[]  = $tag;
	 break;
	  case "7": 
	$tag7[] = $tag;
	 break;
	
			}

           }
        echo '</p>';
		//print_r($_POST['my-select']);
		if (empty($tag1)) {$tag1[] = " ";} 
		if (empty($tag2)) {$tag2[] = " ";} 
		if (empty($tag3)) {$tag3[] = " ";} 
		if (empty($tag4)) {$tag4[] = " ";} 
		if (empty($tag5)) {$tag5[] = " ";} 
		if (empty($tag6)) {$tag6[] = " ";} 
	    if (empty($tag7)) {$tag7[] = " ";} 
		
		$tag1 = implode(",",$tag1);
		$tag2 = implode(",",$tag2); 
		$tag3 = implode(",",$tag3); 
		$tag4 = implode(",",$tag4); 
		$tag5 = implode(",",$tag5); 
		$tag6 = implode(",",$tag6);
		$tag7 = implode(",",$tag7); 
	
			
			
			
			
		$sql = "update users set password = '" . escape($_POST['password']) . "'"; 
		$sql = $sql . ", is_admin = " . $_POST['is_admin'] . ", is_active = " . $_POST['is_active'] . ", changePassword = " . $_POST['changePassword'] . ", first = '" . escape($_POST['first']) . "'";
		$sql = $sql . ", country = '" . $tag7  . "' ";
		$sql = $sql . ",  mobile = '" . $_POST['mobile'] . "' ";
		$sql = $sql . ", email = '" . $_POST['email']. "' ";
		
		$sql = $sql . ", CURRICULUM = '" . $_POST['experience'] . "'";
		$sql = $sql . ", spanish_level = '" . $tag6 . "' ";
		$sql = $sql . ", metro = '" . $_POST['metro'] . "', AVAILABILITY = '" . $tag5 . "' ";
		$sql = $sql . ", ZONES = '" . $tag1 . "', startdate = '" . $_POST['startdate'] . "' ";
		$sql = $sql . ", enddate = '" . $_POST['enddate']. "' ";
		$sql = $sql . ", CERTIFICATION = '" . $tag2. "' ";
		$sql = $sql . ", CLASS_TYPE = '" . $tag3. "' ";
		$sql = $sql . ", GENDER = '" . $tag4. "' ";
		
		
		
			$sql = $sql . ", user_id = '" . escape($_POST['user_id']) . "' where id = " . $id;
		
		
		//print $sql;
		mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
		$message = "User Profile Saved.";
	}
}


if (($id != "") && (($message == "User Profile Saved.") || ($message == ""))) {
	$sql = "select * from users where id = " . $id;
	$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
	if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$first =  stripslashes($row["first"]);

		$user_id =  stripslashes($row["user_id"]);
		$password =  stripslashes($row["password"]);
		$is_admin = $row["is_admin"];
		$is_active = $row["is_active"];
		$changePassword = $row["changePassword"];
		$country = $row["country"];
		//$telephone1 = $row["telephone1"];
		//$telephone2 = $row["telephone2"];
		$mobile = $row["mobile"];
		$email = $row["email"];
		//$address1 = $row["address1"];
		//$address2 = $row["address2"];
		//$city = $row["city"];
		//$state = $row["state"];
		//$zip = $row["zip"];
		$experience = $row["CURRICULUM"];			 	 	 				 
		 	 	 	 	 	 	 
	$spanish_level = $row["spanish_level"];	 	 	 	 	 	 	 
	//$preferences = $row["preferences"];		 	 	 	 	 	 	 
	$metro = $row["metro"];		 	 	 	 	 	 	 
		 	 	 	 	 	 	
	$startdate = $row["startdate"];		 	 	 	 	 	
	$enddate = $row["enddate"];
	$zones = $row["ZONES"];	 	 	 	 	 	 	
	$certification = $row["CERTIFICATION"]; 
	$class_type = $row["CLASS_TYPE"];
	$gender = $row["GENDER"];
	$availability = $row["AVAILABILITY"];	 	 				 
				 	 	 	 	 	 	 
	 	 	 	 	
	
	} 
}
	
?>


<div style="position: relative;" align="right">  
</div>  
<p><b>Teacher Profile &#8211; <?php echo  $mode; ?> &#8211; <font color='#ff9900'><?php echo  $message ?></font></b></p>
      <table width="2000" align="center" border="0" class="pepe4" cellpadding="0" cellspacing="0" id="body">
        <tr> 
          <td width="2000" valign="top"> 
            <!--start dynamic code -->
            <form action="profile.php" name="associate" id="associate" method="post">
            	<input type="hidden" name="id" value="<?php echo $id;?>">
              <table border="0" align="center" class="pepe4" cellpadding="0" cellspacing="0" id="shell">
              
                <tr valign="top"> 
                 
                  <td bgcolor="#FFFFFF"> <table border="0"  class="pepe4"align="center" cellpadding="5" cellspacing="0" bgcolor="#cccccc" id="login">
                      <tr> 
                        <td colspan="2" valign="top"><b>Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b>
                          
                          
                          
                          <span id="sprytextfield1">
                            <input name="first" type="text" value="<?php echo  $first;?>"  size="45">
                            <span class="textfieldRequiredMsg">A value is required.</span></span>                        </td>
                        </tr>

                     
                      <tr> 
                        <td colspan="2" valign="top"><b>User ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b><span id="sprytextfield3">
                          <input name="user_id" type="text" value="<?php echo  $user_id;?>" size="45" />
                          <span class="textfieldRequiredMsg">A value is required.</span></span><i>no spaces, min 5 characters</i></td>
                        </tr>
                			<tr> 
                        <td colspan="2" valign="top"><b>Password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b><span id="sprytextfield4">
                          <input name="password" type="text" value="<?php echo $password;?>" size="45" />
                          <span class="textfieldRequiredMsg">A value is required.</span></span><i>no spaces, min 5 characters</i></td>
                        </tr>
                     
                      <tr> 
                        <td colspan="2" valign="top"><b>Phone&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b><span id="sprytextfield6">
                          <input name="mobile" type="text" value="<?php echo  $mobile;?>" size="45" />
                          <span class="textfieldRequiredMsg">A value is required.</span></span></td></tr><tr> <td colspan="2" valign="top"><b>Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b><span id="sprytextfield7">
                            <input name="email" type="text" value="<?php echo  $email;?>" size="45" />
                            <span class="textfieldRequiredMsg">A value is required.</span></span></td></tr><tr> <td colspan="2" valign="top"><b>Metro&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b><span id="sprytextfield8">                         <input name="metro" type="text" value="<?php echo  $metro;?>" size="45" ><span class="textfieldRequiredMsg">A value is required.</span></span></td>
                      </tr>
                      <tr><td colspan="2"><head>
                        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
                        
                        <link href="css/multi-select.css" media="screen" rel="stylesheet" type="text/css">
                        
                        
                        
                        <div>
                       <?php 
function is_selected1($arg, $arg2) {
   
   
   $arg2 = explode(",", $arg2);

	   foreach($arg2 as $arg1){
		 
	    if($arg == $arg1) { 
      echo ' selected="selected"'; 
	  }
   }

} 



?>

  
   
                          <select multiple="multiple" id="my-select" name="my-select1[]">
                            <optgroup label='ZONES'>
                              <option value="1.7N" <?php is_selected1('7N', $zones); ?> >7N (L7 North)</option>
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
                              <option value="1.12SE"<?php is_selected1('12SE', $zones); ?>>12SE (L12 South East)</option>
                              <option value="1.12SW"<?php is_selected1('12SW', $zones); ?>>12SW (L12 South West)</option>
                              <option value="1.ML2"<?php is_selected1('ML2', $zones); ?>>ML2 (Metro Ligero 2)</option>
                              <option value="1.ML3"<?php is_selected1('ML3', $zones); ?>>ML3 (Metro Ligero 3)</option>
                              <option value="1.A"<?php is_selected1('A', $zones); ?>>A (Aravaca)</option>
                              </optgroup>
                            
                            <optgroup label='Certification'>
                              <option value='2.TE'<?php is_selected1('TE', $certification); ?>>TE</option>
                              <option value='2.CE-TEFL'<?php is_selected1('CE-TEFL', $certification); ?>>CE-TEFL</option>
                              <option value='2.CELTA'<?php is_selected1('CELTA', $certification); ?>>CELTA</option>
                              <option value='2.TEFL'<?php is_selected1('TEFL', $certification); ?>>TEFL</option>
                              <option value='2.TESOL'<?php is_selected1('TESOL', $certification); ?>>TESOL</option>
                              </optgroup>
                            
                            <optgroup label='Class type'>
                              <option value='3.Company'<?php is_selected1('Company', $class_type); ?>>Company</option>
                              <option value='3.Kids'<?php is_selected1('Kids', $class_type); ?>>Kids</option>
                              <option value='3.Teenagers'<?php is_selected1('Teenagers', $class_type); ?>>Teenagers</option>
                              <option value='3.Adults'<?php is_selected1('Adults', $class_type); ?>>Adults</option>
                              </optgroup>
                            <optgroup label='Gender'>
                              <option value='4.Female'<?php is_selected1('Female', $gender); ?>>Female</option>
                              <option value='4.Male'<?php is_selected1('Male', $gender); ?>>Male</option>
                              </optgroup>
                            
                             <optgroup label='AVAILABILITY'>
                              <option value='5.FEBRAURY'<?php is_selected1('FEBRAURY', $availability); ?>>FEBRAURY</option>
                              <option value='5.MAY'<?php is_selected1('MAY', $availability); ?>>MAY</option>
                              <option value='5.JUNE'<?php is_selected1('JUNE', $availability); ?>>JUNE</option>
                              <option value='5.JULY'<?php is_selected1('JULY', $availability); ?>>JULY</option>
                              <option value='5.AUGUST'<?php is_selected1('AUGUST', $availability); ?>>AUGUST</option>
                              <option value='5.DECEMBER'<?php is_selected1('DECEMBER', $availability); ?>>DECEMBER</option>
                              </optgroup>
                          
                            
                            <optgroup label='Spanish'>
                              <option value='6.Low'<?php is_selected1('Low', $spanish_level); ?>>Low</option>
                              <option value='6.Intermediate'<?php is_selected1('Intermediate', $spanish_level); ?>>Intermediate</option>
                              <option value='6.High'<?php is_selected1('High', $spanish_level); ?>>High</option>
                              <option value='6.Bilingual-Native'<?php is_selected1('Bilingual-Native', $spanish_level); ?>>Bilingual-Native</option>
                              
                              </optgroup>
                              
                                  
                                <optgroup label='country'>
                              <option value='7.USA'<?php is_selected1('USA', $country); ?>>USA</option>
                              <option value='7.UK'<?php is_selected1('UK', $country); ?>>UK</option>
                              <option value='7.IRLAND'<?php is_selected1('IRLAND', $country); ?>>IRLAND</option>
                              <option value='7.AUSTRALIA'<?php is_selected1('AUSTRALIA', $country); ?>>AUSTRALIA</option>
                              <option value='7.MEXICO'<?php is_selected1('MEXICO', $country); ?>>MEXICO</option>
                              <option value='7.OTHER'<?php is_selected1('OTHER', $country); ?>>OTHER</option>
                              </optgroup>
                            
                              
                            </select>
                          
                                                
                          
                          
                          <script src="js/jquery.multi-select.js" type="text/javascript"></script>
                          
                          
                          
                          <script  type="text/javascript">
		 jQuery.noConflict();  
		
		(function($){
      jQuery('#my-select').multiSelect({ selectableOptgroup: true });
	})(jQuery);
    </script></div></td></tr>
    <tr>
                      
                        <td width="119" valign="top"><b>Experience:</b></td>
                        <td width="298"> 
 
   <textarea name="experience" id="experience" cols="73" rows="5"  
   onKeyDown="limitText(this.form.experience,'countdown003',1000);" 
onKeyUp="limitText(this.form.experience,'countdown003',1000);"><?php echo  $experience;?></textarea><span id="countdown003"></span>

                        
                        		</td>
                      </tr>
                      
                       <tr>
                         <td width="119" valign="top"><b>Start Date</b></td>
                         <td> <input name="startdate" type="text" value="<?php echo  $startdate;?>" size="73" /></td>
                       </tr>
                       <tr>
                         <td width="119" valign="top"><b>End Date</b></td>
                         <td> <input name="enddate" type="text" value="<?php echo  $enddate;?>" size="73" /></td>
                       </tr>
                       <tr> 
                        <td width="119" valign="top"><b>Force Password Change:</b></td>
                        <td><input name="changePassword" type="radio" value="1" <?php echo  ($changePassword == 1) ? 'checked' : '' ?>>
                          yes&nbsp; <input name="changePassword" type="radio" value="0" <?php echo  ($changePassword == 0) ? 'checked' : '' ?>>
                          no<br>
                          <font color="#666666" size="-1">Force this user to change their password at next login?</font></td>
                      </tr>
                      <tr> 
                        <td width="119" valign="top"><b>Active:</b></td>
                        <td><input name="is_active" type="radio" value="1" <?php echo  ($is_active == 1) ? 'checked' : '' ?>>
                          yes 
                          <input name="is_active" type="radio" value="0" <?php echo  ($is_active == 0) ? 'checked' : '' ?>>
                          no<br> <font color="#666666" size="-1">Is this teacher actively working at Canterbury?</font></td>
                      </tr>
                      <tr> 
                        <td width="119" valign="top"><b>System Admin:</b></td>
                        <td><input name="is_admin" type="radio" value="1" <?php echo  ($is_admin == 1) ? 'checked' : '' ?>>
                          yes 
                          <input name="is_admin" type="radio" value="0" <?php echo  ($is_admin == 0) ? 'checked' : '' ?>>
                          no<br> <font color="#666666" size="-1">Can this user view reports and edit logins?</font></td>
                      </tr>
                    </table></td>
                </tr>
                <tr valign="top"> 
                  <td colspan="2" bgcolor="#fff">&nbsp; </td>
                </tr>
                <tr valign="top" bgcolor="#fff"> 
                  <td colspan="2" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input name="action" type="submit" id="action" value="Save Changes"> 
                    </td>
                </tr>
              </table>
            </form>
            <!--end dynamic content -->
            Return to <a href="index.php">User List</a> <p><!--<code>Do not obscure 
              password fields here; obscure them on login screens. &quot;physician 
              flag&quot; redirects their login to their file manager.</code>--></p></td>
        </tr>
      </table></td>
  </tr>
</table>
 </div>  
       
      
<?php include 'includes/foot.php'?>
<script>

var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");

var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");

var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");


var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7");

var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8");



</script>
