<?php
	/*  Strudent Reports, version 1.0
		Author: ISC. Gerardo Cata�o
		Date: July 2009 */
?>
<?php include '../../includes/constants.php'?>
<?php include '../../includes/database.php'?>
<?php include '../../includes/authorize.php'?>
<?php include 'includes/globalFunctions.php'?>

<?php

$user_id = $_COOKIE["user_id"];
$message = "";
$cb_teacher = $_REQUEST["cb_teacher"];
$cb_client = $_REQUEST["cb_client"];
$cb_student = $_REQUEST["cb_student"];
$cb_date = $_REQUEST["cb_date"];
$teacher = $_POST["teacher"];
$client = $_POST["client"];
$student = $_POST["student"];
$m1 = (int)$_POST["m1"];
$m2 = (int)$_POST["m2"];
$y1 = (int)$_POST["y1"];
if ($m1 == 0) $m1 = date("m");
if ($m2 == 0) $m2 = 12;
if ($m1 > $m2) $m1 = 1;
if ( ($y1 < 2000) || ($y1 > date("Y")+1) ) $y1 = date("Y");


$mode = "Searching student reports";

if ( (($cb_teacher)||($cb_client)||($cb_student)||($cb_date)) && (($message == "Searching student reports") || ($message == ""))) {


		$sql = "select * from informes_alumnos2 where ";
	
	if ($cb_teacher) $sql .= " IDUSUARIO = " . $teacher . " ";
	if ( ($cb_teacher) && ($cb_client) ) $sql .= " and ";
	if ($cb_client) $sql .= " IDCLIENTE = " . $client . " ";
	if ( (($cb_teacher) || ($cb_client)) && ($cb_student) ) $sql .= " and ";
	if ($cb_student) $sql .= " ALUMNO like '%" . addslashes($student) . "%' ";
	if ( (($cb_teacher) || ($cb_client) || ($cb_student)) && ($cb_date) ) $sql .= " and ";
	//if ($cb_date) $sql .= " A�O_INFORME >= " . $y1 . " and A�O_INFORME <= " . $y2 . " and ";
	if ($cb_date) $sql .= " ANO_INFORME = " . $y1 . " and ";
	if ($cb_date) $sql .= " MES_INFORME >= " . $m1 . " and MES_INFORME <= " . $m2 . " "; //and ";
	//if ($cb_date) $sql .= " DIA_INFORME >= " . $d1 . " and DIA_INFORME <= " . $d2 . " ";		
	
	$sql .= " order by ANO_INFORME DESC, MES_INFORME DESC, DIA_INFORME DESC;";
	
	//print $sql;
	$result = mysqli_query($link, $sql, $link) or die("Invalid query: " . mysqli_error($link));	

} 
/*
else {
	$sql = "select * from informes_alumnos2 where idusuario = 1 order by A�O_INFORME DESC, MES_INFORME DESC, DIA_INFORME DESC";
	//print $sql;	
	$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
}
*/

////////////////////////////////////////////////////////////////////////////////////////////////////////
$sqlTeachers = "select id, first from users where id!=1 order by first asc; ";
$resultTeachers = mysqli_query($link, $sqlTeachers) or die("Invalid query: " . mysqli_error($link));
$teachersOptions="";
while ($rowTeachers = mysqli_fetch_array($resultTeachers, MYSQLI_ASSOC)) {
	if ($teacher == $rowTeachers['id']) {
		$selected = "selected=\"selected\"";
	} else {
		$selected = "";
	}
	$teachersOptions .= "\n<option " . $selected . " value=\"" . $rowTeachers['id'] . "\">" . $rowTeachers['first'] . "</option>";
}

$sqlClients = "select a.end, b.id, a.name, class_type, length, a.id as ident from groups a, userGroup b where a.id = b.group_id group by name; ";
$resultClients = mysqli_query($link, $sqlClients) or die("Invalid query: " . mysqli_error($link));
$clientsOptions="";
while ($rowClients = mysqli_fetch_array($resultClients, MYSQLI_ASSOC)) {
	if ($client == $rowClients['ident']) {
		$selected = "selected=\"selected\"";
	} else {
		$selected = "";
	}
	$clientsOptions .= "\n<option " . $selected . " value=\"" . $rowClients['ident'] . "\">" . $rowClients['name'] . " - " . $rowClients['end'] . "</option>";
}
////////////////////////////////////////////////////////////////////////////////////////////////////////

