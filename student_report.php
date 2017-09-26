<?php include 'includes/constants.php'?>
<?php include 'includes/functions.php'?>
<?php include 'includes/database.php'?>
<?php include 'includes/authorize.php'?>

<?php
  include('config.php');

  Conectar();
   $user_id = $_COOKIE["user_id"];

  function DameIdUsers($Login)
    {
    global $Conexion;
       if($Login!='') {
	   
	 $sql='SELECT ID FROM users WHERE  user_id="'.$Login.'"';
	   
	 $rs = mysql_query($sql,$Conexion);
	 
	  //print 'SELECT NOMBRE_GRUPO FROM grupos2 WHERE ID='.$IdGrupo;
	 //print 'SELECT ID,'.$orderby1.','.$orderby2.' FROM '.strtolower($tabla).' ORDER BY '.$orderby1.','.$orderby2;
	 
	 //print $sql;
	 //exit();
	  				
  	 $fila = mysql_fetch_row($rs);
				
	 $NumeroRegistros = mysql_num_rows($rs);
	 
	 //print $NumeroRegistros;
	 
	 $resul='';
	 if($NumeroRegistros==0) {
	  $resul='';
	 } 
	 else {
	  $resul=$fila[0];
	 }   
	 
	   
	   mysql_free_result($rs);
	
	   return $resul; 

	   }
	
	
	
	}
  
  
  function DameOpcionesClients($teacher)
   {
   //***********************modificado por SVI*************************
    
   if ($teacher == "admin"){
   
   $sql = "select a.end, b.id, a.name, class_type, length, a.id as ident from groups a, userGroup b where a.id = b.group_id and b.end is null group by name";
   
   }else {
   $sql = "select a.end, b.id, a.name, class_type, length, a.id as ident from groups a, userGroup b, users c ";
   $sql = $sql . "where a.id = b.group_id and b.user_id = c.id and c.user_id = '" . $teacher .  "' and b.end is null order by a.name";
	}

	//print $sql;
  $result = mysql_query($sql) or die("Invalid query: " . mysql_error());
  while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	
	$clients = $clients . "<option value='" . $row['ident'] . "'" . $selected . ">" . $row["name"].  $row['end'] . "</option>";
   
   
   }
   
   
 return $clients;
 }  
   




//print '---------------->'.$user_id; 

//exit;

