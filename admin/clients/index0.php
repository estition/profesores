<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php include 'includes/constants.php'?>
<?php include 'includes/functions.php'?>
<?php include 'includes/database.php'?>
<?php include 'includes/authorize.php'?>

<?php
if ($_POST['action'] == "Delete") {
	$i = 0;
	if (count($_POST['delete']) == 0) {$message = "<br>Must check the client first.";}
else{
	foreach ($_POST['delete'] as $id) {
		if ($_POST['type'][$i] == 'Client') {
   		$sql = 'delete from clients where id = ' . $id;
   		mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
		$message = "<br>Group profile deleted.";
   	} else if ($_POST['type'][$i] == 'Group') {
   		$sql = 'delete from groups where id = ' . $id;
   		mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
   		$sql = 'delete from clients where group_id = ' . $id;
   		mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
		 $message = "<br>Group profile deleted.";
		}
    $i++;
   
	}
	}
}

if ($_POST['action'] == "Baja") {


$i = 0;

if (count($_POST['baja']) == 0) {$message = "<br>Must check the client first.";}
else{

	foreach ($_POST['baja'] as $id) {
	
	$opciones = explode(',',$id);
	
	
	$yy =  substr($opciones[1], 0, -6);
	$mm =  substr($opciones[1], 5, 2);
	$dd =  substr($opciones[1], 8, 2);
	
	$fecha_final = $yy.$mm.$dd;
	
	
		if (($opciones[2] == 'Client') && ($fecha_final < date('Y').date('m').date('d'))) {
		
	
   		$sql = 'update clients set baja=1 where id = ' . $opciones[0];
   		mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
		$message = "<br>Client profile inactive.";
   	} else	if (($opciones[2] == 'Group') && ($fecha_final < date('Y').date('m').date('d'))){
	
	
	
   		$sql = 'update groups set baja=1 where id = ' . $opciones[0];
   		mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
   		$sql = 'update clients set baja=1 where group_id = ' . $opciones[0];
   		mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
		 $message = "<br>Group profile inactive.";
		}
    $i++;
	

	}
  }
}


if ($_POST['action'] == "Alta") {
$i = 0;

if (count($_POST['baja']) == 0) {$message = "<br>Must check the client first.";}
else{

	foreach ($_POST['alta'] as $id) {
	
	
	if ($_POST['type'][$i] == 'Client') {
	
   		$sql = 'update clients set baja=0 where id = ' . $id;
   		mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
		$message = "<br>Client profile active.";
   	} else if ($_POST['type'][$i] == 'Group') {
		echo $id;
   		$sql = 'update groups set baja=0 where id = ' . $id;
   		mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
   		$sql = 'update clients set baja=0 where group_id = ' . $id;
   		mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
		 $message = "<br>Group profile active.";
		}
    $i++;
 
	
	
	}
  }
}


