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
$cb_title= $_REQUEST["cb_title"];
$cb_authors= $_REQUEST["cb_authors"];
//$cb_isbn= $_REQUEST["cb_isbn"]; //Modificación, isbn no necesario; 20090622
$cb_kind= $_REQUEST["cb_kind"];
$cb_levels= $_REQUEST["cb_levels"];
$title= $_POST["title"];
$authors= $_POST["authors"];
$isbn = $_POST["isbn"];
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


$mode = "Searching books";
//if ( (($cb_title)||($cb_authors)||($cb_isbn)||($cb_levels)) && (($message == "<br />Searching books") || ($message == ""))) {
if ( (($cb_title)||($cb_authors)||($cb_kind)||($cb_levels)) && (($message == "<br />Searching books") || ($message == ""))) {
	//$sql = "select idLibraryBook, title, authors, isbn from libraryBook where ";
	//$sql = "select * from libraryBook where "; //cambio, para mostrar todos los campos;18/06/2009
		$sql = "select * from libraryBook, libraryBookKind where libraryBook.idLibraryBookKind = libraryBookKind.idLibraryBookKind and "; //Modificada para agregar clasificación; 20090622
	
	if ($cb_title) $sql .= " title like '%" . addslashes($title) . "%' ";
	if ( ($cb_title) && ($cb_authors) ) $sql .= " and ";
	if ($cb_authors) $sql .= " authors like '%" . addslashes($authors) . "%' ";
	/*if ( (($cb_title) || ($cb_authors)) && ($cb_isbn) ) $sql .= " and ";
	if ($cb_isbn) $sql .= " isbn like '%" . addslashes($isbn) . "%' ";*/ //Modificación, isbn no necesario; 20090622
	if ( (($cb_title) || ($cb_authors)) && ($cb_kind) ) $sql .= " and "; //Modificada para agregar clasificación; 20090622
	if ($cb_kind) $sql .= " libraryBookKind.idLibraryBookKind = " . addslashes($bookKind) . " ";
	
	if ($cb_levels) { 
	//if ( (($cb_title) || ($cb_authors) || ($cb_isbn)) && ($cb_levels) ) {	
		/*
		$levelString = "";
		for($i=0;$i<=8;$i++){
			$levelString = "level".$i;
			if ($levelString) $sql .= " and level".$i." = 1 ";
		}
		*/
		//if ( ((!$cb_title) && (!$cb_authors) && (!$cb_isbn)) ) $sql .= " idLibraryBook = idLibraryBook ";	//Modificación, isbn no necesario; 20090622
		if ( ((!$cb_title) && (!$cb_authors) && (!$cb_kind)) ) $sql .= " idLibraryBook = idLibraryBook "; //Modificada para agregar clasificación; 20090622
		if ($level0) $sql .= " and level0 = 1 ";
		if ($level1) $sql .= " and level1 = 1 ";
		if ($level2) $sql .= " and level2 = 1 ";
		if ($level3) $sql .= " and level3 = 1 ";
		if ($level4) $sql .= " and level4 = 1 ";
		if ($level5) $sql .= " and level5 = 1 ";
		if ($level6) $sql .= " and level6 = 1 ";
		if ($level7) $sql .= " and level7 = 1 ";
		if ($level8) $sql .= " and level8 = 1 ";
	}
	
	$sql .= " order by libraryBookKind.idLibraryBookKind, title;";	//Modificada para agregar clasificación; 20090622
	
	//print $sql;
	$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
	
//} else if ( (!$cb_title)&&(!$cb_authors)&&(!$cb_isbn)&&(!$cb_levels) ) {	//Modificación, isbn no necesario; 20090622
} else if ( (!$cb_title)&&(!$cb_authors)&&(!$cb_kind)&&(!$cb_levels) ) {
	//$sql = "select idLibraryBook, title, authors, isbn from libraryBook";
	//$sql = "select * from libraryBook order by idLibraryBook, title; "; //cambio, para mostrar todos los campos;18/06/2009
	$sql = "select * from libraryBook, libraryBookKind where libraryBook.idLibraryBookKind = libraryBookKind.idLibraryBookKind and idLibraryBook order by libraryBookKind.idLibraryBookKind, title; "; //Modificada para agregar clasificación; 20090622
	//print $sql;	
	$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
}

