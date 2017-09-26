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
/*$title= $_POST["title"];
$authors= $_POST["authors"];
$description = $_POST["description"];
$editorial = $_POST["editorial"];
$editionDate = $_POST["editionDate"];
$editionPlace = $_POST["editionPlace"];
$isbn = $_POST["isbn"];
$editionNumber = $_POST["editionNumber"];
$pages = $_POST["pages"];
$level0 = $_POST["level0"];
$level1 = $_POST["level0"];
$level2 = $_POST["level0"];
$level3 = $_POST["level0"];
$level4 = $_POST["level0"];
$level5 = $_POST["level0"];
$level6 = $_POST["level0"];
$level7 = $_POST["level0"];
$level8 = $_POST["level0"];
$level9 = $_POST["level0"];*/

if ($id == "") {
	$id = $_REQUEST['id'];
}


//if (($id != "") && (($message == "<br />Book Profile Saved.") || ($message == ""))) {
if (($id != "") || ($message == "")) {
	$mode = "Selecting chapters to send";
	$sql = "select * from libraryBook where idLibraryBook = " . $id;
	$sql = "select * from libraryBook, libraryBookKind where libraryBook.idLibraryBookKind = libraryBookKind.idLibraryBookKind and idLibraryBook = " . $id; //Modificada para agregar clasificación; 20090622
	$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
	if ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$title =  stripslashes($row["title"]);
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
		$bookKind = $row["name"];		
	}
	
	$sql2 = "select * from libraryChapter where idLibraryBook = " . $id . " order by number";
	$result2 = mysql_query($sql2) or die("Invalid query: " . mysql_error());
}

	
?>
<?php include 'includes/top.php'?>
<?php include 'includes/menu.php'?>

<script type="text/javascript">
	function enviar_correo(contador, idCurso, course_type, direccionar){
		//var correos="";
		var id;
		var bandId=false;
		for (i=1; i<contador; i++){
			id="chapterSelection"+i;
			if (document.getElementById(id).checked==true){		
				//correos+=","+id;
				var identificador=identificador+","+document.getElementById(id).value;
				bandId=true;	
			}	
		}
		if (bandId==true) {
			identificador=identificador.substr(1);
		}
		if ( (direccionar=="mail") && (bandId==true) ) {
			window.location="envioCapitulos.php?identificador="+identificador;
		} else {
			alert("Select chapter(s).");
		}
	}

	function check(contador){
		var respuesta;
		/*if (document.getElementById("todos").checked){
		respuesta=true;
		} else {respuesta=false;}*/
		for (i=1; i<contador; i++){		
			id="chapterSelection"+i;
			document.getElementById(id).checked=respuesta;				
		}	
	}
