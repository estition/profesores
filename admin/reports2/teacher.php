<?php //include 'constants.php'?>
<?php //include 'functions.php'?>
<?php //include 'database.php'?>
<?php //include 'authorize.php'?>
<?php //include 'running_total.php'?>
<?php include 'includes/constants.php'?>
<?php include 'includes/functions.php'?>
<?php include 'includes/database.php'?>
<?php include 'includes/authorize.php'?>
<?php include 'running_total.php'?>
<?php


function DameFechas($GrupoId,$fromday,$today,$concept_id)
     {
	 $Resultado = " ";
	 $sqlJBT = "select date_format(entry.day, '%d') as day from entry,groups ";
	 $sqlJBT .= "where entry.day >= '" . $fromday . "' and entry.day <= '" . $today . "' and entry.group_id = " . $GrupoId;
	 $sqlJBT .= " and entry.concept_id = " . $concept_id . " and groups.id = entry.group_id order by entry.day";
	 $sqlJBT .= " and groups.name REGEXP BINARY '^[ABCDEFGHIJKLMNÑOPQRSTUVWXYZ][ABCDEFGHIJKLMNÑOPQRSTUVWXYZ]'";
	 //print $sqlJBT;
	 
	 //exit;
	 
	 $rsJBT = mysql_query($sqlJBT) or die("Invalid query: " . mysql_error());
				while ($rowJBT = mysql_fetch_array($rsJBT, MYSQL_ASSOC)) {
				   $Resultado .= $rowJBT['day']. " ";
				   }
	 
	 return $Resultado;			   
	 }

/* antes jbt
if ($_REQUEST['act'] == "Close month") {
	$sql = "insert into paysheet (user_id, day, observations, changes, total) values (" . $_REQUEST['teacher_id'] . ",'" . $_REQUEST['fromday'] . "', '" . $_REQUEST['observations'] . "', " . $_REQUEST['changes'] . ", " . ($_REQUEST['sum'] + $_REQUEST['changes']) . ")";
	//print $sql;
	$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
	$theid = mysql_insert_id();

	$sql = "update entry set paysheet_id = " . $theid . " where day >= '" . $_REQUEST['fromday'] . "' and day <= '" . $_REQUEST['today'] . "' and user_id = " . $_REQUEST['teacher_id'];
	//print $sql;
	mysql_query($sql) or die("Invalid query: " . mysql_error());
}
*/

/* antes jbt
$sql = "select id, first, last1, last2, user_id from users where is_active=1 order by last1";
$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
$teachers .= "<option value='0'>Select teacher....</option>";
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	if ($_POST['teacher_id'] == $row['id']) {
		$selected = "selected";
	} else {
		$selected = "";
	}
	
	$teachers .= "<option " . $selected . " value='" . $row['id'] . "'>" . $row['last1'] . " " . $row['last2'] . ", " . $row['first'] . "</option>";
}
*/


$month = $_REQUEST['month'];

/*
if ($month == "") {
	$month = (int) date('n', time());
}*/

$year = $_REQUEST['year'];

/*
if ($year == "") {
	$year = (int) date('Y', time());
}*/

$years .= "<option selected value=''></option>"; //Yo incluir uno vacio
for ($j=2012; $j <= 2040; $j++) {
	/*
	if ($year == $j) {
		$selected = "selected";
	} else {
		$selected = "";
	}
	*/
	$years .= "<option " . $selected . " value='" . $j . "'>" . $j . "</option>";
}

$months .= "<option selected value=''></option>"; //Yo incluir uno vacio
for ($i=1; $i <= 12; $i++) {
	/*
	if ($month == $i) {
		$selected = "selected";
	} else {
		$selected = "";
	}
	*/
	$spelled = date('F', strtotime($j . '-' . $i . '-' . 1));
	$months .= "<option " . $selected . " value='" . $i . "'>" . $spelled . "</option>";
	$Meses[$i] = $spelled; 
}



if ($year != "") {
	if (!function_exists('cal_days_in_month')) 
{ 
    function cal_days_in_month($calendar, $month, $year) 
    { 
        return date('t', mktime(0, 0, 0, $month, 1, $year)); 
    } 
} 
if (!defined('CAL_GREGORIAN')) 
    define('CAL_GREGORIAN', 1); 
	$days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
	
	$fromday = $year . "-" . $month . "-01";
	$today = $year . "-" . $month . "-" . $days;
}


