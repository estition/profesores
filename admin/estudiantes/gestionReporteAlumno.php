<head>

<script type="text/javascript">
function limitText(limitField, limitCount, limitNum) {

	
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		

		var info = document.getElementById(limitCount);
		
		info.innerHTML = limitNum - limitField.value.length;
	}
}
</script>
</head>
<?php

?>
<?php include '../../includes/constants.php'?>
<?php include '../../includes/database.php'?>
<?php include '../../includes/authorize.php'?>
<?php include 'includes/globalFunctions.php'?>

<?php

$user_id = $_COOKIE["user_id"];
$message = "";
$id= $_REQUEST["id"];
//$txtIdUsuario = $_REQUEST["txtIdUsuario"];
$opciones = explode(',',$_POST["txtIdCliente"]);

$txtIdCliente = $opciones[0];
$email = $opciones[1];
//echo $email."BBBBB";

$opciones1 = explode(',',$_POST["txtAlumno"]);

$idalumno = $opciones1[0];
$alumno = $opciones1[1];


$GrupoOpciones1 = $_POST["GrupoOpciones1"];
$GrupoOpciones2 = $_POST["GrupoOpciones2"];
$GrupoOpciones3 = $_POST["GrupoOpciones3"];
$GrupoOpciones4 = $_POST["GrupoOpciones4"];
$GrupoOpciones5 = $_POST["GrupoOpciones5"];
$GrupoOpciones6 = $_POST["GrupoOpciones6"];
$GrupoOpciones7 = $_POST["GrupoOpciones7"];
$GrupoOpciones8 = $_POST["GrupoOpciones8"];
$txtOtrosComentarios = $_POST["txtOtrosComentarios"];
$txtIdNivel = $_POST["txtIdNivel"];
$txtDuracionClase = $_POST["txtDuracionClase"];
$txtNecesitaMejorar = $_POST["txtNecesitaMejorar"];
$txtIdTipoInforme = $_POST["txtIdTipoInforme"];
$txtIdCurso = $_POST["txtIdCurso"];
$txtMaterialUsado = $_POST["txtMaterialUsado"];
$txtAlumno = $_POST["txtAlumno"];

//$email = $_POST["email"];
$totalHours = $_POST["totalHours"];

$status = $_POST["status"];
$adminComments = $_POST["adminComments"];

$borrar = $_POST["borrar"];
$infoValida = $_POST["infoValida"];

///////////////////////////////////////////////////////////////////////////////////////////////////////////

//BEGIN: NEW REPORT
if ( ($_REQUEST['id'] == "") && ($infoValida) ) {
			
					  
	$mode = "New student report";
	if ($_POST['action'] == "Save changes") {
				
		if ($message == "") {
		
			$Año=date("Y"); $Dia=date("d"); $Mes=date("m");
				  $sql = "insert into informes_alumnos2 ( ";
				  $sql = $sql." DIA_INFORME, MES_INFORME, ANO_INFORME, IDCLIENTE, IDUSUARIO, PRONUNCIACION, GRAMATICA, COMPRENSION_ORAL, COMPRENSION_ESCRITA, EXPRESION_ORAL, EXPRESION_ESCRITA, PARTICIPACION, COMPORTAMIENTO, OTROS_COMENTARIOS, IDNIVEL, DURACION_CLASE, NECESITA_MEJORAR, IDTIPO_INFORME, IDCURSO, MATERIAL_USADO, ALUMNO, IDALUMNO, email, totalHours "   /* COMENTARIO1, COMENTARIO2, COMENTARIO3, COMENTARIO4, COMENTARIO5, COMENTARIO6, COMENTARIO7, COMENTARIO8*/ ;  										//.DameIdUsers($user_id). //.$_POST['$txtIdUsuario'].	//$txtIdUsuario
			      $sql = $sql.') values ('.$Dia.','.$Mes.','.$Año.','.$txtIdCliente.','.DameIdUsers($user_id).','.$_POST['GrupoOpciones1'].','.$_POST['GrupoOpciones2'].','.$_POST['GrupoOpciones3'].','.$_POST['GrupoOpciones4'].','.$_POST['GrupoOpciones5'].','.$_POST['GrupoOpciones6'].','.$_POST['GrupoOpciones7'].','.$_POST['GrupoOpciones8'].',"'.addslashes($_POST['txtOtrosComentarios']).'",'.$_POST['txtIdNivel'].',"'.$_POST['txtDuracionClase'].'","'.$_POST['txtNecesitaMejorar'].'","'.$_POST['txtIdTipoInforme'].'","'.addslashes($_POST['txtIdCurso']).'","'.addslashes($_POST['txtMaterialUsado']).'","'.$alumno.'","'.$idalumno.'","'.$email.'","'.$_POST['totalHours']. /* '","'.$_POST['txtComentarios1']. '","'.$_POST['txtComentarios2']. '","'.$_POST['txtComentarios3']. '","'.$_POST['txtComentarios4']. '","'.$_POST['txtComentarios5']. '","'.$_POST['txtComentarios6'].'","'.$_POST['txtComentarios7']. '","'.$_POST['txtComentarios8']. */'")';		

		//print $sql;
			mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
			$id = mysql_insert_id();	

			$message = "Student report saved.";
		}
	}
} else {
	$mode = "Edit student report";
}
//END: NEW REPORT