if ($_POST['filter'] != "") {
	switch ($_POST['filter']) { 
			case 0:
			$sql = " select a.id, c.id, c.name, c.apellido1, first, last1, c.telephone1, c.mobile, c.email, c.days,	c.starttime,c.endtime, c.tcontry,  c.group_type, a.start, a.length, (select count(id) from clients d where group_id = c.id) as num from userGroup a, users b, groups c  where   a.user_id = b.id and  group_id = c.id and a.end is null and c.baja = '0' order by name";
			break;
			case 1:					
$sql = "select a.id, c.id, c.name, c.apellido1, first, last1, c.telephone1, c.mobile, c.email, c.days,	c.starttime,c.endtime, c.tcontry, c.group_type, a.start, a.length, (select count(id) from clients d where group_id = c.id) as num from userGroup a, users b, groups c  where  c.group_type = 'Group' and a.user_id = b.id and  group_id = c.id and a.end is null and c.baja = '0' order by name";


				break;
		  case 2:
		  
		  $sql = "select a.id, c.id, c.name, c.apellido1, first, last1, c.telephone1, c.mobile, c.email, c.days,	c.starttime,c.endtime, c.tcontry, c.group_type, a.start, a.length, (select count(id) from clients d where group_id = c.id) as num from userGroup a, users b, groups c  where  c.group_type = 'Group' and a.user_id = b.id and  group_id = c.id and c.baja = '1' order by name";
		  				
	      break;
	    case 3:
		
		  $sql = "select c.id, c.name, c.apellido1, first, last1, c.telephone1, c.mobile, c.email, c.days,	c.starttime,c.endtime, c.tcontry, c.group_type, a.start, a.length, (select count(id) from clients d where group_id = c.id) as num from userGroup a, users b, groups c  where c.group_type = 'Group' and  a.user_id = b.id and  group_id = c.id and a.end is null order by name";
		
		break;
	    case 4:
				$sql = "select c.id, c.name, c.group_type, c.start, c.telephone1, c.mobile, c.email, c.days	,c.starttime,c.endtime, c.tcontry, (select count(id) from clients b where group_id = c.id and baja = '1') as num from groups c where c.group_type = 'Group' order by name";
				
	      break;		
	    case 5:
		$sql = "select a.id, c.id, c.name, c.apellido1, first, last1, c.telephone1, c.mobile, c.email, c.days,	c.starttime,c.endtime, c.tcontry, c.group_type, a.start, '' as num, a.length from userGroup a, users b, groups c  where c.group_type = 'Client' and  a.user_id = b.id and a.group_id = c.id and a.end is null and c.baja = '0' order by name";
	    	
	      break;
		   case 6:
		   $sql = "select a.id, c.id, c.name, c.apellido1, first, last1, c.telephone1, c.mobile, c.email, c.days,	c.starttime,c.endtime, c.tcontry, c.group_type, a.start, '' as num, a.length from userGroup a, users b, groups c  where c.group_type = 'Client' and  a.user_id = b.id and a.group_id = c.id and a.end is null and c.baja = '1' order by name";
	    	
	      break;
		  case 7:
		$sql = "select a.id, c.id, c.name, c.apellido1, first, last1, c.telephone1, c.mobile, c.email, c.days,	c.starttime,c.endtime, c.tcontry, c.group_type, a.start, '' as num, a.length from userGroup a, users b, groups c  where c.group_type = 'Client' and a.user_id = b.id and a.group_id = c.id and a.end is null order by name"; 	
			
	      break;
		  case 8:
		  $sql = "select id, name, apellido1, group_type, start, telephone1, mobile, email, days, starttime, endtime, tcontry, '1' as num from groups where group_type = 'Client' order by name";
		  break;
		 
		  case 9:
		   $sql = "select a.id, a.name, a.group_type, a.start, a.telephone1, a.mobile, a.email, a.days,	a.starttime,a.endtime, a.tcontry, (select count(id) from clients b where group_id = a.id) as num from groups a where a.group_type = 'Client' and a.baja = '1' order by name";
		  break;
		 }
} else {
$sql = "select a.id, c.id, c.name, c.apellido1, first, last1, c.group_type, a.start, c.telephone1, c.mobile, c.email, c.days,c.starttime,c.endtime, c.tcontry, a.length, (select count(id) from clients d where group_id = c.id) as num from userGroup a, users b, groups c where  a.user_id = b.id and  a.group_id = c.id and a.end is null and c.baja = '0' order by c.name";
	
}

//print $sql;
$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));

global $numRows; 

$numRows = mysqli_num_rows($result);

