<?php include 'includes/constants.php'?>
<?php include 'includes/functions.php'?>
<?php include 'includes/database.php'?>
<?php include 'includes/authorize.php'?>
<?php

$message = "";
$name= $_POST["name"];
$apellido1= $_POST["apellido1"];
$apellido2= $_POST["apellido2"];
$cif= $_POST["cif"];
$telephone1= $_POST["telephone1"];
$telephone2 = $_POST["telephone2"];
$mobile = $_POST["mobile"];
$fax = $_POST["fax"];
$email = $_POST["email"];
$address1 = $_POST["address1"];
$address2 = $_POST["address2"];
$city = $_POST["city"];
$state = $_POST["state"];
$zip = $_POST["zip"];
$start = $_POST["start"];
$end = $_POST["end"];
//$supplement = $_POST["supplement"];
//$class_type = $_POST["class_type"];
$empresa = $_POST["empresa"];
$particular = $_POST["particular"];
$teacher_id = $_POST["teacher_id"];
$factura =$_POST['factura'];
$lista_asistencia = $_POST['lista_asistencia'];
$publicidad = $_POST["publicidad"];
$razon= $_POST["razon"];
$activar_casilla = false;


//if ($_REQUEST['id'] == "") {
	/* NEW PROFILE */

	$mode = "New";
	if ($_POST['action'] == "Siguiente") {
		
		if ($empresa != "" and $razon == ""){
		$message = $message . "Debe escribir una Raz&oacuten Social.<br>";
		}
		if ($name == "") {
			$message = $message . "Debe escribir un nombre.<br>";
			}
		if ($apellido1 == "") {
			$message = $message . "Debe escribir un apellido paterno.<br>";
		}
		if ($empresa!= "" and $cif == "") {
			$message = $message . "Debe escribir un CIF/NIF.<br>";
		}
		if ($mobile == "" and $telephone1 == "") {
			$message = $message . "Debe haber como menos un tel&eacute;fono m&oacute;vil o fijo de contacto.<br>";
		}
		if ($address1 == "") {
			$message = $message . "Falta la direcci&oacute;n.<br>";
		}
		if ($city == "") {
			$message = $message . "Falta la ciudad.<br>";
		}
				if ($state == "") {
			$message = $message . "Falta la provincia.<br>";
		}
				if ($zip == "" and $empresa != "") {
			$message = $message . "Falta el c&oacute;digo postal.<br>";
		}
				if ($publicidad == "") {
			$message = $message . "Falta elegir la publicidad.<br>";
		}
		if ($message == "") {
			echo "<form name='siguiente_pag' id='siguiente_pag' action='creacion_grupos.php' method='post'>";
			echo "<input type='hidden' value='". $name."' name='name'/>";
            echo "<input type='hidden' value='". $apellido1."' name='apellido1'/>";
            echo "<input type='hidden' value='". $apellido2."' name='apellido2'/>";
            echo "<input type='hidden' value='". $cif."' name='cif'/>";
            echo "<input type='hidden' value='". $telephone1."' name='telephone1'/>";
            echo "<input type='hidden' value='". $telephone2."' name='telephone2'/>";            
            echo "<input type='hidden' value='". $mobile."' name='mobile'/>";
            echo "<input type='hidden' value='". $fax."' name='fax'/>";                        
            echo "<input type='hidden' value='". $email."' name='email'/>";
            echo "<input type='hidden' value='". $address1."' name='address1'/>";
            echo "<input type='hidden' value='". $$address2."' name='address2'/>";
            echo "<input type='hidden' value='". $city."' name='city'/>";
            echo "<input type='hidden' value='". $state."' name='state'/>";
            echo "<input type='hidden' value='". $zip."' name='zip'/>";
            echo "<input type='hidden' value='". $start."' name='start'/>";
            echo "<input type='hidden' value='". $end."' name='end'/>";            
/*            echo "<input type='hidden' value='". $supplement."' name='supplement'/>";
            echo "<input type='hidden' value='". $class_type."' name='class_type'/>"; */
            echo "<input type='hidden' value='". $empresa."' name='empresa'/>";           
            echo "<input type='hidden' value='". $particular."' name='particular'/>";            
            echo "<input type='hidden' value='". $teacher_id."' name='teacher_id'/>";
            echo "<input type='hidden' value='". $factura."' name='factura'/>";            
            echo "<input type='hidden' value='". $lista_asistencia."' name='lista_asistencia'/>";            
            echo "<input type='hidden' value='". $publicidad."' name='publicidad'/>";            
            echo "<input type='hidden' value='". $razon."' name='razon'/>";
			echo "</form>";         
			echo "<script language='javascript'>document.getElementById('siguiente_pag').submit();</script>";
			
		}else {
			$activar_casilla = true;
		}
	}