if ($_POST['action'] == "Save Report") {
    $strSucess='Successfully...';
	/*Tabla: informes_alumnos2 
	Campo Tipo Cotejamiento Atributos Nulo Predeterminado Extra Acción 
  ID int(11)   No  auto_increment               
  FECHA_INFORME varchar(10) latin1_spanish_ci  No                 
  IDCLIENTE int(11)   No                 
  IDALUMNO int(11)   No                 
  IDUSUARIO int(11)   No                 
  PRONUNCIACION int(11)   No                 
  GRAMATICA int(11)   No                 
  COMPRENSION_ORAL int(11)   No                 
  COMPRENSION_ESCRITA int(11)   No                 
  EXPRESION_ORAL int(11)   No                 
  EXPRESION_ESCRITA int(11)   No                 
  PARTICIPACION int(11)   No                 
  COMPORTAMIENTO int(11)   No                 
  OTROS_COMENTARIOS varchar(300) latin1_spanish_ci  No                 
  IDNIVEL int(11)   No                 
  DURACION_CLASE double   No                 
  NECESITA_MEJORAR varchar(300) latin1_spanish_ci  No                 
  IDTIPO_INFORME int(11)   No                 
  IDCURSO 

	
	*/
	 $Año=date('Y');
     $Dia=date('d');
     $Mes=date('m');
	 			//////////////////// INSERTAMOS NUEVO //////////////////
				  $Insert='INSERT INTO informes_alumnos2(DIA_INFORME,MES_INFORME,AÑO_INFORME,IDCLIENTE,IDUSUARIO,PRONUNCIACION,GRAMATICA,COMPRENSION_ORAL,COMPRENSION_ESCRITA,EXPRESION_ORAL,EXPRESION_ESCRITA,PARTICIPACION,COMPORTAMIENTO,OTROS_COMENTARIOS,IDNIVEL,DURACION_CLASE,NECESITA_MEJORAR,IDTIPO_INFORME,IDCURSO,MATERIAL_USADO,ALUMNO,COMENTARIO1,COMENTARIO2,COMENTARIO3,COMENTARIO4,COMENTARIO5,COMENTARIO6,COMENTARIO7,COMENTARIO8)';  
			      $Insert=$Insert.' VALUES('.$Dia.','.$Mes.','.$Año.','.$_POST['txtIdCliente'].','.DameIdUsers($user_id).','.$_POST['GrupoOpciones1'].','.$_POST['GrupoOpciones2'].','.$_POST['GrupoOpciones3'].','.$_POST['GrupoOpciones4'].','.$_POST['GrupoOpciones5'].','.$_POST['GrupoOpciones6'].','.$_POST['GrupoOpciones7'].','.$_POST['GrupoOpciones8'].',"'.$_POST['txtOtrosComentarios'].'",'.$_POST['txtIdNivel'].',"'.$_POST['txtDuracionClase'].'","'.$_POST['txtNecesitaMejorar'].'","'.$_POST['txtIdTipoInforme'].'","'.$_POST['txtIdCurso'].'","'.$_POST['txtMaterialUsado'].'","'.$_POST['txtAlumno'].'","'.$_POST['txtComentarios1'].'","'.$_POST['txtComentarios2'].'","'.$_POST['txtComentarios3'].'","'.$_POST['txtComentarios4'].'","'.$_POST['txtComentarios5'].'","'.$_POST['txtComentarios6'].'","'.$_POST['txtComentarios7'].'","'.$_POST['txtComentarios8'].'")';
				  //$Insert=$Insert.'"'.$_POST['txtPrecio'].'","'.$_POST['txtPrecioInformado'].'","'.$_POST['txtIdProfesor'].'","'.$_POST['txtObjetivos'].',"'.$_POST['txtSeguimiento'].',"'.$_POST['txtIdInformadoPor'].'","'.$_POST['txtPersonaInformadora'].'","'.$_POST['txtInformadoCancelacion'].'","'.$_POST['txtInformadoPago'].',"'.$_POST['txtInformadoClub'].'","'.$_POST['txtIdHorarioPreferencia'].'","'.$_POST['txtPreferenciaHM'].'","'.$_POST['txtPreferenciaIB'].'","'.$_POST['txtDesaFactura'].'","'.$_POST['txtDeseaNota'].'","'.$_POST['txtNiños'].'")';
				  $Res = mysql_query($Insert);
				  if (!$Res)
			         {
			         print 'Error tipo Insert: '.$Insert;
			         exit;
			         }
					 //////////////////////////////////////////////////////////////////////
	include 'includes/top_success.php';
}
else {
    include 'includes/top.php'; 
  }

$page_name = "student report";