if ($id == "") {
	$id = $_REQUEST['id'];
}


//BEGIN: EDIT REPORT

if ( ($_REQUEST['id'] != "") && ($_POST['action'] == "Save changes") && ($infoValida) ) {

	if ($message == "") {	//$Año=date("Y"); $Dia=date("d"); $Mes=date("m");
	
		$sql = "update informes_alumnos2 set IDCLIENTE = '" . $txtIdCliente . "' ";
		//$sql = $sql . ", IDUSUARIO = '" . $txtIdUsuario . /*addslashes($_POST['txtIdUsuario']) .*/ "', ALUMNO = '" . addslashes($_POST['txtAlumno']) . "' ";

		$sql = $sql . ", ALUMNO = '" . $alumno . "', IDALUMNO = '" . $idalumno . "' ";	
		$sql = $sql . ", IDTIPO_INFORME = '" . $_POST['txtIdTipoInforme'] . "', IDNIVEL = '" . $_POST['txtIdNivel'] . "' ";
		$sql = $sql . ", IDCURSO = '" . $_POST['txtIdCurso'] . "', DURACION_CLASE = '" . $_POST['txtDuracionClase'] . "' ";		
		$sql = $sql . ", PRONUNCIACION = '" . $_POST['GrupoOpciones1'] . "', GRAMATICA = '" . $_POST['GrupoOpciones2'] . "' ";
		$sql = $sql . ", COMPRENSION_ORAL = '" . $_POST['GrupoOpciones3'] . "', COMPRENSION_ESCRITA = '" . $_POST['GrupoOpciones4'] . "' ";
		$sql = $sql . ", EXPRESION_ORAL = '" . $_POST['GrupoOpciones5'] . "', EXPRESION_ESCRITA = '" . $_POST['GrupoOpciones6'] . "' ";
		$sql = $sql . ", PARTICIPACION = '" . $_POST['GrupoOpciones7'] . "', COMPORTAMIENTO = '" . $_POST['GrupoOpciones8'] . "' ";		
		$sql = $sql . ", OTROS_COMENTARIOS = '" . addslashes($_POST['txtOtrosComentarios']) . "', MATERIAL_USADO = '" .addslashes( $_POST['txtMaterialUsado']) . "' ";
		$sql = $sql . ", NECESITA_MEJORAR = '" . addslashes($_POST['txtNecesitaMejorar']) . "' " ;
		
		$sql = $sql . ", email = '" . $email . "' " ;
		$sql = $sql . ", totalHours = '" . $_POST['totalHours'] . "' " ;
		
		////////////////////////////////////
		if ($is_admin_a) {		
			$sql = $sql . ", status = '" . $_POST['status'] . "' " ;
			$sql = $sql . ", adminComments = '" .addslashes($_POST['adminComments']) . "' " ;
		} else {
			$sql = $sql . ", status = 0 " ;
			$sql = $sql . ", adminComments = '' " ;
		}
		////////////////////////////////////		
		
		$sql = $sql . " where ID = " . $id . ";";
	
		//print $sql;
		mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
		$message = "Student report saved.";
	}
}
//END: EDIT REPORT


