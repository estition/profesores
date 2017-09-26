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
$id= $_POST["id"];
//$identificador= $_POST["identificador"];
//enviar mail
$enviar=$_REQUEST['enviar'];
$mensaje_mail=$_REQUEST['mensaje_mail'];
$mensaje_mail_html=str_replace("\r","<br />",$mensaje_mail);
$correos=$_REQUEST['correos'];
$asunto=$_REQUEST['asunto'];
$file_source=$_FILES['attachment'];
$attached_files=$_REQUEST['attached_files'];
$attach=$_REQUEST['attach'];
$files= array();
$mode = "Sending book chapters";
//enviar mail
$infoValida = $_POST["infoValida"];

function separa_en_array($parametro){
	if ($parametro!=""){
	$token= strtok($parametro,",");
	while ($token!=false){
	$files[$i]=trim($token);
	$i++;
	$token=strtok(",");
	}
	}
	return $files;
}

if($_REQUEST['identificador']!="")
	{	
	$identificador=separa_en_array($_REQUEST['identificador']);
	//$correos="";
	$enlaces="";
	$infoLibro="";
	$idLibro=0;
	$cont_id=0;
		foreach($identificador as $id){
			if ($id!= NULL or $id!=""){			
//				$query= "select email from alumno where idalumno='".$id."'";
				$query= "select url, number, title, idLibraryBook from libraryChapter where idLibraryChapter='".$id."'";		
				$resultado=mysql_query($query) or die("Query error: ".mysql_error());
				$row=mysql_fetch_row($resultado);
				//$correos.=",".$row[0];
				//$enlaces.=",".$row[0];
				if ($cont_id!=0) {
					$enlaces.="<a href=http://www.canterburyenglish.com/profesores/admin/biblioteca/recursos/".$row[0].">".$row[1].". ".$row[2]."</a><br />";	//Atención: se eliminan las comillas de href en los enlaces por problemas de interpretación en el servidor
					$idLibro = $row[3];
				}
				$cont_id++;
			}
		}
		if ($idLibro!=0){
			$sqlLibro = "select title, authors from libraryBook where idLibraryBook = " . $idLibro;
			$resultLibro = mysql_query($sqlLibro) or die("Invalid query: " . mysql_error());			
			$rowLibro = mysql_fetch_row($resultLibro);
			$infoLibro = "Book information<br />Title: ".$rowLibro[0]."<br />Author(s): ".$rowLibro[1]."<br />";
		} else $infoLibro = "";
	//$correos=substr($correos,2);
	$enlaces = "\n\n<!-- ATTENTION, DO NOT MODIFY OR DELETE THE NEXT CODE. -->\n".$infoLibro."If you want to have a color copy of this book, you can buy it at your usual bookstore using the above information.<br /><br />Click on the next link(s) to see a chapter(s) sample:<br />".$enlaces."<br />Important: This is an automatically generated e-mail, please do not reply to this address.<br /><br />\n<!-- END OF CODE -->";
	
	}


include 'includes/functionMailCE.php';

$file_source= "attachment_tmp/";
$files=separa_en_array($attached_files);


if ( ($enviar =="Send") && ($infoValida) ){
	$asunto = "Canterbury English: ".$asunto;
	$mensaje_mail = $first." ".$last1." wrote:\n\n". $mensaje_mail;
	$mensaje_mail_html = $first." ".$last1." wrote:<br /><br />". $mensaje_mail_html;
	$mensaje=$mensaje." ".EnviarCorreo(separa_en_array($correos),$asunto,$mensaje_mail,$mensaje_mail_html, $file_source, $files);
}


if ($id == "") {
	$id = $_REQUEST['id'];
}

	
?>
<?php include 'includes/top.php'?>
<?php include 'includes/menu.php'?>

<script type="text/javascript">
	function validar(){
		var x=1;
		cadena="";
		if (document.getElementById("correos").value==""){
			x = 0; cadena += " - Enter e-mail address(es).\n";
		}
		if (document.getElementById("asunto").value==""){
			x = 0; cadena += " - Enter subject.\n";
		}
		
		if (x==0) alert("Please correct:\n"+cadena);
		
		if (x==1) document.getElementById("infoValida").value = 1;
		else document.getElementById("infoValida").value = 0;		
	}	
</script>

      <table width="100%" border="0" cellpadding="10" cellspacing="0" id="body">
        <tr> 
          <td width="100%" valign="top"> <p><b>Library &#8211; 
            <?php echo  $mode ?> <br><font color='#ff9900'><?php echo  $message; ?></font></b></p>
            <table border="0" cellpadding="5" cellspacing="0" id="shell">
                <tr valign="top"> 
                  <td colspan="2" bgcolor="#EEEEEE">&nbsp;</td>
                </tr>
                <tr valign="top">
                  <!--<td bgcolor="#EEEEEE"><font>Book Info</font></td>-->
            
   