/*} else {
	$mode = "Edit";
}*/				
?>
<?php include 'includes/top.php'?>
<?php include 'includes/menu.php'?>

<script language="javascript">
function empresa_particular(){

var state = !arguments[arguments.length-1];
var all = document.all ? document.all :	document.getElementsByTagName('*');
var elements = new Array();


	if (document.associate.particular.checked && !document.associate.empresa.checked){
		document.getElementById("empresa").disabled=true;
		document.getElementById("action").disabled=false;
		document.getElementById("mensaje").deleteCell(0);
		for(var i=1; i<arguments.length-1; i++) {
			document.forms[arguments[0]][arguments[i]].disabled = state;
			}
		for (var e = 0; e < all.length; e++){
    		if (all[e].className =="color" && all[e].id !== "razon"){
			document.getElementById(all[e].id).style.color = 'black';
			}
		} 
	}else if (document.associate.empresa.checked && !document.associate.particular.checked){
		document.getElementById("particular").disabled=true;
		document.getElementById("action").disabled=false;
		document.getElementById("mensaje").deleteCell(0);
		for(var i=1; i<arguments.length-1; i++) {
			document.forms[arguments[0]][arguments[i]].disabled = state;
			}
			
		for (var e = 0; e < all.length; e++){
			if (all[e].className =="color"){
			document.getElementById(all[e].id).style.color = 'black';
			}
		} 
	}else if (!document.associate.empresa.checked && !document.associate.particular.checked){
		document.getElementById("empresa").disabled=false;
		document.getElementById("particular").disabled=false;
		document.getElementById("action").disabled=true;
		var x=document.getElementById("mensaje").insertCell(0);
		x.innerHTML="<span style='font-weight: bold'><font color='#ff9900'>Por favor marque si el cliente es particular o empresa.</font></span>";

		for(var i=1; i<arguments.length-1; i++) {
			document.forms[arguments[0]][arguments[i]].disabled = state;
			}		
		for (var e = 0; e < all.length; e++){
    		if (all[e].className == "color"){
			document.getElementById(all[e].id).style.color = 'gray';
			}
		}
	}
	
}

</script>

