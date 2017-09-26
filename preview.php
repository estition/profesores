<?php include 'includes/constants.php'?>
<?php include 'includes/functions.php'?>
<?php include 'includes/database.php'?>
<?php include 'includes/authorize.php'?>
<?php

function DameFechas($GrupoId,$fromday,$today,$concept_id,$class_type,$length)
     {
	 
	 
	 $Resultado = " ";
	 $sqlJBT = "select date_format(entry.day, '%d') as day from entry,groups ";
	 $sqlJBT .= "where entry.day >= '" . $fromday . "' and entry.day <= '" . $today . "' and entry.group_id = " . $GrupoId;
	 $sqlJBT .= " and entry.concept_id = " . $concept_id . " and entry.class_type=" . $class_type . " and hours=" . $length . " and groups.id = entry.group_id  order by day ";
	
	 //and groups.name REGEXP BINARY '^[ABCDEFGHIJKLMNÑOPQRSTUVWXYZ][ABCDEFGHIJKLMNÑOPQRSTUVWXYZ]'
	 //print $sqlJBT;
	 
	 //exit;
	 
	 $rsJBT = mysql_query($sqlJBT) or die("Invalid query00000: " . mysql_error());
				while ($rowJBT = mysql_fetch_array($rsJBT, MYSQL_ASSOC)) {
				   $Resultado .= $rowJBT['day']. " ";
				   }
	 
	 	 return $Resultado;			   
	 }

if ($_REQUEST['paysheet_id'] != "") {
	$sql = "select observations, changes from paysheet where id = " . $_REQUEST['paysheet_id'];
	$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	$observations = $row['observations'];
	$changes = 0;
	$changes = $row['changes'];
} else {
	$observations = $_REQUEST['observations'];
	$changes = $_REQUEST['changes'];
	$observations = "";
	$changes = 0;
}

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
          <td width="100%" valign="top"> <p><b>Paysheet PREVIEW - <?php echo $_REQUEST['fromday']?> to <?php echo $_REQUEST['today']?>
          		<div align="right"> <input type="button" onClick="javascript:printThis();" value="Print"></div><br><br>
              <table border="0" cellpadding="1" cellspacing="0" bgcolor="#CCCCCC" id="border" width="100%">
                <tr> 
                  <td>
                  <table border="0" cellpadding="2" cellspacing="0" bgcolor="#FFFFFF" id="listing" width="100%">
                      <tr>
                      	<td width="1%" bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td width="10%" bgcolor="#eeeeee"><font size="-1"><b>Dates</b></font></td>
                        <td width="1%" bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td width="5%" bgcolor="#eeeeee"><font size="-1"><b>Length</b></font></td>
                        <td width="1%" bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td width="19%" bgcolor="#eeeeee"><font size="-1"><b>Client</b></font></td>
                        <td width="1%" bgcolor="#eeeeee">&nbsp;</td>
                        <td width="4%" bgcolor="#eeeeee"><font size="-1"><b>Class Type</b></font></td>
                        <td width="1%" bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td width="5%" align='center' bgcolor="#eeeeee"><font size="-1"><b>Class<br>
                        Taught</b></font>
                        <td width="1%" bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td width="8%" align='center' bgcolor="#eeeeee"><font size="-1"><b>Late Student<br />
                        Cancellation</b></font>
                        <td width="1%" bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td width="8%" align='center' bgcolor="#eeeeee"><b><font size="-1">Makeup Taught</font><br />
                        <font size="-2">Only preview months</font></b>
                        <td width="1%" bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        	<td width="5%" align='center' bgcolor="#eeeeee"><font size="-1"><b>Total<br>
                       	    Classes</b></font>
                        <td width="1%" bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
						 <td width="8%" align='center' bgcolor="#eeeeee"><b><font size="-1">Student Cancellation</font><br />
					     <font size="-2">Only input if not taught</font></b>
                        <td width="1%" bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        	<td width="8%" align='center' bgcolor="#eeeeee"><b><font size="-1">Teacher Cancellation</font><br />
                       	    <font size="-2">Only input if not taught</font></b>
                        <td width="1%" bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        
                        <td width="1%" bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        	<td width="7%" align='center' bgcolor="#eeeeee"><b><font size="-1">Photocopies</font><br />
                        	</b>
                        <td width="1%" bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                    </tr>

<?php

