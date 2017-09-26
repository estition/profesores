<!--
*****************************************
PHP FAKE MAIL SCRIPT
Developed by Abhishek Deshpande
http://www.whoisabhi.com/fake-mail/
*****************************************
-->
<html>
<head>
<title>Mail Status</title>
</head>
<body>

<?php

$to=$_POST['to'];
$from=$_POST['from'];
$name=$_POST['name'];
$subject=$_POST['subject'];
$message=$_POST['message'];
$message=$message."\n Don't take this mail seriously. 
\n Its just a joke (Fake) mail sent by one of your mate with Help of YOUR_URL_HERE Script Developed by Abhishek";

$head="From: <$name>".$from."\r\n".
	'Reply-To: '.$from."\r\n";
$her=$head.' < '.$from.' >';


$ret=mail($to, $subject, $message, $her);
if($ret==true)
echo "<br /> Mail sent Successfully";
else
echo "<br /> Unable to Send mail. There are other reasons why mail may not be delivered. Sorry - it's hard to be perfect with this sort of thing! -Abhishek";

?>
<br><a href="YOUR_URL_HERE">Go Back</a>
</body>
</html>