<?php 
$activado=false;
if ($_POST['action'] == "activado") {
$activado= false;
}
?>
<STYLE type="text/css">
.color{color: gray;}
</STYLE>

      <table width="100%" border="0" cellpadding="10" cellspacing="0" id="body">
        <tr> 
          <td width="100%" valign="top"> <p><b>Crear un Nuevo Cliente &#8211; 
              <?php echo  $mode ?> <br><font color='#ff9900'><?php echo  $message ?></font></b></p>
            <!--start dynamic code -->
            <form name="associate" id="associate" method="post">
            	<input type="hidden" name="id" value="<?php echo $id;?>">
              <table border="0" cellpadding="5" cellspacing="0" width="80%">
                <tr valign="top"> 
                  <td colspan="2" bgcolor="#EEEEEE">&nbsp;</td>
              </tr>
                <strong>Informaci&oacuten General </strong>
                <tr valign="top"><td bgcolor="#FFFFFF"><table border="0" cellpaddign="5" cellspacing="0" width="100%">
                   <tr>
                     <td>
                       <div align="left">
                         <input type="checkbox" name="particular" onclick="empresa_particular('associate', 'name', 'apellido1', 'apellido2', 'cif', 'telephone1', 'telephone2', 'mobile', 'fax', 'email', 'address1', 'address2', 'city', 'state', 'zip', 'publicidad', 'factura', 'lista_asistencia', 'publicidad', this.checked)"/> 
                         <strong>Particular
                         <input type="checkbox" name="empresa" onclick="empresa_particular('associate', 'razon', 'name', 'apellido1', 'apellido2', 'cif','telephone1', 'telephone2', 'mobile', 'fax', 'email', 'address1', 'address2', 'city', 'state', 'zip', 'factura', 'lista_asistencia', 'publicidad', this.checked)"/> 
                          Empresa
                          </strong>
                         </div></td></tr><tr id="mensaje"><td><span style="font-weight: bold"><font color='#ff9900'>Por favor marque si el cliente es particular o empresa.</font></span></td>
                         </tr><tr><td>
                       <table border="0" cellpadding="5" cellspacing="0" width="100%">
                      <tr>
                        <td width="15%" valign="top" class="color" id="razon"><strong>Raz&oacuten Social:</strong></td>
                          <td width="15%"><strong>
                            <input size="35" name="razon" type="text" disabled="true" value="<?php echo  $razon;?>">
                            </strong></td>               
                          <td width="7%">&nbsp;</td>
                          <td width="24%" valign="top" id="factura" class="color"><input disabled="true" id="factura1" type="checkbox" name="factura"/>
                            <span style="font-weight: bold">Requiere Factura</span></td>
                          <td width="39%">&nbsp;</td>
                      </tr>
                         <tr> 
                        <td valign="top" id="name" class="color"><strong>Nombre:</strong></td>
                        <td><strong>
                        <input size="35" name="name" type="text" disabled="true" value="<?php echo  $name;?>">
                        </strong></td>               
                        <td>&nbsp;</td>
                        <td id="lista_asistencia" class="color"><span style="font-weight: bold">
                          <input disabled="true" type="checkbox" id="lista_asistencia1" name="lista_asistencia"/>
                          Requiere lista de asistencia</span></td>
                        <td>&nbsp;</td>
                         </tr>
                         <tr> 
                           <td valign="top" id="apellido1" class="color"><strong>Apellido paterno:</strong></td>
                          <td><strong>
                            <input size="35" name="apellido1" disabled="true" type="text" value="<?php echo  $apellido1;?>">
                            </strong></td>               
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                         </tr>
                         <tr> 
                           <td valign="top" id="apellido2" class="color"><strong>Apellido materno:</strong></td>
                          <td><strong>
                            <input size="35" name="apellido2" disabled="true" type="text" value="<?php echo  $apellido2;?>">
                            </strong></td>               
                          <td>&nbsp;</td>
                          <td id="publicidad" class="color"><span style="font-weight: bold">Por favor indique c&oacute;mo nos encontr&oacute;:</span></td>
                          <td>&nbsp;</td>
                         </tr>
                         <tr> 
                           <td valign="top" id="cif" class="color"><b>CIF/NIF:</b></td>
                          <td><input name="cif" type="text" disabled="true" value="<?php echo  $cif;?>"></td>               
                          <td>&nbsp;</td>
                          <td><div align="center">
                            <select name="publicidad" disabled="true">
                              <?php 
							  if ($publicidad==""){
							  echo "<option  value='' selected='selected'>--Seleccione publicidad--</option>";
							  echo "<option  value='' selected=''></option>";
							  echo "<option  value='internet'>Internet</option>";
                              echo "<option  value='paginas_amarillas'>P&aacute;ginas Amarillas</option>";
                              echo "<option  value='segunda_mano'>Segunda mano</option>";
                              echo "<option  value='persona'>Un Conocido</option>";
                              echo "<option  value='otra'>Otra</option>";
							  }else {
									switch ($publicidad){
									  case internet:
									  echo "<option  value='' selected=''></option>";
									  echo "<option  value='internet' selected='selected'>Internet</option>";
									  echo "<option  value='paginas_amarillas'>P&aacute;ginas Amarillas</option>";
        		                      echo "<option  value='segunda_mano'>Segunda mano</option>";
                		              echo "<option  value='persona'>Un Conocido</option>";
                        		      echo "<option  value='otra'>Otra</option>";
									  break;
									  case paginas_amarillas:
									  echo "<option  value='' selected=''></option>";
									  echo "<option  value='paginas_amarillas' selected='selected'>P&aacute;ginas Amarillas</option>";
									  echo "<option  value='internet'>Internet</option>";
        		                      echo "<option  value='segunda_mano'>Segunda mano</option>";
		        	                  echo "<option  value='persona'>Un Conocido</option>";
                    		          echo "<option  value='otra'>Otra</option>";
									  break;
									  case segunda_mano:
									  echo "<option  value='' selected=''></option>";
									  echo "<option  value='segunda_mano' selected='selected'>Segunda mano</option>";
									  echo "<option  value='internet'>Internet</option>";
                           		      echo "<option  value='paginas_amarillas'>P&aacute;ginas Amarillas</option>";
                              	      echo "<option  value='persona'>Un Conocido</option>";
		                              echo "<option  value='otra'>Otra</option>";
									  break;
									  case persona:
									  echo "<option  value='' selected=''></option>";
									  echo "<option  value='persona' selected='selected'>Un Conocido</option>";
									  echo "<option  value='internet'>Internet</option>";
                           		      echo "<option  value='paginas_amarillas'>P&aacute;ginas Amarillas</option>";
                              	      echo "<option  value='segunda_mano'>Segunda mano</option>";
		                              echo "<option  value='otra'>Otra</option>";
									  break;
									  case otra:
									  echo "<option  value='' selected=''></option>";
									  echo "<option  value='otra' selected='selected'>Otra</option>";
									  echo "<option  value='internet'>Internet</option>";
                           		      echo "<option  value='paginas_amarillas'>P&aacute;ginas Amarillas</option>";
                              	      echo "<option  value='segunda_mano'>Segunda mano</option>";
		                              echo "<option  value='persona'>Un Conocido</option>";
									  break;
									 }
							  		}
							  ?>
                              
                            </select>
                          </div></td>
                          <td>&nbsp;</td>
                         </tr>
                         <tr> 
                           <td valign="top" id="telephone1" class="color"><b>Tel&eacutefono:</b></td>
                           <td><input name="telephone1" disabled="true" type="text" value="<?php echo  $telephone1; ?>"></td>
                           <td>&nbsp;</td>
                           <td>&nbsp;</td>
                           <td>&nbsp;</td>
                         </tr>
                         <tr> 
                           <td valign="top" id="telephone2" class="color"><b>Tel&eacutefono Secundario:</b></td>
                           <td><input name="telephone2" disabled="true" type="text" value="<?php echo  $telephone2;?>"></td>
                           <td>&nbsp;</td>
                           <td>&nbsp;</td>
                           <td>&nbsp;</td>
                         </tr>
                         <tr> 
                           <td valign="top" id="mobile" class="color"><b>M&oacutevil:</b></td>
                          <td><input name="mobile" disabled="true" type="text" value="<?php echo  $mobile;?>"></td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                         </tr>
                         <tr> 
                           <td valign="top" id="fax" class="color"><b>Fax:</b></td>
                          <td><input name="fax" disabled="true" type="text" value="<?php echo  $fax;?>"></td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                         </tr>
                         <tr> 
                           <td valign="top" id="email" class="color"><b>E-mail:</b></td>
                          <td><input name="email" disabled="true" type="text" value="<?php echo  $email;?>"></td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                         </tr>
                         <tr> 
                           <td valign="top" id="direccion" class="color"><b>Direcci&oacuten:</b></td>
                           <td><input name="address1" disabled="true" type="text" value="<?php echo  $address1;?>" size="35">
                             <input name="address2" disabled="true" type="text" value="<?php echo  $address2;?>" size="35"></td>
                           <td>&nbsp;</td>
                           <td>&nbsp;</td>
                           <td>&nbsp;</td>
                         </tr>
                         <tr> 
                           <td valign="top" id="ciudad" class="color"><b>Ciudad</b></td>
                          <td><input name="city" type="text" disabled="true" value="<?php echo  $city;?>"></td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                         </tr>
                          <tr><td valign="top" id="provincia" class="color"><b>Provincia</b></td><td><input name="state" type="text"  disabled="true" value="<?php echo  $state;?>"></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          <tr><td valign="top" id="cp" class="color"><b>CP:</b></td><td><input name="zip" type="text" disabled="true" value="<?php echo  $zip;?>" size="10"></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                       
                  </table></td></tr>
                <tr valign="top"> 
                  <td colspan="2" bgcolor="#eeeeee">&nbsp; </td>
                </tr>
                <tr valign="top" bgcolor="#dddddd"> 
                  <td colspan="2" align="center"> <input name="action" type="submit" disabled="true" id="action" value="Siguiente">                    </td>
                </tr>
              </table>
