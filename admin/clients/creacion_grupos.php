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
$action =$_POST["action"];

//$supplement = $_POST["supplement"];
//$class_type = $_POST["class_type"];
$empresa = $_POST["empresa"];
$particular = $_POST["particular"];
$teacher_id = $_POST["teacher_id"];
$factura =$_POST['factura'];
$lista_asistencia = $_POST['lista_asistencia'];
$publicidad = $_POST["publicidad"];
$razon = $_POST['razon'];
$activar_casilla = false;


function envia(){
			echo "<form name='siguiente_pag' id='siguiente_pag' action='creacion_grupos.php' method='post'>";
            echo "<input type='hidden' value='<?php echo $name;?>' name='name'/>";
            echo "<input type='hidden' value='<?php echo $apellido1;?>' name='apellido1'/>";
            echo "<input type='hidden' value='<?php echo $apellido2;?>' name='apellido2'/>";
            echo "<input type='hidden' value='<?php echo $cif;?>' name='cif'/>";
            echo "<input type='hidden' value='<?php echo $telephone1;?>' name='telephone1'/>";
            echo "<input type='hidden' value='<?php echo $telephone2;?>' name='telephone2'/>";            
            echo "<input type='hidden' value='<?php echo $mobile;?>' name='mobile'/>";
            echo "<input type='hidden' value='<?php echo $fax;?>' name='fax'/>";                        
            echo "<input type='hidden' value='<?php echo $email;?>' name='email'/>";
            echo "<input type='hidden' value='<?php echo $address1;?>' name='address1'/>";
            echo "<input type='hidden' value='<?php echo $$address2;?>' name='address2'/>";
            echo "<input type='hidden' value='<?php echo $city;?>' name='city'/>";
            echo "<input type='hidden' value='<?php echo $state;?>' name='state'/>";
            echo "<input type='hidden' value='<?php echo $zip;?>' name='zip'/>";
            echo "<input type='hidden' value='<?php echo $start;?>' name='start'/>";
            echo "<input type='hidden' value='<?php echo $end;?>' name='end'/>";        
            echo "<input type='hidden' value='<?php echo $supplement;?>' name='supplement'/>";
            echo "<input type='hidden' value='<?php echo $class_type;?>' name='class_type'/>"; 
            echo "<input type='hidden' value='<?php echo $empresa;?>' name='empresa'/>";           
            echo "<input type='hidden' value='<?php echo $particular;?>' name='particular'/>";            
            echo "<input type='hidden' value='<?php echo $teacher_id;?>' name='teacher_id'/>";
            echo "<input type='hidden' value='<?php echo $factura;?>' name='factura'/>";            
            echo "<input type='hidden' value='<?php echo $lista_asistencia;?>' name='lista_asistencia'/>";            
            echo "<input type='hidden' value='<?php echo $publicidad;?>' name='publicidad'/>";            
            echo "</form>";         
			echo "<script language='javascript'>document.getElementById('siguiente_pag').submit();</script>";
			}
?>
<?php include 'includes/top.php'?>
<?php include 'includes/menu.php'?>
<table width="100%" border="0" cellpadding="10" cellspacing="0" id="body">
<tr><td><span style="font-weight: bold">Creaci&oacute;n de grupos para el cliente:</span></td></tr>
<tr><td></td></tr>
<tr><td>

