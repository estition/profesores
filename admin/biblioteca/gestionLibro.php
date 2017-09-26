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
$title= $_POST["title"];
$authors= $_POST["authors"];
$description = $_POST["description"];
$editorial = $_POST["editorial"];
$editionDate = $_POST["editionDate"];
$editionPlace = $_POST["editionPlace"];
$isbn = $_POST["isbn"];
$editionNumber = $_POST["editionNumber"];
$pages = $_POST["pages"];
$level0 = $_POST["level0"];
$level1 = $_POST["level1"];
$level2 = $_POST["level2"];
$level3 = $_POST["level3"];
$level4 = $_POST["level4"];
$level5 = $_POST["level5"];
$level6 = $_POST["level6"];
$level7 = $_POST["level7"];
$level8 = $_POST["level8"];
$level9 = $_POST["level9"];
$bookKind = $_POST["bookKind"];

$borrar = $_POST["borrar"];
$infoValida = $_POST["infoValida"];


//BEGIN: NEW BOOK
if ( ($_REQUEST['id'] == "") && ($infoValida) ) {

	$mode = "New Book";
	if ($_POST['action'] == "Save changes") {
					
		
		if ($message == "") {
			$sql = "insert into libraryBook ( ";
			$sql = $sql . " title, authors, description, editorial, editionDate, editionPlace, isbn, editionNumber, pages, level0, level1, level2, level3, level4, level5, level6, level7, level8, level9, idLibrarybookKind ) values ";
			$sql = $sql . "('" . addslashes($_POST['title']) . "'";
			$sql = $sql . ", '" . addslashes($_POST['authors']) ."'";
			$sql = $sql . ", '" . addslashes($_POST['description']) ."'";
			$sql = $sql . ", '" . addslashes($_POST['editorial']) ."'";
			$sql = $sql . ", '" . addslashes($_POST['editionDate']) ."'";
			$sql = $sql . ", '" . addslashes($_POST['editionPlace']) ."'";
			$sql = $sql . ", '" . addslashes($_POST['isbn']) ."'";
			$sql = $sql . ", '" . addslashes($_POST['editionNumber']) ."'";
			$sql = $sql . ", '" . addslashes($_POST['pages']) ."'";
			$sql = $sql . ", '" . escape($_POST['level0']) ."'";
			$sql = $sql . ", '" . escape($_POST['level1']) ."'";
			$sql = $sql . ", '" . escape($_POST['level2']) ."'";
			$sql = $sql . ", '" . escape($_POST['level3']) ."'";
			$sql = $sql . ", '" . escape($_POST['level4']) ."'";
			$sql = $sql . ", '" . escape($_POST['level5']) ."'";
			$sql = $sql . ", '" . escape($_POST['level6']) ."'";
			$sql = $sql . ", '" . escape($_POST['level7']) ."'";
			$sql = $sql . ", '" . escape($_POST['level8']) ."'";
			$sql = $sql . ", '" . escape($_POST['level9']) ."'";			
			$sql = $sql . ", '" . addslashes($_POST['bookKind']) . "');";

			//print $sql;
			mysql_query($sql) or die("Invalid query: " . mysql_error());
			$id = mysql_insert_id();	

			$message = "<br />Book Profile Saved.";
		}
	}
} else {
	$mode = "Edit Book";
}
//END: NEW BOOK


if ($id == "") {
	$id = $_REQUEST['id'];
}


