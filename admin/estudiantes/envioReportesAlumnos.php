<?php
	/*  Student Reports, version 1.0
		Author: ISC. Gerardo Cata�o
		Date: July 2009  */
?>
<?php include '../../includes/constants.php'?>
<?php include '../../includes/functions.php'?>
<?php include '../../includes/database.php'?>
<?php include '../../includes/authorize.php'?>
<?php include '../../includes/top.php';?>
    
	<script src="../../SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
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
if ($asunto=="") $asunto="Informe";
$archivos_attach=$_REQUEST['archivos_attach'];
$mode = "Sending student report(s)";
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
	$cont_id=0;
		foreach($identificador as $id){
			if ($id!= NULL or $id!=""){
				$query= "select ID, email from informes_alumnos2 where ID='".$id."'";
				$resultado=mysqli_query($link, $query) or die("Query error: ".mysqli_error($link));
				$row=mysqli_fetch_row($resultado);			

				if ($cont_id!=0) {
					$correos.=",".$row['1'];					
				}
				$cont_id++;
			}
		}

	//$correos=substr($correos,2);

	/*$cabecera="<!-- ATTENTION, DO NOT MODIFY OR DELETE THE NEXT CODE. -->\n<table align=center><tr><td align=center><img src=http://www.canterburyenglish.com/logo.jpg alt=Canterbury&nbsp;English /><br /><span style=color:blue><i><h2 style=color:blue>Canterbury English</h2></i>C/ Claudio Coello 50 - 1� Interior Izq.<br />28001 Madrid<br />Tel. 91 758 56 22  Fax. 91 758 56 25<br /><a href=http://www.canterburyenglish.com alt=www.canterburyenglish.com target=_blank>www.canterburyenglish.com</a></span></td></tr></table>\n<!-- END OF CODE -->\n";
	//Por problemas de interpretaci�n en el servidor: se omiten comillas y ap�strofes
	
	$mensajeDirector="
Estimado cliente:


En nombre de todo el equipo de Canterbury English agradecemos la confianza que ha depositado en nosotros a lo largo del curso ". --$anioCarta."/".++$anioCarta." y esperamos que nuestras clases le/s hayan servido para mejorar el conocimiento de la lengua inglesa.

Nos complace enviarle los informes de los alumnos. Si existiera alg�n error en los datos le rogamos nos env�e por fax o tel�fono la informaci�n correcta y se lo enviaremos de nuevo lo antes posible.

Con el fin de facilitar la organizaci�n de las clases del pr�ximo curso ".$anioCarta."/".++$anioCarta." incluimos un impreso de solicitud para que, una vez cumplimentado, nos lo env�e a nuestra oficina. Teniendo en cuenta la fecha de comienzo de curso, para evitar retrasos en la atenci�n a su solicitud por saturaci�n de nuestras l�neas telef�nicas, les rogamos nos env�e esta hoja cumplimentada por fax, correo o e-mail. Dada la gran demanda en estas fechas, les recomendamos que comiencen sus clases durante el mes de septiembre, para una mayor rapidez en la adjudicaci�n de profesor/a.

Con ello pretendemos adelantar la asignaci�n de profesor/a en funci�n del horario y d�as disponibles por parte de los alumnos, adapt�ndolas lo mejor posible en la agenda de los profesores.

Tengan en cuenta que cuanto m�s amplia sea la franja horaria dentro de la cual se pueda fijar la  hora  del comienzo y fin de la clase, m�s r�pidamente le podremos participar el comienzo del curso.

Agradeciendo, una vez m�s su inter�s y colaboraci�n, reciban un cordial saludo.

Richard Clarke 
Director
"; //trim(substr($correos,1))
	$anioCarta=(int)date("Y");
	$mensajeDirector="
Estimado cliente:

Estimados clientes, adjuntamos los informes de progreso del/los alumnos/as correspondiente al primer trimestre del a�o escolar ".$anioCarta."/".++$anioCarta.", y aprovechamos la ocasi�n para transmitirles nuestros mejores deseos para estas fiestas y el Nuevo A�o ".$anioCarta.".



Agradeciendo, una vez m�s su inter�s y colaboraci�n, reciban un cordial saludo.

<img src=http://www.canterburyenglish.com/profesores/admin/estudiantes/recursos/rc.png alt=Canterbury&nbsp;English />
  Richard Clarke 
  Director
  
  
  
<img src=http://www.canterburyenglish.com/profesores/admin/estudiantes/recursos/Navidad2011.jpg alt=Canterbury&nbsp;English />"; 
  
  


	$enlaces = "\n<!-- ATTENTION, DO NOT MODIFY OR DELETE THE NEXT CODE. -->\n Cualquier pregunta, duda o sugerencia, favor de ponerse en contacto con nosotros v�a e-mail en la direcci�n: <b>canterbury@canterburyenglish.com</b>.<br /><br />\n<!-- END OF CODE -->"; //*Important: This is an automatically generated e-mail, please do not reply to this address.*/
	
	
}


