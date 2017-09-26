<?php
$HOME = 1;
$PRODUCTION = 2;
$site = $HOME;
//$site = $PRODUCTION;
if ($site == $PRODUCTION) {
	$site = "www.canterburyconsultingspain.com.mialias.net/profesores";
	$protocall = "http";
	
	$mysqli_host = "localhost";
	$mysqli_user = "canter6165";
	$mysqli_password = "v6CIR7pB";
	$database = "canterburybd";
	
} elseif ($site == $HOME) {
    $site = "localhost/profesores";
	$protocall = "http";
	$mysqli_host = "localhost";
	$mysqli_user = "root";
	$mysqli_password = "";
	$database = "canterburyproto";

}

?>