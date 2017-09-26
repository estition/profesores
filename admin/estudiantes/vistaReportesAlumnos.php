<?php
	/*  Student Reports, version 1.0
		Author: ISC. Gerardo Cata�o
		Date: July 2009  */
?>
<?php include '../../includes/constants.php'?>
<?php include '../../includes/database.php'?>
<?php include '../../includes/authorize.php'?>
<?php include 'includes/globalFunctions.php'?>


<?php

$message = "";
$user_id = $_COOKIE["user_id"];
$id = DameIdUsers($user_id);
$mode = "Created by ". $first;

if ( $id!="" ) {
	$sql = "select * from informes_alumnos2 where idusuario = ".$id. " order by ANO_INFORME DESC, MES_INFORME DESC, DIA_INFORME DESC";
	//print $sql;	
	$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
}

?>
<?php include '../../includes/top.php'?>

<div style="position: relative;" align="right">  
</div>
<script type="text/javascript">
	
</script>
 <p align="center"><b>Student reports &#8211; <?php echo  $mode ?> &#8211; <font color='#ff9900'><?php echo  $message; ?></font></b></p>

  
  

       <table border="0" class="pepe3" cellpadding="5" align="center" bgcolor="#ccc" cellspacing="0" id="login"><tr><td><!-- tabla ext. results -->
      
    
        
        
        <tr valign="top"> 
            <td bgcolor="#ccc"><font>Reports</font></td>
            <td bgcolor="#ccc">
            <table border="0" cellpadding="5" cellspacing="0">
        	
            <?php
			if (mysql_num_rows($result)==0)
				echo "<tr><td><b>There are no student reports already created.</b></td></tr>";
			else {	
            ?>
		      	<tr>
                    <td width="2%">&nbsp;</td><td width="8%"><b>Date</b></td><td width="5%"><b>Report status</b></td><td width="10%"><b>Teacher</b></td><td width="20%"><b>Client</b></td><td width="15%"><b>Student</b></td><td width="5%"><b>Type</b></td><td width="15%"><b>Link</b></td><td width="15%"><b>Edit link</b></td>
		      	</tr>     
       			<?php
				$contador=1;
           		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {					
					echo "<tr>";
					echo "<td>".$contador.". </td>";					
					echo "<td>".addZero($row['DIA_INFORME'])."/".addZero($row['MES_INFORME'])."/".$row['ANO_INFORME']."</td>";
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
					echo "<td>".obtenNombreProfesor($row['IDUSUARIO'])."</td>";
					echo "<td>".obtenNombreCliente($row['IDCLIENTE'])."</td>";
					echo "<td>".$row['ALUMNO']."</td>";					
					if ($row['IDTIPO_INFORME']==0) {
						echo "<td>Adult</td>";
						if ($row['status']==1)
							echo "<td><a href=\"reporteAlumnoAdultoPDF.php?id=".$row['ID']."\" target=\"_blank\">See the report here</a></td>";
						else
							echo "<td>&nbsp;</td>";
					} else {
						echo "<td>Child</td>";
						if ($row['status']==1)
							echo "<td><a href=\"reporteAlumnoNinoPDF.php?id=".$row['ID']."\" target=\"_blank\">See the report here</a></td>";					
						else
							echo "<td>&nbsp;</td>";
					}
					if ( ($row['status']!=1) || ($is_admin_a) ) {
						echo "<td><a href=\"gestionReporteAlumno.php?id=".$row['ID']."\">Edit the report here</a></td>";
					} else {
						echo "<td>&nbsp;</td>";
					}
					echo "</tr>";
					$contador++;
				}				
				?>
        	<?php	} //else?>
        	</table>
            </td>
      	</tr>
        
        
        <tr valign="top"> 
        	<td colspan="6" bgcolor="#ccc">&nbsp; </td>
        </tr>
        <tr valign="top" bgcolor="#dddddd">
            <td colspan="6" align="center">        		
                <input name="addStudentReport" id="addStudentReport" type="button" value="Add new student report" onclick="javascript:location.href='gestionReporteAlumno.php';" />
                <input name="back" id="back" type="button" value="Back to search" onclick="javascript:location.href='busquedaReporteAlumno.php';" /> <br /><br />
                <span style="text-align:center"><a href="http://www.canterburyenglish.com/profesores/admin/estudiantes/recursos/SR-teacher_guide.pdf" target="_blank">View the student reports teacher's guide</a></span>
            </td>
        

   
      
      <?php //busqueda
	  //}
	  ?>
      <br /><br />
            	
            <td></td></tr>
      	</table>    
      <br /><br /><br /><br /><br />
      
       </div>  
       
      <!--</td>
  </tr>
</table>-->
<?php include 'includes/foot.php'?>
