<?php include '../../includes/constants.php'?>
<?php include '../../includes/functions.php'?>
<?php include '../../includes/database.php'?>
<?php include '../../includes/authorize.php'?>
<?php

 function DameFechas($GrupoId,$fromday,$today,$concept_id,$class_type,$hours)
     {
	 $Resultado = " ";
	 $sqlJBT = "select date_format(entry.day, '%d') as day from entry,groups ";
	 $sqlJBT .= "where entry.day >= '" . $fromday . "' and entry.day <= '" . $today . "' and entry.group_id = " . $GrupoId;
	 $sqlJBT .= " and entry.concept_id = " . $concept_id . " and entry.class_type= ".$class_type." and hours= ".$hours." and groups.id = entry.group_id order by entry.day";
	 //and groups.name REGEXP BINARY '^[ABCDEFGHIJKLMN�OPQRSTUVWXYZ][ABCDEFGHIJKLMN�OPQRSTUVWXYZ]'
	 //print $sqlJBT;
	 
	 //exit;
	 
	 $rsJBT = mysqli_query($link, $sqlJBT) or die("Invalid query: " . mysqli_error($link));
				while ($rowJBT = mysqli_fetch_array($rsJBT, MYSQLI_ASSOC)) {
				   $Resultado .= $rowJBT['day']. " ";
				   }
	 
	 return $Resultado;			   
	 }

if ($_REQUEST['paysheet_id'] != "") {
	$sql = "select observations, changes, total from paysheet where id = " . $_REQUEST['paysheet_id'];
	//print $sql;	
	$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$observations = $row['observations'];
	$changes = 0;
	$changes = $row['changes'];
} else {
	$observations = $_REQUEST['observations'];		
	$changes = $_REQUEST['changes'];
	$observations = "";
	$changes = 0;
}

$sql = "select first from users where id = " . $_REQUEST['teacher_id'];
$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$name = $row['first'];
?>
<html>
<title>Teacher Paysheet</title>
<link href="css/canterbury.css" type="text/css" rel="stylesheet">
<script>

var da = (document.all) ? 1 : 0; 
var pr = (window.print) ? 1 : 0; 
var mac = (navigator.userAgent.indexOf("Mac") != -1); 

function printThis() { 
	window.print();
} 

</script> 

<form method="post" name="myform"> 

 <table width="100%" border="0" cellpadding="10" cellspacing="0" id="body">
        <tr> 
          <td width="100%" valign="top"> <p><b>
          <font size="3"><?php echo $name?> - <?php echo $_REQUEST['month'] . '-' . $_REQUEST['year']?></font></b>
          		<div align="right">  <input type="button" onClick="javascript:printThis();" value="Print"></div><br><br>
              <table border="0" cellpadding="1" cellspacing="0" bgcolor="#CCCCCC" id="border" width="100%">
                <tr> 
                  <td>
                  <table border="0" cellpadding="2" cellspacing="0" bgcolor="#FFFFFF" id="listing" width="100%">
                      <tr>
                      	<td width="1%" bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td width="7%" bgcolor="#eeeeee"><font size="-1"><b>Dates</b></font></td>
                        <td width="1%" bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Length</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Client</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee" align='center'><font size="-1"><b>Class<br> Type</b></font>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee" align='center'><font size="-1"><b>Class<br> Taught</b></font>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee" align='center'><font size="-1"><b>Late Student<br />Cancellation</b></font>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee" align='center'><b><font size="-1">Makeup Taught</font><br /><font size="-2">Only preview months</font></b>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        	<td bgcolor="#eeeeee" align='center'><font size="-1"><b>Total<br> Classes</b></font>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        	<td bgcolor="#eeeeee" align='center'><font size="-1"><b>Rate</b></font>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
												<td bgcolor="#eeeeee" align='center'><font size="-1"><b>Total</b></font>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
						<td bgcolor="#eeeeee" align='center'><font size="-1"><b>Student<br> Cancellation</b></font>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
						<td bgcolor="#eeeeee" align='center'><font size="-1"><b>Teacher<br> Cancellation</b></font>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                      </tr>

<?php

