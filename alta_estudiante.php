
<?php //include('config.php');
	 $strGuardar=0;
	 $strGuardar=$_REQUEST['guardar'];
	 include('config.php');

     Conectar();
	 
	 if($strGuardar==1 && $_POST['txtNombre']!='' && $_POST['txtApellido1']!='') {
	 
	   
					//////////////////// INSERTAMOS NUEVO //////////////////
				  $Insert='INSERT INTO alumnos2(APELLIDO1,APELLIDO2,NOMBRE,NIF,TELEFONO,MOVIL,EMAIL,DIRECCION,CIUDAD,IDPROVINCIA,CODIGO_POSTAL,IDNIVEL,OBJETIVOS,SEGUIMIENTO,IDGRUPO)';  
			      $Insert=$Insert.' VALUES("'.$_POST['txtApellido1'].'","'.$_POST['txtApellido2'].'","'.$_POST['txtNombre'].'","'.$_POST['txtNif'].'","'.$_POST['txtTelefono'].'","'.$_POST['txtMovil'].'","'.$_POST['txtEmail'].'","'.$_POST['txtDireccion'].'","'.$_POST['txtCiudad'].'","'.$_POST['txtIdProvincia'].'","'.$_POST['txtCodigoPostal'].'","'.$_POST['txtIdNivel'].'","'.$_POST['txtObjetivos'].'","'.$_POST['txtSeguimiento'].'","'.$_POST['txtIdGrupo'].'")';
				  //$Insert=$Insert.'"'.$_POST['txtPrecio'].'","'.$_POST['txtPrecioInformado'].'","'.$_POST['txtIdProfesor'].'","'.$_POST['txtObjetivos'].',"'.$_POST['txtSeguimiento'].',"'.$_POST['txtIdInformadoPor'].'","'.$_POST['txtPersonaInformadora'].'","'.$_POST['txtInformadoCancelacion'].'","'.$_POST['txtInformadoPago'].',"'.$_POST['txtInformadoClub'].'","'.$_POST['txtIdHorarioPreferencia'].'","'.$_POST['txtPreferenciaHM'].'","'.$_POST['txtPreferenciaIB'].'","'.$_POST['txtDesaFactura'].'","'.$_POST['txtDeseaNota'].'","'.$_POST['txtNiños'].'")';
				  $Res = mysql_query($Insert);
				  if (!$Res)
			         {
			         print 'Error tipo Insert: '.$Insert;
			         exit;
			         }
					 //////////////////////////////////////////////////////////////////////
	 } 

 

 
 
 ?>
 
    <html>
	<head>
	<link href="css/canterbury.css" type="text/css" rel="stylesheet">
	<title>Canterbury Hours</title>
	
	
	 
	</head>

	<script type=text/javascript>
	
	function Guardar()
	  {
	  //alert("Hola");
	  //window.opener.location.reload();
	  //window.opener.document.location.reload();
	  document.alta_estudiante.action="alta_estudiante.php?guardar=1";
	  document.alta_estudiante.submit();
      }
	
	</script>
	
	<?php if($strGuardar==1 && $_POST['txtNombre']!='' && $_POST['txtApellido1']!='') { ?>
	<body onload="javascript:window.opener.location.reload();">
	<?php 
	}
	else { ?>
	<body>
	<?php }?>
      <table width="63%" border="0" cellpadding="10" cellspacing="0" id="body">
        <tr> 
          <td width="100%" valign="top"><b><font color='#ff9900'><?php echo  $message ?></font></b>
			<form action="alta_estudiante.php" name="alta_estudiante" id="alta_estudiante" method="post">
              <table border="0" cellpadding="1" cellspacing="0" bgcolor="#738FE6" id="border">
                <tr> 
                  <td><table border="0" cellpadding="5" cellspacing="0" id="shell">
                      <tr valign="top"> 
                        <td width="501" bgcolor="#0033CC"><b><font class="textW">Add new student </font></b></td>
                      </tr>
                      <tr valign="top"> 
                        <td bgcolor="#B6C5F2">Enter new student </td>
                      </tr>
                      <tr valign="top"> 
                        <td bgcolor="#FFFFFF"> <table width="490" border="0" cellpadding="5" cellspacing="0" id="login">
                            <tr> 
                              <td width="82" valign="top"><b>Name*</b></td>
                              <td width="291"> 
							  <input type="text" name="txtNombre" id="txtNombre" size="60">
                              </td>
                            </tr>
							<tr> 
                              <td width="82" valign="top"><b>Surname1* </b></td>
                              <td width="291"> 
							  <input type="text" name="txtApellido1" id="txtApellido1" size="60">
                              </td>
                            </tr>
							<tr> 
                              <td width="82" valign="top"><b>Surname2</b></td>
                              <td width="291"> 
							  <input type="text" name="txtApellido2" id="txtApellido2" size="60">
                              </td>
                            </tr>
							<tr> 
                              <td width="82" valign="top"><b>NIF</b></td>
                              <td width="291"> 
							  <input type="text" name="txtNif" id="txtNif" size="15">
                              </td>
                            </tr>
							<tr> 
                              <td width="82" valign="top"><b>Phone number </b></td>
                              <td width="291"> 
							  <input type="text" name="txtTelefono" id="txtTelefono" size="15">
                              </td>
                            </tr>
							<tr> 
                              <td width="82" valign="top"><b>Mobile</b></td>
                              <td width="291"> 
							  <input type="text" name="txtMovil" id="txtMovil" size="15">
                              </td>
                            </tr>
							<tr> 
                              <td width="82" valign="top"><b>Address</b></td>
                              <td width="291"> 
							  <input type="text" name="txtDireccion" id="txtDireccion" size="60">
                              </td>
                            </tr>
							<tr> 
                              <td width="82" valign="top"><b>City</b></td>
                              <td width="291"> 
							  <input type="text" name="txtCiudad" id="txtCiudad" size="30">
                              </td>
                            </tr>
							<tr> 
                              <td width="82" valign="top"><b>Province</b></td>
                              <td width="291"> 
							    <select name="txtProvincia" id="txtProvincia">
                                  <option value=""></option>
                                  <?php print DameOpciones('','provincias2','PROVINCIA'); ?>
                                </select>
                              </td>
                            </tr>
							<tr> 
                              <td width="82" valign="top"><b>Postal Code </b></td>
                              <td width="291"> 
							  <input type="text" name="txtCodigoPostal" id="txtCodigoPostal" size="10">
                              </td>
                            </tr>
							<tr> 
                              <td width="82" valign="top"><b>Level</b></td>
                              <td width="291"> 
							    <select name="txtNivel" id="txtNivel">
                                  <option value=""></option>
                                  <?php print DameOpciones('','niveles2','NIVEL'); ?>
                                </select>
                              </td>
                            </tr>
							<tr> 
                              <td width="82" valign="top"><b>Aim</b></td>
                              <td width="291"> 
							    <textarea name="txtObjetivos" cols="50" id="txtObjetivos" wrap="VIRTUAL" style="WIDTH: 300px" maxlength="25"></textarea>
                              </td>
                            </tr>
							<tr> 
                              <td width="82" valign="top"><b>Monitoring</b></td>
                              <td width="291"> 
							    <textarea name="txtSeguimiento" cols="50" id="txtSeguimiento" wrap="VIRTUAL" style="WIDTH: 300px" maxlength="25"></textarea>
                              </td>
                       
                             
                            
                          </table></td>
                      </tr>
                      <tr valign="top" bgcolor="#dddddd"> 
                        <td align="right" bgcolor="#B6C5F2"> 
                          
					<?php if($strGuardar==1 && $_POST['txtNombre']!='' && $_POST['txtApellido1']!='') {   
                          print 'Successfully...';
						  }
						  else {
						  print '* Fields obligatories'; 
						  }
						  //<input type="button" name="btnAccept" value="Aceptar" id="btnAccept" class="boton" onclick="Enviar();" />
						  ?>
						<input name="BotonEnviar" id="BotonEnviar" type="button" class="submit-button" value="Enter" onClick="Guardar();" /> 
                        </td>
                      </tr>
                    </table>
                    
                  </td>
                </tr>
              </table>
            </form>
		  </td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
