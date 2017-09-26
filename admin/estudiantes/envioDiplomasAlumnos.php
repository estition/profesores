<?php include '../../includes/constants.php'?>
<?php include '../../includes/functions.php'?>
<?php include '../../includes/database.php'?>
<?php include '../../includes/authorize.php'?>
<?php include '../../includes/top.php';?>
    
    

</head>
<?php

$message = "";
$id= $_POST["id"];
//$identificador= $_POST["identificador"];
$enviar=$_REQUEST['enviar'];	//enviar mail
$mensaje_mail=$_REQUEST['mensaje_mail'];
$mensaje_mail_html=str_replace("\r","<br />",$mensaje_mail);
$correos=$_REQUEST['correos'];
$asunto=$_REQUEST['asunto'];
if ($asunto=="") $asunto="Diploma";
$archivos_attach=$_REQUEST['archivos_attach'];
$mode = "Sending student report(s)";
$infoValida = $_POST["infoValida"];

function separa_en_array($parametro){
    $files = array();
	if ($parametro != "" || !is_null($parametro) || $parametro !== "ndefined"){
            $pos = strpos($parametro, ',');
            if ( $pos !== false) {
//                $token= strtok($parametro,",");
                $files = explode(",", $parametro);
            }else{
                array_push($files,  $parametro);
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
        
function numbersFilters($id)
{
    if (!is_null($id) && $id !== "" && is_numeric ( $id ) && $id !== "ndefined"){
        return $id;
    }
}
$ids = array_map("numbersFilters", $identificador);
$idsNotNulls = array_filter($ids);
//var_dump($idsNotNulls);
$emails = array();
		foreach($idsNotNulls as $id){
			if ($id!= NULL or $id!=""){
				$query= "select ID, email from informes_alumnos2 where ID='".$id."'";
				$resultado=mysqli_query($link, $query) or die("Query error: ".mysqli_error($link));
				$row=mysqli_fetch_row($resultado);			
					array_push($emails, $row['1']);					
				$cont_id++;
			}
		}


		
//var_dump(implode(",", $idsNotNulls));exit;
//$query= "select email from informes_alumnos2 where ID IN ('".implode("', '",$idsNotNulls)."')";
//$resultado=mysqli_query($link, $query) or die("Query error: ".mysqli_error($link));
//$rows=mysqli_fetch_array($resultado, MYSQL_NUM);
//var_dump($query);
if(count($emails) > 0){
$unique_mails = array_unique($emails);
$correos = implode(",",  $unique_mails);
    
}else $correos = "";

	//$correos=substr($correos,2);
	$anioCarta=(int)date("Y");
	$cabecera="<!-- ATTENTION, DO NOT MODIFY OR DELETE THE NEXT CODE. -->\n<table align=center><tr><td align=center><img src=http://www.canterburyenglish.com/logo.jpg alt=Canterbury&nbsp;English /><br /><span style=color:blue><i><h2 style=color:blue>Canterbury English</h2></i>C/ Claudio Coello 50 - 1 Interior Izq.<br />28001 Madrid<br />Tel. 91 758 56 20  Fax. 91 758 56 25<br /><a href=http://www.canterburyenglish.com alt=www.canterburyenglish.com target=_blank>www.canterburyenglish.com</a></span></td></tr></table>\n<!-- END OF CODE -->\n";
	//Por problemas de interpretación en el servidor: se cambia a comilla simple, se omiten en href.
	
	$mensajeDirector="
		

Estimado cliente:


En nombre de todo el equipo de Canterbury English agradecemos la confianza que ha depositado en nosotros a lo largo del curso ". --$anioCarta."/".++$anioCarta." y esperamos que nuestras clases le/s hayan servido para mejorar el conocimiento de la lengua inglesa.

Nos complace enviarle el/los diploma/s del curso. Si existiera algún error en los datos le rogamos nos envíe por E-Mail o teléfono la información correcta y se lo enviaremos corregido lo antes posible.

Con el fin de facilitar la organización de las clases del próximo curso ".$anioCarta."/".++$anioCarta." incluimos un impreso de solicitud para que, una vez cumplimentado, nos lo envíe a nuestra oficina. Teniendo en cuenta la fecha de comienzo de curso, para evitar retrasos en la atención a su solicitud por saturación de nuestras líneas telefónicas, les rogamos nos envíe esta hoja cumplimentada por fax, correo o e-mail. Dada la gran demanda en estas fechas, les recomendamos que comiencen sus clases durante el mes de septiembre, para una mayor rapidez en la adjudicación de profesor/a.

A continuación ponemos a su disposición los enlaces de los ficheros anteriormente mencionados:  <a href=http://www.canterburyenglish.com/SolicitudInscripcion.doc alt='Solicitud de inscripción' target='_blank'>Solicitud de inscripción</a> Recuerde rellenar estos formatos y enviarlos como archivo adjunto vía e-mail a la dirección <b>coordinacion@canterburyenglish.com</b>.

Con ello pretendemos adelantar la asignación de profesor/a en función del horario y días disponibles por parte de los alumnos, adaptándolas lo mejor posible en la agenda de los profesores.

Tengan en cuenta que cuanto más amplia sea la franja horaria dentro de la cual se pueda fijar la  hora del comienzo y fin de la clase, más rápidamente le podremos participar el comienzo del curso.

Agradeciendo una vez más su interés y colaboración, reciban un cordial saludo y nuestros mejores deseos en el nuevo año académico.
		

<img src=http://www.canterburyenglish.com/profesores/admin/estudiantes/recursos/rc.png alt=Canterbury&nbsp;English />
Richard Clarke 
Director
"; 




	
}


if ($enviar==""){
	include 'includes/creacionDiplomaAlumnoPDF.php';		//Student Reports
	//include 'includes/creacionDiplomaAlumnoPDF.php';
        //		//Diplomas
	foreach($files as $archivo){
		$archivos_attach.=",".$archivo;
	}
        
}




if ( ($enviar =="Send") && ($infoValida) ){
	include 'includes/funcionReporteAlumnoMail.php';
	$asunto = "Canterbury English: ".$asunto;
	$mensaje=$mensaje." ".EnviarCorreo(separa_en_array($correos),$asunto,$mensaje_mail,$mensaje_mail_html, $file_source, separa_en_array($archivos_attach),$identificador); 
        $asunto = "";
}


if ($id == "") {
	$id = $_REQUEST['id'];
}

	
?>

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
 <p align="center"><b>Diplomas &#8211; <?php echo  $mode ?> &#8211; <font color='#ff9900'><?php echo  $message; ?></font></b></p>

      <table width="100%" border="0" class="pepe3" align="center" cellpadding="10" cellspacing="0" id="body">
        <tr> 
          <td width="100%" valign="top">
           <table border="0" class="pepe3" cellpadding="5" cellspacing="0" id="shell">
              
                <tr valign="top">
            
   
<!-- CUERPO E-MAIL  -->
            
<TD width="600" valign="top">


          <form method="post" enctype="multipart/form-data" action="envioDiplomasAlumnos.php" name="enviar_mail" id="enviar_mail">
		    <TABLE WIDTH=600 class="pepe3" HEIGHT=321 align="center" bgcolor="#cccccc" class="bodytext">
		      <TR>
		        <TD colspan="2" valign="top">		          
		          				  
                    <?php  //($mensaje!="" && strpos($mensaje, "E-Mail sent succesfully to")!=false)

					if ($mensaje!="" && strpos($mensaje, "E-Mail sent succesfully to")!=false){
						echo "<p style='text-align:center'><span class='style13'>".$mensaje."</span></p>";
						echo "</TD></TR>";
						echo "<TR><TD colspan='2' style='text-align:center'>";
						echo "<input name=\"back\" id=\"back\" type=\"button\" value=\"Back to search\" onclick=\"javascript:location.href='busquedaReporteAlumno.php';\" />";
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
		            <TD width="443" style="padding-right:2em"><input type="text" name="from" id="from" size="60" value="canterbury@canterburyenglish.com" disabled></TD>
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
				  <?php echo "\n".$cabecera.$mensajeDirector.$mensaje_mail; ?>
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
                 
                  	<input type="submit" name="enviar" id="enviar" value="Send" onClick="validar()" >
		            <input type="hidden" name="archivos_attach" id="archivos_attach" value="<?php echo $archivos_attach; ?>">
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
      </td>
  </tr>
<!--</table> -->

<!-- NO FOOTER --->
			<tr height="10">				
				<td align="left"><br />
				&copy; Canterbury English, <?php echo date("Y"); ?>
                </table>
				</td>
			</tr>
            
		</table>
         </div>  
       
       
        
	</body>
</html>

<?php //include 'includes/foot.php'?>