//Se agrega clasificación de CE; 20090622
$sqlBookKind = "select idLibraryBookKind, name from libraryBookKind order by idLibraryBookKind";
$resultBookKind = mysql_query($sqlBookKind) or die("Invalid query: " . mysql_error());
//$bookKindOptions .= "<option value=\"0\">Select book classification...</option>";
$bookKindOptions="";
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
	function levelValue(){
		for(i=0;i<=8;i++){
			if (document.getElementById("level"+i).checked==false)
				document.getElementById("level"+i).value = 0;
			else
				document.getElementById("level"+i).value = 1;
		}
	}
	function searchValue(){
		if (document.getElementById("cb_title").checked==true) document.getElementById("cb_title").value = 1;
		if (document.getElementById("cb_authors").checked==true) document.getElementById("cb_authors").value = 1;
		//if (document.getElementById("cb_isbn").checked==true) document.getElementById("cb_isbn").value = 1;	//Modificación, isbn no necesario; 20090622
		if (document.getElementById("cb_kind").checked==true) document.getElementById("cb_kind").value = 1;
		if (document.getElementById("cb_levels").checked==true) document.getElementById("cb_levels").value = 1;		
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
                  <td bgcolor="#EEEEEE"><font>Select criteria</font></td>
                  <td bgcolor="#FFFFFF"> <table border="0" cellpadding="5" cellspacing="0" id="login">
                      <tr>
                       	<td><input id="cb_title" name="cb_title" type="checkbox" <?php levelCheckBox($cb_title);?> /></td>                     
                        <td><b>Title:</b></td>
                        <td><input name="title" type="text" maxlength="100" size="50" value="<?php echo $title; ?>"></td>               
                      </tr>
                     <tr>
                       	<td><input id="cb_authors" name="cb_authors" type="checkbox" <?php levelCheckBox($cb_authors);?> /></td>                     
                        <td><b>Authors:</b></td>
                        <td><input name="authors" type="text" maxlength="75" size="50" value="<?php echo $authors; ?>"></td>
                      </tr>
                      <tr>
                       	<td colspan="3" style="text-align:center">Canterbury English information:</td>
                      </tr>
                      <tr>
                       	<td><input id="cb_kind" name="cb_kind" type="checkbox" <?php levelCheckBox($cb_kind);?> /></td>                      
                        <td><b>Book classification:</b></td>
                        <td>
                        <select id="bookKind" name="bookKind">
                        	<?php echo  $bookKindOptions; ?>
                        </select>
                        </td>                        
                      </tr>                      
                      <tr>
                      	<td><input id="cb_levels" name="cb_levels" type="checkbox" <?php levelCheckBox($cb_levels);?> /></td>
                        <td><b>Level(s):</b></td>
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
                  	<?php if ($is_admin_a) { ?>                                      
                  		<input name="addBook" id="addBook" type="button" value="Add new book" onclick="javascript:location.href='gestionLibro.php';" />
                    <?php } ?>
                    <input name="action" type="submit" id="action" value="Search" onclick="levelValue(); searchValue();"> 
                  </td>
                </tr>
              </table>
            </form>            
            <!--end dynamic content -->
            </td>
        </tr>
	   </table>      

      <br /><br />
      	<table>
        	<?php if ($is_admin_a) { ?>
      		<tr><td><span style="text-align:center"><a href="http://www.canterburyenglish.com/profesores/admin/biblioteca/recursos/CEVL-administrator_guide.pdf" target="_blank">View the virtual library administrator's guide</a></span></td></tr>
            <?php } ?>
            <tr><td><span style="text-align:center"><a href="http://www.canterburyenglish.com/profesores/admin/biblioteca/recursos/CEVL-teacher_guide.pdf" target="_blank">View the virtual library teacher's guide</a></span></td></tr>
      	</table>
      <br /><br />
      <?php  //busqueda
      //if ( (($cb_title)||($cb_authors)||($cb_isbn)||($cb_levels)) && (($message == "<br />Searching books") || ($message == ""))) {
	  ?>

      <table width="100%" border="0" cellpadding="10" cellspacing="0"><tr><td><!-- tabla ext. results -->
      
      <table width="700" border="0" cellpadding="5" cellspacing="0"><!-- tabla int. results -->
      	<tr valign="top"> 
        	<td colspan="6" bgcolor="#eeeeee">&nbsp; </td>
        </tr>
        
        
        <tr valign="top"> 
            <td bgcolor="#EEEEEE"><font>Results</font></td>
            <td bgcolor="#FFFFFF">
            <table border="0" cellpadding="5" cellspacing="0">
        	
            <?php				
			if (mysql_num_rows($result)==0)
				echo "<tr><td><b>There are no results for this search.</b></td></tr>";
			else {
            ?>
		      	<tr>
        			<!--<td>&nbsp;</td><td width="25%"><b>Title</b></td><td width="25%"><b>Description</b></td><td width="25%"><b>Level(s)</b></td><td width="25%"><b>Link</b></td>-->
                    <td td width="20%"><b>Book<br />classification</b></td><td width="20%"><b>Title</b></td><td width="20%"><b>Description</b></td><td width="20%"><b>Level(s)</b></td><td width="20%"><b>Link</b></td>
		      	</tr>     
       			<?php
				$cadenaKind="";
           		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {					
					echo "<tr>";
					//echo "<td>&nbsp;</td>";
					if ($cadenaKind!=$row['name']){
						$cadenaKind=$row['name'];
						echo "<td>".$cadenaKind."</td>";
					} else
						echo "<td>&nbsp;</td>";
//					echo "<td>".$row['idLibraryBookKind']."</td>";
					echo "<td>".$row['title']."</td>";
					echo "<td>".$row['description']."</td>";
					echo "<td>";
						if ($row['level0']) echo "Beginner<br />";
						if ($row['level1']) echo "Elementary<br />";
						if ($row['level2']) echo "Upper Elementary<br />";
						if ($row['level3']) echo "Lower Intermediate<br />";
						if ($row['level4']) echo "Intermediate<br />";
						if ($row['level5']) echo "Upper Intermediate<br />";
						if ($row['level6']) echo "Advanced Level 1<br />";
						if ($row['level7']) echo "Advanced Level 2<br />";
						if ($row['level8']) echo "Advanced Level 3<br />";
					echo "</td>";
					echo "<td><a href=\"vistaLibro.php?id=".$row['idLibraryBook']."\" >See the book here</a></td>";																						
					echo "</tr>";
				}				
				?>
        	<?php	} //else?>
        	</table>
            </td>
      	</tr>
        
        
        <tr valign="top"> 
        	<td colspan="6" bgcolor="#eeeeee">&nbsp; </td>
        </tr>
        <tr valign="top" bgcolor="#dddddd">
            <td colspan="6" align="center">        		
                &nbsp;<br />          
            </td>
        </tr>

              
      </table><!-- tabla int. results -->
      
      </td></tr></table><!-- tabla ext. results -->
      
      <?php //busqueda
	  //}
	  ?>      
      <br /><br /><br />
      <!--</td>
  </tr>
</table>-->
<?php include 'includes/foot.php'?>