//BEGIN: DELETE REPORT
if ($id != "" && $_POST['action2'] == "Delete student report") {
	if ($message == "") {	
		if ($borrar){
				$sql = "delete from informes_alumnos2 where ID = " . $id;		
				//print $sql;
				mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
				$message = "Student Report Deleted.";
				$id ="";
				if ($is_admin_a){
					echo "<script type=\"text/javascript\">alert(\"The student report has been deleted succesfully.\"); window.location.href=\"busquedaReporteAlumno.php\";</script>";}
				else{
					/*echo "<script type=\"text/javascript\">alert(\"The student report has been deleted succesfully.\"); window.location.href=\"vistaReportesAlumnos.php?id=".DameIdUsers($user_id)."\";</script>";*/
					echo "<script type=\"text/javascript\">alert(\"The student report has been deleted succesfully.\"); window.location.href=\"vistaReportesAlumnos.php\";</script>";}
		}	// $borrar		
	}	//message
}
//END: DELETE REPORT	


if (($id != "") && (($message == "Student report saved.") || ($message == ""))) {
	$sql = "select * from informes_alumnos2 where ID = " . $id;
	//print $sql;
	$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
	if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		//$txtIdUsuario = $row["IDUSUARIO"];
		$IdUsuarioTemp = $row["IDUSUARIO"];
		$txtIdCliente = $row["IDCLIENTE"];		
		$GrupoOpciones1 = $row["PRONUNCIACION"];
		$GrupoOpciones2 = $row["GRAMATICA"];
		$GrupoOpciones3 = $row["COMPRENSION_ORAL"];
		$GrupoOpciones4 = $row["COMPRENSION_ESCRITA"];
		$GrupoOpciones5 = $row["EXPRESION_ORAL"];
		$GrupoOpciones6 = $row["EXPRESION_ESCRITA"];
		$GrupoOpciones7 = $row["PARTICIPACION"];
		$GrupoOpciones8 = $row["COMPORTAMIENTO"];
		$txtOtrosComentarios = $row["OTROS_COMENTARIOS"];
		$txtIdNivel = $row["IDNIVEL"];
		$txtDuracionClase = $row["DURACION_CLASE"];
		$txtNecesitaMejorar = $row["NECESITA_MEJORAR"];
		$txtIdTipoInforme = $row["IDTIPO_INFORME"];
		$txtIdCurso = $row["IDCURSO"];
		$txtMaterialUsado = $row["MATERIAL_USADO"];
		$txtAlumno = $row["ALUMNO"];
		$idalumno = $row["IDALUMNO"];
		
		$email = $row["email"];
		$totalHours = $row["totalHours"];
		$status = $row["status"];
		$adminComments = addslashes($row["adminComments"]);	
		
		/* DIA_INFORME, MES_INFORME, AÑO_INFORME, IDCLIENTE,IDUSUARIO, PRONUNCIACION, GRAMATICA,COMPRENSION_ORAL, COMPRENSION_ESCRITA, EXPRESION_ORAL, EXPRESION_ESCRITA, PARTICIPACION, COMPORTAMIENTO, OTROS_COMENTARIOS, IDNIVEL, DURACION_CLASE, NECESITA_MEJORAR, IDTIPO_INFORME, IDCURSO, MATERIAL_USADO, ALUMNO, COMENTARIO1, COMENTARIO2, COMENTARIO3, COMENTARIO4, COMENTARIO5, COMENTARIO6, COMENTARIO7, COMENTARIO8) "; */ 
		
	} 
}

	
?>
<?php include '../../includes/top.php';

?>


<div style="position: relative;" align="right">  
</div>

