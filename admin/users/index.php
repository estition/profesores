<?php include '../../includes/constants.php'?>
<?php include '../../includes/functions.php'?>
<?php include '../../includes/database.php'?>
<?php include '../../includes/authorize.php'?>
<?php include '../../iniRoot.php'?>

<?php
if($is_admin_a) {
function SiNo($str)
  {
  if($str==0)
    return 'No';
  elseif($str==1)
    return 'Si';
  }

if ($_POST['action'] == "Delete") {
	
	foreach ($_POST['delete'] as $id) {
	$sql0 = 'select user_id from userGroup where user_id = ' . $id;
    $result0 = mysqli_query($link, $sql0) or die("Invalid query: " . mysqli_error($link));
	$numfilas = mysqli_num_rows($result0);
	
	if($numfilas == 0){
	
    $sql = 'delete from users where id = ' . $id;
    mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
    $message = "<br>User profile deleted.";}
	else{ $message = "<br>You cannot delete a teacher with one or more client associated; please make sure the teacher does no have any client associated by going to CLIENT_ADMIN option in the left pane menu!!"; }
	}

}


if ($_POST['action'] == "Baja") {

	foreach ($_POST['baja'] as $id) {
	
    $sql = 'update users set baja=1 where id = ' . $id;
    mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
    $message = "<br>Usuario dado de baja.";
	}
}
if ($_POST['action'] == "Alta") {
	foreach ($_POST['alta'] as $id) {
    $sql = 'update users set baja=0 where id = ' . $id;
    mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
    $message = "<br>Usuario dado de alta.";
	}	
}

$filter = "";
switch ($_POST['filter']) {
	  case 2:
	   	$filter = "where is_active = '1' and baja ='0' ";
		break;	
    case 3:
	   	$filter = "where is_active = '0' ";		
      	break;
    case 4:
	   	$filter = "where is_admin = '1' ";		
      	break;
	case 5:
	   	$filter = "where baja ='1' ";		
      	break;	
    default:
    	$filter = "where is_active = '1' and baja ='0' ";
    	break;
}

$sql = "select id, first, is_admin,  metro, spanish_level, country,  mobile, email from users  " . $filter . " order by first";
$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));

$page_name = "user admin";
?>
 <?php require_once('../../includes/top.php');?>
  
 <div style="position: relative;  top: 30px;"  align="center"> 