if (($_REQUEST['teacher_id'] != "") && ($_REQUEST['fromday'] != "")) {


	$sum = 0;
	$taught = 0;
	$sql2 = "select b.id, hours, name, apellido1, b.id as group_id, a.class_type from entry a, groups b ";
	$sql2 .= "where a.group_id = b.id and a.user_id = " . $_REQUEST['teacher_id'] . " and day >= '" . $_REQUEST['fromday'] . "' and day <= '" . $_REQUEST['today'] . "' ";
	$sql2 .= " and ( concept_id = 1 or concept_id = 3 or concept_id = 5) group by b.id, hours, a.class_type  order by day asc, hours asc";

	$result2= mysqli_query($link, $sql2) or die("Invalid query: " . mysqli_error($link));
	$numRows = mysqli_num_rows($result2);
	
	$all_taught = 0;
	$all_noshow = 0;
	$all_makeup = 0;
	
	if ($numRows > 0) {
		while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {

				$sql = "select b.id, date_format(day, '%d') as day, name, apellido1, observations, hours, concept_id, supplement, a.class_type from entry a, groups b ";
				$sql .= "where a.group_id = b.id and a.user_id = " . $_REQUEST['teacher_id'] . " and day >= '" . $_REQUEST['fromday'] . "' and day <= '" . $_REQUEST['today'] . "' and b.id = " . $row2['id'] . " and hours = " . $row2['hours'] . " and a.class_type = " . $row2['class_type'];
				$sql .= " and ( concept_id = 1 or concept_id = 3 or concept_id = 5) order by day";
				//print $sql;
				$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
				$total_taught = 0;
				$total_noshow = 0;
				$total_makeup = 0;
				//$dates = "";
				
				
				$row_sum = 0;
				$row_taught = 0;
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		//********************************************************************************************	
			//*************************************Creado por SVI*****************************************
			//********************************************************************************************
			
				if ($row2['class_type']== 1 and $row['concept_id']== 1){
				$dates .=  $row['day'] . " ";
				}else if ($row2['class_type']== 2 and $row['concept_id']== 1){
				$dates .=  $row['day'] . " ";
				}else if ($row2['class_type']== 3 and $row['concept_id']== 1){
				$dates .=  $row['day'] . " ";
				}else if ($row2['class_type']== 4 and $row['concept_id']== 1){
				$dates .=  $row['day'] . " ";
				}
			
			
			
			//********************************************************************************************	
			//**********************************Termina edici�n SVI***************************************
			//********************************************************************************************					
					$supplement = $row['supplement'];
				  $class_type = $row['class_type'];
					//$dates .=  $row['day'] . " ";
		
					$sql = "select price from prices where type = " . $class_type .  " and hours = " . $row['hours'];
					$result3 = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
					$row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC);
						if ($row['concept_id'] == 1) {
						$total_taught += 1;
						$all_taught += 1;
						$taught_sum = $row3['price'] + $supplement;
						$row_sum += $taught_sum;
						$row_taught += 1;
					} else {
						$hours = "";
					}
					
					if ($row['concept_id'] == 3) {
						$total_noshow += 1;
						$all_noshow += 1;
						$noshow_sum = $row3['price'] + $supplement;
						$row_sum += $noshow_sum;
						$row_taught += 1;
					} else {
						$hours = "";
					}
					
					if ($row['concept_id'] == 5) {
						$total_makeup += 1;
						$all_makeup += 1;
						$makeup_sum = $row3['price'] + $supplement;
						$row_sum += $makeup_sum;
						$row_taught += 1;
					} else {
						$hours = "";
					}
				}
				/*
				1 Class Taught 0 
      			2 Student Cancellation 0 
      			3 Student No-show 0 
      			4 Teacher Cancellation 0 
      			5 Makeup Class Taught 0 
      			6 Admin - Cancel out an untaught class 1 
      			7 Admin - Give the client an extra class 1 
				*/
			  $sum += $row_sum;
			  $taught += $row_taught; //DameFechasCancellation2($row2['id'],$_REQUEST['fromday'],$_REQUEST['today'],1)
			
			//********************************************************************************************	
			//*************************************Creado por SVI*****************************************
			//********************************************************************************************
			
			if ($class_type== 1){
			$class_type_name= "Individual Class";
			}else if ($class_type== 2){
			$class_type_name= "Group Class I";
			}else if ($class_type== 3){
			$class_type_name= "Group Class II";
			}else if ($class_type== 4){
			$class_type_name= "Group Class III";
			}
			
			//********************************************************************************************	
			//**********************************Termina edici�n SVI***************************************
			//********************************************************************************************
			  		  
				print "<tr>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td bgcolor='" . $bg ."' width='100'>". $dates . "</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td bgcolor='" . $bg ."'>" . $row2['hours']."</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td bgcolor='" . $bg ."'>" . $row2["name"] ." ".$row2["apellido1"]. "</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td align='center' bgcolor='" . $bg ."'>" . $class_type_name ."</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td align='center' bgcolor='" . $bg ."'>". $total_taught . "</td>";
				//print "<td align='center' bgcolor='" . $bg ."'>" . $dates ."</td>";
				//agregado por svi
			    $dates="";
			    //fin agregado svi
				//print "<td align='center' bgcolor='" . $bg ."'>". DameFechas($row2['id'],$_REQUEST['fromday'],$_REQUEST['today'],1) . "</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				//print "<td align='center' bgcolor='" . $bg ."'>". $total_noshow . "</td>";
				print "<td align='center' bgcolor='" . $bg ."'>". DameFechas($row2['id'],$_REQUEST['fromday'],$_REQUEST['today'],3,$row2['class_type'], $row2['hours']) . "</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				//print "<td align='center' bgcolor='" . $bg ."'>". $total_makeup . "</td>";
				print "<td align='center' bgcolor='" . $bg ."'>". DameFechas($row2['id'],$_REQUEST['fromday'],$_REQUEST['today'],5,$row2['class_type'], $row2['hours']) . "</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td align='center' bgcolor='" . $bg ."'>" . $row_taught . "</td>";
				//print "<td align='center' bgcolor='" . $bg ."'>" . DameFechas($row2['id'],$_REQUEST['fromday'],$_REQUEST['today'],1) . "</td>";
				
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td align='center' bgcolor='" . $bg ."'>" . ($row3['price'] + $supplement) . " �</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td align='center' bgcolor='" . $bg ."'>" . $row_sum . " �</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td align='center' bgcolor='" . $bg ."'>". DameFechas($row2['id'],$_REQUEST['fromday'],$_REQUEST['today'],2,$row2['class_type'], $row2['hours']) . "</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td align='center' bgcolor='" . $bg ."'>". DameFechas($row2['id'],$_REQUEST['fromday'],$_REQUEST['today'],4,$row2['class_type'], $row2['hours']) . "</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
			
		}
		print "<tr><td colspan='13' bgcolor='ffffff'>&nbsp;</td></tr>";
	} else {
			print "<tr>";
			print "<td colspan='12'>There are no entries for the given teacher and date.</td>";
			print "</tr>";
	}