</script>


      <table width="100%" border="0" cellpadding="10" cellspacing="0" id="body">
        <tr> 
          <td width="100%" valign="top"> <p><b>Library &#8211; 
              <?php echo  $mode ?> <br><font color='#ff9900'><?php echo  $message; ?></font></b></p>
            <!--start dynamic code -->
            <form name="associate" id="associate" method="post">
            	<input type="hidden" name="id" value="<?php echo $id;?>">
              <table border="0" cellpadding="5" cellspacing="0" id="shell">
                <tr valign="top"> 
                  <td colspan="2" bgcolor="#EEEEEE">&nbsp;</td>
                </tr>
                <tr valign="top"> 
                  <td bgcolor="#EEEEEE"><font>Book</font></td>
                  <td bgcolor="#FFFFFF"> <table border="0" cellpadding="5" cellspacing="0" id="login">
                      <tr> 
                        <td valign="top"><b>Title:</b></td>
                        <td><?php echo  $title;?></td>               
                      </tr>
                     <tr> 
                        <td valign="top"><b>Authors:</b></td>
                        <td><?php echo  $authors;?></td>
                      </tr>
                      <tr> 
                        <td valign="top"><b>Description:</b></td>
                        <td><?php echo  $description;?></td>
                      </tr>
                      <tr> 
                        <td valign="top"><b>Editorial:</b></td>
                        <td><?php echo  $editorial;?></td>
                      </tr>
                      <tr> 
                        <td valign="top"><b>Edition Date:</b></td>
                        <td><?php echo  $editionDate;?></td>
                      </tr>
                      <tr> 
                        <td valign="top"><b>Edition Place:</b></td>
                        <td><?php echo  $editionPlace;?><br></td>
                      </tr>
                      <tr>
                      <tr> 
                        <td valign="top"><b>ISBN:</b></td>
                        <td><?php echo  $isbn;?></td>
                      </tr>
                      <tr> 
                        <td valign="top"><b>Edition number:</b></td>
                        <td><?php echo  $editionNumber;?></td>
                      </tr>
                      <tr> 
                        <td valign="top"><b>Pages:</b></td>
                        <td><?php echo  $pages;?></td>
                      </tr>
                      <tr>
                       	<td colspan="2" style="text-align:center">Canterbury English information:</td>
                      </tr>
                      <tr> 
                        <td valign="top"><b>Book classification:</b></td>
                        <td><?php echo  $bookKind;?></td>
                      </tr>
                      <tr> 
                        <td valign="top"><b>Level(s):</b></td>
                        <td>
                        	<table border="0" width="100%" style="text-align:center">                            	
                                <?php
    	                            if ($level0) echo "<tr><td>Beginner</td></tr>";
									if ($level1) echo "<tr><td>Elementary</td></tr>";
									if ($level2) echo "<tr><td>Upper Elementary</td></tr>";
									if ($level3) echo "<tr><td>Lower Intermediate</td></tr>";
									if ($level4) echo "<tr><td>Intermediate</td></tr>";
									if ($level5) echo "<tr><td>Upper Intermediate</td></tr>";
									if ($level6) echo "<tr><td>Advanced Level 1</td></tr>";
									if ($level7) echo "<tr><td>Advanced Level 2</td></tr>";
									if ($level8) echo "<tr><td>Advanced Level 3</td></tr>";
								?>
                            </table>
                        </td>
                      </tr>
                      
                    </table></td>
                </tr>
                
                                
                <!-- chapters -->                
                <tr valign="top"> 
                  <td colspan="2" bgcolor="#EEEEEE">&nbsp;</td>
                </tr>
                <tr valign="top"> 
                  <td bgcolor="#EEEEEE"><font>Chapters</font></td>
                  <td bgcolor="#FFFFFF"> <table border="0" cellpadding="5" cellspacing="0" id="login">
                  	  <tr><td>&nbsp;</td><td width="100"><b>Title</b></td><td width="150"><b>Description</b></td><td width="150"><b>Link</b></td><td><b>Select chapters</b></td>
                      </tr>
                	  <?php
					  		$contador=1;
                      		while ($row2 = mysql_fetch_array($result2, MYSQL_ASSOC)) {
								echo "<tr>";
								echo "<td>".$row2['number'].".- </td>";
								echo "<td>".$row2['title']."</td>";
								echo "<td>".$row2['description']."</td>";
								if ($row2['url']!="") {
									echo "<td><a href=\"recursos/".$row2['url']."\" target=\"_blank\" >See the chapter here</a></td>";
									echo "<td style=\"text-align:center\"><input type=\"checkbox\" name=\"chapterSelection".$contador."\" id=\"chapterSelection".$contador."\" value=\"".$row2['idLibraryChapter']."\" /> </td>";	
								} else {
									echo "<td>None</td>";
									echo "<td style=\"text-align:center\"><input type=\"checkbox\" name=\"chapterSelection".$contador."\" id=\"chapterSelection".$contador."\" value=\"".$row2['idLibraryChapter']."\" disabled=\"true\" /> </td>";	
								}									
								echo "</tr>\n\t\t\t";
								$contador++;
							}
												
					  ?>
                      
                    </table></td>
                </tr>
                <!-- chapters -->                                                
                
                <tr valign="top"> 
                  <td colspan="2" bgcolor="#eeeeee">&nbsp; </td>
                </tr>
                <tr valign="top" bgcolor="#dddddd">
                  <td colspan="2" align="center">                  	
                    <!--<input name="back" id="back" type="button" value="Back" onclick="javascript:window.history.go(-1);" />-->
                        <input type="button" name="mail_send" id="mail_send" value="Send e-mail" onClick="enviar_correo(<?php echo "'".$contador."'"; ?>,'','','mail')">
                    <input name="back" id="back" type="button" value="Back to book" onclick="javascript:location.href='vistaLibro.php?id=<?php echo $id; ?>';" />		
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
