<?php //include 'constants.php'?>
<?php //include 'functions.php'?>
<?php //include 'database.php'?>
<?php //include 'authorize.php'?>
<?php include 'includes/constants.php'?>
<?php include 'includes/functions.php'?>
<?php include 'includes/database.php'?>
<?php include 'includes/authorize.php'?>
<?php

  /*
  function DameFechasCancellation($GrupoId,$TeacherId,$fromday,$today,$concept_id)
     {
	 $Resultado = " ";
	 $sql = "select date_format(entry.day, '%d') as day from entry  ";
	 $sql .= "where entry.user_id = " . $TeacherId . " and entry.day >= '" . $fromday . "' and entry.day <= '" . $today . "' and entry.group_id = " . $GrupoId;
	 $sql .= " and entry.concept_id = " . $concept_id . " order by entry.day";
	 
	 //print $sql;
	 
	 //exit;
	 
	 $result = mysql_query($sql) or die("Invalid query: " . mysql_error());
				while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				   $Resultado .= $row['day']. " ";
				   }
	 
	 return $Resultado;			   
	 }
	 */
	
	function DameFechasCancellation2($GrupoId,$fromday,$today,$concept_id)
     {
	 $Resultado = " ";
	 $sqlJBT = "select date_format(entry.day, '%d') as day from entry,groups ";
	 $sqlJBT .= "where entry.day >= '" . $fromday . "' and entry.day <= '" . $today . "' and entry.group_id = " . $GrupoId;
	 $sqlJBT .= " and entry.concept_id = " . $concept_id . " and groups.id = entry.group_id and groups.name REGEXP BINARY '^[ABCDEFGHIJKLMNÑOPQRSTUVWXYZ][ABCDEFGHIJKLMNÑOPQRSTUVWXYZ]' order by entry.day";
	 
	 //print $sqlJBT;
	 
	 //exit;
	 
	 $rsJBT = mysql_query($sqlJBT) or die("Invalid query: " . mysql_error());
				while ($rowJBT = mysql_fetch_array($rsJBT, MYSQL_ASSOC)) {
				   $Resultado .= $rowJBT['day']. " ";
				   }
	 
	 return $Resultado;			   
	 }
	 
	 
	 

/*
if ($_REQUEST['paysheet_id'] != "") {
	$sql = "select observations, changes, total from paysheet where id = " . $_REQUEST['paysheet_id'];
	print $sql;	
	$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	$observations = $row['observations'];
	$changes = $row['changes'];
} else {
	$observations = $_REQUEST['observations'];
	$changes = $_REQUEST['changes'];
}

$sql = "select first, last1, last2 from users where id = " . $_REQUEST['teacher_id'];
$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
$row = mysql_fetch_array($result, MYSQL_ASSOC);
$name = $row['first'] . " " . $row['last1'] . " " . $row['last2'];
*/

?>
<html>
<title>Bills Report</title>
<link href="/css/canterbury.css" type="text/css" rel="stylesheet">
<script>

var da = (document.all) ? 1 : 0; 
var pr = (window.print) ? 1 : 0; 
var mac = (navigator.userAgent.indexOf("Mac") != -1); 

function printThis() { 
	//window.print();
	ImprimirConOpciones();
} 



function ImprimirConOpciones()
{ 
 window.print();
//if (NS) { window.print() ; } else 
//{ 
  //var WebBrowser = "<OBJECT ID=WebBrowser1 WIDTH=0 HEIGHT=0 CLASSID=CLSID:8856F961-340A-11D0-A96B-00C04FD705A2> </OBJECT>"; 
  //document.body.insertAdjacentHTML('beforeEnd', WebBrowser); WebBrowser1.ExecWB(6, 2); 
//}
} 


</script> 

<form method="post" name="myform"> 

 <table width="100%" border="0" cellpadding="10" cellspacing="0" id="body">
        <tr> 
          <td width="100%" valign="top"> <p><b>
          <font size="3"><?php //echo $name?>  <?php echo  'BILLS REPORT '.substr($_REQUEST['fromday'],0,6)  ?></font></b>
          		<div align="right">  <input type="button" onClick="javascript:printThis();" value="Print"></div><br><br>
              <table border="0" cellpadding="1" cellspacing="0" bgcolor="#CCCCCC" id="border" width="100%">
                <tr> 
                  <td>
                  <table border="0" cellpadding="2" cellspacing="0" bgcolor="#FFFFFF" id="listing" width="100%">
                      <tr>
                      	<!--<td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Dates</b></font></td>--->
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Length</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Client</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee" align='center'><font size="-1"><b>Class<br> Taught</b></font>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee" align='center'><font size="-1"><b>Student<br> Noshow</b></font>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee" align='center'><font size="-1"><b>Student<br> Cancellation</b></font>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        	<!--<td bgcolor="#eeeeee" align='center'><font size="-1"><b>Total<br> Classes</b></font>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>-->
                        	<!--<td bgcolor="#eeeeee" align='center'><font size="-1"><b>Rate</b></font>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>-->
						  <td bgcolor="#eeeeee" align='center'><font size="-1"><b>Status</b></font>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
												<td bgcolor="#eeeeee" align='center'><font size="-1"><b>Total</b></font>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
						<!--<td bgcolor="#eeeeee" align='center'><font size="-1"><b>Student<br> Cancellation</b></font>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>-->
						<td bgcolor="#eeeeee" align='center'><font size="-1"><b>Teacher<br> Cancellation</b></font>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
						<td bgcolor="#eeeeee" align='center'><font size="-1"><b>Makeup<br> Taught</b></font>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                      </tr>

