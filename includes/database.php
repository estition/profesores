<?php

//try {
//    $dbh = new PDO("mysql:host=$mysqli_host;dbname=$database", $mysqli_user, $mysqli_password);
//}
//catch(PDOException $e)
//{
//   echo $e->getMessage();
//}
//
/* Connecting, selecting database */
$link = mysqli_connect($mysqli_host, $mysqli_user, $mysqli_password, $database)
    or die("Could not connect : " . mysqli_error());
//print "Connected successfully";
//mysqli_select_db($database) or die("Could not select database");

//printf("Initial character set: %s\n", $link->character_set_name());

/* change character set to utf8 */
if (!$link->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $link->error);
    exit();
}

?>