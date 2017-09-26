<?php include 'constants.php'?>
<?php include 'functions.php'?>
<?php include 'database.php'?>
<?php include 'authorize.php'?>
<?php include 'running_total.php'?>
<?php



if ($_REQUEST['act'] == "Close month") {
	$sql = "insert into paysheet (user_id, day, observations, changes, total) values (" . $_REQUEST['teacher_id'] . ",'" . $_REQUEST['fromday'] . "', '" . $_REQUEST['observations'] . "', " . $_REQUEST['changes'] . ", " . ($_REQUEST['sum'] + $_REQUEST['changes']) . ")";
	//print $sql;
	$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
	$theid = mysql_insert_id();

	$sql = "update entry set paysheet_id = " . $theid . " where day >= '" . $_REQUEST['fromday'] . "' and day <= '" . $_REQUEST['today'] . "' and user_id = " . $_REQUEST['teacher_id'];
	//print $sql;
	mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
}


$sql = "select id, first, last1, last2, user_id from users where is_active=1 order by last1";
$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
$teachers .= "<option value='0'>Select teacher....</option>";
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	if ($_POST['teacher_id'] == $row['id']) {
		$selected = "selected";
	} else {
		$selected = "";
	}
	
	$teachers .= "<option " . $selected . " value='" . $row['id'] . "'>" . $row['last1'] . " " . $row['last2'] . ", " . $row['first'] . "</option>";
}

$month = $_REQUEST['month'];

if ($month == "") {
	$month = (int) date('n', time());
}

$year = $_REQUEST['year'];
if ($year == "") {
	$year = (int) date('Y', time());
}

for ($j=2004; $j < 2010; $j++) {
	if ($year == $j) {
		$selected = "selected";
	} else {
		$selected = "";
	}
	$years .= "<option " . $selected . " value='" . $j . "'>" . $j . "</option>";
}

for ($i=1; $i <= 12; $i++) {
	if ($month == $i) {
		$selected = "selected";
	} else {
		$selected = "";
	}
	
	$spelled = date('F', strtotime($j . '-' . $i . '-' . 1));
	$months .= "<option " . $selected . " value='" . $i . "'>" . $spelled . "</option>";
}



if ($year != "") {
	$days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
	
	$fromday = $year . "-" . $month . "-01";
	$today = $year . "-" . $month . "-" . $days;
}


//print $fromday . "-" . $today;
$page_name = "paysheet";
?>

<?php include 'top.php'?>
<?php include 'menu.php'?>
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
		document.forms.myform.action="print_teacher.php";
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
 <table width="100%" border="0" cellpadding="10" cellspacing="0" id="body">
        <tr> 
          <td width="100%" valign="top"> <p><b>Paysheet<br><br>

							<select name="teacher_id" onChange="javascript:sel()"><?php echo  $teachers; ?></select><br><br>
							<select name="month" onChange="javascript:sel()"><?php echo  $months; ?></select>
							<select name="year" onChange="javascript:sel()"><?php echo  $years; ?></select><br><br>
              <table border="0" cellpadding="1" cellspacing="0" bgcolor="#CCCCCC" id="border" width="100%">
                <tr> 
                  <td>
                  <table border="0" cellpadding="2" cellspacing="0" bgcolor="#FFFFFF" id="listing" width="100%">
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
                      </tr>

<?php

