<?php include 'includes/constants.php'?>
<?php include 'includes/database.php'?>
<?php include 'includes/authorize.php'?>
<?php include 'includes/functions.php'?>
<?php include 'iniRoot.php';?>
<?php include 'includes/top.php'?>



<?php


if ($_POST['teacher_id'] != "") {
	// we've entered as admin
	$teacher = $_POST['teacher_id'];
} else {
	$teacher = $_COOKIE["user_id"];
	
	
}



$page_name = "calendar";
?>




<?php


echo "<iframe src=\"https://www.google.com/calendar/embed?title=".$teacher."'s%20calendar&amp;showCalendars=0&amp;mode=WEEK&amp;height=600&amp;wkst=2&amp;hl=en&amp;bgcolor=%23FFFFFF&amp;src=".$teacher."%40canterburyenglish.com&amp;color=%23856508&amp;ctz=Europe%2FMadrid\" style=\" border:solid 1px #777 \" width=\"1300\" height=\"1120\" frameborder=\"0\" scrolling=\"no\"></iframe>"; ?>

<?php include 'includes/foot.php'?>