<?php

//if (($_REQUEST['teacher_id'] != "") && ($_REQUEST['fromday'] != "")) {
   $NumeroDeRegistros=0;
   $Inicio=$_REQUEST['inicio'];
   $Fin=$_REQUEST['fin'];

 if ($_REQUEST['fromday'] != "") {


	$sum = 0;
	$taught = 0;
	/*
	$sql2 = "select b.id, hours, name, b.id as group_id, a.class_type from entry a, groups b ";
	$sql2 .= "where a.group_id = b.id and a.user_id = " . $_REQUEST['teacher_id'] . " and day >= '" . $_REQUEST['fromday'] . "' and day <= '" . $_REQUEST['today'] . "' ";
	$sql2 .= " and ( concept_id = 1 or concept_id = 3 or concept_id = 5) group by b.id, hours, a.class_type  order by day asc, hours asc";
	*/
	
	$sql2 = "select b.id, hours, name, b.id as group_id, a.class_type from entry a, groups b ";
	$sql2 .= "where a.group_id = b.id and day >= '" . $_REQUEST['fromday'] . "' and day <= '" . $_REQUEST['today'] . "' ";
	$sql2 .= "and b.name REGEXP BINARY '^[ABCDEFGHIJKLMNÑOPQRSTUVWXYZ][ABCDEFGHIJKLMNÑOPQRSTUVWXYZ]' and ( concept_id = 1 or concept_id = 3) group by b.id, hours, a.class_type  order by b.name,day asc, hours asc";
    
	
	
	$result2= mysql_query($sql2) or die("Invalid query: " . mysql_error());
	$numRows = mysql_NumRows($result2);
	
	$all_taught = 0;
	$all_noshow = 0;
	$all_makeup = 0;
	
	if ($numRows > 0) {
		while ($row2 = mysql_fetch_array($result2, MYSQL_ASSOC)) {
		        
				$NumeroRegistros=$NumeroRegistros+1;
				
				if($NumeroRegistros>=$Inicio && $NumeroRegistros<=$Fin)
                { 
				/*
				$sql = "select b.id, date_format(day, '%d') as day, name, observations, hours, concept_id, supplement, a.class_type from entry a, groups b ";
				$sql .= "where a.group_id = b.id and a.user_id = " . $_REQUEST['teacher_id'] . " and day >= '" . $_REQUEST['fromday'] . "' and day <= '" . $_REQUEST['today'] . "' and b.id = " . $row2['id'] . " and hours = " . $row2['hours'] . " and a.class_type = " . $row2['class_type'];
				$sql .= " and ( concept_id = 1 or concept_id = 3 or concept_id = 5) order by day";
				*/
			    
				$sql = "select b.id, date_format(day, '%d') as day, name, observations, hours, concept_id, supplement, a.class_type, a.paysheet_id as id_hoja from entry a, groups b ";
				$sql .= "where a.group_id = b.id and day >= '" . $_REQUEST['fromday'] . "' and day <= '" . $_REQUEST['today'] . "' and b.id = " . $row2['id'] . " and hours = " . $row2['hours'] . " and a.class_type = " . $row2['class_type'];
				$sql .= " and b.name REGEXP BINARY '^[ABCDEFGHIJKLMNÑOPQRSTUVWXYZ][ABCDEFGHIJKLMNÑOPQRSTUVWXYZ]' and ( concept_id = 1 or concept_id = 3) order by day";
				
				
				//print $sql;
				
				$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
				$total_taught = 0;
				$total_noshow = 0;
				$total_makeup = 0;
				$total_student_cancellation = 0;
				$total_teacher_cancellation = 0;
				$dates = "";
				//$dates_student_cancellation = "";
				//$dates_teacher_cancellation = "";
				
				//print '**************************';
				
				$row_sum = 0;
				$row_taught = 0;
				//print '@@@@@@';
				$IdsHojasDePago = '';
				while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
					//print '###';
					$supplement = $row['supplement'];
				    $class_type = $row['class_type'];
					$dates .=  $row['day'] . " ";
					$IdsHojasDePago .= $row['id_hoja'];
					
					$sql = "select price from prices where type = " . $class_type .  " and hours = " . $row['hours'];
					
					//print '--------------->              '.$sql;
					
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
					
					/*
					if ($row['concept_id'] == 5) {
						$total_makeup += 1;
						$all_makeup += 1;
						$makeup_sum = $row3['price'] + $supplement;
						$row_sum += $makeup_sum;
						$row_taught += 1;
					} else {
						$hours = "";
					}
					*/
					
					
					if ($row['concept_id'] == 2) {
						$total_student_cancellation += 1;
						$dates_student_cancellation .=  $row['day']. " ";
					} else {
						$hours = "";
					}
						/*
					if ($row['concept_id'] == 4) {
						$total_teacher_cancellation += 1;
						$dates_teacher_cancellation .=  $row['day']. " ";
					} else {
						$hours = "";	
					}
					*/
				}
				
			  $sum += $row_sum;
			  $taught += $row_taught;
				print "<tr>";
				/*
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td bgcolor='" . $bg ."' width='100'>". $dates . "</td>";
				*/
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td bgcolor='" . $bg ."'>" . $row2['hours']."</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td bgcolor='" . $bg ."'>" . $row2["name"] . "</td>";//. $row2["id"].' '
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				/*
				print "<td align='center' bgcolor='" . $bg ."'>". $total_taught . "</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td align='center' bgcolor='" . $bg ."'>". $total_noshow . "</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				1 Class Taught 0 
      			2 Student Cancellation 0 
      			3 Student No-show 0 
      			4 Teacher Cancellation 0 
      			5 Makeup Class Taught 0 
      			6 Admin - Cancel out an untaught class 1 
      			7 Admin - Give the client an extra class 1 
				*/
				print "<td align='center' bgcolor='" . $bg ."'>". DameFechasCancellation2($row2['id'],$_REQUEST['fromday'],$_REQUEST['today'],1) .  "</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td align='center' bgcolor='" . $bg ."'>". DameFechasCancellation2($row2['id'],$_REQUEST['fromday'],$_REQUEST['today'],3) .  "</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				/*
				print "<td align='center' bgcolor='" . $bg ."'>". $total_makeup . "</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				*/
				//print "<td align='center' bgcolor='" . $bg ."'>" . $row_taught . "</td>";DameFechasCancellation2($row2['id'],$_REQUEST['fromday'],$_REQUEST['today'],2)
				print "<td align='center' bgcolor='" . $bg ."'>" . DameFechasCancellation2($row2['id'],$_REQUEST['fromday'],$_REQUEST['today'],2) . "</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				/*
				print "<td align='center' bgcolor='" . $bg ."'>" . ($row3['price'] + $supplement) . "</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";*/
				if ($IdsHojasDePago == '') {  
				  print "<td align='center' bgcolor='" . $bg ."'>X</td>";
			 	  print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				}
				else {
				  print "<td align='center' bgcolor='" . $bg ."'>ok</td>";
			 	  print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				}
				//print "<td align='center' bgcolor='" . $bg ."'>" . $row_sum . "</td>";
				//print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td align='center' bgcolor='" . $bg ."'>" . ($total_taught + $total_noshow + $total_student_cancellation) . "</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				/*
				print "<td align='center' bgcolor='" . $bg ."'>" . DameFechasCancellation2($row2['id'],$_REQUEST['fromday'],$_REQUEST['today'],2)  . "</td>"; //DameFechasCancellation2($row2['id'],$_REQUEST['fromday'],$_REQUEST['today'],2)
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				*/
				print "<td align='center' bgcolor='" . $bg ."'>" . DameFechasCancellation2($row2['id'],$_REQUEST['fromday'],$_REQUEST['today'],4) . "</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td align='center' bgcolor='" . $bg ."'>" . DameFechasCancellation2($row2['id'],$_REQUEST['fromday'],$_REQUEST['today'],5) . "</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
			    
				}//if($NumeroRegistros>=$Inicio && $NumeroRegistros<=$Fin)
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
      <td bgcolor="#eeeeee" align='center'><font size="-1"><b>Student<br> Noshow</b></font>
      <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
      <!--<td bgcolor="#eeeeee" align='center'><font size="-1"><b>Makeup<br> Taught</b></font>
      <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>-->
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
		/*
		print "<td class='text' align='center' bgcolor='" . $bg ."'><b>". $all_makeup . "</b></td>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		*/
		print "<td class='text' align='center' bgcolor='" . $bg ."'><b>" . $taught . "</b></td>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		print "<td class='text' align='center' bgcolor='" . $bg ."'><b>" . $sum . "</b></td>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		print "</tr>";



} else {
			print "<tr>";
			print "<td colspan='16'>Please select a date range.</td>";
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
			<td class='text' align="center"><b><?php echo ($sum + $changes)?></b></font></td>
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