if (($_REQUEST['teacher_id'] != "") && ($fromday != "")) {
	$sql = "select * from paysheet where day = '" . $fromday . "' and user_id = " . $_REQUEST['teacher_id'];
	$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$paysheet_id = $row['id'];
	$observations = $row['observations'];
	$changes = $row['changes'];
	$total = $row['total'];
	
	
	$sum = 0;
	$taught = 0;
	$sql2 = "select b.id, hours, name, b.id as group_id, a.class_type from entry a, groups b ";
	$sql2 .= "where a.group_id = b.id and a.user_id = " . $_REQUEST['teacher_id'] . " and day >= '" . $fromday . "' and day <= '" . $today . "' ";
	$sql2 .= " and ( concept_id = 1 or concept_id = 3 or concept_id = 5) group by b.id, hours, a.class_type  order by day asc, hours asc";
	//print $sql;
	$result2= mysqli_query($link, $sql2) or die("Invalid query: " . mysqli_error($link));
	$numRows = mysqli_num_rows($result2);
	
	$all_taught = 0;
	$all_noshow = 0;
	$all_makeup = 0;
	
	if ($numRows > 0) {
		while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
			
				$sql = "select b.id, date_format(day, '%d') as day, name, observations, hours, concept_id, a.class_type, supplement from entry a, groups b ";
				$sql .= "where a.group_id = b.id and a.user_id = " . $_REQUEST['teacher_id'] . " and day >= '" . $fromday . "' and day <= '" . $today . "' and b.id = " . $row2['id'] . " and hours = " . $row2['hours'] . " and a.class_type = " . $row2['class_type'];
				$sql .= " and ( concept_id = 1 or concept_id = 3 or concept_id = 5) order by day";
				//print $sql;
				$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
				$total_taught = 0;
				$total_noshow = 0;
				$total_makeup = 0;
				$dates = "";
				
				$row_sum = 0;
				$row_taught = 0;
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					$dates .=  $row['day'] . " ";
					$supplement = $row['supplement'];
					$sql = "select price from prices where type = " . $row['class_type'] .  " and hours = " . $row['hours'];
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
				
			  $sum += $row_sum;
			  $taught += $row_taught;
				print "<tr>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td bgcolor='" . $bg ."' width='100' style=\"cursor:hand\" onClick='javascript:details(\"detail.php?fromday=". $fromday . "&today=" . $today . "&group_id=" . $row2['id'] . "&teacher_id=" .$_POST['teacher_id'] . "&hours=" .$row2['hours'] . "&class_type=" . $row2['class_type'] . "\");' target='_new'>". $dates . "</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td bgcolor='" . $bg ."'>" . $row2['hours']."</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				
				$running = getRunningTotal($fromday, $row2['id']);
				if ($running == 0) {
						print "<td bgcolor='" . $bg ."' align=\"center\">ok</td>";
				} else {
						print "<td bgcolor='" . $bg ."' align=\"center\"><a href=\"client.php?group_id=" . $row2['id'] . "&month=" . $month . "&year=" . $year . "\"><font color=\"#ff9900\"><b>" . $running . "</b></font></a></td>";
				}
				
			
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td bgcolor='" . $bg ."'><a href='/admin/clients/group_profile.php?id=" . $row2['id'] . "'>" . $row2["name"] . "</a></td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td align='center' bgcolor='" . $bg ."'>". $total_taught . "</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td align='center' bgcolor='" . $bg ."'>". $total_noshow . "</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td align='center' bgcolor='" . $bg ."'>". $total_makeup . "</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td align='center' bgcolor='" . $bg ."'>" . $row_taught . "</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td align='center' bgcolor='" . $bg ."'>" . $row_sum . "</td>";
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
      <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
      <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
      <td bgcolor="#eeeeee" align='center'><font size="-1"><b>Class<br> Taught</b></font>
      <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
      <td bgcolor="#eeeeee" align='center'><font size="-1"><b>Student<br> Noshow</b></font>
      <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
      <td bgcolor="#eeeeee" align='center'><font size="-1"><b>Makeup<br> Taught</b></font>
      <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
      <td bgcolor="#eeeeee" align='center'><font size="-1"><b>Total<br> Classes</b></font>
      <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
      <td bgcolor="#eeeeee" align='center'><font size="-1"><b>Total<br> Sum</b></font>
      <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
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
            </table>
<?php
if (($_REQUEST['teacher_id'] != "") && ($fromday != "")) {
?>	   
         
<br>            
    <?php
    	if ($paysheet_id == "") {
    ?>
    <table border="0" cellpadding="5" cellspacing="0" width="100%">
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
<?php include 'foot.php'?>