<script type="text/javascript">
	function validar(){
		var x=1, xl=0;
		cadena="";
		if (document.getElementById("txtIdCliente").value==""){
			x = 0; cadena += " - Select client.\n";
		}
		if (document.getElementById("txtAlumno").value==""){
			x = 0; cadena += " - Enter student's name.\n";
		}
		
		if (document.getElementById("txtIdTipoInforme").value==""){
			x = 0; cadena += " - Select report's type.\n";
		}
		if (document.getElementById("txtIdNivel").value==""){
			x = 0; cadena += " - Select level.\n";
		}
		if (document.getElementById("txtIdCurso").value==""){
			x = 0; cadena += " - Select course.\n";
		}			
		if (document.getElementById("txtDuracionClase").value==""){
			x = 0; cadena += " - Enter duration of each class.\n";
		} else {
			if ( validarEntero(document.getElementById("txtDuracionClase").value)=="" ){
				x = 0; cadena += " - Enter a valid duration of each class.\n";
			}
		}
		if (document.getElementById("txtOtrosComentarios").value==""){
			x = 0; cadena += " - Enter student's comments.\n";
		}
		if (document.getElementById("txtMaterialUsado").value==""){
			x = 0; cadena += " - Enter material used.\n";
		}		
		
		<?php if ($is_admin_a) {?>
		if (document.getElementById("status").value==0){
//			x = 0; cadena += " - Select a valid status.\n";
		}
		if (document.getElementById("status").value==2){
			if (document.getElementById("adminComments").value==""){
				x = 0; cadena += " - Enter comments of a wrong report.\n";
			}
		}
		<?php }	?>
		
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
	
	function limita(area_texto,max) {
		if(area_texto.value.length>=max){area_texto.value=area_texto.value.substring(0,max);}
	}
	
	function confirmacionBorrar() {
		var r=confirm("Do you really want to delete this student report?");
			if (r==true) document.getElementById("borrar").value = 1;
			else document.getElementById("borrar").value = 0;
	}
	
		function selTeacher(d) {
									var action = document.getElementById("action");
									action.value="SELECT_TEACHER";
									document.forms.associate.submit();
								}
	
</script>
 <p align="center"><b>Student Report Profile &#8211;<?php echo  $mode ?> <br><font color='#ff9900'><?php echo  $message; ?></font></b>
 <br /> <b>*Comments:</b><br />
Adult comment's must be in english<br />Children comment's must be in spanish</p>
       
            <!--start dynamic code -->
        
            <form name="associate" id="associate" method="post">
            	  	<input type="hidden" name="id" value="<?php echo $id;?>">
             
                 <table border="0" class="pepe1" cellpadding="5" align="center" bgcolor="#ccc" cellspacing="0" id="login">
                 
	                  <tr>                        
                        <td colspan="2" style="text-align:center">Enter the required information:<br />&nbsp;</td>
                      </tr>                  
                      <tr> 
                        <td valign="top"><b>User ID:</b></td>
                        <td><b><?php if (!$is_admin_a) echo $user_id; else { if ($IdUsuarioTemp=="" and $is_admin_a) $IdUsuarioTemp=1; echo obtenLoginProfesor($IdUsuarioTemp); } ?></b><!--<input type="hidden" name="txtIdUsuario" id="txtIdUsuario" />--></td>
                      </tr>
                     <tr> 
                        <td valign="top"><b>*Client:</b></td>
                        <td>
                        
                                          			
                        	 <select name="txtIdCliente" id="txtIdCliente" onChange="javascript:selTeacher(this)">
							  <option value=""></option>
                               
							  <?php print DameOpcionesClients($user_id, $txtIdCliente);?>
                          </select>    
                                        </td>
                      </tr>
                      <tr> 
                        <td valign="top"><b>*Student:</b></td>
                        <td>
                         <select name="txtAlumno" id="txtAlumno">
							  <option value=""></option>
                              
							  <?php print DameOpcionesStudents($txtIdCliente, $idalumno);?>
                          </select> 
                          
                            
                        
                     </td>
                      </tr>
                      <tr> 
                        <td valign="top"><b>*Report type:</b></td>
                        <td>
                        	<select name="txtIdTipoInforme" id="txtIdTipoInforme">
                            	<option value=""></option>
                        	<?php 
							if ($txtIdTipoInforme!=""){ 
								echo "<option value=\"0\" ";
								if ($txtIdTipoInforme==0) echo "selected=\"selected\" ";								
								echo ">Adult</option>";
								echo "<option value=\"1\" ";
								if ($txtIdTipoInforme==1) echo "selected=\"selected\" ";
								echo ">Child</option>";								
							} else { ?>
								<option value="0">Adult</option>
                                <option value="1">Child</option>
                            <?php } ?>
                            </select>                        </td>
                      </tr>
                      <tr> 
                        <td valign="top"><b>*Level:</b></td>
                        <td><select name="txtIdNivel" id="txtIdNivel">
							  <?php 
							  print '<option value=""></option>';
  	 				 		  print DameOpciones($txtIdNivel,'niveles2','NIVEL');							  
							  ?>    
							  </select>                        </td>
                      </tr>
                      <tr> 
                        <td valign="top"><b>*Course:</b></td>
                        <td>
                        	<select name="txtIdCurso" id="txtIdCurso">
                            <option value=""></option>                            
                            <?php
							$anioInicio=date("Y")-4;
							$band=true;
							if ($txtIdCurso!="") {
								for ($i=0;$i<=13;$i++) {
									echo "<option value=\"".$i."\" ";
									if ((int)$txtIdCurso==$i) echo "selected=\"selected\" ";
									echo ">";
									if ($band){
										echo "May ".$anioInicio;
										$band=false;
									} else {
										echo "Dec ".$anioInicio;
										$band=true;
										$anioInicio++;							
									}
									echo "</option>";
								}
							} else {
								for ($i=0;$i<=13;$i++) {
									echo "<option value=\"".$i."\">";
									if ($band){
										echo "May ".$anioInicio;
										$band=false;
									} else {
										echo "Dec ".$anioInicio;
										$band=true;
										$anioInicio++;							
									}
									echo "</option>";
								}
							} ?>
                            </select>                        </td>
                      </tr>
                      <tr> 
                        <td valign="top"><b>*Total hours of class:</b></td>
                        <td> 
                      
<?php 
if ( $txtIdCliente != "") {
	$totalHours = DameTotalHoras($txtIdCliente); 
} ?>
							  
							<input id="totalHours" required name="totalHours" type="text" maxlength="2" size="3" value="<?php echo  $totalHours;?>" />
                        <!--<input name="totalHours" type="hidden" value=<?php // print $totalHours  ;?> />-->
<!--                       <label title="totalHours" for="totalHours"><b><?php // print $totalHours;?></b></label>-->
                     </td>
                      </tr>
                      <tr> 
                        <td valign="top"><b>*Duration of each class:</b></td>
                        <td><input id="txtDuracionClase" name="txtDuracionClase" required type="text" maxlength="5" size="5" value="<?php echo  $txtDuracionClase;?>" /></td>
                      </tr>
                      <tr>                        
                        <td>&nbsp;</td><td style="text-align:center"><br />i.e. if total class length 1.5 hours of which 1 hour with one student and 30 minutes with the other.<br />&nbsp;</td>
                      </tr>
                      
                      
                        
                        
                      <tr> 
                      	<td valign="top"><b>Pronunciation:</b></td>
                        <td>                              
                        <?php
								$etiquetas=array("Needs Improvement","Normal","Good","Excellent","N/A");
							  	if ($GrupoOpciones1!="") {							  		
							  		for ($i=0;$i<=4;$i++){
		                                echo "<label><input name=\"GrupoOpciones1\" id=\"GrupoOpciones1\" type=\"radio\" value=\"".$i."\" ";
										if ((int)$GrupoOpciones1==$i) echo "checked=\"checked\" ";
										echo "/>";
										echo $etiquetas[$i]."</label>";
									}
								} else {
									for ($i=0;$i<=4;$i++){									
		                                echo "<label><input name=\"GrupoOpciones1\" id=\"GrupoOpciones1\" type=\"radio\" value=\"".$i."\" ";
										if ($i==1) echo "checked=\"checked\" ";
										echo "/>";
										echo $etiquetas[$i]."</label>";
									}
								}
						?>                      	</td>
                      </tr>                      
                      <tr> 
                      	<td valign="top"><b>Grammar:</b></td>
                        <td>                              
                        <?php							
							  	if ($GrupoOpciones2!="") {							  		
							  		for ($i=0;$i<=4;$i++){
		                                echo "<label><input name=\"GrupoOpciones2\" id=\"GrupoOpciones2\" type=\"radio\" value=\"".$i."\" ";
										if ((int)$GrupoOpciones2==$i) echo "checked=\"checked\" ";
										echo "/>";
										echo $etiquetas[$i]."</label>";
									}
								} else {
									for ($i=0;$i<=4;$i++){									
		                                echo "<label><input name=\"GrupoOpciones2\" id=\"GrupoOpciones2\" type=\"radio\" value=\"".$i."\" ";										
										if ($i==1) echo "checked=\"checked\" ";
										echo "/>";
										echo $etiquetas[$i]."</label>";
									}
								}
						?>                      	</td>
                      </tr>                      
                      <tr> 
                      	<td valign="top"><b>Listening:</b></td>
                        <td>                              
                        <?php								
							  	if ($GrupoOpciones3!="") {							  		
							  		for ($i=0;$i<=4;$i++){								
		                                echo "<label><input name=\"GrupoOpciones3\" id=\"GrupoOpciones3\" type=\"radio\" value=\"".$i."\" ";
										if ((int)$GrupoOpciones3==$i) echo "checked=\"checked\" ";
										echo "/>";
										echo $etiquetas[$i]."</label>";
									}
								} else {
									for ($i=0;$i<=4;$i++){									
		                                echo "<label><input name=\"GrupoOpciones3\" id=\"GrupoOpciones3\" type=\"radio\" value=\"".$i."\" ";
										if ($i==1) echo "checked=\"checked\" ";
										echo "/>";
										echo $etiquetas[$i]."</label>";
									}
								}
						?>                      	</td>
                      </tr>
                      <tr> 
                      	<td valign="top"><b>Reading:</b></td>
                        <td>                              
                        <?php								
							  	if ($GrupoOpciones4!="") {							  		
							  		for ($i=0;$i<=4;$i++){								
		                                echo "<label><input name=\"GrupoOpciones4\" id=\"GrupoOpciones4\" type=\"radio\" value=\"".$i."\" ";
										if ((int)$GrupoOpciones4==$i) echo "checked=\"checked\" ";
										echo "/>";
										echo $etiquetas[$i]."</label>";
									}
								} else {
									for ($i=0;$i<=4;$i++){									
		                                echo "<label><input name=\"GrupoOpciones4\" id=\"GrupoOpciones4\" type=\"radio\" value=\"".$i."\" ";
										if ($i==1) echo "checked=\"checked\" ";
										echo "/>";
										echo $etiquetas[$i]."</label>";
									}
								}
						?>                      	</td>
                      </tr>
                      <tr> 
                      	<td valign="top"><b>Writing:</b></td>
                        <td>                              
                        <?php								
							  	if ($GrupoOpciones5!="") {							  		
							  		for ($i=0;$i<=4;$i++){								
		                                echo "<label><input name=\"GrupoOpciones5\" id=\"GrupoOpciones5\" type=\"radio\" value=\"".$i."\" ";
										if ((int)$GrupoOpciones5==$i) echo "checked=\"checked\" ";
										echo "/>";
										echo $etiquetas[$i]."</label>";
									}
								} else {
									for ($i=0;$i<=4;$i++){									
		                                echo "<label><input name=\"GrupoOpciones5\" id=\"GrupoOpciones5\" type=\"radio\" value=\"".$i."\" ";
										if ($i==1) echo "checked=\"checked\" ";
										echo "/>";
										echo $etiquetas[$i]."</label>";
									}
								}
						?>                      	</td>
                      </tr>
                      <tr> 
                      	<td valign="top"><b>Speaking:</b></td>
                        <td>                              
                        <?php								
							  	if ($GrupoOpciones6!="") {							  		
							  		for ($i=0;$i<=4;$i++){								
		                                echo "<label><input name=\"GrupoOpciones6\" id=\"GrupoOpciones6\" type=\"radio\" value=\"".$i."\" ";
										if ((int)$GrupoOpciones6==$i) echo "checked=\"checked\" ";
										echo "/>";
										echo $etiquetas[$i]."</label>";
									}
								} else {
									for ($i=0;$i<=4;$i++){									
		                                echo "<label><input name=\"GrupoOpciones6\" id=\"GrupoOpciones6\" type=\"radio\" value=\"".$i."\" ";
										if ($i==1) echo "checked=\"checked\" ";
										echo "/>";
										echo $etiquetas[$i]."</label>";
									}
								}
						?>                      	</td>
                      </tr>
                      <tr> 
                      	<td valign="top"><b>Participation:</b><br />(Only children)</td>
                        <td>                              
                        <?php								
							  	if ($GrupoOpciones7!="") {							  		
							  		for ($i=0;$i<=4;$i++){								
		                                echo "<label><input name=\"GrupoOpciones7\" id=\"GrupoOpciones7\" type=\"radio\" value=\"".$i."\" ";
										if ((int)$GrupoOpciones7==$i) echo "checked=\"checked\" ";
										echo "/>";
										echo $etiquetas[$i]."</label>";
									}
								} else {
									for ($i=0;$i<=4;$i++){									
		                                echo "<label><input name=\"GrupoOpciones7\" id=\"GrupoOpciones7\" type=\"radio\" value=\"".$i."\" ";
										if ($i==1) echo "checked=\"checked\" ";
										echo "/>";
										echo $etiquetas[$i]."</label>";
									}
								}
						?>                      	</td>
                      </tr>
                      <tr> 
                      	<td valign="top"><b>Behavior:</b><br />(Only children)</td>
                        <td>                              
                        <?php								
							  	if ($GrupoOpciones8!="") {							  		
							  		for ($i=0;$i<=4;$i++){								
		                                echo "<label><input name=\"GrupoOpciones8\" id=\"GrupoOpciones8\" type=\"radio\" value=\"".$i."\" ";
										if ((int)$GrupoOpciones8==$i) echo "checked=\"checked\" ";
										echo "/>";
										echo $etiquetas[$i]."</label>";
									}
								} else {
									for ($i=0;$i<=4;$i++){									
		                                echo "<label><input name=\"GrupoOpciones8\" id=\"GrupoOpciones8\" type=\"radio\" value=\"".$i."\" ";										
										if ($i==1) echo "checked=\"checked\" ";
										echo "/>";
										echo $etiquetas[$i]."</label>";
									}
								}
						?>                      	</td>
                      </tr>                      
                      
                            <tr>
                              <td valign="top">&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>                     
                      
                      
                      
                      <tr>
                              <td valign="top"><b>*Comments:</b><br />
                                Adult comment's must be in english<br />Children comment's must be in spanish</td>
                              <td><textarea name="txtOtrosComentarios" cols="50" wrap="virtual" id="txtOtrosComentarios"  onKeyDown="limitText(this.form.txtOtrosComentarios,'countdown002',500);" onKeyUp="limitText(this.form.txtOtrosComentarios,'countdown002',500);"><?php echo  $txtOtrosComentarios;?></textarea><span id="countdown002"></span></td>
                            </tr>
							<tr> 
                              <td valign="top"><b>*Material Used:</b><br />
                                In English</td>
                              <td>                                <p>
                                <textarea name="txtMaterialUsado" cols="50" wrap="VIRTUAL" id="txtMaterialUsado"  onKeyDown="limitText(this.form.txtMaterialUsado,'countdown001',500);" onKeyUp="limitText(this.form.txtMaterialUsado,'countdown001',500);"><?php echo  $txtMaterialUsado;?></textarea><span id="countdown001"></span>
                              </p>                              </td>
                            </tr>
							<tr> 
                              <td valign="top"><p><b>*Describe student:</b><br /> What does the student need to work on? <br /> Advise for next teacher.
                              <br />In English<br /> (Only children)</p>                              </td>
                              <td>                                <p>
                                <textarea name="txtNecesitaMejorar" cols="50" wrap="VIRTUAL"  onKeyDown="limitText(this.form.txtNecesitaMejorar,'countdown000',500);" onKeyUp="limitText(this.form.txtNecesitaMejorar,'countdown000',500);"><?php echo  $txtNecesitaMejorar;?></textarea><span id="countdown000"></span>
                              </p>                              </td>
                            </tr>
                      
         <?php if ($is_admin_a) {	?>
         
                      <tr>                        
                        <td colspan="2" style="text-align:center"><br />Only for User Administrator:<br />&nbsp;</td>
                      </tr>                      
                      <tr> 
                        <td valign="top"><b>Student report status:</b></td>
                        <td>
                        	<select name="status" id="status">
                        	<?php 
								$etiquetasStatus=array("Sent (Waiting for admin's review)","Accepted","Wrong (Please correct)");
							if ($status!=""){
								for ($i=0;$i<=2;$i++){
									echo "\n<option value=\"".$i."\" ";
									if ((int)$status==$i) echo "selected=\"selected\" ";								
									echo ">".$etiquetasStatus[$i]."</option>";
								}								
							} else { 
								for ($i=0;$i<=2;$i++){
									echo "\n<option value=\"".$i."\" ";									
									echo ">".$etiquetasStatus[$i]."</option>";
								}
                            } ?>
                            </select>                        </td>
                      </tr>
                      <tr> 
                      	<td valign="top"><b>Student report comments:</b><br />(For teacher's review)</td>
                        <td><p>
                        	<textarea id="adminComments" name="adminComments" cols="50" wrap="VIRTUAL"  onKeyDown="limitText(this.form.adminComments,'countdown003',500);" onKeyUp="limitText(this.form.adminComments,'countdown003',500);"><?php echo  $adminComments;?></textarea><span id="countdown003"></span>
                        </p></td>
                      </tr>
                      
         <?php }	else {  ?><tr>                        
                        <td colspan="2" style="text-align:center"><br />
                          <strong><font color="#0000CC" size="3">Admin's corrections:</font></strong><br />
                          &nbsp;</td>
                      </tr>                      
                      <tr> 
                        <td valign="top"><b><strong><font color="#CC0033" size="2"><?php  echo $adminComments; ?></font></strong></b></td>
                        <td>
		 
		<?php }	?>   
     


                  </td>
                </tr>
                <tr valign="top"> 
                  <td colspan="2" bgcolor="#eeeeee">&nbsp; </td>
                </tr>
                <tr valign="top" bgcolor="#dddddd"> 
                  <td colspan="2" align="center">
                  	<input name="action" type="submit" id="action" value="Save changes" onclick="validar();" />
                    <input type="hidden" id="infoValida" name="infoValida" value="<?php echo $infoValida;?>">
                    <?php if ($id != "" ) { //solo update	?>
	                    <input name="action2" type="submit" id="action2" value="Delete student report" onclick="confirmacionBorrar();" />
	                <?php } ?>
                    <input type="hidden" name="borrar" id="borrar" value="<?php echo $borrar;?>">                    
                  		<!--<input name="back" id="back" type="button" value="Back to reports" onclick="javascript:location.href='vistaReportesAlumnos.php?id=<?php echo DameIdUsers($user_id); ?>';" />-->
                    <?php if ($is_admin_a) { ?>
                    	<input name="back" id="back" type="button" value="Back to search" onclick="javascript:location.href='busquedaReporteAlumno.php';" />                        
                    <?php } else { ?>
                    	<input name="back" id="back" type="button" value="Back to reports" onclick="javascript:location.href='vistaReportesAlumnos.php';" />
                    <?php } ?>
                  </td>
                </tr>
              </table>
            </form> 
            
            </div>  
       
       
<?php include 'includes/foot.php'?>