<script type="text/javascript">

	function enviar_correo(contador){
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
			window.location="envioMassmail.php?identificador="+identificador;
		}
		else {
			alert("Select emails.");
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
      <table width="100%" class="pepe" border="0"  align="center" cellpadding="10" cellspacing="0" id="body">
        <tr> 
          <td width="100%" valign="top"> <p><b>User Admin</b></p>
            <p>This section allows you to modify a teacher's information.  Click on a name to 
              edit, or check a box (or boxes) to delete.</p>
              
              
      <table border="0" cellpadding="5" cellspacing="0" bgcolor="#B6C5F2" id="action">
        <tr> 
          <td><p>Do you want to create a <b>new profile</b> for a <b><a href="profile.php">Teacher</a></b>?</p></td>
        </tr>
      </table>
      <b><font color='#ff9900'><?php echo $message ?></font></b>
            <form name="filter" method="post" action="index.php">
            <p>Filter by: 
              <select name="filter" id="filter" onChange='javascript:document.filter.submit();'>
                <option value="0" <?php echo  ($_POST['filter'] == 0) ? 'selected' : '' ?>>Filter by...</option>
                <option value="0">-----------------------------</option>
                <option value="1" <?php echo  ($_POST['filter'] == 1) ? 'selected' : '' ?>>Show All</option>
                <option value="2" <?php echo  ($_POST['filter'] == 2) ? 'selected' : '' ?>>Show All Active</option>
                <option value="3" <?php echo  ($_POST['filter'] == 3) ? 'selected' : '' ?>>Show All Inactive</option>
                <option value="4" <?php echo  ($_POST['filter'] == 4) ? 'selected' : '' ?>>Website Admins only</option>
                <option value="5" <?php echo  ($_POST['filter'] == 5) ? 'selected' : '' ?>>Show Not Contrated only</option>
              </select>
              </form>
              
      <!--begin dynamic list -->
      <form action="index.php" name="edit_directory" id="edit_directory" method="post">
              <table border="0" cellpadding="1" cellspacing="0" bgcolor="#CCCCCC" id="border">
                <tr> 
                  <td><table border="0" cellpadding="2" cellspacing="0" bgcolor="#FFFFFF" id="listing">
                      <tr>
                      	<td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Name</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Country</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Mobile</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Metro</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
						<td bgcolor="#eeeeee"><font size="-1"><b>Spanish Level</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Delete?</b></font></td>
						<td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><div align="center"><font size="-1"><b>Dar de baja?</b></font></div></td>
						<td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><div align="center"><font size="-1"><b>Dar de alta?</b></font></div></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><div align="center"><font size="-1"><b>Send Email?</b></font></div></td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                      </tr>
                      <tr>
                      
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                      
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                                     <td bgcolor="#eeeeee">&nbsp;</td>
                       
                      </tr>
                 
<?php
$contador=1;
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	$type = "Teacher";
	$edit_page = "profile.php";
	if ($row["is_active"]) {
		$type = "Active Teacher";
	} else {
		$type = "Inactive Teacher";
	}
	
	if ($row["is_admin"]) {
		$type = "Administrator";
	}

	if ($bg == "#FFFFFF") {
		$bg = "#B6C5F2";
	} else {
		$bg = "#FFFFFF";
	}
	
	
	print "<tr>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	if($row["baja"]=='1') {
	print "<td bgcolor='" . $bg ."'><a href='" . $edit_page . "?id=" . $row["id"] . "'>" .  $row["first"] ."</a></td>";
	}
	else
	{
	print "<td bgcolor='" . $bg ."'><a href='" . $edit_page . "?id=" . $row["id"] . "'><strong>".  $row["first"] . "</strong></a></td>";
	}
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	
	print "<td bgcolor='" . $bg ."'><i>" . $row['country'] . "</i></td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td bgcolor='" . $bg ."'><i>" . $row['mobile'] . "</i></td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td bgcolor='" . $bg ."'><i>" . $row['metro'] . "</i></td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td bgcolor='" . $bg ."'><i>" . $row["spanish_level"] . "</i></td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td bgcolor='" . $bg ."'> <div align='center'> </strong> <input name='delete[]' type='checkbox' id='delete' value='" . $row["id"] . "'> </div> </td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td bgcolor='" . $bg ."'> <div align='center'> <input name='baja[]' type='checkbox' id='baja' value='" . $row["id"] . "'> </div> </td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td bgcolor='" . $bg ."'> <div align='center'> <input name='alta[]' type='checkbox' id='alta' value='" . $row["id"] . "'> </div> </td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	
	if ( ($row['email']!="") && ($row['baja']==0) ) {	
						echo "<td bgcolor='" . $bg ."' style=\"text-align:center\"><input type=\"checkbox\" name=\"reportSelection".$contador."\" id=\"reportSelection".$contador."\" value=\"".$row["id"]."\" /> </td>";	
					} else {
						echo "<td bgcolor='" . $bg ."' style=\"text-align:center\"><input type=\"checkbox\" name=\"reportSelection".$contador."\" id=\"reportSelection".$contador."\" value=\"".$row["id"]."\" disabled=\"true\" /> </td>";	
					}
	
	
	
	

	print "</tr>";
	$contador++;
}
            
?> 
                      <tr> 
                       <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee"></td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee"></td>
                        <td bgcolor="#eeeeee"></td>
                        <td bgcolor="#eeeeee"></td>
                        <td bgcolor="#eeeeee"></td>
                        <td bgcolor="#eeeeee"></td>
                        <td bgcolor="#eeeeee"></td>
                        <td bgcolor="#eeeeee"></td>
                        <td bgcolor="#eeeeee"></td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                      <td bgcolor="#eeeeee">&nbsp;</td>
                       </tr>
                      <tr>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td colspan="20" bgcolor="#eeeeee">
                        
                        <table width="313" border="0" align="center">
  <tr>
    <td width="40"><div align="center">
						    <input name="action" type="submit" id="alta" value="Alta">
					    </div></td>
    <td width="42"><div align="center">
						    <input name="action" type="submit" id="action" value="Baja" />
					    </div></td>
    <td width="57"><div align="center">
  <input name="action" type="submit" id="action" value="Delete">
                        </div></td>
    <td width="52"><div align="center">
                           <input type="button" name="Emails" id="Emails" value="Emails" onClick="enviar_correo(<?php echo "'".$contador."'"; ?>)" />
				</div></td><td width="100">
                <div align="center"> <p>Select all E-mails</p>
                         
                            <input type="checkbox" name="allReports" id="allReports" onclick="checkAll(<?php echo $contador; ?>);" />
                         </div></td>
                
  </tr>
</table>     
                          
                             </td>
                     
                      </tr>
                      <tr>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                      <td colspan="5" bgcolor="#eeeeee"></td>
                       <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>   
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                       
                                        </tr>
                  </table></td>
                </tr>
              </table>
              <!--end dynamic list -->
            </form>
           
    </td>
        </tr>
      </table></td>
  </tr>
</table>
 
      

<?php include 'includes/foot.php' ?>
<?php } else { echo "NOT AUTHORIZED TO SEE THIS PAGE, PLEASE RETURN BACK"; }?>