//BEGIN: EDIT BOOK
if ( ($id != "") && ($_POST['action'] == "Save changes") && ($infoValida) ) {

/*if (strlen($name) < 5) {
		$message = $message . "The name must be at least 5 characters.<br>";
	}*/

	if ($message == "") {
		$sql = "update libraryBook set title = '" . addslashes($_POST['title']) . "' ";
		$sql = $sql . ", authors = '" . addslashes($_POST['authors']) . "', description = '" . addslashes($_POST['description']) . "' ";		
		$sql = $sql . ", editorial = '" . addslashes($_POST['editorial']) . "', editionDate = '" . addslashes($_POST['editionDate']) . "' ";
		$sql = $sql . ", editionPlace = '" . addslashes($_POST['editionPlace']) . "', isbn = '" . addslashes($_POST['isbn']) . "' ";		
		$sql = $sql . ", editionNumber = '" . addslashes($_POST['editionNumber']) . "', pages = '" . addslashes($_POST['pages']) . "' ";
		$sql = $sql . ", level0 = '" . $_POST['level0'] . "', level1 = '" . $_POST['level1'] . "' ";
		$sql = $sql . ", level2 = '" . $_POST['level2'] . "', level3 = '" . $_POST['level3'] . "' ";
		$sql = $sql . ", level4 = '" . $_POST['level4'] . "', level5 = '" . $_POST['level5'] . "' ";
		$sql = $sql . ", level6 = '" . $_POST['level6'] . "', level7 = '" . $_POST['level7'] . "' ";
		$sql = $sql . ", level8 = '" . $_POST['level8'] . "', level9 = '" . $_POST['level9'] . "' ";
		$sql = $sql . ", idlibraryBookKind = '" . addslashes($_POST['bookKind']) . "' where idLibraryBook = " . $id;
		
		//print $sql;
		mysql_query($sql) or die("Invalid query: " . mysql_error());
		$message = "<br />Book Profile Saved.";
	}
}
//END: EDIT BOOK


//BEGIN: DELETE BOOK
if ($id != "" && $_POST['action2'] == "Delete book") {

	if ($message == "") {		
	
		if ($borrar){
		
			$sqlNumCapitulos = "select count(idLibraryBook) from libraryChapter where idLibraryBook = " . $id;
			$resultNumCapitulos = mysql_query($sqlNumCapitulos) or die("Invalid query: " . mysql_error());
			
			$rowNumCapitulos = mysql_fetch_row($resultNumCapitulos);
			$numCapitulos = $rowNumCapitulos[0];
			
			//print $sqlNumCapitulos . " --- ";	//print $numCapitulos;
			
			if ($numCapitulos>0){
				echo "<script type=\"text/javascript\">alert(\"It's not possible to delete this book due to it has associated chapters.\");</script>";
			} else {
				$sql = "delete from libraryBook where idLibraryBook = " . $id;		
				//print $sql;
				mysql_query($sql) or die("Invalid query: " . mysql_error());
				$message = "<br />Book Profile Deleted.";
				$id ="";
				echo "<script type=\"text/javascript\">alert(\"The book has been deleted succesfully.\");window.location.href=\"busquedaLibro.php\";</script>";
			} //$numCapitulos
		
		}	// $borrar
		
	}
}
//END: DELETE BOOK	


if (($id != "") && (($message == "<br />Book Profile Saved.") || ($message == ""))) {
	$sql = "select * from libraryBook where idLibraryBook = " . $id;
	$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
	if ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$title = $row["title"];
		$authors = $row["authors"];
		$description = $row["description"];
		$editorial = $row["editorial"];
		$editionDate = $row["editionDate"];
		$editionPlace = $row["editionPlace"];
		$isbn = $row["isbn"];
		$editionNumber = $row["editionNumber"];
		$pages = $row["pages"];
		$level0 = $row["level0"];
		$level1 = $row["level1"];
		$level2 = $row["level2"];
		$level3 = $row["level3"];
		$level4 = $row["level4"];
		$level5 = $row["level5"];
		$level6 = $row["level6"];
		$level7 = $row["level7"];
		$level8 = $row["level8"];
		$level9 = $row["level9"];
		$bookKind = $row["idLibraryBookKind"];	
	} 
}

//Se agrega clasificación de CE; 20090619
$sqlBookKind = "select idLibraryBookKind, name from libraryBookKind order by idLibraryBookKind";
$resultBookKind = mysql_query($sqlBookKind) or die("Invalid query: " . mysql_error());
$bookKindOptions .= "<option value=\"0\">Select book classification...</option>";
while ($rowBookKind = mysql_fetch_array($resultBookKind, MYSQL_ASSOC)) {
	if ($bookKind == $rowBookKind['idLibraryBookKind']) {
		$selected = "selected=\"selected\"";
	} else {
		$selected = "";
	}
	$bookKindOptions .= "<option " . $selected . " value=\"" . $rowBookKind['idLibraryBookKind'] . "\">" . $rowBookKind['name'] . "</option>";
}
	
