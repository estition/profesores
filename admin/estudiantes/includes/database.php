<?php

/* Connecting, selecting database */

$link = mysql_connect($mysql_host, $mysql_user, $mysql_password)
    or die("Could not connect : " . mysqli_error($link));
   mysql_set_charset('utf8',$link); 



  mysql_select_db($database) or die("Could not select database");

?>