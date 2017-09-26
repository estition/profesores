<?php include 'includes/constants.php'?>
<?php include 'includes/functions.php'?>
<?php include 'includes/database.php'?>
<?php include 'includes/authorize.php'?>


<?php 

$sql = "(select b.name, b.apellido1, a.observations, a.hours, c.concept from entry a, clients b, concepts c where a.group_id = b.id and a.concept_id = c.id and a.id = " . $_REQUEST['id'].") union ";
$sql .= " (select b.name, b.apellido1, a.observations, a.hours, c.concept from entry a, groups b, concepts c where a.group_id = b.id and a.concept_id = c.id and a.id = " . $_REQUEST['id'].")";
$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	$thedate = $row['day'];
	$concept = $row['concept'];
	$client = $row['name'] . " " . $row['apellido1']; 
	$hours = $row['hours'];
	$observations = $row['observations'];
}


?>


<html>
	<head>
		<link href="css/canterbury.css" type="text/css" rel="stylesheet">
		<title>Entry detail</title>
	</head>

<body style="margin: 5px;">
<table width="100%" cellspacing="0" cellpadding="5" height="300" border="0">
<tr>
	<td height="3" colspan="2" bgcolor="FFFFFF">
	</td>
</tr>
<tr bgcolor="0033CC">
	<td colspan="2" class="textW" height="10">
		<b>Entry detail for <?php echo  $thedate; ?></b>
	</td>
<tr>
<tr>
	<td height="3" colspan="2" bgcolor="FFFFFF">
	</td>
</tr>

<tr bgcolor="B6C5F2">
	<td width="30" height="10"><b>Client:</b></td>
	<td width="370">
		<strong><?php echo  $client; ?></strong>
	</td>
</tr>

<tr bgcolor="B6C5F2">
	<td width="30" height="10"><b>Concept:</b></td>
	<td width="370">
		<strong><?php echo  $concept; ?></strong>
	</td>
</tr>
<tr  bgcolor="B6C5F2">
	<td  width="30" height="10"><b>Hours:</b></td>
	<td width="370">
		<strong><?php echo  $hours; ?></strong>
	</td>
</tr>
<tr bgcolor="B6C5F2">
	<td  width="30" height="10">
		<b>Observations:<b>
	</td>
	<td><strong><?php echo  $observations ?></strong></td>
</tr>
<tr bgcolor="B6C5F2">
	<td colspan="2" valign="top" height="140">
		
	</td>
</tr>
<tr>
	<td colspan="2" align="right" valign="top" height="30">
		<a href="javascript:self.close();">close</a>
	</td>
</tr>
</table>
</body>
</html>