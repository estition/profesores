<?php include 'includes/constants.php'?>
<?php include 'includes/functions.php'?>
<?php include 'includes/database.php'?>
<?php include 'includes/authorize.php'?>

  
 <?php  $sql = "select id, first, last1, last2, user_id from users where is_active=1 and baja=0 order by last1";
$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
//**************************modificado por svi***************************

if ($_REQUEST["teacher_id"]==""){
$teachers .= "<option value='0'>Select teacher....</option>";
} else {

$sql1="select id, first, last1, last2 from users where id='".$_REQUEST["teacher_id"]."' order by last1";
$resultado = mysqli_query($link, $sql1) or die("Invalid query: " . mysqli_error($link));
$row1 = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
$selected = "selected";
$teachers.= "<option " . $selected . " value='" . $row1['id'] . "'>" . $row1['last1'] . " " . $row1['last2'] . ", " . $row1['first'] . "</option>";
}
//**************************termina modificación***************************

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	if ($_POST['teacher_id'] == $row['id']) {
		$selected = "selected";
	} else {
		$selected = "";
	}
	
	$teachers .= "<option " . $selected . " value='" . $row['id'] . "'>" . $row['last1'] . " " . $row['last2'] . ", " . $row['first'] . "</option>";
}?>




    <?php
    require_once 'Zend/Loader.php';
    Zend_Loader::loadClass('Zend_Gdata');
    Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
    Zend_Loader::loadClass('Zend_Gdata_Calendar');
    Zend_Loader::loadClass('Zend_Http_Client');
    
    $gdataCal = Zend_Gdata_Calendar::AUTH_SERVICE_NAME;
    $user = "richardinglesadomicilio@gmail.com";
    $pass = "pobox7275";
    $client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $gdataCal);
	//$gdataCal->settingsProperty name="locale" value="en_US";
   $gdataCal = new Zend_Gdata_Calendar($client);
   
   
 
  $query = $gdataCal->newEventQuery();
  $query->setUser('default');
  $query->setVisibility('private');
  $query->setProjection('full');
  $query->setFutureEvents (true);
  $query->setOrderby('starttime');
   // if(isset($_GET['q'])) {
   //   $query->setQuery($_GET['q']);      
   // }

	
	$teacherEvent = $id_arti."-".$first." ".$last1." ".$last2;
	
	$query->setQuery($teacherEvent); 
  
  $eventFeed = $gdataCal->getCalendarEventFeed($query);
  
	echo "<ul>\n";
 
  foreach ($eventFeed as $event) {
  
  
      echo "\t<li><h2>" . stripslashes($event->title) . "</h2></li>\n";
	  
	  echo "\t\t<ul>\n";

	
    foreach ($event->when as $when) {
	
			
	
	
	$diaEvento=$when->startTime;
	 
	 $diaMesEvento = intval(substr($diaEvento,8,2));
	 
	 
	  
	    $yy = intval(substr($diaEvento,0,4));

		$mm = intval(substr($diaEvento,5,2));

		$dd = intval(substr($diaEvento,8,2));

		$hh = intval(substr($diaEvento,11,2));

		$min = intval(substr($diaEvento,14,2));
		
		 
	  
	   $tiempo = date(DATE_RSS, mktime($hh , $min, 0, $mm, $dd, $yy ));
	  
	   
	  echo "\t\t Pay day: " . $tiempo . "<br/>\n";
	  $id = substr($event->id, strrpos($event->id, '/')+1);
      echo "<a href=\"edit.php?id=$id\">edit</a> | ";
      echo "<a href=\"delete.php?id=$id\">delete</a> <br/>\n";
	  echo "\t\t</ul>\n";
      
      
    
	 
  //  $dias[$diaMesEvento] .= $event->title.". Date: ".substr($diaEvento,0,10). "Hora: ".substr($diaEvento,11,5);
	// $dias[$diaMesEvento] .= $event->title.". Hora: ".substr($diaEvento,11,5)." (".substr($diaEvento,23,6).")n";






	// echo "LAAAAAAAAAAAAAA".$hh."/".$min."/".$yy."LAAAAAAAAAAA";

    
	
	//echo stripslashes( $dias[$diaMesEvento]) . " <br/>\n";
	
	

    }
	  
  }
   echo "</ul>\n";
?>
  