//print $fromday . "-" . $today;
$page_name = "paysheet2";
?>
<?php include '../../includes/top.php'?>

<div style="position: relative;" align="center"> 
<script>
		function sel() {
			document.forms.myform.submit();
		}
		
	function details(url) {
		window.open(url, "Details", "width=600, height=300, location=no, menubar=no, status=no, toolbar=no, scrollbars=yes, resizable=yes");
	}
	
	function printWindow() {
		thewindow = window.open("", "Print", "width=600, height=600, location=no, menubar=no, status=no, toolbar=no, scrollbars=yes, resizable=yes");
		document.forms.myform.target="Print";
		document.forms.myform.action="print_teacher.php?inicio=1&fin=300";
		document.forms.myform.submit();
		document.forms.myform.target="";
		document.forms.myform.action="";
		
		thewindow.focus();
	}
	
	function printWindow1() {
		thewindow = window.open("", "Print", "width=600, height=600, location=no, menubar=no, status=no, toolbar=no, scrollbars=yes, resizable=yes");
		document.forms.myform.target="Print";
		document.forms.myform.action="print_teacher.php?inicio=1&fin=70";
		document.forms.myform.submit();
		document.forms.myform.target="";
		document.forms.myform.action="";
		
		thewindow.focus();
	}
	
	function printWindow2() {
		thewindow = window.open("", "Print", "width=600, height=600, location=no, menubar=no, status=no, toolbar=no, scrollbars=yes, resizable=yes");
		document.forms.myform.target="Print";
		document.forms.myform.action="print_teacher.php?inicio=72&fin=200";
		document.forms.myform.submit();
		document.forms.myform.target="";
		document.forms.myform.action="";
		
		thewindow.focus();
	}
</script>



<form method="post" name="myform" id="myform" action="">
<input type="hidden" name="fromday" value="<?php echo $fromday?>">
<input type="hidden" name="today" value="<?php echo $today?>">
<input type="hidden" name="paysheet_id" value="<?php echo $paysheet_id?>">
<input type="hidden" name="month" value="<?php echo $month?>">
<input type="hidden" name="year" value="<?php echo $year?>">
 <table  class="pepe" width="100%" border="0" cellpadding="10" align="center" cellspacing="5" id="body">
        <tr> 
          <td width="100%"  align="center" cellpadding="10" cellspacing="5" valign="top"> <p><b>Bill Report<br><br>

							<!-- onChange="javascript:sel()"onChange="javascript:sel()"<select name="teacher_id" onChange="javascript:sel()"><?php //echo  $teachers; ?></select><br><br> -->
							<select name="month" ><?php echo  $months; ?></select>
							<select name="year" ><?php echo  $years; ?></select>
							<input type="button" name="Ok" value="Ok" onClick="javascript:sel()"><br><br>
              <table class="pepe" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#CCCCCC" id="border" width="100%">
                <tr> 
                  <td>
                  <table border="0" cellpadding="1" align="center" cellspacing="0" bgcolor="#CCCCCC" id="border" width="100%">
                      <tr>
                      	<td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Dates</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Length</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1" align="center"><b>Status</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Client</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee" align='center'><font size="-1"><b>Class<br> Taught</b></font>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee" align='center'><font size="-1"><b>Student<br> Noshow</b></font>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee" align='center'><font size="-1"><b>Makeup<br> Taught</b></font>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        	<td bgcolor="#eeeeee" align='center'><font size="-1"><b>Total<br> Classes</b></font>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
												<td bgcolor="#eeeeee" align='center'><font size="-1"><b>Total</b></font>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
						<td bgcolor="#eeeeee" align='center'><font size="-1"><b>Student<br> Cancelation</b></font>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
						<td bgcolor="#eeeeee" align='center'><font size="-1"><b>Teacher<br> Cancelation</b></font>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                      </tr>

