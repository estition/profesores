<?php

/* Connecting, selecting database */

$link = mysql_connect($mysql_host, $mysql_user, $mysql_password)
    or die("Could not connect : " . mysqli_error($link));
	
	
//	mysqli_query($link, "SET NAME 'utf8'");
//mysqli_query($link, "SET CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'");

mysqli_query($link, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'", $link);
   
//print "Connected successfully";
mysql_select_db($database) or die("Could not select database");

?>