<table width="100%" border="0" id="datos_cliente">
<?php if($razon!=""){
echo "<tr><td><span style='font-weight: bold'>Raz&oacute;n Social: </span></td><td>".$razon."</td></tr>";
}
?>
<tr>
<td width="14%"><span style="font-weight: bold">Nombre: </span></td>
<td width="86%"><?php echo $name." ".$apellido1." ".$apellido2;?></td>
</tr>
<tr>
<td><span style="font-weight: bold">CIF/NIF: </span></td>
<td><?php echo $cif;?></td>
</tr>
<tr>
<td><span style="font-weight: bold">Tel&eacute;fono: </span></td>
<td><?php echo $telephone1;?></td>
</tr>
<tr>
<td><span style="font-weight: bold">Tel&eacute;fono secundario: </span></td>
<td><?php if ($telephone2 == ""){ echo "-----------";}else{echo $telephone2;}?></td>
</tr>
<tr>
<td><span style="font-weight: bold">M&oacute;vil: </span></td>
<td><?php if ($mobile == ""){ echo "-----------";}else{echo $mobile;}?></td>
</tr>
<tr>
<td><span style="font-weight: bold">Fax: </span></td>
<td><?php if ($fax == ""){ echo "-----------";}else{echo $fax;}?></td>
</tr>
<tr>
<td><span style="font-weight: bold">E-mail: </span></td>
<td><?php if ($email == ""){ echo "-----------";}else{echo $email;}?></td>
</tr>
<tr>
<td><span style="font-weight: bold">Direcci&oacute;n: </span></td>
<td><?php echo $address1." ".$address2;?></td>
</tr>
<tr>
<td><span style="font-weight: bold">Ciudad, Provincia y CP: </span></td>
<td><?php echo $city.", ".$state.", ".$zip;?></td>
</tr>
<tr><td><span style="font-weight: bold"> &#191Requiere Factura?: </span></td>
<td><span style="font-weight: normal; color: #FF0000"><?php if ($factura == ""){ echo "No";}else{echo"S&iacute;";}?></span></td>
</tr>
<tr>
<td><span style="font-weight: bold"> &#191Requiere Lista de Asistencia?: </span></td>
<td><span style="font-weight: normal; color: #FF0000"><?php if ($factura == ""){ echo "No";}else{echo"S&iacute;";}?></span></td>
</tr>
<tr>
<td colspan="2"><hr /></td>
</tr>
</table>

