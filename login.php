<?php include 'includes/constants.php'?>
<?php include 'includes/functions.php'?>
<?php include 'includes/database.php'?>
<?php
// opt 1: calendar.php
// opt 2: index.php
if (!isset($_REQUEST['page'])) {
	$p = "index.php";
} else {
        $page = $_REQUEST['page'];
	$p = $_REQUEST['page'];
}


	$error = "";
if (isset($_REQUEST['login'])) {

	$user_id = $_POST['user_id']; 
	$password = $_POST['password'];
	
	

	/* by substringing the url, determine if it's an admin page that has been requested. 
	all admin pages MUST be located in the admin folder */
	$admin = false;
	if (substr($page, 0, 5) == "admin") {
		$admin = true;
	}

	$query = "select id, is_admin from users where user_id = '" . escape($user_id) . "' and password = '" . escape($password) . "';";
	//echo $query;
	$result = mysqli_query($link, $query) or die("Query failed : " . mysqli_error($link));
	$num_rows = mysqli_num_rows($result);

	$row = mysqli_fetch_array($result);
	/* set the error flag if the login is incorrect */
	if ($num_rows != 1) {
		$error = "bad_username_password";
	}
	
	
    //echo $row["id"]."  ".$row["is_admin"]."MARIPOSA";
	/* set the error flag if a non admin user is requesting an admin page */
	if ($row["id"] && !$row["is_admin"]) {
		$error = "not_auth_for_admin";
	}
	

	
	
		setcookie("user_id", $user_id);  /* expires when the browser closes */
		
		/* log the successful transaction */
//		$sql = "insert into log (user_id, action, ip) values ('" . $user_id . "', 'success_auth', '" . $_SERVER['REMOTE_ADDR'] . "');";
//		mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
		
		//exit();
		
		if($row === false){
		//print "<meta http-equiv='refresh' content='0; url=" . $page . "'>";
			print '<meta http-equiv="refresh" content="0; url=login.php">';
		return;}
		elseif(($row["is_admin"] == "1") && $error == ""){
		print '<meta http-equiv="refresh" content="0; url=admin/clients/index.php">';
		return;
		}else{
			print '<meta http-equiv="refresh" content="0; url=index.php">';
		return;}
	}
	
	/* log the failed transaction with the error message*/
//	$sql = "insert into log (user_id, action, ip) values ('" . $user_id . "', '" . $error . "', '" . $_SERVER['REMOTE_ADDR'] . "');";
//	mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
	

?>

<html>
	<head>
	<link href="css/canterbury.css" type="text/css" rel="stylesheet">
	<title>Canterbury Hours Login</title>
	<script>
	function init() {
		document.getElementById("user_id").focus();
	}
	
	function Incidencias() {		
		win = window.open("alta_incidencia.php", "filter", "directories=0,location=0,menubar=0,resizable=0,scrollbars=0,status=0,titlebar=0,toolbar=0,width=620,height=325,top=50,left=270");
	    win.focus();
		}
	
	</script>
	</head>
	<body>
		<form action="<?php echo $protocall.'://'.$site.'/login.php';?>" name="login" id="login" method="post">
    <input type="hidden" name="page" value="<?php echo $p;?>" size="30"> 
		<table width="300" height="300" cellpadding="5" cellspacing="0" border="0" align="center">
			<tr>
				<td height="200" colspan="2" bgcolor="FFFFFF" valign="bottom" align="center">
				<font class="boldText">
					
					<?php if ($error == "bad_username_password") { ?>
       	 
		        <b>Username/password incorrect.</b>
						
					<?php }
					
					/* elseif ($error == "not_auth_for_admin") { ?>
						
						<b>You are not authorized to enter the admin section.</b> 
						
					<?php }*/
					 ?>
					
					</font>
				
				</td>
			</tr>
			<tr bgcolor="0033CC">
				<td colspan="2" class="textW" height="10">
					<b>Canterbury Hours Login</b>
				</td>
			<tr>
			<tr>
				<td height="3" colspan="2" bgcolor="FFFFFF">
				</td>
			</tr>
			
			<tr bgcolor="B6C5F2">
				<td width="30" height="10"><b>Username:</b></td>
				<td width="370">
					<input type="text" size="20" tabindex="1" name="user_id">
				</td>
			</tr>
			<tr bgcolor="B6C5F2">
				<td width="30" height="10"><b>Password:</b></td>
				<td width="370">
					<input type="password" tabindex="2" size="20" name="password">
				</td>
			</tr>
			<tr>
				<td height="3" colspan="2" bgcolor="FFFFFF">
					Please enter your username and password.
				</td>
			</tr>
			<!--<tr>
				<td height="3" colspan="2" bgcolor="FFFFFF">
					<A href="javascript:Incidencias()">Enter incidence technique</a>
				</td>
			</tr>-->
			<tr>
				<td colspan="2" align="right">
				    <input type="button" class="submit-button" tabindex="3" name="login" value="Help" onClick="Incidencias()">
					<input type="submit" class="submit-button" tabindex="3" name="login" value="Login">
				</td>
			</tr>
		</table>
		
		</form>
	</body>
</html>