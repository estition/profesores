<?php 



$error = "";


if (substr($_SERVER['SERVER_PROTOCOL'], 0, strlen($protocall)) != strtoupper($protocall)) {
	print "You may not access this site over: " . $_SERVER['SERVER_PROTOCOL'];
	exit;
}

$query = "select * from users where user_id = '" . $_COOKIE["user_id"] . "';";
	
$result = mysqli_query($link, $query) or die("Query failed : " . mysqli_error($link));
$num_rows = mysql_num_rows($result);

/* set the error flag if the login is incorrect */
if ($num_rows != 1) {
	$error = "not authorized";
}

$is_admin_a = false;
$first = "";

if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	$is_admin_a = $row["is_admin"];
	$first = $row["first"];

	$id_arti = $row['id'];
	$changePassword = $row["changePassword"];
}

/* by substringing the url, determine if it's an admin page that has been requested. 
all admin pages MUST be located in the admin folder */
$admin = false;
if (substr($_SERVER['PHP_SELF'], 1, 5) == "admin") {
	$admin = true;
}

/* set the error flag if a non admin user is requesting an admin page */
if ($admin && !$is_admin_a) {
	$error = "no_admin";
}

if (($changePassword == 1) && ($_SERVER['PHP_SELF'] != '/change_password.php')) {
	print "<meta http-equiv='refresh' content='0; url=/change_password.php'>";
	exit;
}

//********************************************************************************
//********************************************************************************

if ($error != "") {
	print "<meta http-equiv='refresh' content='0; url=" . "/profesores/login.php?page=" . substr($_SERVER['PHP_SELF'], 1) . "'>";
	exit;
}

?>