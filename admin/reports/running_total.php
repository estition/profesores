<?php
function getRunningTotal($date, $group_id) {
	$total_taught = 0;
	$total_noshow = 0;
	$total_teacher_cancel = 0;
	$total_makeup = 0;
	$total_cancelout = 0;
	$total_giveout = 0;

	$sql = "select count(a.id) as num from entry a, groups b where a.group_id = b.id ";
	$sql .= " and b.id = " . $group_id . " and day < '" . $date . "' and concept_id = 1";
	$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
	
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$total_taught = $row['num'];
	}
	
	$sql = "select count(a.id) as num from entry a, groups b where a.group_id = b.id ";
	$sql .= " and b.id = " . $group_id . " and day < '" . $date . "' and concept_id = 2";
	$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$total_student_cancel = $row['num'];
	}
	
	$sql = "select count(a.id) as num from entry a, groups b where a.group_id = b.id ";
	$sql .= " and b.id = " . $group_id . " and day < '" . $date . "' and concept_id = 3";
	$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$total_noshow = $row['num'];
	}
	
	$sql = "select count(a.id) as num from entry a, groups b where a.group_id = b.id ";
	$sql .= " and b.id = " . $group_id . " and day < '" . $date . "' and concept_id = 4";
	$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$total_teacher_cancel = $row['num'];
	}
	
	$sql = "select count(a.id) as num from entry a, groups b where a.group_id = b.id ";
	$sql .= " and b.id = " . $group_id . " and day < '" . $date . "' and concept_id = 5";
	$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$total_makeup = $row['num'];
	}
	
	$sql = "select count(a.id) as num from entry a, groups b where a.group_id = b.id ";
	$sql .= " and b.id = " . $group_id . " and day < '" . $date . "' and concept_id = 6";
	$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$total_cancelout = $row['num'];
	}
	
	$sql = "select count(a.id) as num from entry a, groups b where a.group_id = b.id ";
	$sql .= " and b.id = " . $group_id . " and day < '" . $date . "' and concept_id = 7";
	$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$total_giveout = $row['num'];
	}
	
	return $total_makeup + $total_cancelout - $total_teacher_cancel - $total_student_cancel - $total_giveout;
}
?>