<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<script type="text/javascript">



	function enviar_correo(contador){
		//var correos="";
		var id;
		var bandId=false;
		for (i=0; i<contador; i++){
			id="reportSelection"+i;
			if (document.getElementById(id).checked==true){		
				//correos+=","+id;
				var identificador=identificador+","+document.getElementById(id).value;
				bandId=true;	
			}	
		}
		if (bandId==true) {
			identificador=identificador.substr(10);
			window.location="envioMassmail.php?identificador="+identificador;
		}
		else {
			alert("Select emails.");
		}
	}

	function sendEmails(contador){
	
 
if (typeof contador !== 'undefined' && contador !== null) {
	
	window.location="envioMassmail.php?identificador="+contador;

		
		} else  {
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

<?php include '../../includes/constants.php'?>
<?php include '../../includes/functions.php'?>
<?php include '../../includes/database.php'?>
<?php include '../../includes/authorize.php'?>
<?php 
$message = "";
if($is_admin_a){
    if(isset($_POST['filter']))
        $filtro = $_POST['filter'];
    else
         $filtro = "";

 
  //validador de email
function validaEmail($email) {
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


<?php
if(isset($_POST['action']))
    $action = $_POST['action'];
else
    $action = false;
if ($action == "Delete") {
$comp = true;
if (count($_POST['delete']) == 0) {$message = "Must check the client first.";}
elseif (count($_POST['delete']) != 0){
$comp = false;
	foreach ($_POST['delete'] as $id) {

   		$sql = 'delete from groups where id = ' . $id;
   		mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
   		$sql = 'delete from clients where group_id = ' . $id;
   		mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
		 $message = "Client/Group profile deleted.";
		 

   
	}
	
	}
	//Company
	
	if ((count($_POST['delete1']) == 0) && ($com)) {$message = "Must check the Company first.";}
elseif (count($_POST['delete1']) != 0){

	foreach ($_POST['delete1'] as $id) {

   		$sql = 'delete from companies where id = ' . $id;
   		mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
   		$sql = "update groups set old_id = 0 where old_id = " . $id;
   		 mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
		 $message = "Company profile deleted.";
	
   
	}
	}
	
}

if ($action == "Baja") {
$comp1 = true;
if (count($_POST['baja']) == 0) {$message = "Must check the client first.";}
else{
$comp1 = false;
	foreach ($_POST['baja'] as $id) {
	
	$opciones = explode(',',$id);
	
	
	$yy =  substr($opciones[1], 0, -6);
	$mm =  substr($opciones[1], 5, 2);
	$dd =  substr($opciones[1], 8, 2);
	
	$fecha_final = $yy.$mm.$dd;
	
	
		if ($fecha_final < date('Y').date('m').date('d')){
	
	
	
   		
   		 $sql = "update groups set active = 0, baja = 1 where id = " . $opciones[0];
   		 mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
		 $message = "Group profile inactive.";
		 
		}
		
	

	}
  }
  //company
  
  
if ((count($_POST['baja1']) == 0) && ($com1)) {$message = "Must check the company first.";}
else{

	foreach ($_POST['baja1'] as $id) {
	
	$opciones = explode(',',$id);
	
	
	$yy =  substr($opciones[1], 0, -6);
	$mm =  substr($opciones[1], 5, 2);
	$dd =  substr($opciones[1], 8, 2);
	
	$fecha_final = $yy.$mm.$dd;
	
	
		if ($fecha_final < date('Y').date('m').date('d')){
	
	
	
   		
   		 $sql = "update companies set active = 0, baja = 1 where id = " . $opciones[0];
   		 mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
		 $sql = 'update groups set active = 0, baja = 1 where old_id = ' . $opciones[0];
   		 mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
		 //$message = "<br>Client/Group profile sent to historical.";
		 $message = "Company profile inactive.";
		}
		
	

	}
  }
}


///////////////////////


 
if ($action == "Historico") {

$comp2= true;
if (count($_POST['historical']) == 0) {$message = "Must check the client first.";}
else{
$comp2= false;
	foreach ($_POST['historical'] as $id) {
	
	$opciones = explode(',',$id);
	
	
	$yy =  substr($opciones[1], 0, -6);
	$mm =  substr($opciones[1], 5, 2);
	$dd =  substr($opciones[1], 8, 2);
	
	$fecha_final = $yy.$mm.$dd;
	
	
		if ($fecha_final < date('Y').date('m').date('d')){
	
	
	
   		$sql = 'update groups set historical=1 where id = ' . $opciones[0];
   		mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
   		$sql = 'update clients set historical=1 where group_id = ' . $opciones[0];
   		mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
		 $message = "Client/Group profile sent to historical.";
		}
	   
	}
  }
  
  //company
  
  

if ((count($_POST['historical1']) == 0) && ($com2)) {$message = "Must check the company first.";}
else{

	foreach ($_POST['historical1'] as $id) {
	
	$opciones = explode(',',$id);
	
	
	$yy =  substr($opciones[1], 0, -6);
	$mm =  substr($opciones[1], 5, 2);
	$dd =  substr($opciones[1], 8, 2);
	
	$fecha_final = $yy.$mm.$dd;
	
	
		if ($fecha_final < date('Y').date('m').date('d')){
	
	
	
   		$sql = 'update companies set historical=1 where id = ' . $opciones[0];
   		mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
   		$sql = 'update groups set historical=1 where old_id = ' . $opciones[0];
   		mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
		 $message = "Company profile sent to historical.";
		}
	   
	}
  }
}
  

if ($action == "Alta") {

if (count($_POST['alta']) == 0) {$message = "Must check the client first.";}
else{
	
   $comp = true;
	foreach ($_POST['alta'] as $id) {
	
	
	  $sql = 'update groups set baja=0, historical = 0, active = 0 where id = ' . $id;
   		mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
   		$sql = 'update clients set baja=0, historical = 0, active = 0 where old_id = ' . $id;
   		mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
		 $message = "Group profile active.";
		 $comp = false;
		}
		
	
	
	
  }
  
  //company
  if($comp ){
  if (count($_POST['alta1']) == 0) {$message = "Must check the company first.";}
else{

	foreach ($_POST['alta1'] as $id) {
	
	
   		$sql = 'update companies set baja=0, historical = 0, active = 0 where id = ' . $id;
   		mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
   		$sql = 'update groups set baja=0, historical = 0, active = 0 where old_id = ' . $id;
   		mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
		 $message = "Group profile active.";
		}
		
	
}
	
  }
}


if ($filtro != "") {
	switch ($filtro) { 
			case 0:
			$sql = "select a.id, c.id, c.name,  first, a.start, c.telephone1, c.mobile, c.email, c.days,c.fecha_inicio,c.endtime,  a.length, (select count(id) from clients d where group_id = c.id) as num from usergroup a, users b, groups c where  a.user_id = b.id and  a.group_id = c.id and (a.end is null or a.end > '".date('Y')."-".date('m')."-".date('d')."') and c.active = 1 and c.baja = '0' and c.historical = '0' group by c.name order by c.name limit 500";
			break;
			case 1:		//assigned			
$sql = "select a.id, c.id, c.name, first, a.start, c.telephone1, c.mobile, c.email, c.days,c.fecha_inicio,c.endtime,  a.length, (select count(id) from clients d where group_id = c.id) as num from usergroup a, users b, groups c where  a.user_id = b.id and  a.group_id = c.id and (a.end is null or a.end > '".date('Y')."-".date('m')."-".date('d')."') and c.baja = '0' and c.historical = '0' group by c.name order by c.name limit 500";


			break;
		    case 2: //no assigned
		  
			  
		$sql = "select	a.id, a.name, a.telephone1, a.mobile, a.email, '' as end, a.returndate, (select count(d.id) from clients d where group_id = a.id) as num 
from
(
	SELECT a.id, a.name, a.telephone1, a.mobile, a.email,  a.returndate, (select count(d.id) from clients d where group_id = a.id) as num FROM groups a WHERE  a.baja= '0' and a.id NOT IN (SELECT b.group_id FROM usergroup b) or ESTADO_CLIENTE = 'No asignado'
		group by a.id

	union all

	SELECT a.id, a.name, a.telephone1, a.mobile, a.email,  a.returndate, (select count(d.id) from clients d where group_id = b.id) as num FROM groups a, usergroup b where b.group_id = a.id and a.baja= '0' and a.active = '0' and a.historical = '0' GROUP BY a.id
) as a GROUP BY a.id
order by name";
		  
		  
		 /* $sql = "(SELECT a.id, a.name, a.telephone1, a.mobile, a.email, a.group_type, (select count(d.id) from clients d where group_id = a.id) as num FROM groups a WHERE  a.baja= '0' and a.id NOT IN (SELECT group_id FROM userGroup)) union ";
		  $sql .= " (SELECT a.id, a.name, a.telephone1, a.mobile, a.email, a.group_type, (select count(d.id) from clients d where group_id = b.id) as num FROM groups a, userGroup b where b.group_id = a.id and a.baja= '0' and a.active = '0' and a.historical = '0') GROUP BY a.id order by name";*/
		
		  // se cambio active a 1 para que aparezca clientes no asignados en activos el 23/12/2010.
		  			
	      break; 
		  
		  case 3: //company
		  
	
		  
		  $sql = "select a.id, c.id, c.name, first, c.telephone1, c.mobile, c.email, c.days,	c.fecha_inicio,c.endtime,  a.start, a.length, (select count(id) from clients d where group_id = c.id) as num from usergroup a, users b, groups c  where  c.enterprise = '1' and a.user_id = b.id and  group_id = c.id and c.baja = '0' and c.historical = '0' and (a.end is null or a.end > '".date('Y')."-".date('m')."-".date('d')."') order by name";
		  
		  				
	      break;
	    case 4: //baja
		
		
		
		$sql = "(select c.id, c.returndate, c.name, c.telephone1, c.mobile, c.email, c.days, c.fecha_inicio, c.endtime,  (select count(id) from clients d where group_id = id) as num from groups c where c.baja = '1' and c.active = '0') union all  (
SELECT c.id, c.returndate, c.name, c.telephone1, c.mobile, c.email, 
c.days,c.fecha_inicio, a.end,  (select count(id) from clients d where group_id = c.id) as num 
FROM usergroup a LEFT JOIN groups c
ON a.group_id = c.id  
INNER JOIN (SELECT MAX(id) AS id FROM usergroup GROUP BY group_id) b
ON (a.id = b.id and a.end is not null and a.end <= '".date('Y')."-".date('m')."-".date('d')."' and c.baja = '0' and c.active = '1')) order by name";
		 
		
		break;
	    case 5://historical
				  $sql = "select a.id, a.name, a.start, a.telephone1, a.mobile, a.email, a.days,	a.fecha_inicio,a.endtime, a.returndate,  (select count(id) from clients b where group_id = a.id) as num from groups a where a.historical = '1' order by name";
				
	      break;
		  case 6:	
		  
		    $sql = "select c.id, c.nombre, c.telefono, c.movil, c.email, c.cif,	c.metro, (select count(id) from groups where old_id = c.id) as num from companies c  where c.baja = '0' and c.historical = '0' and c.active = '1' order by nombre";	
	   
		 }
} else {
$sql = "select a.id, c.id, c.name, first,  a.start, a.end, c.telephone1, c.mobile, c.email, c.days,c.fecha_inicio,c.endtime,  a.length, (select count(id) from clients d where group_id = c.id) as num from usergroup a, users b, groups c where  a.user_id = b.id and  a.group_id = c.id and (a.end is null or a.end > '".date('Y')."-".date('m')."-".date('d')."') and c.baja = '0' and c.historical = '0'  GROUP BY c.name order by c.name limit 500";
	
}

//print $sql;
$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));

global $numRows; 
global $contador; 
$numRows = mysqli_num_rows($result);

$page_name = "client admin";
?>

<?php include '../../includes/top.php'?>
 <p align="center"><b> <font color='#ff9900'><?php echo  $message; ?></font></b></p>

          </div>
          
      <table class="pepe" width="1170" border="0" align="right" cellpadding="10" cellspacing="0">
        <tr> 
          <td width="100%" valign="top"> <p><b>Canterbury Client Profiles</b></p>
            <p>This section allows you to modify a client or a client group's information.  Click on a name to 
              edit, or check a box (or boxes) to delete.</p>
              
              
      <table border="0" width="1170" cellpadding="5" cellspacing="0" bgcolor="#B6C5F2" id="action">
        <tr> 
          <td> <?php if ($filtro == 6){ ?>
 <p>Do you want to create a <b>New profile</b> for a <b><a href="company_profile.php">Company</a></b>?</p> <?php } else { ?> <p>Do you want to create a <b>New profile</b> for a <b><a href="group_profile.php">Individual Clients/Group</a></b>?</p>
 <?php } ?> </td>
          
        </tr>
      </table>
                  <form name="filter" method="post" action="index.php">
            <p>Filter by: 
              <select name="filter" id="filter" onChange='javascript:document.filter.submit();'>
                <option value="0" <?php echo  ($filtro == 0) ? 'selected' : '' ?>>Filter by...</option>
                <option value="1" <?php echo  ($filtro == 1) ? 'selected' : '' ?>>Show Assigned</option>
                <option value="2" <?php echo  ($filtro == 2) ? 'selected' : '' ?>>Show No Assigned</option>
                <option value="6" <?php echo  ($filtro == 6) ? 'selected' : '' ?>>Show Companies</option>
                <option value="3" <?php echo  ($filtro == 3) ? 'selected' : '' ?>>Show Assigned Groups-Company</option>
                <option value="4" <?php echo  ($filtro == 4) ? 'selected' : '' ?>>Show Bajas</option>
                <option value="5" <?php echo  ($filtro == 5) ? 'selected' : '' ?>>Show Historicals</option>
                
              </select>
              </form>
              
              
              <?php if($filtro == 6){ ?>
              <form action="index.php" name="edit_directory" id="edit_directory" method="post">
              <input type="hidden" name="filter" value=<?php echo $filtro ?> >
              <table border="0" width="1187" cellpadding="1" cellspacing="0" bgcolor="#CCCCCC" id="border">
              
                <tr> 
                  <td><table width="100%" border="0" cellpadding="2" cellspacing="0" bgcolor="#ccc">
                      <tr>
                      	<td width="1" bgcolor="#ccc"><font size="-1">&nbsp;</font></td>
                        <td width="70"bgcolor="#ccc"><div align="left"><font size="-1"><b>Nombre de Empresa</b></font></div></td>
                        <td width="1" bgcolor="#ccc"><font size="-1">&nbsp;</font></td>
                        
                        <td width="70" bgcolor="#ccc"><div align="center"><font size="-1"><b>Numero de Grupos</b></font></div></td>
                        <td width="1" bgcolor="#ccc"><font size="-1">&nbsp;</font></td>
                        <td width="20" bgcolor="#ccc"><div align="center"><font size="-1"><b>CIF</b></font></div></td>
                        <td width="1" bgcolor="#ccc"><font size="-1">&nbsp;</font></td>
                        <td width="22" bgcolor="#CCCCCC"><div align="center"><font size="-1"><b>Telefono<br>
                        number</b></font></div></td>
                        <td width="1" bgcolor="#CCCCCC"><font size="-1">&nbsp;</font></td>
                        
                        <td width="70" bgcolor="#CCCCCC"><div align="center"><font size="-1"><b>Movil</b></font></div></td>
                        <td width="1" bgcolor="#CCCCCC"><font size="-1">&nbsp;</font></td>
                       
                        <td width="42" bgcolor="#CCCCCC"><div align="center"><font size="-1"><b>Email</b></font></div></td>
                        <td width="1" bgcolor="#CCCCCC"><font size="-1">&nbsp;</font></td>
                        <td width="26" bgcolor="#CCCCCC"><div align="center"><font size="-1"><b>Metro</b></font></div></td>
                        <td width="3" bgcolor="#CCCCCC"><font size="-1">&nbsp;</font></td>
                        
                        <td width="26" bgcolor="#CCCCCC"><div align="center"><font size="-1"><b>Enviar Email?</b></font></div></td>
                        <td width="3" bgcolor="#CCCCCC"><font size="-1">&nbsp;</font></td>
                        <td width="32" bgcolor="#CCCCCC"><div align="center"><font size="-1"><b>D</b></font></div></td>
                        <td width="2" bgcolor="#CCCCCC"><font size="-1">&nbsp;</font></td>
                        <td width="32" bgcolor="#CCCCCC"><div align="center"><font size="-1"><b>B</b></font></div></td>
                        <td width="1" bgcolor="#CCCCCC"><font size="-1">&nbsp;</font></td>
                        <td width="32" bgcolor="#CCCCCC"><div align="center"><font size="-1"><b>H</b></font></div></td>
                        <td width="1" bgcolor="#CCCCCC"><font size="-1">&nbsp;</font></td>
                        <td width="32" bgcolor="#CCCCCC"><div align="center"><font size="-1"><b>A</b></font></div></td>
                        
                        <td width="1" bgcolor="#CCCCCC"><font size="-1">&nbsp;</font></td>
                        
                        
                        </tr>
                 
<?php
	$i = 1; 
	$contador=1;
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	//$type = $row['group_type'];
	//$end =   $row["end"];
	$id =   $row["id"];
	$name = $row["nombre"];

	
	
	
	$opciones = $id;
	
	
	
	$count = $row['num'];
	
	
	if ($bg == "#FFFFFF") {
		$bg = "#B6C5F2";
	} else {
		$bg = "#FFFFFF";
	}
		
	print "<tr >";
	print "<td bgcolor='" . $bg ."' >&nbsp;</td>";
	print "<td bgcolor='" . $bg ."'><a href=company_profile.php?id=" . $id . ">"." ".$i." ".$name."</a></td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	
	 
	print "<td align='center' bgcolor='" . $bg ."'>" . $count . "</td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td bgcolor='" . $bg ."'><i>" . $row["cif"] . "</i></td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td align='center' bgcolor='" . $bg ."'>" . $row["telefono"] . "</td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	if($filtro != 2){
	print "<td align='center' bgcolor='" . $bg ."'>" . $row["movil"]. "</td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";}
	print "<td align='center' bgcolor='" . $bg ."'>" . $row["email"] . "</td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td align='center' bgcolor='" . $bg ."'>" . $row["metro"] . "</td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	
	
	if (validaEmail($row["email"])) {	
						echo "<td bgcolor='" . $bg ."' style=\"text-align:center\"><input type=\"checkbox\" name=\"reportSelection1".$contador."\" id=\"reportSelection".$contador."\" value=\"".$row["id"]."\" /> </td>";	
					} else {
						echo "<td bgcolor='" . $bg ."' style=\"text-align:center\"><input type=\"checkbox\" name=\"reportSelection1".$contador."\" id=\"reportSelection".$contador."\" value=\"".$row["id"]."\" disabled=\"true\" /> </td>";	
					}
	 print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		 

	print "<td align='right' bgcolor='" . $bg ."'><input name='delete1[]' type='checkbox' id='delete1' value='" . $row["id"] . "'> ";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td align='right' bgcolor='" . $bg ."'><input name='baja1[]' type='checkbox' id='baja1' value='" . $opciones . "'>";
    print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td align='right' bgcolor='" . $bg ."'><input name='historical1[]' type='checkbox' id='historical1' value='" . $opciones . "'>";
    print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td align='right' bgcolor='" . $bg ."'><input name='alta1[]' type='checkbox' id='alta1' value='" . $row["id"] . "'>
	     ";
		   print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		 

		  
	
	print "</tr>";
	
	
	$i++; 
	$contador++;  
}
            
