<?php
	/*  Virtual Library, version 1.0
		Author: ISC. Gerardo Cataño
		Date: June 2009  */
?>
<?php include 'includes/constants.php'?>
<?php include 'includes/functions.php'?>
<?php include 'includes/database.php'?>
<?php include 'includes/authorize.php'?>

<?php

$message = "";
$idLibraryBook = $_REQUEST["idLibraryBook"];
$number= $_POST["number"];
$title= $_POST["title"];
$description = $_POST["description"];
$url = $_POST["url"];

$borrar = $_POST["borrar"];
$infoValida = $_POST["infoValida"];


function libraryBookName(){
	//if ($idLibraryBook!=""){
	if ($_REQUEST["idLibraryBook"]!=""){
	
		$sql = "select title from libraryBook where idLibraryBook = " . $_REQUEST["idLibraryBook"] ; //. $idLibraryBook; //
		$result = mysql_query($sql) or die("Invalid query: " . mysql_error());	
		if ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$libraryBook = $row["title"];		
		}		
	}
	return $libraryBook;
	//print $sql;
}

//BEGIN: NEW CHAPTER
if ( ($_REQUEST['id'] == "") && ($infoValida) ) {

	$mode = "New Chapter";
	if ($_POST['action'] == "Save changes") {					
		
		if ($message == "") {
			$sql = "insert into libraryChapter ( ";
			$sql = $sql . " idLibraryBook, number, title, description";
			//si se carga archivo correctamente se guarda url
			if ( ($_FILES["file"]["type"] == "application/pdf") && ($_FILES["file"]["size"] < 10000000) && (strpos($_FILES["file"]["name"]," ") == false) ) {
				$sql = $sql . ", url ";
			}
			$sql = $sql . ") values ";
			$sql = $sql . "('" . addslashes($_REQUEST['idLibraryBook']) . "'";
			$sql = $sql . ", '" . addslashes($_POST['number']) ."'";
			$sql = $sql . ", '" . addslashes($_POST['title']) ."'";
			$sql = $sql . ", '" . addslashes($_POST['description']) ."'";
			//$sql = $sql . ", '" . escape($_POST['url']) . "');";
			
			//si se carga archivo correctamente se guarda url
			if ( ($_FILES["file"]["type"] == "application/pdf") && ($_FILES["file"]["size"] < 10000000) && (strpos($_FILES["file"]["name"]," ") == false) ) {
				$sql = $sql . ", '" . $_FILES["file"]["name"] . "' ";
			}
			
			$sql = $sql . ");";

			//print $sql;
			mysql_query($sql) or die("Invalid query: " . mysql_error());
			$id = mysql_insert_id();	

			$message = "<br />Chapter Profile Saved.";
		}
	}
} else {
	$mode = "Edit Chapter";
}
//END: NEW CHAPTER


if ($id == "") {
	$id = $_REQUEST['id'];
}


//BEGIN: EDIT CHAPTER
if ( ($id != "") && ($_POST['action'] == "Save changes") && ($infoValida) ) {	

	if ($message == "") {
		$sql = "update libraryChapter set idLibraryBook = '" . addslashes($_REQUEST['idLibraryBook']) . "' ";
		$sql = $sql . ", number = '" . addslashes($_POST['number']) . "', title = '" . addslashes($_POST['title']) . "' ";
		//$sql = $sql . ", description = '" . $_POST['description'] . "', url = '" . $_POST['url'] . "' "; ANTES
		$sql = $sql . ", description = '" . addslashes($_POST['description']) . "' ";


		//si se carga archivo correctamente se actualiza link
		if ( ($_FILES["file"]["type"] == "application/pdf") && ($_FILES["file"]["size"] < 10000000) && (strpos($_FILES["file"]["name"]," ") == false) ) {
			$sql = $sql . ", url = '" . $_FILES["file"]["name"] . "' ";
		}

		$sql = $sql . " where idLibraryChapter = " . $id;
		
		//print $sql;
		mysql_query($sql) or die("Invalid query: " . mysql_error());
		$message = "<br />Chapter Profile Saved.";
	}
}
//END: EDIT CHAPTER


