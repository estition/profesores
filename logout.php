<?php include 'includes/constants.php'?>
<?php include 'includes/functions.php'?>
<?php include 'includes/database.php'?>
<?php

/* log the successful transaction */
$sql = "insert into log (user_id, action, ip) values ('" . $_COOKIE["user_id"] . "', 'logout', '" . $_SERVER['REMOTE_ADDR'] . "');";
mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));

setcookie ("user_id", "", time() - 3600);

?>

<html>
<head>
<title>Canterbury Hours Input</title>
	<link href="css/canterbury.css" type="text/css" rel="stylesheet">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="copyright" content="2004">
</head>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" >
<br>
<table width="80%" border="0" align="center" cellpadding="10" cellspacing="0" id="body">
	<tr>
		<td>
			<img src="images/clock.jpg">
		</td>
	</tr>
  <tr> 
    <td width="100%" valign="top"> <p><b>You have successfully logged out.</b></p>
      <p>The cookie that remembers your login credentials has been cleared from 
        your computer. 
        
        <br><br>Please <a href="login.php"><b>sign in</b></a> again to access 
        the timetracker or admin section.</p>
      </td>
  </tr>
</table>
<br>
</body>
</html>
