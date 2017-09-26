<?php include '../../includes/constants.php'?>
<?php include '../../includes/functions.php'?>
<?php include '../../includes/database.php'?>
<?php include '../../includes/authorize.php'?>
<?php include 'running_total.php'?>
<?php

$group_id = $_REQUEST['group_id'];

$sql = "select id, name from groups order by name";
$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
$groups .= "<option value='0'>Select client group....</option>";
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	if ($_REQUEST['group_id'] == $row['id']) {
		$selected = "selected";
	} else {
		$selected = "";
	}
	
	$groups .= "<option " . $selected . " value='" . $row['id'] . "'>" . $row['name'] . "</option>";
}

$month = $_REQUEST['month'];

if ($month == "") {
	$month = (int) date('n', time());
}

$year = $_REQUEST['year'];
if ($year == "") {
	$year = (int) date('Y', time());
}

for ($j=2004; $j < 2015; $j++) {
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


//print $fromday . "-" . $today;



$page_name = "client report";
?>
<?php include '../../includes/top.php'?>
<script>
		function sel() {
			document.forms.myform.submit();
		}
</script>
 <table width="100%" border="0" cellpadding="10" cellspacing="0" id="body">
        <tr> 
          <td width="100%" valign="top"> <p><b>Client Report<br>
          
          		<form method="post" name="myform">
							<select name="group_id" onChange="javascript:sel()"><?php echo  $groups; ?></select><br><br>
							<select name="month" onChange="javascript:sel()"><?php echo  $months; ?></select>
							<select name="year" onChange="javascript:sel()"><?php echo  $years; ?></select><br><br>
              <table border="0" cellpadding="1" cellspacing="0" bgcolor="#CCCCCC" id="border" width="100%">
                <tr> 
                  <td>
                  <table border="0" cellpadding="2" cellspacing="0" bgcolor="#FFFFFF" id="listing" width="100%">
                      <tr>
                      	<td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Date</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Client</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Observations</b></font>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee" align='center'><font size="-1"><b>Class Taught</b></font>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee" align='center'><font size="-1"><b>Student Cancel</b></font>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee" align='center'><font size="-1"><b>Student Noshow</b></font>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee" align='center'><font size="-1"><b>Teacher Cancellation</b></font>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee" align='center'><font size="-1"><b>Makeup Taught</b></font>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee" align='center'><font size="-1"><b>Admin Class Cancelout</b></font>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee" align='center'><font size="-1"><b>Admin Class Giveout</b></font>
                        </td>
                      </tr>

<?php
if ($_REQUEST['group_id'] != "") {
	
	if ($year != "") {
		$days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
		
		$fromday = $year . "-" . $month . "-01";
		$today = $year . "-" . $month . "-" . $days;
	}
			
	// totals
	$bg = "#0033CC";
	print "<tr class='textW'>";
	print "<td class='textW' colspan='20' bgcolor='" . $bg ."'><b>Running total from previous months: " . getRunningTotal($fromday, $group_id) . " </b></td>";
	print "</tr>";

	for ($x=0; $x<3; $x++) {
		
		if ($year != "") {
			$days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
			
			$fromday = $year . "-" . $month . "-01";
			$today = $year . "-" . $month . "-" . $days;
		}

		$sql = "select b.id, day, name, observations, hours, concept_id from entry a, groups b where a.group_id = b.id and group_id = " . $_REQUEST['group_id'] . " and day >= '" . $fromday . "' and day <= '" . $today . "' order by day asc";
		//print $sql;
		$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
		$numRows = mysqli_num_rows($result);
		
		$total_taught = 0;
		$total_student_cancel = 0;
		$total_noshow = 0;
		$total_teacher_cancel = 0;
		$total_makeup = 0;
		$total_cancelout = 0;
		$total_giveout = 0;

		if ($numRows > 0) {
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				
				if ($bg == "#FFFFFF") {
					$bg = "#B6C5F2";
				} else {
					$bg = "#FFFFFF";
				}
				
				print "<tr>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td bgcolor='" . $bg ."' nowrap>". $row['day'] . "</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td bgcolor='" . $bg ."'><a href='/profesores/admin/clients/client_profile.php?id=" . $row['id'] . "'>" . $row["name"] . "</a></td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				print "<td bgcolor='" . $bg ."'>" . $row["observations"] . "</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				
				if ($row['concept_id'] == 1) {
					$hours = $row['hours'];
					$total_taught += $row['hours'];
				} else {
					$hours = "";
				}
				print "<td align='center' bgcolor='" . $bg ."'>". $hours . "</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				
				if ($row['concept_id'] == 2) {
					$hours = $row['hours'];
					$total_student_cancel += $row['hours'];
				} else {
					$hours = "";
				}
				print "<td align='center' bgcolor='" . $bg ."'>". $hours . "</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				
				if ($row['concept_id'] == 3) {
					$hours = $row['hours'];
					$total_noshow += $row['hours'];
				} else {
					$hours = "";
				}
				print "<td align='center' bgcolor='" . $bg ."'>". $hours . "</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				
				if ($row['concept_id'] == 4) {
					$hours = $row['hours'];
					$total_teacher_cancel += $row['hours'];
				} else {
					$hours = "";
				}
				print "<td align='center' bgcolor='" . $bg ."'>". $hours . "</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				
				if ($row['concept_id'] == 5) {
					$hours = $row['hours'];
					$total_makeup += $row['hours'];
				} else {
					$hours = "";
				}
				print "<td align='center' bgcolor='" . $bg ."'>". $hours . "</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				
				if ($row['concept_id'] == 6) {
					$hours = $row['hours'];
					$total_cancelout += $row['hours'];
				} else {
					$hours = "";
				}
				print "<td align='center' bgcolor='" . $bg ."'>". $hours . "</td>";
				print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
				
				if ($row['concept_id'] == 7) {
					$hours = $row['hours'];
					$total_giveout += $row['hours'];
				} else {
					$hours = "";
				}
				print "<td align='center' bgcolor='" . $bg ."'>". $hours . "</td>";
				print "</tr>";
			}

	                      
			// totals
			$bg = "#0033CC";
			print "<tr class='textW'>";
			print "<td class='textW' colspan='7' bgcolor='" . $bg ."'><b>Totals for " . date('F', strtotime($year . '-' . $month . '-' . 1)) . " " . $year . ":</b></td>";
			
			print "<td class='textW' align='center' bgcolor='" . $bg ."'><b>". $total_taught  . "</b></td>";
			print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
			print "<td class='textW' align='center' bgcolor='" . $bg ."'><b>". $total_student_cancel . "</b></td>";
			print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
			print "<td class='textW' align='center' bgcolor='" . $bg ."'><b>". $total_noshow . "</b></td>";
			print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
			print "<td class='textW' align='center' bgcolor='" . $bg ."'><b>". $total_teacher_cancel . "</b></td>";
			print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
			print "<td class='textW' align='center' bgcolor='" . $bg ."'><b>". $total_makeup . "</b></td>";
			print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
			print "<td class='textW' align='center' bgcolor='" . $bg ."'><b>". $total_cancelout . "</b></td>";
			print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
			print "<td class='textW' align='center' bgcolor='" . $bg ."'><b>". $total_giveout . "</b></td>";
			print "</tr>";
			

			if ($month == 12) {
				$t_year = $year + 1;
				$t_month = 1;
			} else {
				$t_year = $year;
				$t_month = $month + 1;
			}
			$bg = "#0033CC";
			print "<tr class='textW'>";
			print "<td class='textW' colspan='20' bgcolor='" . $bg ."'><b>Running total after " . date('F', strtotime($year . '-' . $month . '-' . 1)) . " " . $year . ": " . getRunningTotal($t_year . "-" . $t_month . "-01", $group_id) . " </b></td>";
	
				
			print "<tr><td colspan='20' bgcolor='cccccc'>&nbsp;</td></tr>";
			
		} else {
			
				print "<tr>";
				print "<td colspan='12'>There are no entries for " . date('F', strtotime($year . '-' . $month . '-' . 1)) . " " . $year . ".</td>";
				print "</tr>";
		}
		if ($month == 12) {
				$year++;
				$month = 1;
			} else {
				$month++;
			}
			
	}
} else {
			print "<tr>";
			print "<td colspan='12'>Please select a client group and date range.</td>";
			print "</tr>";
	}               
?> 

                  </table>
    
    						</td>
              </tr>
            </table>
           </form>
                </td>
  </tr>
</table>
<?php include 'includes/foot.php'?>