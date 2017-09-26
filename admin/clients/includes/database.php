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

?>