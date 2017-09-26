<?php include '../../includes/constants.php'?>
<?php include '../../includes/functions.php'?>
<?php include '../../includes/database.php'?>
<?php include '../../includes/authorize.php'?>
<html>
	<head>
		<link href="css/canterbury.css" type="text/css" rel="stylesheet">
		<title>Detail</title>
	</head>

<body style="margin: 5px;">
<table width="100%" cellspacing="0" cellpadding="5" border="0">
<tr>
	<td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
	<td bgcolor="#eeeeee"><font size="-1"><b>Day</b></font></td>
	<td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
	<td bgcolor="#eeeeee"><font size="-1"><b>Length</b></font></td>
	<td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
		<td bgcolor="#eeeeee"><font size="-1"><b>Type</b></font></td>
	<td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
	<td bgcolor="#eeeeee"><font size="-1"><b>Price</b></font></td>
	<td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
	<td bgcolor="#eeeeee"><font size="-1"><b>Supplement</b></font></td>
	<td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
	<td bgcolor="#eeeeee" align='center'><font size="-1"><b>Class Taught</b></font>
	<td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
	<td bgcolor="#eeeeee" align='center'><font size="-1"><b>Student Noshow</b></font>
	<td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
		<td bgcolor="#eeeeee" align='center'><font size="-1"><b>Makeup Class Taught</b></font>
	<td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
			<td bgcolor="#eeeeee" align='center'><font size="-1"><b>Sum</b></font>
	<td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
</tr>
<?php

$sql = "select b.id, day, name, observations, hours, concept_id, a.class_type, supplement from entry a, groups b ";
$sql .= "where a.group_id = b.id and a.user_id = " . $_REQUEST['teacher_id'] . " and day >= '" . $_REQUEST['fromday'] . "' and day <= '" . $_REQUEST['today'] . "' and b.id = " . $_REQUEST['group_id'] . " and hours = " . $_REQUEST['hours'] . " and a.class_type = " . $_REQUEST['class_type'];
$sql .= " and ( concept_id = 1 or concept_id = 3 or concept_id = 5)  order by day asc";
$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
$total_taught = 0;
$total_noshow = 0;
$total_teacher_cancel = 0;
$total_makeup = 0;
$total_cancelout = 0;
$total_giveout = 0;

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	$row_sum = 0;
	$supplement = $row['supplement'];
	
	$sql = "select price from prices where type = " . $row['class_type'] .  " and hours = " . $row['hours'];
	//print $sql;
	$result2 = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
	$row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
	
	if ($bg == "#FFFFFF") {
		$bg = "#B6C5F2";
	} else {
		$bg = "#FFFFFF";
	}
	
	print "<tr>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td bgcolor='" . $bg ."' nowrap>". $row['day'] . "</td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td bgcolor='" . $bg ."' nowrap>". $row['hours'] . "</td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td bgcolor='" . $bg ."' nowrap>";
	
	if ($row['class_type'] == 1) {
		print "Ind.";
	} else {
		print "Gr.";
	}

	print "</td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td bgcolor='" . $bg ."' nowrap>". $row2['price'] . "</td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td bgcolor='" . $bg ."' nowrap>". $supplement . "</td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	
	if ($row['concept_id'] == 1) {
		$hours = $row['hours'];
		$total_taught += $row['hours'];
		$row_sum = $row2['price'] + $supplement;
		$sum += $row_sum;
	} else {
		$hours = "";
	}
	print "<td align='center' bgcolor='" . $bg ."'>". $hours . "</td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	
	
	if ($row['concept_id'] == 3) {
		$hours = $row['hours'];
		$total_noshow += $row['hours'];
		$row_sum = $row2['price'] + $supplement;
		$sum += $row_sum;
	} else {
		$hours = "";
	}
	print "<td align='center' bgcolor='" . $bg ."'>". $hours . "</td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	
	
	if ($row['concept_id'] == 5) {
		$hours = $row['hours'];
		$total_makeup += $row['hours'];
		$row_sum = $row2['price'] + $supplement;
		$sum += $row_sum;
	} else {
		$hours = "";
	}
	print "<td align='center' bgcolor='" . $bg ."'>". $hours . "</td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	
	print "<td align='center' bgcolor='" . $bg ."'>" . $row_sum . "</td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<tr>";
}
			

				

				?>
</table>
</body>
</html>
