<?php
$HOME = 1;
$PRODUCTION = 2;

//$site = $PRODUCTION;
$site = $HOME ;
if ($site == $HOME) {
	$site = "www.canterburyenglish.com/profesores";
	$protocall = "http";
	
	$mysql_host = "localhost";
	$mysql_user = "Administrador";
	$mysql_password = "hercules";
	$database = "canterburyproto";
	
} elseif ($site == $PRODUCTION) {
    $site = "localhost/profesores";
	$protocall = "http";
	$mysql_host = "localhost";
	$mysql_user = "root";
	$mysql_password = "";
	$database = "canterburyproto";

}

?>