<?php if ($action!="Salvar Datos"){?>
<form name="salvar" method="post" id="salvar">
<?php 
		    echo "<input type='hidden' value='".$name."' name='name'/>";
            echo "<input type='hidden' value='".$apellido1."' name='apellido1'/>";
            echo "<input type='hidden' value='".$apellido2."' name='apellido2'/>";
            echo "<input type='hidden' value='".$cif."' name='cif'/>";
            echo "<input type='hidden' value='".$telephone1."' name='telephone1'/>";
            echo "<input type='hidden' value='".$telephone2."' name='telephone2'/>";            
            echo "<input type='hidden' value='".$mobile."' name='mobile'/>";
            echo "<input type='hidden' value='".$fax."' name='fax'/>";                        
            echo "<input type='hidden' value='".$email."' name='email'/>";
            echo "<input type='hidden' value='".$address1."' name='address1'/>";
            echo "<input type='hidden' value='".$$address2."' name='address2'/>";
            echo "<input type='hidden' value='".$city."' name='city'/>";
            echo "<input type='hidden' value='".$state."' name='state'/>";
            echo "<input type='hidden' value='".$zip."' name='zip'/>";
            echo "<input type='hidden' value='".$start."' name='start'/>";
            echo "<input type='hidden' value='".$end."' name='end'/>";        
            echo "<input type='hidden' value='".$supplement."' name='supplement'/>";
            echo "<input type='hidden' value='".$class_type."' name='class_type'/>"; 
            echo "<input type='hidden' value='".$empresa."' name='empresa'/>";           
            echo "<input type='hidden' value='".$particular."' name='particular'/>";            
            echo "<input type='hidden' value='".$teacher_id."' name='teacher_id'/>";
            echo "<input type='hidden' value='".$factura."' name='factura'/>";            
            echo "<input type='hidden' value='".$lista_asistencia."' name='lista_asistencia'/>";            
            echo "<input type='hidden' value='".$publicidad."' name='publicidad'/>";   
?>
<table id="forma_salvar" width="100%">
<tr><td colspan="2"><div align="left"><span style="font-weight: bold; font-size: 10pt">&#191La informaci&oacute;n del cliente es correcta?</span></div>
</td></tr>
<tr><td width="8%" align="right">
<input type="submit" name="action" value="Modificar Datos"/></td><td width="92%" align="left"><input type="submit" name="action" value="Salvar Datos"/>
</td></tr>
</table>

</td></tr>
<tr><td>
</form>
<?php }else if ($action=="Salvar Datos" && $salvado==false){

            $sql = "insert into groups (name, apellido1, apellido2, cif, ";
			$sql = $sql . "telephone1, telephone2, mobile, fax, email, address1, address2, city, state, zip, razon_social, publicidad, factura, lista_asistencia) values ";
			$sql = $sql . "('" . $name . "', '" . $apellido1 ."', '" . $apellido2 . "', '" . $cif . "'";
			$sql = $sql . ", '" . $telephone1 ."'";
			$sql = $sql . ", '" . $telephone2 . "', '" . $mobile ."'";
			$sql = $sql . ", '" . $fax . "', '" . $email . "', '" . $address1 ."'";
			$sql = $sql . ", '" . $address2 . "', '" . $city ."'";
			$sql = $sql . ", '" . $state . "', '" . $zip ."', '". $razon."', '".$publicidad ."', '".$factura."', '".$lista_asistencia."');";
			mysql_query($sql) or die("Invalid query: " . mysql_error());
			$id = mysql_insert_id();
			$message = "<br>Datos de cliente salvados, continue con la creción de grupo(s) o se eliminar&aacute;n los datos.";
$salvado=true;
}
if ($salvado== true){
?>

<form method="post" name="agregar a grupo" id="agregar a grupo">
  <table width="100%" border="0" cellpadding="10" cellspacing="0" id="creacion_grupos">
    <?php if ($message!=""){echo "<tr><td colspan='3'><strong><font color='#ff9900'>".$message."</font></strong></td></td>";} ?>
    <tr>
      <td colspan="3"><span style="font-weight: bold">Creación de grupo(s):</span></td>
    </tr>
    <tr>
      <td colspan="3"><span style="font-weight: bold">Instrucciones</span></td>
    </tr>
    <tr>
      <td colspan="4"><span style="font-weight: bold">
        <ol type="1">
          <li>Seleccione el grupo al que quiere agregar alumnos</li>
          <li>Escriba los datos del alumno que va a agregar</li>
          <li>De click en el bot&oacute;n de agregar</li>
        </ol>
      </span></td>
    </tr>
    <tr>
      <td rowspan="9" width="99" valign="top"><div align="center">
          <select size="18" multiple="multiple" name="grupos">
            <option value="grupo1">Grupo 1</option>
          </select>
      </div></td>
      <td width="4" height="39"></td>
      <td colspan="2" id="datos"> Datos del nuevo Alumno:</td>
      <td colspan="3" rowspan="9" valign="top"><div align="left">
          <select size="18" multiple="multiple" name="alumnos">
            <option value="grupo1"></option>
          </select>
      </div></td>
    </tr>
    <tr>
      <td></td>
    </tr>
    <tr>
      <td width="4"></td>
      <td width="210">*Nombre</td>
      <td width="175"><input name="nombre_al" type="text" disabled="true" value=""></td>
    </tr>
    <tr>
      <td width="4"></td>
      <td width="210">*Apellido Paterno</td>
      <td width="175"><input name="apellido1_al" type="text" disabled="true" value=""></td>
    </tr>
    <tr>
      <td width="4"></td>
      <td width="210">Apellido Materno</td>
      <td width="175"><input name="apellido1_al" type="text" disabled="true" value=""></td>
    </tr>
    <tr>
      <td width="4"></td>
      <td width="210">M&oacute;vil</td>
      <td width="175"><input name="movil_al" type="text" disabled="true" value=""></td>
    </tr>
    <tr>
      <td width="4"></td>
      <td width="210">E-mail</td>
      <td width="175"><input name="email_al" type="text" disabled="true" value=""></td>
    </tr>
    <tr>
      <td width="4"></td>
      <td width="210">Edad</td>
      <td width="175"><select name="edad">
        <?php for ($i=3; $i<=80; $i++){echo "<option value='".$i."'>".$i." años</option>";} ?>
      </select></td>
    </tr>
    <tr>
      <td width="4"></td>
      <td width="210">*Nivel de Ingl&eacute;s</td>
      <td><select name="nivel_ingles">
          <option value="Principiante">Principiante</option>
          <option value="Intermedio">Intermedio</option>
          <option value="Avanzado">Avanzado</option>
      </select></td>
    </tr>
    <tr>
      <td colspan="2" valign="top"><input type="submit" name="action" value="Crear nuevo grupo"></td>
      <td colspan="2"><div align="center">
          <input type="submit" name="action" value="Agregar alumno">
      </div></td>
      <td width="110" valign="top"><div align="left">
        <input type="submit" name="action" value="Borrar alumno">
      </div></td>
      <td width="15"></td>
      <td width="95"><input type="submit" name="action" value="Editar alumno"></td>
      <td width="504" valign="top">&nbsp;</td>
    </tr>
  </table>
</form>
<?php  }?>
</td></tr>
</table>


<?php include 'includes/foot.php'?>