$page_name = "client admin";
?>
<?php include 'includes/top.php'?>
<?php include 'includes/menu.php'?>

      <table width="100%" border="0" cellpadding="10" cellspacing="0" id="body">
        <tr> 
          <td width="100%" valign="top"> <p><b>Canterbury Client Profiles</b></p>
            <p>This section allows you to modify a client or a client group's information.  Click on a name to 
              edit, or check a box (or boxes) to delete.</p>
              
              
      <table border="0" cellpadding="5" cellspacing="0" bgcolor="#B6C5F2" id="action">
        <tr> 
          <td><p>Do you want to create a <b>New profile</b> for a <b><a href="client_profile1.php">Client</a></b>?</p></td>
          
        </tr>
        <tr> 
         
          <td><p>Do you want to create a <b>New profile</b> for a <b><a href="group_profile.php">Group</a></b>?</p></td>
        </tr>
      </table>
      <b><font color='#ff9900'><?php echo  $message ?></font></b>
            <form name="filter" method="post" action="index.php">
            <p>Filter by: 
              <select name="filter" id="filter" onChange='javascript:document.filter.submit();'>
                <option value="0" <?php echo  ($_POST['filter'] == 0) ? 'selected' : '' ?>>Filter by...</option>
                <option value="1" <?php echo  ($_POST['filter'] == 1) ? 'selected' : '' ?>>Show associated active Groups</option>
                <option value="2" <?php echo  ($_POST['filter'] == 2) ? 'selected' : '' ?>>Show associated Groups Historical</option>
                <option value="3" <?php echo  ($_POST['filter'] == 3) ? 'selected' : '' ?>>Show All associated Groups</option>
                <option value="4" <?php echo  ($_POST['filter'] == 4) ? 'selected' : '' ?>>Show All Groups</option>
                <option value="5" <?php echo  ($_POST['filter'] == 5) ? 'selected' : '' ?>>Show associated active Clients</option>
                <option value="6" <?php echo  ($_POST['filter'] == 6) ? 'selected' : '' ?>>Show associated Clients Historical</option>
                <option value="7" <?php echo  ($_POST['filter'] == 7) ? 'selected' : '' ?>>Show All associated Clients</option>
                <option value="8" <?php echo  ($_POST['filter'] == 8) ? 'selected' : '' ?>>Show All Clients</option>
                <option value="9" <?php echo  ($_POST['filter'] == 9) ? 'selected' : '' ?>>Show General Historical</option>
              </select>
              </form>
              
      <!--begin dynamic list -->
      <form action="index.php" name="edit_directory" id="edit_directory" method="post">
              <table border="0" width="100%" cellpadding="1" cellspacing="0" bgcolor="#CCCCCC" id="border">
                <tr> 
                  <td><table width="100%" border="0" cellpadding="2" cellspacing="0" bgcolor="#FFFFFF" id="listing">
                      <tr>
                      	<td width="1" bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td width="300"bgcolor="#eeeeee"><div align="center"><font size="-1"><b>Client's name</b></font></div></td>
                        <td width="1" bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td width="20" bgcolor="#eeeeee"><div align="center"><font size="-1"><b>Type</b></font></div></td>
                        <td width="1" bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td width="22" bgcolor="#eeeeee"><div align="center"><font size="-1"><b>Client<br>
                        count</b></font></div></td>
                        <td width="1" bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td width="250" bgcolor="#eeeeee"><div align="center"><font size="-1"><b>Teacher's name</b></font></div></td>
                        <td width="1" bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        
                        <td width="42" bgcolor="#eeeeee"><div align="center"><font size="-1"><b>Telephone</b></font></div></td>
                        <td width="1" bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td width="26" bgcolor="#eeeeee"><div align="center"><font size="-1"><b>Mobile</b></font></div></td>
                        <td width="1" bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td width="52" bgcolor="#eeeeee"><div align="center"><font size="-1"><b>Email</b></font></div></td>
                        <td width="1" bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td width="38" bgcolor="#eeeeee"><div align="center"><font size="-1"><b>USA/UK?</b></font></div></td>
                        <td width="1" bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        
                        
                          
                        
                        
                        <td width="100" bgcolor="#eeeeee"><div align="center"><font size="-1"><b>Start date</b></font></div></td>
                        <td width="6" bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        
                        <td width="20" bgcolor="#eeeeee"><div align="center"><font size="-1"><b>Days</b></font></div></td>
                        <td width="5" bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td width="39" bgcolor="#eeeeee"><div align="center"><font size="-1"><b>Start time</b></font></div></td>
                        <td width="4" bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td width="37" bgcolor="#eeeeee"><div align="center"><font size="-1"><b>Class Length</b></font></div></td>
                        <td width="3" bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td width="30" bgcolor="#eeeeee"><div align="center"><font size="-1"><b>D</b></font></div></td>
                        <td width="2" bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td width="30" bgcolor="#eeeeee"><div align="center"><font size="-1"><b>H</b></font></div></td>
                        <td width="1" bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td width="30" bgcolor="#eeeeee"><div align="center"><font size="-1"><b>A</b></font></div></td>                         
                      </tr>
                 
