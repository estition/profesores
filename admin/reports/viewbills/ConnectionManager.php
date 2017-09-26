<?php
class ConManager{
	function getConnection(){
	  //change to your database server/user name/password
		$link = mysqli_connect("localhost","root","root") or
    die("Could not connect: " . mysqli_error($link));
	mysqli_query($link, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
    //change to your database name
		mysqli_select_db($link, "canterburyproto") or 
		     die("Could not select database: " . mysqli_error($link));
		
		return $link;
	}
}
?>