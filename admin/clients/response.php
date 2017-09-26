<?php
include 'includes/constants.php';

 include 'includes/database.php';

if(isset($_POST["content_txt"]) && strlen($_POST["content_txt"])>0) 
{	//check $_POST["content_txt"] is not empty

	//sanitize post value, PHP filter FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH Strip tags, encode special characters.
	$contentToSave = filter_var($_POST["content_txt"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH); 
	$id = filter_var($_POST["content_id"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
	//echo $id."pepe";
	//echo $contentToSave."PEPE2";
	// Insert sanitize string in record
	 	$sql = "update groups set  old_id = ".$id. " where id = " . $contentToSave;
 
	//print $sql . "<br>";
  if(mysqli_query($link, $sql) )  
	
	
	//if(mysqli_query($link, "INSERT INTO add_delete_record(content) VALUES('".$contentToSave."')"))
	{
		$Result = mysqli_query($link, "SELECT name,nivel FROM groups where id = ".$contentToSave) or die("Invalid query1: " . mysqli_error($link));

//get all records from add_delete_record table
			while($row = mysqli_fetch_array($Result))
				{
 				 echo '<li id="item_'.$contentToSave.'">';
 				 echo '<div class="del_wrapper"><a href="#" class="del_button" id="del-'.$contentToSave.'">';
  				echo '<img src="images_group/icon_del.gif" border="0" />';
 				 echo '</a></div>';
				 
				 echo '<a href="group_profile.php?id="'.$contentToSave.'"><img src="images_group/customer.gif"></a>';
  
 				   echo '<b>'.$row["name"].'</b> <br> Nivel: '.$row["nivel"].'</li>';
				 
}

//close db connection
                mysql_close($link);


	}else{
		
		//header('HTTP/1.1 500 '.mysqli_error($link)); //display sql errors.. must not output sql errors in live mode.
		header('HTTP/1.1 500 Looks like mysql error, could not update record!'.$sql);
		exit();
	}

}
elseif(isset($_POST["recordToDelete"]) && strlen($_POST["recordToDelete"])>0 && is_numeric($_POST["recordToDelete"]))
{	//do we have a delete request? $_POST["recordToDelete"]

	//sanitize post value, PHP filter FILTER_SANITIZE_NUMBER_INT removes all characters except digits, plus and minus sign.
	$idToDelete = filter_var($_POST["recordToDelete"],FILTER_SANITIZE_NUMBER_INT); 
	
	$sql = "update groups set  old_id = 0 where id = " . $idToDelete;
 
	print $sql . "<br>";
  if(!mysqli_query($link, $sql) )  
	
	
	//try deleting record using the record ID we received from POST
	//if(!mysqli_query($link, "DELETE FROM add_delete_record WHERE id=".$idToDelete))
	{    
		//If mysql delete query was unsuccessful, output error 
		header('HTTP/1.1 500 Could not delete record!');
		exit();
	}
	mysql_close($link); //close db connection
}
else
{
	//Output error
	header('HTTP/1.1 500 Error occurred, Could not process request!');
    exit();
}
?>