<?php
	$i = 1; 
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	$type = $row['group_type'];
	$end =   $row["end"];
	$id =   $row["id"];
	$name = $row["name"]." ".$row["apellido1"];

	
	
	
	$opciones = $id.",".$end.",".$type;
	
	
	
	$count = $row['num'];
	
	if ($type == "Client") {
		$edit_page = "client_profile1.php";
	} else if ($type == "Group") {
		$edit_page = "group_profile.php";
	}
	
	if ($bg == "#FFFFFF") {
		$bg = "#B6C5F2";
	} else {
		$bg = "#FFFFFF";
	}
	
	print "<tr >";
	print "<td bgcolor='" . $bg ."' >&nbsp;</td>";
	print "<td bgcolor='" . $bg ."'><a href='" . $edit_page . "?id=" . $row["id"] . "'>"." ".$i." ".$name."</a></td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td bgcolor='" . $bg ."'><i>" . $type . "</i></td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td align='center' bgcolor='" . $bg ."'>" . $count . "</td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td align='center' bgcolor='" . $bg ."'>" . $row["first"]." " .$row["last1"] . "</td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td align='center' bgcolor='" . $bg ."'>" . $row["telephone1"] . "</td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td align='center' bgcolor='" . $bg ."'>" . $row["mobile"] . "</td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td align='center' bgcolor='" . $bg ."'>" . $row["email"] . "</td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td align='center' bgcolor='" . $bg ."'>" . $row["tcontry"] . "</td>";
	   
    print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td align='center' bgcolor='" . $bg ."'>" . $row["start"] . "</td>";
    print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td align='center' bgcolor='" . $bg ."'>" . $row["days"] . "</td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td align='center' bgcolor='" . $bg ."'>" . $row["starttime"] . "</td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td align='center' bgcolor='" . $bg ."'>" . $row["length"] . "</td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	
	print "<td bgcolor='" . $bg ."'><input name='delete[]' type='checkbox' id='delete' value='" . $row["id"] . "'>
	    	<input name='type[]' type='hidden' id='type' value='" . $type . "'></td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td bgcolor='" . $bg ."'><input name='baja[]' type='checkbox' id='baja' value='" . $opciones . "'>";
    print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td bgcolor='" . $bg ."'><input name='alta[]' type='checkbox' id='alta' value='" . $row["id"] . "'>
	      <input name='type[]' type='hidden' id='type' value='" . $type . "'></td>";
		 
	
	
	
	

	print "</tr>";
	
	
	$i++;   
}
            
?> 
                      <tr> 
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">Total Groups/Clients: <?php echo $numRows; ?></td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                         <td bgcolor="#eeeeee">&nbsp;</td>
                        
                       
                        <td bgcolor="#eeeeee">&nbsp;</td>
                          <td bgcolor="#eeeeee"></td>
                            <td bgcolor="#eeeeee"></td>
    
                         <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                       <td bgcolor="#eeeeee"><div align="right">
                           <input name="action" type="submit" id="action" value="Delete">
                        </div></td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee"><div align="left">
                          <input name="action" type="submit" id="action" value="Historical" />
                        </div></td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                         <td bgcolor="#eeeeee"><div align="left">
                           <input name="action" type="submit" id="alta" value="Alta">
                        </div></td>
                           <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                       <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee"></td>
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
<?php include 'includes/foot.php'?>