<?php 
 if ($activar_casilla==true){
 	
		if ($factura!=""){
		echo "<script language='javascript'>
		document.getElementById('factura1').checked=true;
		</script>";
		}
		if ($lista_asistencia!=""){
		echo "<script language='javascript'>
		document.getElementById('lista_asistencia1').checked=true;
		</script>";
		}
	
	if ($particular!=""){
 		echo "<script language='javascript'>
		document.getElementById('particular').checked=true;
		document.getElementById('empresa').disabled=true;
		empresa_particular('associate', 'name', 'apellido1', 'apellido2', 'cif', 'telephone1', 'telephone2', 'mobile', 'fax', 'email', 'address1', 'address2', 'city', 'state', 'zip', 'publicidad', 'factura', 'lista_asistencia', 'publicidad', document.getElementById('particular').checked);</script>";
 		} else {
		echo "<script language='javascript'>
		document.getElementById('empresa').checked=true;
		document.getElementById('particular').disabled=true;
		empresa_particular('associate', 'razon', 'name', 'apellido1', 'apellido2', 'cif','telephone1', 'telephone2', 'mobile', 'fax', 'email', 'address1', 'address2', 'city', 'state', 'zip', 'factura', 'lista_asistencia', 'publicidad', document.getElementById('empresa').checked);</script>";
 		}
		
  }
?>               
</form>
</td></tr>
</table>
Return to <a href="index.php">Group/Client List</a></td>
</tr>
</table>
</td>
</tr>
</table>
<?php include 'includes/foot.php'?>