if ($enviar==""){
	include 'includes/creacionReporteAlumnoPDF.php';		//Student Reports
	//include 'includes/creacionDiplomaAlumnoPDF.php';		//Diplomas
	foreach($files as $archivo){
		$archivos_attach.=",".$archivo;
	}
}





if ( ($enviar =="Send") && ($infoValida) ){
	include 'includes/funcionReporteAlumnoMail.php';
	$asunto = "Canterbury English: ".$asunto;
	$mensaje=$mensaje." ".EnviarCorreo(separa_en_array($correos),$asunto,$mensaje_mail,$mensaje_mail_html, $file_source, separa_en_array($archivos_attach),$identificador); 
}


if ($id == "") {
	$id = $_REQUEST['id'];
}

	
?>


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


<script type="text/javascript">
function ajaxGetInfo(title){
	  var d = new Date();
 var n = d.getFullYear();
  if(title.value == "verano"){
	 document.getElementById('mensaje_mail').innerHTML =  "<!-- ATTENTION, DO NOT MODIFY OR DELETE THE NEXT CODE. -->\n<table align=center><tr><td align=center><img src=http://www.canterburyenglish.com/logo.jpg alt=Canterbury&nbsp;English /><br /><span style=color:blue><i><h2 style=color:blue>Canterbury English</h2></i>C/ Claudio Coello 50 - 1º Interior Izq.<br />28001 Madrid<br />Tel. 91 758 56 20  Fax. 91 758 56 25<br /><a href=http://www.canterburyenglish.com alt=www.canterburyenglish.com target=_blank>www.canterburyenglish.com</a></span></td></tr></table>\n\n\
<!-- END OF CODE -->\n<br>Queridos estudiantes:<br><br>Desde Canterbury English esperamos os habéis pasado unas buenas vacaciones de verano y así recargar energías para el nuevo ciclo escolar que se avecina. Nosotros seguimos trabajando por lo que además de entregaros esta carta, también os haremos llegar los student reports y vuestros diplomas, culminando así con el curso "+ --n+"/"+ ++n+". ¡Enhorabuena por vuestros resultados! <br><br>De igual manera os reiteramos nuestro total compromiso con cada uno de vosotros para seguir trabajando juntos en este nuevo ciclo que estamos por comenzar.<br><br><br><img src=http://www.canterburyenglish.com/profesores/admin/estudiantes/recursos/rc.png alt=Canterbury&nbsp;English /><br>Richard Clarke<br>Director<br><br>\n\n<!-- ATTENTION, DO NOT MODIFY OR DELETE THE NEXT CODE. -->\n Cualquier pregunta, duda o sugerencia, favor de ponerse en contacto con nosotros vía e-mail en la dirección: <b>canterbury@canterburyenglish.com</b>.<br /><br />\n<!-- END OF CODE -->";
 }
 else if(title.value == "invierno"){	 
	 document.getElementById('mensaje_mail').innerHTML =  "<!-- ATTENTION, DO NOT MODIFY OR DELETE THE NEXT CODE. -->\n<table align=center><tr><td align=center><img src=http://www.canterburyenglish.com/logo.jpg alt=Canterbury&nbsp;English /><br /><span style=color:blue><i><h2 style=color:blue>Canterbury English</h2></i>C/ Claudio Coello 50 - 1 Interior Izq.<br />28001 Madrid<br />Tel. 91 758 56 20  Fax. 91 758 56 25<br /><a href=http://www.canterburyenglish.com alt=www.canterburyenglish.com target=_blank>www.canterburyenglish.com</a></span></td></tr></table>\n\n\
 <!-- END OF CODE -->\n<br>Queridos estudiantes de Canterbury:<br><br><br><br>Desde Canterbury English queremos agradeceros por este año que hemos pasado con vosotros. Agradecemos a los padres que confían en nosotros y a nuestros clientes adultos y a nuestras empresas por permitirnos ser parte de su formación en el idioma inglés. <br><br> Hemos pasado muchos momentos de satisfacción gracias a todos nuestros estudiantes y profesores que han puesto esfuerzo para lograr que este año sea uno de recompensas y satisfacciones. <br><br>Seguimos trabajando para ayudar a nuestros estudiantes a mejorar, por lo que​ también aprovechamos esta oportunidad para enviaros los primeros reportes de estudiante del curso "+ --n+"/"+ ++n+" (otoño-invierno) y recordaros que en el mes de agosto recibiréis los últimos reportes de estudiante del curso (primavera-verano) junto con vuestros respectivos diplomas.<br><br>¡Os deseamos un gran verano y os esperamos de regreso para este próximo curso donde seguramente aprenderemos muchas cosas más juntos!<br><br><br><br><img src=http://www.canterburyenglish.com/profesores/admin/estudiantes/recursos/rc.png alt=Canterbury&nbsp;English /><br>Richard Clarke<br>Director<br><br>\n\n<!-- ATTENTION, DO NOT MODIFY OR DELETE THE NEXT CODE. -->\n Cualquier pregunta, duda o sugerencia, favor de ponerse en contacto con nosotros vía e-mail en la dirección: <b>canterbury@canterburyenglish.com</b>.<br /><br />\n<!-- END OF CODE -->";
//	 document.getElementById('mensaje_mail').innerHTML =  "<!-- ATTENTION, DO NOT MODIFY OR DELETE THE NEXT CODE. -->\n<table align=center><tr><td align=center><img src=http://www.canterburyenglish.com/logo.jpg alt=Canterbury&nbsp;English /><br /><span style=color:blue><i><h2 style=color:blue>Canterbury English</h2></i>C/ Claudio Coello 50 - 1 Interior Izq.<br />28001 Madrid<br />Tel. 91 758 56 20  Fax. 91 758 56 25<br /><a href=http://www.canterburyenglish.com alt=www.canterburyenglish.com target=_blank>www.canterburyenglish.com</a></span></td></tr></table>\n<!-- END OF CODE -->\n<br>Estimado cliente:<br><br>Adjuntamos los informes de progreso del/los alumnos/as correspondiente al año escolar "+ --n+"/"+ ++n+" y aprovechamos la ocasión para transmitirles nuestros mejores deseos para estas fiestas y el Nuevo Año "+ ++n+". <br><br>Agradeciendo, una vez más su colaboración, reciban un cordial saludo.<br><img src=http://www.canterburyenglish.com/profesores/admin/estudiantes/recursos/rc.png alt=Canterbury&nbsp;English /><br>Richard Clarke<br>Director<br><br> <img src=http://www.canterburyenglish.com/profesores/admin/estudiantes/recursos/Navidad2011.jpg alt=Canterbury&nbsp;English />\n\n<!-- ATTENTION, DO NOT MODIFY OR DELETE THE NEXT CODE. -->\n Cualquier pregunta, duda o sugerencia, favor de ponerse en contacto con nosotros vía e-mail en la dirección: <b>canterbury@canterburyenglish.com</b>.<br /><br />\n<!-- END OF CODE -->";
	 
	 n = "";}
  
  }
 
  </script>
  
    <div style="position: relative;" align="center"> 

      <p align="center"><b>Student Reports &#8211; <?php echo  $mode ?> &#8211; <font color='#ff9900'><?php echo  $message; ?></font></b></p>

    <table width="100%" border="0" class="pepe3" align="center" cellpadding="10" cellspacing="0" id="body">
        <tr> 
          <td width="100%" valign="top">
           <table border="0" class="pepe3" cellpadding="5" cellspacing="0" id="shell">
              
                <tr valign="top">
            
   