<?php
//if (($_REQUEST['teacher_id'] != "") && ($fromday != "")) { antes
if (($fromday != "")) {
	//print 'entro';
	$sql = "select * from paysheet where day = '" . $fromday . "'";
	//print $sql; 
	$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	$paysheet_id = $row['id'];
	$observations = $row['observations'];
	$changes = $row['changes'];
	$total = $row['total'];
	
	
	$sum = 0;
	$taught = 0;
	/* antes
	$sql2 = "select b.id, hours, name, b.id as group_id, a.class_type from entry a, groups b ";
	$sql2 .= "where a.group_id = b.id and a.user_id = " . $_REQUEST['teacher_id'] . " and day >= '" . $fromday . "' and day <= '" . $today . "' ";
	$sql2 .= " and ( concept_id = 1 or concept_id = 3 or concept_id = 5) group by b.id, hours, a.class_type  order by day asc, hours asc";
    */
	
	$sql2 = "select b.id, hours, name, b.id as group_id, a.class_type from entry a, groups b ";
	$sql2 .= "where a.group_id = b.id and day >= '" . $fromday . "' and day <= '" . $today . "' and b.name REGEXP BINARY '^[ABCDEFGHIJKLMNÑOPQRSTUVWXYZ][ABCDEFGHIJKLMNÑOPQRSTUVWXYZ]' ";
	$sql2 .= " and ( concept_id = 1 or concept_id = 3) group by b.id, hours, a.class_type order by b.name asc, day asc, hours asc";
	//print $sql;
	$result2= mysql_query($sql2) or die("Invalid query: " . mysql_error());
	$numRows = mysql_NumRows($result2);
	
	$all_taught = 0;
	$all_noshow = 0;
	$all_makeup = 0;
	
	if ($numRows > 0) {
		while ($row2 = mysql_fetch_array($result2, MYSQL_ASSOC)) {
			    
				/*
				$sql = "select b.id, date_format(day, '%d') as day, name, observations, hours, concept_id, a.class_type, supplement from entry a, groups b ";
				$sql .= "where a.group_id = b.id and a.user_id = " . $_REQUEST['teacher_id'] . " and day >= '" . $fromday . "' and day <= '" . $today . "' and b.id = " . $row2['id'] . " and hours = " . $row2['hours'] . " and a.class_type = " . $row2['class_type'];
				$sql .= " and ( concept_id = 1 or concept_id = 3 or concept_id = 5) order by day";
				*/
				
		$sql = "select b.id, date_format(day, '%d') as day, name, observations, hours, concept_id, a.class_type, supplement, a.paysheet_id as id_hoja from entry a, groups b ";
				$sql .= "where a.group_id = b.id and day >= '" . $fromday . "' and day <= '" . $today . "' and b.id = " . $row2['id'] . " and hours = " . $row2['hours'] . " and a.class_type = " . $row2['class_type'];
				$sql .= " and ( concept_id = 1 or concept_id = 3) and b.name REGEXP BINARY '^[ABCDEFGHIJKLMNÑOPQRSTUVWXYZ][ABCDEFGHIJKLMNÑOPQRSTUVWXYZ]' order by b.name, day";
				
				//print $sql;
				$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
				$total_taught = 0;
				$total_noshow = 0;
				$total_makeup = 0;
				$dates = "";
				
				$row_sum = 0;
				$row_taught = 0;
				$IdsHojasDePago = '';
				while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
					$dates .=  $row['day'] . " ";
					$IdsHojasDePago .= $row['id_hoja'];
					$supplement = $row['supplement'];
					$sql = "select price from prices where type = " . $row['class_type'] .  " and hours = " . $row['hours'];
					$result3 = mysql_query($sql) or die("Invalid query: " . mysql_error());
					$row3 = mysql_fetch_array($result3, MYSQL_ASSOC);
						if ($row['concept_id'] == 1) { //Class Taught 
						$total_taught += 1;
						$all_taught += 1;
						$taught_sum = $row3['price'] + $supplement;
						$row_sum += $taught_sum;
						$row_taught += 1;
					} else {
						$hours = "";
					}
					
					if ($row['concept_id'] == 3) { //Student Nonshow
						$total_noshow += 1;
						$all_noshow += 1;
						$noshow_sum = $row3['price'] + $supplement;
						$row_sum += $noshow_sum;
						$row_taught += 1;
					} else {
						$hours = "";
					}
					
					/*
					if ($row['concept_id'] == 5) { //Makeup Taught
						$total_makeup += 1;
						$all_makeup += 1;
						$makeup_sum = $row3['price'] + $supplement;
						$row_sum += $makeup_sum;
						$row_taught += 1;
					} else {
						$hours = "";
					}*/
				}
				
			  $sum += $row_sum;
			  $taught += $row_taught;
				print "<tr>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td bgcolor='" . $bg ."' width='100' style=\"cursor:hand\" onClick='javascript:details(\"detail.php?fromday=". $fromday . "&today=" . $today . "&group_id=" . $row2['id'] . "&hours=" .$row2['hours'] . "&class_type=" . $row2['class_type'] . "\");' target='_new'>". $dates . "</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td bgcolor='" . $bg ."'>" . $row2['hours']."</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				
				//$running = getRunningTotal($fromday, $row2['id']);
				$blnCerrado = 0; //DameExistePaySheetId
				$running = 0;
				if ($IdsHojasDePago == '') {
						print "<td bgcolor='" . $bg ."' align=\"center\">X</td>";
				} else {
						//print "<td bgcolor='" . $bg ."' align=\"center\"><a href=\"client.php?group_id=" . $row2['id'] . "&month=" . $month . "&year=" . $year . "\"><font color=\"#ff9900\"><b>" . $running . "</b></font></a></td>";
				       print "<td bgcolor='" . $bg ."' align=\"center\">ok</td>";
				}
				
			
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td bgcolor='" . $bg ."'><a href='/admin/clients/group_profile.php?id=" . $row2['id'] . "'>" . $row2['id'] .'-'. $row2["name"] . "</a></td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td align='center' bgcolor='" . $bg ."'>". DameFechas($row2['id'],$_REQUEST['fromday'],$_REQUEST['today'],1) . "</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td align='center' bgcolor='" . $bg ."'>". DameFechas($row2['id'],$_REQUEST['fromday'],$_REQUEST['today'],3) . "</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td align='center' bgcolor='" . $bg ."'>". DameFechas($row2['id'],$_REQUEST['fromday'],$_REQUEST['today'],5) . "</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td align='center' bgcolor='" . $bg ."'>" . $row_taught . "</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td align='center' bgcolor='" . $bg ."'>" . $row_sum . "</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td align='center' bgcolor='" . $bg ."'>". DameFechas($row2['id'],$_REQUEST['fromday'],$_REQUEST['today'],2) . "</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td align='center' bgcolor='" . $bg ."'>". DameFechas($row2['id'],$_REQUEST['fromday'],$_REQUEST['today'],4) . "</td>";
			
		}
		print "<tr><td colspan='13' bgcolor='#cccccc'>&nbsp;</td></tr>";
	} else {
			print "<tr>";
			print "<td colspan='12'>There are no entries for the given teacher and date.</td>";
			print "</tr>";
	}
