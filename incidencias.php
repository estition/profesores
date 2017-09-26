<?php include 'includes/constants.php'?>
<?php include 'includes/functions.php'?>
<?php include 'includes/database.php'?>
<?php include 'includes/authorize.php'?>

<?php
$user_id = $_COOKIE["user_id"];

if ($_POST['action'] == "Save Changes") {
	$password = $_POST['password'];
	$new_password = $_POST['new_password'];
	$new_password_rep = $_POST['new_password_rep'];

	$sql = "select id from users where user_id = '" . $user_id . "' and password = '" . $password . "'";
	$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
	if (!$row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$message = $message . "The old password you have entered is incorrect.<br>";
	}	
	
	if (strlen($new_password) < 5) {
		$message = $message . "The new password must be at least 5 characters.<br>";
	}

	if (strpos($new_password, ' ')) {
		$message = $message . "The new password may not contain spaces.<br>";
	}
	
	if ($password == $new_password) {
		$message = $message . "Old and new passwords cannot be the same.<br>";
	}
	
	if ($new_password != $new_password_rep) {
		$message = $message . "The new password and the repeat new password are not the same.<br>";
	}
	
	if ($message == "") {
		$sql = "update users set password = '" . $new_password . "' , changePassword = 0 where user_id = '" . $user_id . "' and password = '" . $password . "'";
		mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
		print "<meta http-equiv='refresh' content='0; url=/index.php'>";
		exit;
	}
	
}

$page_name = "change password";
?>
<?php include 'includes/top.php'?>
<?php include 'includes/menu_incidencias.php'?>

      <table width="100%" border="0" cellpadding="10" cellspacing="0" id="body">
        <tr> 
          <td width="100%" valign="top"> <p><b>Welcome Teachers! </b><br>
          If you're logging in for the first time, you must change your password.
          </p>
						<b><font color='#ff9900'><?php echo  $message ?></font></b>
            <form action="change_password.php" name="login_changer" id="login_changer" method="post">
              <table border="0" cellpadding="1" cellspacing="0" bgcolor="#738FE6" id="border">
                <tr> 
                  <td><table border="0" cellpadding="5" cellspacing="0" id="shell">
                      <tr valign="top"> 
                        <td bgcolor="#0033CC"><b><font class="textW">Change Password</font></b></td>
                      </tr>
                      <tr valign="top"> 
                        <td bgcolor="#B6C5F2">Enter your old and new passwords.</td>
                      </tr>
                      <tr valign="top"> 
                        <td bgcolor="#FFFFFF"> <table border="0" cellpadding="5" cellspacing="0" id="login">
                            <tr> 
                              <td valign="top"><b>User ID:</b></td>
                              <td> <b><?php echo $user_id?></b>
                              </td>
                            </tr>
                            <tr> 
                              <td valign="top"><b>Old Password:</b></td>
                              <td> <input name="password" type="password" id="pwd3" size="25"> 
                              </td>
                            </tr>
                            <tr> 
                              <td valign="top"><b>New Password:</b></td>
                              <td><input name="new_password" type="password" id="pwd3" size="25"> 
                                <i>no spaces, min 5 characters</i></td>
                            </tr>
                             <tr> 
                              <td valign="top"><b>Repeat New Password:</b></td>
                              <td><input name="new_password_rep" type="password" id="pwd3" size="25"> 
                                <i>no spaces, min 5 characters</i></td>
                            </tr>
                            <tr>
                              <td valign="top">&nbsp;</td>
                              <td>Be sure to record your 
                                new password somewhere safe! </td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr valign="top" bgcolor="#dddddd"> 
                        <td align="right" bgcolor="#B6C5F2"> 
                          <input name="action" type="submit" id="save" class="submit-button" value="Save Changes"> 
                        </td>
                      </tr>
                    </table>
                    
                  </td>
                </tr>
              </table>
            </form>
					</td>
        </tr>
      </table></td>
  </tr>
</table>
<?php include 'includes/foot.php'?>