?>
<?php //include 'includes/top.php'?>
<?php include 'includes/menu.php'?>
<script>
	
	/*
txtIdCliente
txtIdAlumno
txtIdTipoInforme
txtIdNivel
txtIdCurso
DuracionClase
txtOtrosComentarios
txtMaterialUsado
txtNecesitaMejorar
	
	*/
	function AltaEstudiante() {		
		win = window.open("alta_estudiante.php", "filter", "directories=0,location=0,menubar=0,resizable=0,scrollbars=0,status=0,titlebar=0,toolbar=0,width=550,height=570,top=50,left=270");
	    win.focus();
		}
	
	function limita(area_texto,max)
{
if(area_texto.value.length>=max){area_texto.value=area_texto.value.substring(0,max);}
}
	
	function ValidaEnviar(){ 
    //valido el nombre 
    if (document.student_report.txtIdCliente.value.length==0){ 
       alert("Missing fields to be filled"); 
       document.student_report.txtIdCliente.focus(); 
       return 0; 
    }
	
	if (document.student_report.txtAlumno.value.length==0){ 
       alert("Missing fields to be filled"); 
       document.student_report.txtIdAlumno.focus(); 
       return 0; 
    }
	
	if (document.student_report.txtIdTipoInforme.value.length==0){ 
       alert("Missing fields to be filled"); 
       document.student_report.txtIdTipoInforme.focus(); 
       return 0; 
    }
	
	if (document.student_report.txtIdNivel.value.length==0){ 
       alert("Missing fields to be filled"); 
       document.student_report.txtIdNivel.focus(); 
       return 0; 
    }
	
	if (document.student_report.txtIdCurso.value.length==0){ 
       alert("Missing fields to be filled"); 
       document.student_report.txtIdCurso.focus(); 
       return 0; 
    }
	
	if (document.student_report.txtOtrosComentarios.value.length==0){ 
       alert("Missing fields to be filled"); 
       document.student_report.txtOtrosComentarios.focus(); 
       return 0; 
    }
	
	if (document.student_report.txtMaterialUsado.value.length==0){ 
       alert("Missing fields to be filled"); 
       document.student_report.txtMaterialUsado.focus(); 
       return 0; 
    }
	if(document.student_report.txtIdTipoInforme.value==1){
		if (document.student_report.txtNecesitaMejorar.value.length==0){ 
       		alert("Missing fields to be filled"); 
       		document.student_report.txtNecesitaMejorar.focus(); 
       		return 0; 
    		}	 
	}

    
    document.student_report.submit(); 
   } 
	
	
	</script>

      <table width="100%" border="0" cellpadding="10" cellspacing="0" id="body">
        <tr> 
          <td width="100%" valign="top"> 
		  
		  <p><b>Welcome Teachers <font color="#FF0000"></font>!</b><b><font color='#ff9900'><?php echo  $message; ?></font></b>            </p>
						<form action="student_report.php" name="student_report" id="student_report" method="post">
              <table border="0" cellpadding="1" cellspacing="0" bgcolor="#738FE6" id="border">
                <tr> 
                  <td width="814"><table border="0" cellpadding="5" cellspacing="0" id="shell">
                      <tr valign="top"> 
                        <td width="805" bgcolor="#0033CC"><b><font class="textW">Student Report</font></b></td>
                      </tr>
                      <tr valign="top"> 
                        <td bgcolor="#B6C5F2">Enter student report</td>
                      </tr>
                      <tr valign="top"> 
                        <td bgcolor="#FFFFFF"> <table border="0" cellpadding="5" cellspacing="0" id="login">
                            <tr> 
                              <td width="128" valign="top"><b>User ID:</b></td>
                              <td width="626"> <b><?php echo $user_id?></b>                              </td>
                            </tr>
                            <tr> 
                              <td valign="top"><b>Client:</b></td>
                              <td> <select name="txtIdCliente" id="txtIdCliente">
							  <option value=""></option>
							  <?php print DameOpcionesClients($user_id);?>
                              </select>                              </td>
                            </tr>
                            <!--<tr> 
                              <td valign="top"><b>Student:</b></td>
                              <td><select name="txtIdAlumno" id="txtIdAlumno">
							  <option value="NULL"></option>
							  <?php //print DameOpciones2('','alumnos2','APELLIDO1','NOMBRE');?>
                              </select>
							  <input name="btn_student" type="button" id="save" class="submit-button" value="Add New Student" onClick="AltaEstudiante()">
                            </td>
                            </tr>-->
							<tr> 
                              <td valign="top"><b>Student * :</b></td>
                              <td><input name="txtAlumno" id="txtAlumno" size="55"></td>
                            </tr>
							<tr>
                              <td valign="top">&nbsp;</td>
                              <td> <b>*</b> please put first and last name. </td>
                            </tr>
							<tr> 
                              <td valign="top"><b>Type report:</b></td>
                              <td><select name="txtIdTipoInforme" id="txtIdTipoInforme">
                                <option value=""></option>
								<option value="0">Adult</option>
                                <option value="1">Children</option>
                                </select>                              </td>
                            </tr>
                             <tr> 
                              <td valign="top"><b>Level:</b></td>
                              <td> 
							  <select name="txtIdNivel" id="txtIdNivel">
							  <?php 
							  print '<option value="NULL"></option>';
	 				 		  print DameOpciones('','niveles2','NIVEL');
 					  ?>    
							  </select>                               </td>
                            </tr>
							 <tr> 
                              <td valign="top"><b>Course</b><b>:</b></td>
                              <td><select name="txtIdCurso" id="txtIdCurso">
                                <option value=""></option>
								<option value="0">May 08</option>
                                <option value="1">Dec 08</option>
                                <option value="2">May 09</option>
                                <option value="3">Dec 09</option>
                                </select>                               </td>
                            </tr>
							<tr> 
                              <td valign="top"><b>Class lenght * </b><b>:</b></td>
                              <td><input name="txtDuracionClase" id="txtDuracionClase" size="10"></td>
                            </tr>
							<tr>
                              <td valign="top">&nbsp;</td>
                              <td> <b>*</b> i.e. if total class length 1.5 hours of which 1 hour with one student and 30 minutes with the other. </td>
                            </tr>
							 <tr> 
                              <td valign="top"><b>Pronunciation</b><b>:</b></td>
                              <td><p>
                                <label>
                                <input name="GrupoOpciones1" type="radio" value="0">
  Needs Improvement</label>
                                <label>
                                <input name="GrupoOpciones1" type="radio" value="1" checked>
  Normal</label>
                                <label>
                                <input type="radio" name="GrupoOpciones1" value="2">
  Good</label>
                                <label>
                                <input type="radio" name="GrupoOpciones1" value="3">
  Excellent</label>
   <label>
                                <input type="radio" name="GrupoOpciones1" value="4">
  N/A</label>
   <br>
                              </p></td>
                            </tr>
							 <tr> 
                              <td valign="top"><b>Grammar:</b></td>
                              <td><label>
                                <input type="radio" name="GrupoOpciones2" value="0">