?>
<?php echo '&nbsp;&nbsp;Bills&nbsp;Report&nbsp;&nbsp;' . $Meses[$_REQUEST['month']] . ' ' . $_REQUEST['year']?>

		<tr>
      <td bgcolor="#cccccc"><font size="-1">&nbsp;</font></td>
      <td bgcolor="#cccccc"><font size="-1">&nbsp;</font></td>
      <td bgcolor="#cccccc"><font size="-1">&nbsp;</font></td>
      <td bgcolor="#cccccc"><font size="-1">&nbsp;</font></td>
      <td bgcolor="#cccccc"><font size="-1">&nbsp;</font></td>
      <td bgcolor="#cccccc"><font size="-1">&nbsp;</font></td>
      <td bgcolor="#cccccc"><font size="-1">&nbsp;</font></td>
      <td bgcolor="#cccccc"><font size="-1">&nbsp;</font></td>
      <td bgcolor="#cccccc"><font size="-1">&nbsp;</font></td>
      <td bgcolor="#cccccc" align='center'><font size="-1"><b>Class<br> Taught</b></font>
      <td bgcolor="#cccccc"><font size="-1">&nbsp;</font></td>
      <td bgcolor="#cccccc" align='center'><font size="-1"><b>Student<br> Noshow</b></font>
      <td bgcolor="#cccccc"><font size="-1">&nbsp;</font></td>
      <td bgcolor="#cccccc" align='center'><font size="-1"><b>Makeup<br> Taught</b></font>
      <td bgcolor="#cccccc"><font size="-1">&nbsp;</font></td>
      <td bgcolor="#cccccc" align='center'><font size="-1"><b>Total<br> Classes</b></font>
      <td bgcolor="#cccccc"><font size="-1">&nbsp;</font></td>
      <td bgcolor="#cccccc" align='center'><font size="-1"><b>Total<br> Sum</b></font>
      <td bgcolor="#cccccc"><font size="-1">&nbsp;</font></td>
    </tr>
    
    <?php
                      
		// totals
		$bg = "#0033CC";
		print "<tr class='textW'>";
		print "<td class='textW' colspan='9' bgcolor='" . $bg ."'><b>Totals for this month:</b></td>";
		
		print "<td class='textW' align='center' bgcolor='" . $bg ."'><b>". $all_taught  . "</b></td>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		print "<td class='textW' align='center' bgcolor='" . $bg ."'><b>". $all_noshow . "</b></td>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		
		print "<td class='textW' align='center' bgcolor='" . $bg ."'><b>". $all_makeup . "</b></td>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		print "<td class='textW' align='center' bgcolor='" . $bg ."'><b>" . $taught . "</b></td>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		print "<td class='textW' align='center' bgcolor='" . $bg ."'><b>" . $sum . "</b></td>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		print "</tr>";

} else {
			print "<tr>";
			print "<td colspan='16'>Please select a date range and press Ok.</td>";
			print "</tr>";
	}               
