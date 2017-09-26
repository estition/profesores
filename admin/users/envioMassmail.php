
<?php include '../../includes/constants.php'?>
<?php include '../../includes/functions.php'?>
<?php include '../../includes/database.php'?>
<?php include '../../includes/authorize.php'?>


<?php
$message = "";
$id= $_POST["id"];
//$identificador= $_POST["identificador"];
$enviar=$_REQUEST['enviar'];	//enviar mail
$mensaje_mail=$_REQUEST['mensaje_mail'];
$mensaje_mail_html=str_replace("\r","<br />",$mensaje_mail);
$correos=$_REQUEST['correos'];
$asunto=$_REQUEST['asunto'];
if ($asunto=="") $asunto="Informe";
$archivos_attach=$_REQUEST['archivos_attach'];
$mode = "Sending student report(s)";
$infoValida = $_POST["infoValida"];
$file_source=$_FILES['attachment'];

$attached_files=$_REQUEST['attached_files'];

$attach=$_REQUEST['attach'];

$files= array();

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
	$cont_id=0;
		foreach($identificador as $id){
			if ($id!= NULL or $id!=""){
				$query= "select ID, email from users where ID='".$id."'";
				$resultado=mysqli_query($link, $query) or die("Query error: ".mysqli_error($link));
				$row=mysqli_fetch_row($resultado);			

				if ($cont_id!=0) {
					$correos.=",".$row['1'];					
				}
				$cont_id++;
			}

		}
		$correos=substr($correos,1);
}
		
			////////////////////////////////////////////////////////////////////////	 

if ($attach=="Attach File"){


$target = "attachment_tmp/"; 
$target = $target . basename( $_FILES['attachment']['name']); 

$ok=1;
if(move_uploaded_file($_FILES['attachment']['tmp_name'], $target)) 
		{ 
		$mensaje = "The file <strong>". basename($_FILES['attachment']['name']). "</strong> is attached";
		$attached_files= $attached_files.",".basename($_FILES['attachment']['name']);
		
		} 
	else { 
		$mensaje = "Sorry, there was a problem attaching your file.";
		} 
}


$file_source= "attachment_tmp/";

$files= separa_en_array($attached_files);
 /////////////////////////////////////////////////////////////
 
//echo "<TR><TD colspan='2'><p><span class='style13'>".$files."1"."</span></p></TD></TR>";
//echo "<TR><TD colspan='2'><p><span class='style13'>".$file_source."2"."</span></p></TD></TR>";
//echo "<TR><TD colspan='2'><p><span class='style13'>".$correos."3"."</span></p></TD></TR>";

include 'includes/funcionReporteAlumnoMail.php';

if ( ($enviar =="Send") && ($infoValida) ){

$mensaje=$mensaje." ".EnviarCorreo(separa_en_array($correos),$asunto,$mensaje_mail,$mensaje_mail_html,$file_source, $files);
}


if ($id == "") {
	$id = $_REQUEST['id'];
}

	
?>
<?php include '../../includes/top.php';?>
    
    <div style="position: relative;" align="center"> 
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

     <table width="100%" border="0" class="pepe3" align="center" cellpadding="10" cellspacing="0" id="body">
        <tr> 
          <td width="100%" valign="top"> <p align="center"><b>Student Reports&#8211; </b></p>
           <table border="0" class="pepe3" cellpadding="5" cellspacing="0" id="shell">
                <tr valign="top"> 
                  <td colspan="2" bgcolor="#fff">&nbsp;</td>
                </tr>
                <tr valign="top">
            
   
<!-- CUERPO E-MAIL  -->
            
<TD width="600" valign="top">


          <form method="post" enctype="multipart/form-data" action="envioMassmail.php" name="enviar_mail" id="enviar_mail">
		    <TABLE WIDTH=600 class="pepe3" HEIGHT=321 align="center" bgcolor="#cccccc" class="bodytext">
		      <TR>
		        <TD colspan="2" valign="top">		          
		          				  
                    <?php  //($mensaje!="" && strpos($mensaje, "E-Mail sent succesfully to")!=false)

					if ($mensaje!="" && strpos($mensaje, "E-Mail sent succesfully to")!=false){
						echo "<p style='text-align:center'><span class='style13'>".$mensaje."</span></p>";
						echo "</TD></TR>";
						echo "<TR><TD colspan='2' style='text-align:center'>";
						echo "<input name=\"back\" id=\"back\" type=\"button\" value=\"Back to search\" onclick=\"javascript:location.href='index.php';\" />";
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
		            <TD width="443" style="padding-right:2em"><input type="text" name="from" id="from" size="60" value="scheduling@canterburyenglish.com" disabled></TD>
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
				   <?php echo "\n".$mensaje_mail; ?>
                  </textarea></TD></TR>	         
                  <TR>
                    <TD colspan="2"><p><span class="style14">Attached File(s):</span><?php if(!empty($files)){foreach($files as $reg){ echo " <br>".$reg;}}?></p></TR>                 
                    
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
                  <input type="file" name="attachment" id="attachment">                    
                 
                    <input type="submit" name="attach" id="attach" value="Attach File">
                    
                     <input type="hidden" name="attached_files" id="attached_files" value="<?php echo $attached_files; ?>">
                     
                     
                  	<input type="submit" name="enviar" id="enviar" value="Send" onClick="validar()" >
		            
                    <input type="hidden" id="infoValida" name="infoValida" value="<?php echo $infoValida;?>">
                    <input name="back" id="back" type="button" value="Back" onClick="javascript:window.history.go(-1);" />
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
</TABLE>    
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
         </div>  
       
         
	</body>
</html>

<?php //include 'includes/foot.php'?>