Needs Improvement</label>
                                <label>
                                <input name="GrupoOpciones2" type="radio" value="1" checked>
Normal</label>
                                <label>
                                <input type="radio" name="GrupoOpciones2" value="2">
Good</label>
                                <label><input type="radio" name="GrupoOpciones2" value="3">
Excellent</label><label>
                                <input type="radio" name="GrupoOpciones2" value="4">
  N/A</label></td>
                            </tr>
							 <tr> 
                              <td valign="top"><b>Listening</b><b>:</b></td>
                              <td><label>
                                <input type="radio" name="GrupoOpciones3" value="0">
Needs Improvement</label>
                                <label>
                                <input name="GrupoOpciones3" type="radio" value="1" checked>
Normal</label>
                                <label>
                                <input type="radio" name="GrupoOpciones3" value="2">
Good</label>
                                <label><input type="radio" name="GrupoOpciones3" value="3">
Excellent</label><label>
                                <input type="radio" name="GrupoOpciones3" value="4">
  N/A</label></td>
                            </tr>
							 <tr> 
                              <td valign="top"><b>Reading:</b></td>
                              <td><label>
                                <input type="radio" name="GrupoOpciones4" value="0">
Needs Improvement</label>
                                <label>
                                <input name="GrupoOpciones4" type="radio" value="1" checked>
Normal</label>
                                <label>
                                <input type="radio" name="GrupoOpciones4" value="2">
Good</label>
                                <label>
                                <input type="radio" name="GrupoOpciones4" value="3">
Excellent</label><label>
                                <input type="radio" name="GrupoOpciones4" value="4">
  N/A</label></td>
                            </tr>
							<tr> 
                              <td valign="top"><b>Writing</b><b>:</b></td>
                              <td><label>
                                <input type="radio" name="GrupoOpciones5" value="0">
Needs Improvement</label>
                                <label>
                                <input name="GrupoOpciones5" type="radio" value="1" checked>