?>

<?php include '../../includes/top.php'?>

<div style="position: relative;" align="right">  
</div>  
<?php 
function validaEmail($email) {
if ( filter_var($email, FILTER_VALIDATE_EMAIL) ) {
	 return true;
} else {
	 return false;
}
}
  //validador de email
function validaEmail1($email) {
    // First, we check that there's one @ symbol, and that the lengths are right
    if (!preg_match("/^[^@]{1,64}@[^@]{1,255}$/", $email)) {
        // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
        return false;
    }
    // Split it into sections to make life easier
    $email_array = explode("@", $email);
    $local_array = explode(".", $email_array[0]);
    for ($i = 0; $i < sizeof($local_array); $i++) {
         if (!preg_match("/^(([A-Za-z0-9!#$%&'*+\/=?^_`{|}~-][A-Za-z0-9!#$%&'*+\/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$/", $local_array[$i])) {
            return false;
        }
    }    
    if (!preg_match("/^\[?[0-9\.]+\]?$/", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
        $domain_array = explode(".", $email_array[1]);
        if (sizeof($domain_array) < 2) {
                return false; // Not enough parts to domain
        }
        for ($i = 0; $i < sizeof($domain_array); $i++) {
            if (!preg_match("/^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$/", $domain_array[$i])) {
                return false;
            }
        }
    }
    return true;
}

?>

<script type="text/javascript">

	function searchValue(){
		if (document.getElementById("cb_teacher").checked==true) document.getElementById("cb_teacher").value = 1;
		if (document.getElementById("cb_client").checked==true) document.getElementById("cb_client").value = 1;
		if (document.getElementById("cb_student").checked==true) document.getElementById("cb_student").value = 1;
		if (document.getElementById("cb_date").checked==true) document.getElementById("cb_date").value = 1;
	}	
	
	function enviar_correo(contador, direccionar){
		//var correos="";
		var id;
		var bandId=false;
		for (i=1; i<contador; i++){
			id="reportSelection"+i;
			if (document.getElementById(id).checked==true){		
				//correos+=","+id;
				var identificador=identificador+","+document.getElementById(id).value;
				bandId=true;	
			}	
		}
		if (bandId==true) {
			identificador=identificador.substr(1);
		}
		if ( (direccionar=="reporte") && (bandId==true) ) {
			window.location="envioReportesAlumnos.php?identificador="+identificador;
		} else
		if ( (direccionar=="diploma") && (bandId==true) ) {
			window.location="envioDiplomasAlumnos.php?identificador="+identificador;	
		} else {
			alert("Select student report(s).");
		}
	}
	
	function checkAll(contador){
		if (document.getElementById("allReports").checked == true){
			for (i=1; i<contador; i++){		
				id="reportSelection"+i;
				if (document.getElementById(id).disabled==false)
					document.getElementById(id).checked=true;
			}		
		} else {
			for (i=1; i<contador; i++){		
				id="reportSelection"+i;
				document.getElementById(id).checked=false;
			}
		}		
	}
	
</script>
 <p align="center"><b>Student reports &#8211; <?php echo  $mode ?> &#8211; <font color='#ff9900'><?php echo  $message; ?></font></b></p>

            <form name="associate" id="associate" method="post">
            	<input type="hidden" name="id" value="<?php echo $id;?>">
              
              
                  <table border="0" class="pepe3" cellpadding="5" align="center" bgcolor="#ccc" cellspacing="0" id="login">
                  		<?php
							function filterCheckBox($x){
								echo " value=\"".$x."\" ";
								if ($x==1) echo " checked=\"checked\"" ;
							}						
						?>
                      <tr>
                       	<td><input id="cb_teacher" name="cb_teacher" type="checkbox" <?php filterCheckBox($cb_teacher);?> /></td>                      
                        <td><b>Teacher:</b></td>
                        <td>
                        <select id="teacher" name="teacher">
                        	<?php echo  $teachersOptions; ?>
                        </select>
                        </td>                        
                      </tr> 
                      <tr>
                       	<td><input id="cb_client" name="cb_client" type="checkbox" <?php filterCheckBox($cb_client);?> /></td>                      
                        <td><b>Client:</b></td>
                        <td>
                        <select id="client" name="client">
                        	<?php echo  $clientsOptions; ?>
                        </select>
                        </td>                        
                      </tr> 
                     <tr>
                       	<td><input id="cb_student" name="cb_student" type="checkbox" <?php filterCheckBox($cb_student);?> /></td>                     
                        <td><b>Student:</b></td>
                        <td><input id="student" name="student" type="text" maxlength="75" size="50" value="<?php echo $student; ?>"></td>
                     </tr>
                     
                     <tr>
                       	<td><input id="cb_date" name="cb_date" type="checkbox" <?php filterCheckBox($cb_date);?> /></td>                     
                        <td><b>Date:</b><br /></td>
                        <td>                        	
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Months:&nbsp;
                            <?php
								$mesesIngles=array("", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
								echo "<select name=\"m1\" id=\"m1\"> ";
								for($i=1;$i<=12;$i++){
									echo "<option value=\"".$i."\" ";
									if ((int)$m1==$i) echo "selected=\"selected\" ";
									echo ">".$mesesIngles[$i]."</option>";
								}
								echo "</select>";
							?>                            
                            &nbsp; to &nbsp;
                            <?php								
								echo "<select name=\"m2\" id=\"m2\"> ";
								for($i=1;$i<=12;$i++){
									echo "<option value=\"".$i."\" ";
									if ((int)$m2==$i) echo "selected=\"selected\" ";
									echo ">".$mesesIngles[$i]."</option>";
								}
								echo "</select>";
							?>                            
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Year: &nbsp;
                            <input id="y1" name="y1" type="text" maxlength="4" size="4" value="<?php if ($y1!="") echo $y1; else echo date("Y"); ?>" />
                        </td>
                     </tr>                 
                                          
				
               
                <tr valign="top" bgcolor="#dddddd">
                  <td colspan="5" align="center">
                  	<?php if ($is_admin_a) { ?>                                      
                  		<input name="addStudentReport" id="addStudentReport" type="button" value="Add new student report" onclick="javascript:location.href='gestionReporteAlumno.php';" />
                    <?php } else {?>
                    <input name="back" id="back" type="button" value="Back to reports" onclick="javascript:location.href='vistaReportesAlumnos.php';" />
                    <?php } ?>
                    <input name="action" type="submit" id="action" value="Search" onclick="searchValue();" />
              
            </form>            
            <!--end dynamic content -->
            </td>
        </tr>
	      

      <br /><br />
      <table align="center">
        	<?php if ($is_admin_a) { ?>
      		<tr><td><span style="text-align:center"><a href="http://www.canterburyenglish.com/profesores/admin/estudiantes/recursos/SR-administrator_guide.pdf" target="_blank">View the student reports administrator's guide</a></span></td></tr>
            <?php } ?>
            <tr><td><span style="text-align:center"><a href="http://www.canterburyenglish.com/profesores/admin/estudiantes/recursos/SR-teacher_guide.pdf" target="_blank">View the student reports teacher's guide</a></span></td></tr>
      	</table>
      <br /><br />
      
      <?php  //busqueda
      if ( (($cb_teacher)||($cb_client)||($cb_student)||($cb_date)) && (($message == "Searching student reports") || ($message == ""))) { $pepe3 ="pepe3";
	  ?>

	<form name="selection" id="selection" method="post">

   
      <?php if ($is_admin_a) { ?> 
     <table border="0" class="pepe3" cellpadding="5" align="center" bgcolor="#ccc" cellspacing="0" id="login"><!-- tabla int. results -->
      <?php } else { ?>
      <table border="0" class="pepe3" cellpadding="5" align="center" bgcolor="#ccc" cellspacing="0" id="login"><!-- tabla int. results -->
      <?php } ?>
      	
      
          
        	
            <?php				
			if (mysql_num_rows($result)==0)
				echo "<tr><td><b>There are no results for this search.</b></td></tr>";
			else {
            ?>
		      	<tr>
                    <td width="2%">&nbsp;</td><td width="8%"><b>Date</b></td>
					<?php if ($is_admin_a) { ?><td width="5%"><b>Report status</b></td><?php } ?>
                    <td width="10%"><b>Teacher</b></td><td width="20%"><b>Client</b></td><td width="15%"><b>Student</b></td><td width="4%"><b>Type</b></td><td width="18%"><b>Link</b></td>
                    <?php if ($is_admin_a) { ?><td width="15%"><b>Edit link</b></td><?php } ?>
		      	</tr>     
       			
                <?php
				$contador=1;
				$cont=1;
           		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {					
					echo "<tr>";
					echo "<td>".$contador.". </td>";					
					echo "<td>".addZero($row['DIA_INFORME'])."/".addZero($row['MES_INFORME'])."/".$row['ANO_INFORME']."</td>";
					if ($is_admin_a) {
						switch ($row['status']) {
						case 0:
							echo "<td style=\"text-align:center;color:#FFA500\">Sent (Waiting for administrator's review)</td>";
							break;
						case 1:
							echo "<td style=\"text-align:center;color:green\">Accepted</td>";
							break;
						case 2:
							echo "<td><span style='text-align:center;color:red;text-decoration:underline;cursor:pointer' onclick=' alert(\"".$row['adminComments']."\");'>Wrong (Please correct)</span></td>";						
							break;											
						}
					}
					echo "<td>".obtenNombreProfesor($row['IDUSUARIO'])."</td>";
					echo "<td>".obtenNombreCliente($row['IDCLIENTE'])."</td>";
					echo "<td>".$row['ALUMNO']."</td>";					
					if ($row['IDTIPO_INFORME']==0) {
						echo "<td>Adult</td>";
						if ($row['status']==1) {
							echo "<td><a href=\"reporteAlumnoAdultoPDF.php?id=".$row['ID']."\" target=\"_blank\">See the report here</a>";
							if ($is_admin_a)
								
								echo "<br /><a href=\"diplomaAlumnoPDF.php?id=".$row['ID']."&client_id1=".$row['IDCLIENTE']."\" target=\"_blank\">See the diploma here</a>";
							  
							echo "</td>";
						} else
							echo "<td>&nbsp;</td>";
					} else {
						echo "<td>Child</td>";
						if ($row['status']==1) {
							echo "<td><a href=\"reporteAlumnoNinoPDF.php?id=".$row['ID']."\" target=\"_blank\">See the report here</a>";
							if ($is_admin_a)
						
								echo "<br /><a href=\"diplomaAlumnoPDF.php?id=".$row['ID']."&client_id1=".$row['IDCLIENTE']."\" target=\"_blank\">See the diploma here</a>"; 
							 
							echo "</td>";
						} else
							echo "<td>&nbsp;</td>";
					}				
				
					if ($is_admin_a) {
						echo "<td><a href=\"gestionReporteAlumno.php?id=".$row['ID']."\">Edit the report here</a></td>";
					} /*else {
						echo "<td>&nbsp;</td>";
					}*/
					
					if ($is_admin_a) {					
///////////////////////////////////					
					if ( (validaEmail($row['email'])) && ($row['status']==1) ) {
					    $cont++;	
						echo "<td style=\"text-align:center\"><input type=\"checkbox\" name=\"reportSelection".$contador."\" id=\"reportSelection".$contador."\" value=\"".$row['ID']."\" /> </td>";	
						
					} else {
						echo "<td style=\"text-align:center\"><input type=\"checkbox\" name=\"reportSelection".$contador."\" id=\"reportSelection".$contador."\" value=\"".$row['ID']."\" disabled=\"true\" /> </td>";	
					}
///////////////////////////////////
					}
					
					echo "</tr>\n";
					$contador++;
					
				}				
				?>
                
                
                
        	<?php	} //else?>
        	
        <tr valign="top"> 
        	<td colspan="12" bgcolor="#eeeeee" align="right">
            	<?php if ($is_admin_a) { echo "Emails ready to be sended: ".$cont; ?> 
               
     <input type="checkbox" name="allReports" id="allReports" onclick="checkAll(<?php echo $contador; ?>);" />
                <?php } ?>
                &nbsp;
            </td>
        </tr>
        <tr valign="top" bgcolor="#dddddd">
            <td colspan="12" align="center">
            	<?php if ($is_admin_a) { ?>       		
                <input type="button" name="mail_send" id="mail_send" value="Send student report(s)" onClick="enviar_correo(<?php echo "'".$contador."'"; ?>,'reporte')" />
                <input type="button" name="mail_send" id="mail_send" value="Send diploma(s)" onClick="enviar_correo(<?php echo "'".$contador."'"; ?>,'diploma')" />
                <?php } else echo "<br />"; ?>
            </td>
        </tr>

     
      
      </td></tr></table><!-- tabla ext. results -->
     
      </form>
      
      <?php //busqueda
	  }
	  ?>      
      <br /><br /><br />
      <!--</td>
  </tr>
</table>-->  </div>