<?php include 'includes/constants.php'?>
<?php include 'includes/functions.php'?>
<?php include 'includes/database.php'?>
<?php include 'includes/authorize.php'?>
<?php

$message = "";
$name= $_POST["name"];
$telephone1= $_POST["telephone1"];
$telephone2 = $_POST["telephone2"];
$mobile = $_POST["mobile"];
$email = $_POST["email"];
$address1 = $_POST["address1"];
$address2 = $_POST["address2"];
$city = $_POST["city"];
$state = $_POST["state"];
$zip = $_POST["zip"];
$group_id = $_REQUEST["group_id"];


if ($_REQUEST['id'] == "") {
	/* NEW PROFILE */

	$mode = "New User";
	if ($_POST['action'] == "Save Changes") {
		
		if (strlen($name) < 5) {
			$message = $message . "The name must be at least 5 characters.<br>";
		}
		
		
		if ($message == "") {
			$sql = "insert into clients (name, ";
			$sql = $sql . "telephone1, telephone2, mobile, email, address1, address2, city, state, zip, group_id) values ";
			$sql = $sql . "('" . escape($_POST['name']) . "'";
			$sql = $sql . ", '" . escape($_POST['telephone1']) ."'";
			$sql = $sql . ", '" . escape($_POST['telephone2']) . "', '" . escape($_POST['mobile']) ."'";
			$sql = $sql . ", '" . escape($_POST['email']) . "', '" . escape($_POST['address1']) ."'";
			$sql = $sql . ", '" . escape($_POST['address2']) . "', '" . escape($_POST['city']) ."'";
			$sql = $sql . ", '" . escape($_POST['state']) . "', '" . escape($_POST['zip']) ."', " . $_POST['group_id'] . ");";

			//print $sql;
			mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
			$id = mysql_insert_id();	

			$message = "<br>Client Profile Saved.";
		}
	}
} else {
	$mode = "Edit Client";
}

if ($id == "") {
	$id = $_REQUEST['id'];
}



if ($id != "" && $_POST['action'] == "Promote this user to a group") {
	/*  Copy the client's information into a group and associate the client with the group */
	
	
	
}


if ($id != "" && $_POST['action'] == "Save Changes") {
/* EDIT EXISTING PROFILE */





	if (strlen($name) < 5) {
		$message = $message . "The name must be at least 5 characters.<br>";
	}

	if ($message == "") {
		$sql = "update clients set telephone1 = '" . $_POST['telephone1'] . "' ";
		$sql = $sql . ", telephone2 = '" . $_POST['telephone2'] . "', mobile = '" . $_POST['mobile'] . "' ";
		$sql = $sql . ", email = '" . $_POST['email'] . "', address1 = '" . $_POST['address1'] . "' ";
		$sql = $sql . ", address2 = '" . $_POST['address2'] . "', city = '" . $_POST['city'] . "' ";
		$sql = $sql . ", state = '" . $_POST['state'] . "', zip = '" . $_POST['zip'] . "' ";
		$sql = $sql . ", name = '" . $_POST['name'] . "', group_id = " . $_POST['group_id'] . " where id = " . $id;
		
		
		
		//print $sql;
		mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
		$message = "<br>Client Profile Saved.";
	}
}


if (($id != "") && (($message == "<br>Client Profile Saved.") || ($message == ""))) {
	$sql = "select * from clients where id = " . $id;
	$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
	if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$name =  stripslashes($row["name"]);
		$telephone1 = $row["telephone1"];
		$telephone2 = $row["telephone2"];
		$mobile = $row["mobile"];
		$email = $row["email"];
		$address1 = $row["address1"];
		$address2 = $row["address2"];
		$city = $row["city"];
		$state = $row["state"];
		$zip = $row["zip"];
		$group_id = $row['group_id'];
	} 
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
	
?>
<?php include '../../includes/top.php'?>
      <table width="100%" border="0" cellpadding="10" cellspacing="0" id="body">
        <tr> 
          <td width="100%" valign="top"> <p><b>Client Profile &#8211; 
              <?php echo  $mode ?> <br><font color='#ff9900'><?php echo  $message ?></font></b></p>
            <!--start dynamic code -->
            <form name="associate" id="associate" method="post">
            	<input type="hidden" name="id" value="<?php echo $id;?>">
              <table border="0" cellpadding="5" cellspacing="0" id="shell">
                <tr valign="top"> 
                  <td colspan="2" bgcolor="#EEEEEE">&nbsp;</td>
                </tr>
                <tr valign="top"> 
                  <td bgcolor="#EEEEEE"><font>Client 
                    Info</font></td>
                  <td bgcolor="#FFFFFF"> <table border="0" cellpadding="5" cellspacing="0" id="login">
                      <tr> 
                        <td valign="top"><b>Name:</b></td>
                        <td><input name="name" type="text" value="<?php echo  $name;?>"></td>               
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
                      <tr> 
                        <td valign="top"><b>Group:</b></td>
                        <td>
                        <select name="group_id">
                        	<?php echo  $groups; ?>
                        </select>
                        </td>
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
            </form>
            
            <!--end dynamic content -->
            Return to <a href="index.php">Group/Client List</a>
            <?php
            if (($group_id != "") && ($id != "")) {
            ?>
            <br><br>
            View this client's <a href="group_profile.php?id=<?php echo $group_id?>">Group</a>
            <?php
          	}
            ?>
            </td>
        </tr>
      </table></td>
  </tr>
</table>
<?php include 'includes/foot.php'?>