if (($_REQUEST['teacher_id'] != "") && ($_REQUEST['fromday'] != "")) {

    
	$sum = 0;
	$taught = 0;
	$sql2 = "select b.id, day, hours, name, b.id as group_id, a.class_type from entry a, groups b 
	where a.group_id = b.id and a.user_id = " . $_REQUEST['teacher_id'] . " and a.day >= '" . $_REQUEST['fromday'] . "' and a.day <= '" . $_REQUEST['today'] . "' 
	 and ( concept_id = 1 or concept_id = 2 or concept_id = 3 or concept_id = 4 or concept_id = 5) group by b.id, hours, a.class_type order by day, hours asc";
	
	
	
	$result2= mysql_query($sql2) or die("Invalid query1111: " . mysql_error());
	$numRows = mysql_NumRows($result2);
	
	$all_taught = 0;
	$all_noshow = 0;
	$all_makeup = 0;
	
	if ($numRows > 0) {
	
		while ($row2 = mysql_fetch_array($result2, MYSQL_ASSOC)) {

				$sql = "select b.id, date_format(day, '%d') as day, name, observations, hours, concept_id, supplement, a.class_type, a.supplement_entry from entry a, groups b ";
				$sql .= "where a.group_id = b.id and a.user_id = " . $_REQUEST['teacher_id'] . " and day >= '" . $_REQUEST['fromday'] . "' and day <= '" . $_REQUEST['today'] . "' and b.id = " . $row2['id'] . " and hours = " . $row2['hours'] . " and a.class_type = " . $row2['class_type'];
				$sql .= " and ( concept_id = 1 or concept_id = 2 or concept_id = 3 or concept_id = 4 or concept_id = 5) order by day";
				
				//print $sql;
				$result = mysql_query($sql) or die("Invalid query2222: " . mysql_error());
				$total_taught = 0;
				$total_noshow = 0;
				$total_makeup = 0;
				$supplement_entry = 0;
				$dates = "";
				
				$row_sum = 0;
				$row_taught = 0;
				while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
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
			//**********************************Termina edición SVI***************************************
			//********************************************************************************************	
			      $supplement = $row['supplement'];
				  $class_type = $row['class_type'];	
				  $supplement_entry0 = $row['supplement_entry'];
				  $supplement_entry += 0.025*$supplement_entry0;
				  $total_supplement += 0.025*$supplement_entry0;
				  
				 
			//	  $dates .=  $row['day'] . " ";
				 
					
					$sql = "select price from prices where type = " . $class_type .  " and hours = " . $row['hours'];
					$result3 = mysql_query($sql) or die("Invalid query: " . mysql_error());
					$row3 = mysql_fetch_array($result3, MYSQL_ASSOC);
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
			//********************************************************************************************	
			//*************************************Creado por SVI*****************************************
			//********************************************************************************************
			
			if ($class_type == 1){
			$class_type_name = "Individual Class";
			}else if ($class_type == 2){
			$class_type_name = "Group Class I";
			}else if ($class_type == 3){
			$class_type_name = "Group Class II";
			}else if ($class_type == 4){
			$class_type_name = "Group Class III";
			}
			
			//********************************************************************************************	
			//**********************************Termina edición SVI***************************************
			//********************************************************************************************
			  $sum += $row_sum;
			  $taught += $row_taught;
			  
			  
				print "<tr>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td bgcolor='" . $bg ."' width='100'>". $dates . "</td>";
				$dates = "";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
			
				print "<td bgcolor='" . $bg ."'>" . $row2['hours']."</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td bgcolor='" . $bg ."'>" . $row2["name"] . "</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td bgcolor='" . $bg ."'>" . $class_type_name . "</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td align='center' bgcolor='" . $bg ."'>". $total_taught . "</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				
			//late student cancelation-Raft's modification
				
			
				print "<td align='center' bgcolor='" . $bg ."'>". $total_noshow . "</td>";
				

				/*rafael modification*/
				/*print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
					print "<td align='center' bgcolor='" . $bg ."'>". $total_noshow . "</td>";*/
			
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td align='center' bgcolor='" . $bg ."'>". $total_makeup . "</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td align='center' bgcolor='" . $bg ."'>" . $row_taught . "</td>";
				
				
			
				
				
				/*rafael modification*/
				/*print "<td align='center' bgcolor='" . $bg ."'>". DameFechas($row2['id'],$_REQUEST['fromday'],$_REQUEST['today'],3,$row2['class_type'], $row2['hours']) . "</td>";*/
				
					/*rafael modification*/
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td align='center' bgcolor='" . $bg ."'>".
				DameFechas($row2['id'],$_REQUEST['fromday'],$_REQUEST['today'],2,$row2['class_type'], $row2['hours']) . "</td>";
				
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				//print "<td align='center' bgcolor='" . $bg ."'>". $total_makeup . "</td>";
				print "<td align='center' bgcolor='" . $bg ."'>". DameFechas($row2['id'],$_REQUEST['fromday'],$_REQUEST['today'],4,$row2['class_type'], $row2['hours']) . "</td>";
				
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				//print "<td align='center' bgcolor='" . $bg ."'>". $total_makeup . "</td>";
				print "<td align='center' bgcolor='" . $bg ."'>".  $supplement_entry . "</td>";
				
				
				
				
			
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
      <td bgcolor="#eeeeee">&nbsp;</td>
      <td bgcolor="#eeeeee">&nbsp;</td>
      <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
      <td bgcolor="#eeeeee" align='center'><font size="-1"><b>Class<br> Taught</b></font>
      <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
      <td bgcolor="#eeeeee" align='center'><font size="-1"><b>Late Student<br />Cancellation</b></font>
      <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
      <td bgcolor="#eeeeee" align='center'><b><font size="-1">Makeup Taught</font><br /><font size="-2">Only preview months</font></b>
      <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
      <td bgcolor="#eeeeee" align='center'><font size="-1"><b>Total<br> Classes</b></font>
      <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
     
      <td bgcolor="#eeeeee" align='center'><font size="-1"><b>Total<br> Photocopies</b></font>
      <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
    </tr>
    
    <?php
                      
		// totals
		$bg = "#ffffff";
		print "<tr class='text'>";
		print "<td class='text' colspan='7' bgcolor='" . $bg ."'><b>Totals for this month:</b></td>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		print "<td class='text' align='center' bgcolor='" . $bg ."'><b>". $all_taught  . "</b></td>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		print "<td class='text' align='center' bgcolor='" . $bg ."'><b>". $all_noshow . "</b></td>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		print "<td class='text' align='center' bgcolor='" . $bg ."'><b>". $all_makeup . "</b></td>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		print "<td class='text' align='center' bgcolor='" . $bg ."'><b>" . $taught . "</b></td>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		
		print "<td class='text' align='center' bgcolor='" . $bg ."'><b>" . $total_supplement . "</b></td>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		print "</tr>";



} else {
			print "<tr>";
			print "<td colspan='16'>Please select a teacher and date range.</td>";
			print "</tr>";
	}               
?> 
                  </table>
    
				  </td>
              </tr>
              
  
  
      
  </form>
                </td>
  </tr>

</html>