<!-- CUERPO E-MAIL  -->
            
<TD width="600" valign="top">


          <form method="post" enctype="multipart/form-data" action="envioCapitulos.php" name="enviar_mail" id="enviar_mail">
		    <TABLE WIDTH=600 HEIGHT=321 align="left" bgcolor="#FFFFFF" class="bodytext">
		      <TR>
		        <TD colspan="2" valign="top">		          
		          				  
                    <?php  //($mensaje!="" && strpos($mensaje, "E-Mail sent succesfully to")!=false)

					if ($mensaje!="" && strpos($mensaje, "E-Mail sent succesfully to")!=false){
						//echo "<TR><TD colspan='2'><p><span class='style13'>".$mensaje."</span></p></TD></TR>";
						echo "<p style='text-align:center'><span class='style13'>".$mensaje."</span></p>";
						echo "</TD></TR>";
						echo "<TR><TD colspan='2' style='text-align:center'>";
						echo "<input name=\"back\" id=\"back\" type=\"button\" value=\"Back to search\" onclick=\"javascript:location.href='busquedaLibro.php';\" />";
						echo "</TD></TR>";
					} else {					
					?>
                    <p><span class='style13'> <?php echo $mensaje; ?></span></p>
                </TD>
		      </TR>
			      
			      <TR>
			        <TD colspan="2" style="padding-right:2em">&nbsp;</TD>
		        </TR>
                
                <TR><TD>                
                
                <TABLE border="0"><!-- TABLE INT -->
			      <TR>
			        <TD width="79" style="padding-right:2em"><p><strong>From: </strong></p> </TD>
		            <TD width="443" style="padding-right:2em"><input type="text" name="from" id="from" size="60" value="teachers@canterburyenglish.com" disabled></TD>
			      </TR>
			      <TR>
			        <TD style="padding-right:2em"><p><strong>To:</strong></p></TD>
		            <TD style="padding-right:2em"><input type="text" name="correos" id="correos" size="60" value="<?php echo $correos;?>"></TD>
		          </TR>
			      <TR>
			        <TD style="padding-right:2em"><p><strong>Subject: </strong></p></TD>
		            <TD style="padding-right:2em"><input type="text" name="asunto" id="asunto" size="60" value="<?php echo $asunto;?>"></TD>
		          </TR>
			      <TR>
			        <TD colspan="2"><p><strong>Message:</strong></p></TD>
	              </TR>
		          <TR><TD colspan="2"><textarea name="mensaje_mail" id="mensaje_mail" rows="20" cols="60">
				  <?php echo "\n".$mensaje_mail.$enlaces; ?>
                  </textarea></TD></TR>	         
                  <TR>
                    <TD colspan="2"><p><span class="style14">Attached File:</span><?php if(!empty($files)){foreach($files as $reg){ echo " <br>".$reg;}}?></p></TR>                 
                <tr>
                  <td colspan="2"><input type="file" name="attachment" id="attachment">
                  <label>
                    <input type="submit" name="attach" id="attach" value="Attach File" <?php if (!empty($files)) echo "disabled=\"disabled\""; ?> >
                  </label>
                  </td>
                </tr>                
              </TABLE><!-- TABLE INT -->              
 
              </TD></TR>              
              
<!--	          
        </TABLE>
          </form>
</TD>
-->
                
<!-- CUERPO E-MAIL  -->
                
                <tr valign="top"> 
                  <td colspan="2" bgcolor="#eeeeee">&nbsp; </td>
                </tr>
                <tr valign="top" bgcolor="#dddddd"> 
                  <td colspan="2" align="center">
                  	<input type="submit" name="enviar" id="enviar" value="Send" onclick="validar()" >
		            <input type="hidden" name="attached_files" id="attached_files" value="<?php echo $attached_files; ?>">
                    <input type="hidden" id="infoValida" name="infoValida" value="<?php echo $infoValida;?>">
                    <input name="back" id="back" type="button" value="Back" onclick="javascript:window.history.go(-1);" />
                  </td>
                </tr>
              <!--</table>-->
              
            <!--end dynamic content -->
            
            <?php  //($mensaje!="" && strpos($mensaje, "E-Mail sent succesfully to")!=false)
			}
			?>
            
            <!-- </td> 
        </tr> -->
      </table>
</form>      
      </td>
  </tr>
<!--</table> -->

<!-- NO FOOTER --->
			<tr height="10">				
				<td align="left"><br />
				&copy; Canterbury English, <?php echo date("Y"); ?>
				</td>
			</tr>
		</table>
	</body>
</html>

<?php //include 'includes/foot.php'?>