?>
		<tr>
      <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
      <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
      <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
      <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
      <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
      <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
      <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
      <td bgcolor="#eeeeee" align='center'><font size="-1"><b>Class<br> Taught</b></font>
      <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
      <td bgcolor="#eeeeee" align='center'><font size="-1"><b>Late Student<br />Cancellation</b></font>
      <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
      <td bgcolor="#eeeeee" align='center'><b><font size="-1">Makeup Taught</font><br /><font size="-2">Only preview months</font></b>
      <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
      <td bgcolor="#eeeeee" align='center'><font size="-1"><b>Total<br> Classes</b></font>
      <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
       <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
      <td bgcolor="#eeeeee" align='center'><font size="-1"><b>Sum</b></font>
      <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
    </tr>
    
    <?php
                      
		// totals
		$bg = "#ffffff";
		print "<tr class='text'>";
		print "<td class='text' colspan='7' bgcolor='" . $bg ."'><b>Totals for this month:</b></td>";
		
		print "<td class='text' align='center' bgcolor='" . $bg ."'><b>". $all_taught  . "</b></td>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		print "<td class='text' align='center' bgcolor='" . $bg ."'><b>". $all_noshow . "</b></td>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		print "<td class='text' align='center' bgcolor='" . $bg ."'><b>". $all_makeup . "</b></td>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		print "<td class='text' align='center' bgcolor='" . $bg ."'><b>" . $taught . "</b></td>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		print "<td class='text' align='center' bgcolor='" . $bg ."'><b>" . $sum . " �</b></td>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		print "</tr>";



} else {
			print "<tr>";
			print "<td colspan='16'>Please select a teacher and date range.</td>";
			print "</tr>";
	}               
?> 
		<tr>
      <tr class='text'>
			<td class='text' colspan='17'><b>Changes:</b></td>
      <td border="1" align='center' nowrap><font size="-1"><b><?php echo $changes?></b></font>
      <td><font size="-1">&nbsp;</font></td>
    </tr>
		<tr>
      <tr class='text'>
      <td class='text' colspan='17'><b>Grand total:</b></td>
			<td class='text' align="center"><b><?php echo ($sum + $changes)." �"?></b></font></td>
      <td><font size="-1">&nbsp;</font></td>
    </tr>

                  </table>
    
    						</td>
              </tr>
              <table>
              <br>
              
               <table width="100%" border="0" cellpadding="10" cellspacing="0">
              <tr>
              	<td>
              		<b>Observations:</b><br>
              			<?php echo $observations?>
              	</td>
              </tr>
            </table>
  
  
  				 <table width="100%" border="0" cellpadding="10" cellspacing="0">
              <tr>
              	<td>
              		Date:
              	</td>
              	<td>
              		Signature (Sign only after you have recieved payment):
              	</td>
              	</tr>
              	<tr>
              	<td>
              		<table width="100" border="1" cellpadding="10" cellspacing="0">
			              <tr>
			              	<td heigh="20">&nbsp;
			              		
			              		
			              	</td>
			              </tr>
			            </table>
              		
              	</td>
              	
              	<td>
              		<table width="300" border="1" cellpadding="10" cellspacing="0">
			              <tr>
			              	<td height="20">&nbsp;
			              		
			              		
			              	</td>
			              </tr>
			            </table>
              		
              	</td>
              </tr>
            </table>
         
  </form>
                </td>
  </tr>
</table>
</html>
<?php 
   //mysql_free_result($result);
   //mysql_free_result($result2);
   //mysql_free_result($result3);

?>