Normal</label>
                                <label>
                                <input type="radio" name="GrupoOpciones5" value="2">
Good</label>
                                <label>
                                <input type="radio" name="GrupoOpciones5" value="3">
Excellent</label><label>
                                <input type="radio" name="GrupoOpciones5" value="4">
  N/A</label></td>
                            </tr>
							<tr> 
                              <td valign="top"><b>Speaking</b><b>:</b></td>
                              <td><label>
                                <input type="radio" name="GrupoOpciones6" value="0">
Needs Improvement</label>
                                <label>
                                <input name="GrupoOpciones6" type="radio" value="1" checked>
Normal</label>
                                <label>
                                <input type="radio" name="GrupoOpciones6" value="2">
Good</label>
                                <label>
                                <input type="radio" name="GrupoOpciones6" value="3">
Excellent</label><label>
                                <input type="radio" name="GrupoOpciones6" value="4">
  N/A</label></td>
                            </tr>
							<tr> 
                              <td valign="top"><p><b>Participation :<br />
                              </b>(only for children)</p>
                              </td>
                              <td><label>
                                <input type="radio" name="GrupoOpciones7" value="0">
Needs Improvement</label>
                              <label>
                                <input name="GrupoOpciones7" type="radio" value="1" checked>
Normal</label>
                                <label>
                                <input type="radio" name="GrupoOpciones7" value="2">
Good</label>
                                <label>
                                <input type="radio" name="GrupoOpciones7" value="3">
Excellent</label><label>
                                <input type="radio" name="GrupoOpciones7" value="4">
  N/A</label></td>
                            </tr>
							<tr> 
                              <td valign="top"><b>Behavior :<br />
                              </b>(only for children)</td>
                              <td><label>
                                <input type="radio" name="GrupoOpciones8" value="0">
Needs Improvement</label>
                              <label>
                                <input name="GrupoOpciones8" type="radio" value="1" checked>
Normal</label>
                              <label>
                                <input type="radio" name="GrupoOpciones8" value="2">
Good</label>
                              <label>
                                <input type="radio" name="GrupoOpciones8" value="3">
Excellent</label><label>
                                <input type="radio" name="GrupoOpciones8" value="4">
  N/A</label></td>
                            </tr>
                            <tr>
                              <td valign="top">&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
							<tr>
                              <td valign="top"><DIV id=result_box dir=ltr><strong> Comments:</strong></DIV>
                              <br />
                              Adult comment's must be in english<br />
                              Children comment's must be in spanish</td>
                              <td><textarea name="txtOtrosComentarios" cols="50" wrap="virtual" id="txtOtrosComentarios" style="WIDTH: 500px" HI onKeyDown="limita(this,450);" onKeyUp="limita(this,450);" maxlength="25"></textarea></td>
                            </tr>
							<tr> 
                              <td valign="top"><b>Material Used:</b><br />
                                In English</td>
                              <td>                                <p>
                                <textarea name="txtMaterialUsado" cols="50" wrap="VIRTUAL" style="WIDTH: 500px" id="txtMaterialUsado" onKeyUp="limita(this,300);" onKeyDown="limita(this,300);"></textarea>
                              </p>                              </td>
                            </tr>
							<tr> 
                              <td valign="top"><p><b>Describe student. What does the student need to work on?  Advise next teacher:<br />
                              </b>In English, children only</p>
                              </td>
                              <td>                                <p>
                                <textarea name="txtNecesitaMejorar" cols="50" wrap="VIRTUAL" style="WIDTH: 500px" id="txtNecesitaMejorar" onKeyUp="limita(this,200);" onKeyDown="limita(this,200);"></textarea>
                              </p>                              </td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr valign="top" bgcolor="#dddddd"> 
                        <td align="right" bgcolor="#B6C5F2">
						   <input type="hidden" name="action" value="Save Report"> 
                          <?php print $strSucess; ?><input name="btn_action" type="button" id="save" class="submit-button" value="Save Report" onclick="ValidaEnviar()"> 
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
<?php include 'includes/foot.php'?>