//BEGIN: DELETE CHAPTER
if ($id != "" && $_POST['action2'] == "Delete chapter") {

	if ($message == "") {		
	
		if ($borrar){
		
			$sqlUrl = "select url from libraryChapter where idLibraryChapter = " . $id;
			$resultUrl = mysql_query($sqlUrl) or die("Invalid query: " . mysql_error());
			
			$rowUrl = mysql_fetch_row($resultUrl);
			$urlArchivo = $rowUrl[0];
			/*
			//print $sqlNumCapitulos . " --- ";	//print $numCapitulos;
			/*if ($numCapitulos>0){
				echo "<script type=\"text/javascript\">alert(\"It's not possible to delete this book due to it has associated chapters.\");</script>";
			} else {*/
				$sql = "delete from libraryChapter where idLibraryChapter = " . $id;		
				//print $sql;
				//print $urlArchivo;
				mysql_query($sql) or die("Invalid query: " . mysql_error());
				$message = "<br />Chapter Profile Deleted.";
				$id ="";
				if ($urlArchivo!="") {
					unlink("recursos/".$urlArchivo);
				}
			echo "<script type=\"text/javascript\">alert(\"The chapter has been deleted succesfully.\");window.location.href=\"vistaLibro.php?id=".$idLibraryBook."\";</script>";
			//} //$numCapitulos
		
		}	// $borrar
		
	}
}
//END: DELETE CHAPTER


if (($id != "") && (($message == "<br />Chapter Profile Saved.") || ($message == ""))) {

	$sql = "select * from libraryChapter where idLibraryChapter = " . $id;
	$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
	if ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

		$idLibraryBook = $row["idLibraryBook"];
		$number = $row["number"];
		$title = $row["title"];		
		$description = $row["description"];
		$url = $row["url"];
	
	} 
}


?>


<?php include 'includes/top.php'?>
<?php include 'includes/menu.php'?>

<script type="text/javascript">
	function validar(){
		var x=1;
		cadena="";
		if (document.getElementById("number").value==""){
			x = 0; cadena += " - Enter chapter's number.\n";
		} else {
			if ( validarEntero(document.getElementById("number").value)=="" ){
				x = 0; cadena += " - Enter a valid chapter's number.\n";
			}
		}
		if (document.getElementById("title").value==""){
			x = 0; cadena += " - Enter chapter's title.\n";
		}
		if (document.getElementById("description").value==""){
			x = 0; cadena += " - Enter chapter's description.\n";
		}
		
		if (x==0) alert("Please correct:\n"+cadena);
		
		if (x==1) document.getElementById("infoValida").value = 1;
		else document.getElementById("infoValida").value = 0;
		
	}
	
	function validarEntero(valor){  
    	valor = parseInt(valor)
      	if (isNaN(valor)) {
            return ""
	    } else {            
            return valor
      	}
	}
	
	function confirmacionBorrar() {
		var r=confirm("Do you really want to delete this chapter?");
			if (r==true) document.getElementById("borrar").value = 1;
			else document.getElementById("borrar").value = 0;
	}	