?> 
                      <tr> 
                        <td bgcolor="#CCCCCC">&nbsp;</td>
                     
                        <td bgcolor="#CCCCCC">Total:<?php echo $numRows; ?></td>
                        <td bgcolor="#CCCCCC">&nbsp;</td>
                          
                        <td align="left" bgcolor="#CCCCCC"></td> 
                        <td bgcolor="#CCCCCC">&nbsp;</td>
                         <td bgcolor="#CCCCCC">&nbsp;</td>
                         <td bgcolor="#CCCCCC">&nbsp;</td>
                         <td bgcolor="#CCCCCC">&nbsp;</td>
                        
    
                        <td colspan="9" bgcolor="#CCCCCC">
                               
                          <div align="left">
                            <input name="action" type="submit" id="alta" value="Alta">
                                   
                            <input name="action" type="submit" id="action" value="Delete">
                                   
                            <input name="action" type="submit" id="action" value="Baja" />
                                   
                            <input name="action" type="submit" id="action" value="Historico" />
                            <input type="button" name="Emails" id="Emails" value="Emails" onClick="enviar_correo(<?php echo "'".$numRows."'"; ?>)" />                      
                          </div></td>
                        <td bgcolor="#CCCCCC">&nbsp;</td>
                        <td bgcolor="#CCCCCC"></td>
                        <td bgcolor="#CCCCCC">&nbsp;</td>
                        
                       
                       <td bgcolor="#CCCCCC">&nbsp;</td>
                        <td bgcolor="#CCCCCC">&nbsp;</td>
                        <td bgcolor="#CCCCCC">&nbsp;</td>
                        <td bgcolor="#CCCCCC">&nbsp;</td>
                         <td bgcolor="#CCCCCC">&nbsp;</td>
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
 <?php } else { ?>
              
              
              
              
             
              
              
      <!--begin dynamic list -->
      <form action="index.php" name="edit_directory" id="edit_directory" method="post">
      <input type="hidden" name="filter" value=<?php echo $filtro ?> >
              <table border="0" width= "1087" cellpadding="1" cellspacing="0" bgcolor="#CCCCCC" id="border">
              <tr> <td colspan="9" bgcolor="#CCCCCC">
                
                          <div align="right">
                            <input name="action" type="submit" id="alta" value="Alta">
                                   
                            <input name="action" type="submit" id="action" value="Delete">
                                   
                            <input name="action" type="submit" id="action" value="Baja" />
                                   
                            <input name="action" type="submit" id="action" value="Historico" />
                      
                           
                           
                            <input type="button" name="Emails" id="Emails" value="Emails" onClick="enviar_correo(<?php echo "'".$numRows."'"; ?>)" />                     
                          </div></td></tr>
                <tr> 
               
                  <td><table width="1170" border="0" cellpadding="2" cellspacing="0" bgcolor="#CCCCCC">
                      <tr>
                      	<td width="1" bgcolor="#CCCCCC"><font size="-1">&nbsp;</font></td>
                        <td width="70"bgcolor="#CCCCCC"><div align="left"><font size="-1"><b>Client's name</b></font></div></td>
                        <td width="1" bgcolor="#CCCCCC"><font size="-1">&nbsp;</font></td>
                          <?php if($filtro == 2 || $filtro == 4 || $filtro == 5 ){ ?>
                        <td width="50" bgcolor="#CCCCCC"><div align="left"><font size="-1"><b>Retorna?</b></font></div></td>
                        <td width="1" bgcolor="#CCCCCC">&nbsp;</td>
                         
                        
                          <?php } ?>
                       
                        <td width="22" bgcolor="#CCCCCC"><div align="center"><font size="-1"><b>Client<br>
                        number</b></font></div></td>
                        <td width="1" bgcolor="#CCCCCC"><font size="-1">&nbsp;</font></td>
                        
                         <?php if($filtro == 0 || $filtro == 1 || $filtro == 3 ){ ?>
                        <td width="70" bgcolor="#CCCCCC"><div align="center"><font size="-1"><b>Teacher's name</b></font></div></td>
                       
                          <td width="1" bgcolor="#CCCCCC">&nbsp;</td>
                        <?php } ?>
                        <td width="42" bgcolor="#CCCCCC"><div align="center"><font size="-1"><b>Telephone</b></font></div></td>
                        <td width="1" bgcolor="#CCCCCC"><font size="-1">&nbsp;</font></td>
                        
                        <td width="26" bgcolor="#CCCCCC"><div align="center"><font size="-1"><b>Mobile</b></font></div></td>
                        <td width="1" bgcolor="#CCCCCC"><font size="-1">&nbsp;</font></td>
                        <td width="52" bgcolor="#CCCCCC"><div align="center"><font size="-1"><b>Email</b></font></div></td>
                        <td width="1" bgcolor="#CCCCCC"><font size="-1">&nbsp;</font></td>
                        <td width="38" bgcolor="#CCCCCC"><div align="center"><font size="-1"><b>Send emails?</b></font></div></td>
                        <td width="1" bgcolor="#CCCCCC"><font size="-1">&nbsp;</font></td>
                        
              
                        
                        <td width="20" bgcolor="#CCCCCC"><div align="center"><font size="-1"><b>Days</b></font></div></td>
                       
                        <td width="4" bgcolor="#CCCCCC"><font size="-1">&nbsp;</font></td>
                       <?php if($filtro == 0 || $filtro == 1 || $filtro == 3 ){ ?>
                        <td width="37" bgcolor="#CCCCCC"><div align="center"><font size="-1"><b>Class Length</b></font></div></td>
                        <td width="3" bgcolor="#CCCCCC"><font size="-1">&nbsp;</font></td>
                        <?php } ?>
                        <td width="32" bgcolor="#CCCCCC"><div align="center"><font size="-1"><b>D</b></font></div></td>
                        <td width="2" bgcolor="#CCCCCC"><font size="-1">&nbsp;</font></td>
                        <td width="32" bgcolor="#CCCCCC"><div align="center"><font size="-1"><b>B</b></font></div></td>
                        <td width="1" bgcolor="#CCCCCC"><font size="-1">&nbsp;</font></td>
                        <td width="32" bgcolor="#CCCCCC"><div align="center"><font size="-1"><b>H</b></font></div></td>
                        <td width="1" bgcolor="#CCCCCC"><font size="-1">&nbsp;</font></td>
                        <td width="32" bgcolor="#CCCCCC"><div align="center"><font size="-1"><b>A</b></font></div></td>
                        <td width="1" bgcolor="#CCCCCC"><font size="-1">&nbsp;</font></td>
                        </tr>
                 
<?php
	$i = 0; 
	$contador=0;
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	
	$end =   $row["end"];
	$id =   $row["id"];
	$name = $row["name"];

	
	
	
	$opciones = $id.",".$end;
	
	
	
	$count = $row['num'];
	

	
	if (isset($bg) && $bg == "#FFFFFF") {
		$bg = "#B6C5F2";
	} else {
		$bg = "#FFFFFF";
	}
	
	print "<tr >";
	print "<td bgcolor='" . $bg ."' >&nbsp;</td>";
	print "<td bgcolor='" . $bg ."'><a href=group_profile.php?id=" . $row["id"] . ">"." ".$i." ".$name."</a></td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	 if($filtro == 2 || $filtro == 4 || $filtro == 5 ){
	print "<td align='left' bgcolor='" . $bg ."'>" . $row["returndate"] . "</td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	}
	
	print "<td align='center' bgcolor='" . $bg ."'>" . $count . "</td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	  if($filtro == 0 || $filtro == 1 || $filtro == 3 ){
	print "<td align='center' bgcolor='" . $bg ."'>" . $row["first"]. "</td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	}
	print "<td align='center' bgcolor='" . $bg ."'>" . $row["telephone1"] . "</td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td align='center' bgcolor='" . $bg ."'>" . $row["mobile"] . "</td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td align='center' bgcolor='" . $bg ."'>" . $row["email"] . "</td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	
	
	if (validaEmail($row["email"])) {	
	
	
					echo "<td bgcolor='" . $bg ."' style=\"text-align:center\"><input type=\"checkbox\" name=\"reportSelection".$contador."\" id=\"reportSelection".$contador."\" value=\"".$row["id"]."\" /> </td>";	
					} else {
						echo "<td bgcolor='" . $bg ."' style=\"text-align:center\"><input type=\"checkbox\" name=\"reportSelection".$contador."\" id=\"reportSelection".$contador."\" value=\"".$row["id"]."\" disabled=\"true\" /> </td>";	
					}
	
	   
    print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td align='center' bgcolor='" . $bg ."'>" . $row["days"] . "</td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	 if($filtro == 0 || $filtro == 1 || $filtro == 3 ){
	print "<td align='center' bgcolor='" . $bg ."'>" . $row["length"] . "</td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	 }
	print "<td bgcolor='" . $bg ."'><input name='delete[]' type='checkbox' id='delete' value='" . $row["id"] . "'>
	    	</td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td bgcolor='" . $bg ."'><input name='baja[]' type='checkbox' id='baja' value='" . $opciones . "'>";
    print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td bgcolor='" . $bg ."'><input name='historical[]' type='checkbox' id='historical' value='" . $opciones . "'>";
    print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td bgcolor='" . $bg ."'><input name='alta[]' type='checkbox' id='alta' value='" . $row["id"] . "'>
	      ";
    print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		 
	
	print "</tr>";
	
	
	$i++; 
	$contador++;  
}
            
?> 
                      <tr> 
                        <td bgcolor="#CCCCCC">&nbsp;</td>
                         
                    
                        <td bgcolor="#CCCCCC">Total:<?php echo $numRows; ?></td>
                        <td bgcolor="#CCCCCC">&nbsp;</td>
                          
                        <td align="left" bgcolor="#CCCCCC"></td> 
                        <td bgcolor="#CCCCCC">&nbsp;</td>
                         <td bgcolor="#CCCCCC">&nbsp;</td>
                        
                       <td bgcolor="#CCCCCC">&nbsp;</td>
                        <td bgcolor="#CCCCCC">&nbsp;</td>
                          <td bgcolor="#CCCCCC"></td>
                          
                           <?php if($filtro != 2){ ?>
                            <td bgcolor="#CCCCCC"></td>
                          
                                                        <?php }?>
                                                      
                          
                        <td bgcolor="#CCCCCC">&nbsp;</td>
                        <td colspan="9" bgcolor="#CCCCCC">
                       </td>
                       
                       
                       <td bgcolor="#CCCCCC">&nbsp;</td>
                        <td bgcolor="#CCCCCC">&nbsp;</td>
                        <td bgcolor="#CCCCCC">&nbsp;</td>
                        <td bgcolor="#CCCCCC">&nbsp;</td>
                         <td bgcolor="#CCCCCC">&nbsp;</td>
                           <td bgcolor="#CCCCCC">&nbsp;</td>
                        <td bgcolor="#CCCCCC">&nbsp;</td>
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
 
         

 <?php } ?>
<?php } else { echo "NOT AUTHORIZED TO SEE THIS PAGE, PLEASE RETURN BACK"; }?>