?> 



                  </table>
    
    						</td>
              </tr>
            </table>
<?php

//if (($_REQUEST['teacher_id'] != "") && ($fromday != "")) {
if ($fromday != "") {
?>	   
         
<br>            
    <?php
    	if ($paysheet_id == "") {
    ?>
    <table  class="pepe" border="0" cellpadding="5" cellspacing="0" width="100%">
  <tr valign="top"> 
    <td colspan="2" bgcolor="#EEEEEE">&nbsp;</td>
  </tr>
  <tr valign="top"> 
    <td bgcolor="#EEEEEE"></td>
    
    <td bgcolor="#FFFFFF">
    <font>
     Close this paysheet</font><br><table border="0" cellpadding="5" cellspacing="0" width="100%">
        <tr><td><b>Changes</b>
        	</td>
        	<td>
        	<input type="text" size="5" name="changes" value="0"> Input changes here, for deduction put in a negative number.
          </td>
        </tr>
        <tr><td>
        	<b>Observations</b>
        	</td>
        	<td>
        	<textarea name="observations" rows="6" cols="60"></textarea>
          </td>
        </tr>
      </table>
     </td>
  </tr>
  <tr valign="top"> 
    <td colspan="2" bgcolor="#eeeeee">&nbsp; </td>
  </tr>
  <tr valign="top" bgcolor="#dddddd"> 
    <td colspan="2" align="center"> <input name="act" type="submit" id="act" value="Close month">
        		<input type="button" onClick="printWindow();" value="Print paysheet">
				<input type="button" onClick="printWindow1();" value="Print paysheet 1/2">
				<input type="button" onClick="printWindow2();" value="Print paysheet 2/2">
      </td>
  </tr>
</table>
    <?php
    
      print "<input type='hidden' name='sum' value='" . $sum . "'>";
  } else {
  ?>
  <table border="0" cellpadding="5" cellspacing="0" width="100%">
  <tr valign="top"> 
  		<td>
              		<b>Changes:</b>
      </td>
      <td>
              			<?php echo $changes?>
              	</td>
              </tr>
  						<tr>
  							<td>
              		<b>Observations:</b>
              	</td>
              	<td>
              			<?php echo $observations?>
              	</td>
              </tr>
              <tr>
  							<td>
              		<b>Total:</b>
              	</td>
              	<td>
              			<?php echo $total?>
              	</td>
              </tr>
  <tr valign="top" bgcolor="#dddddd"> 
    <td colspan="2" align="center"> 
    <input type='hidden' name='paysheet_id' value="<?php echo $paysheet_id?>">
       	<input type="button" onClick="printWindow();" value="Print paysheet">
		<input type="button" onClick="printWindow1();" value="Print paysheet 1/2">
		<input type="button" onClick="printWindow2();" value="Print paysheet 2/2">
      </td>
  </tr>
</table>
  <?php
 
	}
	
	?>

<?php
}
?>  
  
  </form>
                </td>
  </tr>
</table>
</div>  
        
<?php include 'includes/foot.php'?>