</script>

      <table width="100%" border="0" cellpadding="10" cellspacing="0" id="body">
        <tr> 
          <td width="100%" valign="top"> <p><b>Chapter Profile &#8211; 
              <?php echo  $mode ?> <br><font color='#ff9900'><?php echo  $message; ?></font></b></p>

            <!--start dynamic code -->
            <form name="associate" id="associate" method="post" enctype="multipart/form-data">
            	<input type="hidden" name="id" value="<?php echo $id;?>">
              <table border="0" cellpadding="5" cellspacing="0" id="shell">
                <tr valign="top"> 
                  <td colspan="2" bgcolor="#EEEEEE">&nbsp;</td>
                </tr>
                <tr valign="top"> 
                  <td bgcolor="#EEEEEE"><font>Chapter Info</font></td>
                  <td bgcolor="#FFFFFF"> <table border="0" cellpadding="5" cellspacing="0" id="login">
                  	  <tr>                        
                        <td colspan="2" style="text-align:center">Enter the required chapter information:<br />&nbsp;</td>
                      </tr>                  	  
                      <tr> 
                        <td valign="top"><b>Book:</b></td>
                        <td><!--<input type="text" name="idLibraryBook" readonly="readonly" value="<?php //echo  $idLibraryBook;?>" />-->
                        	<?php echo libraryBookName(); ?><input type="hidden" name="idLibraryBook" value="<?php echo  $idLibraryBook;?>" />
                        </td>
                      </tr>
                      <tr> 
                        <td valign="top"><b>*Number:</b></td>
                        <td><input id="number" name="number" type="text" maxlength="2" size="3" value="<?php echo $number;?>" /></td>               
                      </tr>                     
                      <tr> 
                        <td valign="top"><b>*Chapter title:</b></td>
                        <td><input id="title" name="title" type="text" maxlength="100" size="50" value="<?php echo $title;?>" /></td>               
                      </tr>
                      <tr> 
                        <td valign="top"><b>*Description:</b></td>
                        <td><input id="description" name="description" type="text" maxlength="75" size="50" value="<?php echo $description;?>" /></td>
                      </tr>
                      <tr> 
                        <td valign="top"><b>Link:</b></td>
                        <td>
							<?php 
								if ($url != "")
									echo  "<a target=\"_blank\" href=\"recursos/".$url."\" >See the chapter here</a>";
								else
									echo "None";
							?>
                            <input type="hidden" name="url" value="<?php echo $url;?>" /><br /><br />

                <label for="file">Filename:</label>
				<input type="file" name="file" id="file" /> 
                
                        </td>
                      </tr>                      
                      
                    </table></td>
                </tr>
                <tr valign="top"> 
                  <td colspan="2" bgcolor="#eeeeee">&nbsp; </td>
                </tr>
                <tr valign="top" bgcolor="#dddddd"> 
                  <td colspan="2" align="center">
                  		<input name="action" type="submit" id="action" value="Save changes" onclick="validar();"/>
                        <input type="hidden" id="infoValida" name="infoValida" value="<?php echo $infoValida;?>">
                        <?php if ($id != "" ) { //solo update	?>
                        	<input name="action2" type="submit" id="action2" value="Delete chapter" onclick="confirmacionBorrar();" />
						<?php } ?>
	                    <input type="hidden" name="borrar" id="borrar" value="<?php echo $borrar;?>">
                        <input name="back" id="back" type="button" value="Back to book" onclick="javascript:location.href='vistaLibro.php?id=<?php echo $idLibraryBook; ?>';" />
                  </td>
                </tr>
              </table>
            </form>            
            <!--end dynamic content -->
            </td>
        </tr>
        
        
<!-- chapter -->
<tr><td>
<?php
//BEGIN: loading and validating chapter
if ($id!="") {	

if (isset($_FILES["file"])) {

	if ( ($_FILES["file"]["type"] == "application/pdf") && ($_FILES["file"]["size"] < 10000000) && (strpos($_FILES["file"]["name"]," ") == false) ) {
	
		if ($_FILES["file"]["error"] > 0){
		    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
	    }
	  	else {
		    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
		    echo "Type: " . $_FILES["file"]["type"] . "<br />";
		    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
		    //echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

		    if (file_exists("recursos/" . $_FILES["file"]["name"])) {
		      echo $_FILES["file"]["name"] . " already exists. ";
		    }
		    //else {
		      move_uploaded_file($_FILES["file"]["tmp_name"],
		      "recursos/" . $_FILES["file"]["name"]);
		      //echo "Stored in: " . "recursos/" . $_FILES["file"]["name"];
		    //}
			  echo "<br /><br /> File succesfully stored.";
	    }
	}
		  
	else {
	  echo "Note: The file must be on pdf format, with a maximum size of 10 Mb and its name mustn't contain spaces.";
	}
 
} //isset($_FILES["file"]
 
} //id!=""
//END: loading and validating chapter
?>
</td></tr>
<!-- chapter -->

        
      </table>

<?php include 'includes/foot.php'?>