<!-- CUERPO E-MAIL  -->
            
<TD width="600" valign="top">


          <form method="post" enctype="multipart/form-data" action="envioReportesAlumnos.php" name="enviar_mail" id="enviar_mail">
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
		            <TD style="padding-right:2em"><input type="text" name="correos" id="correos" size="60" value="<?php $correos=substr($correos,1); echo $correos;?>"></TD>
		          </TR>
			      <TR>
			        <TD style="padding-right:2em"><p><strong>Subject: </strong></p></TD>
		            <TD style="padding-right:2em"><input type="text" name="asunto" id="asunto" size="60" value="<?php echo $asunto;?>"></TD>
		          </TR>
			      <TR>
			        <TD colspan="2"><p><strong>Message:</strong></p></TD>
	              </TR>
		          <TR>
		            <TD colspan="2">
                  <span id="sprytextarea1">
                  
		               <textarea name="mensaje_mail" id="mensaje_mail" rows="20" cols="60" ></textarea>
                        <div class="textareaRequiredMsg">VERANO O NAVIDAD?</font></div>
		              </span>
                      
                     
                 </TD></TR>	
                         
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
                  
                       <select name="category" id="category"  onchange="ajaxGetInfo(this);">
      <option value="default"  SELECTED >-------</option>
      <option value="verano" >Verano</option>
      <option value="invierno" >Invierno</option>
      </select>
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
				</td>
			</tr>
		</table>
         </div>  
       
	        <script type="text/javascript">
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1");
            </script>
	</body>
</html>

<?php //include 'includes/foot.php'?>