?>
<?php include 'includes/top.php'?>
<?php include 'includes/menu.php'?>

<script type="text/javascript">
	function validar(){
		var x=1, xl=0;
		cadena="";
		if (document.getElementById("title").value==""){
			x = 0; cadena += " - Enter book's title.\n";
		}
		if (document.getElementById("authors").value==""){
			x = 0; cadena += " - Enter book's authors.\n";
		}
		if (document.getElementById("description").value==""){
			x = 0; cadena += " - Enter book's description.\n";
		}
		if (document.getElementById("editorial").value==""){
			x = 0; cadena += " - Enter book's editorial.\n";
		}				
		if (document.getElementById("pages").value==""){
			x = 0; cadena += " - Enter book's page number.\n";
		} else {
			if ( validarEntero(document.getElementById("pages").value)=="" ){
				x = 0; cadena += " - Enter a valid book's page number.\n";
			}
		}
		if (document.getElementById("bookKind").value == 0){
			x = 0; cadena += " - Enter book's classification.\n";
		}		
		for(i=0;i<=8;i++){
			if (document.getElementById("level"+i).value == 1){
				xl = 1; break;
			} else {
				xl = 0;
			}
		}
		if (xl==0) { x = 0; cadena += " - Enter book's level(s).\n"; }
		
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
		
	function levelValue(){
		for(i=0;i<=8;i++){
			if (document.getElementById("level"+i).checked==false)
				document.getElementById("level"+i).value = 0;
			else
				document.getElementById("level"+i).value = 1;
		}
	}
	
	function confirmacionBorrar() {
		var r=confirm("Do you really want to delete this book?");
			if (r==true) document.getElementById("borrar").value = 1;
			else document.getElementById("borrar").value = 0;
	}
	
</script>

      <table width="100%" border="0" cellpadding="10" cellspacing="0" id="body">
        <tr> 
          <td width="100%" valign="top"> <p><b>Book Profile &#8211; 
              <?php echo  $mode ?> <br><font color='#ff9900'><?php echo  $message; ?></font></b></p>
            <!--start dynamic code -->
            <form name="associate" id="associate" method="post">
            	<input type="hidden" name="id" value="<?php echo $id;?>">
              <table border="0" cellpadding="5" cellspacing="0" id="shell">
                <tr valign="top"> 
                  <td colspan="2" bgcolor="#EEEEEE">&nbsp;</td>
                </tr>
                <tr valign="top"> 
                  <td bgcolor="#EEEEEE"><font>Book Info</font></td>
                  <td bgcolor="#FFFFFF"> <table border="0" cellpadding="5" cellspacing="0" id="login">
	                  <tr>                        
                        <td colspan="2" style="text-align:center">Enter the required book information:<br />&nbsp;</td>
                      </tr>                  
                      <tr> 
                        <td valign="top"><b>*Title:</b></td>
                        <td><input id="title" name="title" type="text" maxlength="100" size="50" value="<?php echo  $title;?>" /></td>               
                      </tr>
                     <tr> 
                        <td valign="top"><b>*Author(s):</b></td>
                        <td><input id="authors" name="authors" type="text" maxlength="75" size="50" value="<?php echo  $authors;?>" /></td>
                      </tr>
                      <tr> 
                        <td valign="top"><b>*Description:</b></td>
                        <td><input id="description" name="description" type="text" maxlength="150" size="50" value="<?php echo  $description;?>" /></td>
                      </tr>
                      <tr> 
                        <td valign="top"><b>*Editorial:</b></td>
                        <td><input id="editorial" name="editorial" type="text" maxlength="50" size="30" value="<?php echo  $editorial;?>" /></td>
                      </tr>
                      <tr> 
                        <td valign="top"><b>Edition Date:</b></td>
                        <td><input id="editionDate" name="editionDate" type="text" maxlength="25" size="30" value="<?php echo  $editionDate;?>" /></td>
                      </tr>
                      <tr> 
                        <td valign="top"><b>Edition Place:</b></td>
                        <td><input id="editionPlace" name="editionPlace" type="text" maxlength="50" size="30" value="<?php echo  $editionPlace;?>" /><br></td>
                      </tr>
                      <tr> 
                        <td valign="top"><b>ISBN:</b></td>
                        <td><input id="isbn" name="isbn" type="text" maxlength="15" size="15" value="<?php echo  $isbn;?>" /></td>
                      </tr>
                      <tr> 
                        <td valign="top"><b>Edition number:</b></td>
                        <td><input id="editionNumber" name="editionNumber" type="text" maxlength="15" size="15" value="<?php echo  $editionNumber;?>" /></td>
                      </tr>
                      <tr> 
                        <td valign="top"><b>*Pages:</b></td>
                        <td><input id="pages" name="pages" type="text" maxlength="4" size="4" value="<?php echo  $pages;?>" /></td>
                      </tr>
                      <tr>                        
                        <td colspan="2" style="text-align:center"><br />Enter the required information (Canterbury English use):<br />&nbsp;</td>
                      </tr>
                      <tr> 
                        <td valign="top"><b>*Book classification:</b></td>
                        <td>
                        <select id="bookKind" name="bookKind">
                        	<?php echo  $bookKindOptions; ?>
                        </select>
                        </td>
                      </tr>                      
                      <tr> 
                        <td valign="top"><b>*Level(s):</b></td>
                        <?php
						function levelCheckBox($x){
							echo " value=\"".$x."\" ";
							if ($x==1) echo " checked=\"checked\"" ;
						}						
						?>
                        <td>
                        	<table border="0" width="100%" style="text-align:right">
                            	<tr>
                                	<td>Beginner:&nbsp;<input id="level0" name="level0" type="checkbox" <?php levelCheckBox($level0);?> /></td>
                                	<td>Elementary:&nbsp;<input id="level1" name="level1" type="checkbox" <?php levelCheckBox($level1);?> /></td>
                                    <td>Upper Elementary:&nbsp;<input id="level2" name="level2" type="checkbox" <?php levelCheckBox($level2);?> /></td>
                                </tr>
                                <tr>
                                    <td>Lower Intermediate:&nbsp;<input id="level3" name="level3" type="checkbox" <?php levelCheckBox($level3);?> /></td>
                                    <td>Intermediate:&nbsp;<input id="level4" name="level4" type="checkbox" <?php levelCheckBox($level4);?> /></td>
                                    <td>Upper Intermediate:&nbsp;<input id="level5" name="level5" type="checkbox" <?php levelCheckBox($level5);?> /></td>
                                </tr>
                                <tr>
                                    <td>Advanced Level 1:&nbsp;<input id="level6" name="level6" type="checkbox" <?php levelCheckBox($level6);?> /></td>
                                    <td>Advanced Level 2:&nbsp;<input id="level7" name="level7" type="checkbox" <?php levelCheckBox($level7);?> /></td>
                                    <td>Advanced Level 3:&nbsp;<input id="level8" name="level8" type="checkbox" <?php levelCheckBox($level8);?> /></td>
                                </tr>
                            </table>
                        </td>
                      </tr>                      
					  
                    </table></td>
                </tr>
                <tr valign="top"> 
                  <td colspan="2" bgcolor="#eeeeee">&nbsp; </td>
                </tr>
                <tr valign="top" bgcolor="#dddddd"> 
                  <td colspan="2" align="center">
                  	<input name="action" type="submit" id="action" value="Save changes" onclick="levelValue(); validar();" />
                    <input type="hidden" id="infoValida" name="infoValida" value="<?php echo $infoValida;?>">
                    <?php if ($id != "" ) { //solo update	?>
	                    <input name="action2" type="submit" id="action2" value="Delete book" onclick="confirmacionBorrar();" />
	                <?php } ?>
                    <input type="hidden" name="borrar" id="borrar" value="<?php echo $borrar;?>">
                    <?php if ($id==""){ ?>
                    	<input name="back" id="back" type="button" value="Back to search" onclick="javascript:location.href='busquedaLibro.php';" />
                    <?php } else { ?>
                  		<input name="back" id="back" type="button" value="Back to book" onclick="javascript:location.href='vistaLibro.php?id=<?php echo $id; ?>';" />
                    <?php } ?>
                  </td>
                </tr>
              </table>
            </form>            
            <!--end dynamic content -->
            </td>
        </tr>
      </table><!--</td>
  </tr>
</table>-->
<?php include 'includes/foot.php'?>
