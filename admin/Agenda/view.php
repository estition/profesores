<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><?php include '../../includes/constants.php'?><?php include '../../includes/functions.php'?><?php include '../../includes/database.php'?><?php include '../../includes/authorize.php'?><?phpheader("Connection: Keep-alive");header('Content-Type: text/html; charset=utf-8');if ($is_admin_a) {     if ($_POST['action3'] == "Set Time") {	$endtimeset = $_POST['bdate_hhh'];	$sql = "insert into entry_endtime(endtime) ";	$sql .= " values (" . $endtimeset. ")";	//print $sql;	mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));	echo '<br><h3>A new end time was entered successfully! <a href="view.php">Go Back!!</a></h3>';        exit (header('Location: http://www.canterburyenglish.com/profesores/admin/Agenda/view.php'));}}?><?php include '../../includes/top.php'?><?php require_once 'google-api-php-client-master/autoload.php'?><div style="position: relative;" align="center">        <?php$client_id = '895182433477-rn9l8l33eup83kompcaenjfafatdiago.apps.googleusercontent.com';$service_account_name = '895182433477-rn9l8l33eup83kompcaenjfafatdiago@developer.gserviceaccount.com';$key_file_location = 'certificates/cepayappoitment-d304559862fd.p12';	 // Calendar id$client = new Google_Client();$client->setApplicationName("cepayappoitment");$client->setClientId($client_id);//$service = new Google_Service_Calendar($client);$key = file_get_contents($key_file_location);$cred = new Google_Auth_AssertionCredentials( $service_account_name, array('https://www.googleapis.com/auth/calendar'), $key);$client->setAssertionCredentials($cred);$service = new Google_Service_Calendar($client);		    	  include_once("consult.php");		  $consultar_eventos=new consult;	  //$consultar_eventos->__construct();        if($is_admin_a){	  	if ($_REQUEST['action5'] == "Delete apoitments") {	 	  	/*		    $last = date('d', mktime(0, 0, 0, (date('m') - 1), 0, date('Y')));		   	$prevmonth = date('m') - 1;			if($prevmonth == 0){				$prevmonth = 12;				$ano1= date('Y') - 1; }else{					$prevmonth = (int)date('m') - 1;					$ano1 = date('Y');					 					}			$prevmonth1 = date('m') - 2;			if($prevmonth1 == -1){				$prevmonth1 = 12;				$ano2= date('Y') - 1;}elseif( $prevmonth1 == 0){					$ano2= date('Y');					$prevmonth1 = 1;					}else{					$prevmonth1 = (date('m') - 1);					$ano2 = date('Y');}			 	$startdel = $ano1."-".$prevmonth1."-01";		 	$enddel   = $ano2."-".$prevmonth."-".$last;						*/												$first = date('Y-m-d', mktime(0, 0, 0, date("m"), 1, date("Y")));			$last = date('Y-m-t', mktime(0, 0, 0, date("m"), 1, date("Y")));			//echo $first." VVV ".$last;		//echo $startdel." KKKK ".$enddel;         $eventFeed2=$consultar_eventos->ver_reg_fecha($first, $last, $service);    	//echo "<pre>".print_r($eventFeed2)."<pre>";		 if(  count($eventFeed2 > 0)){			 			  //$key = key($eventFeed2);  // fetches the key of the element pointed to by the internal pointer	//print_r($eventFeed2);//var_dump(key($eventFeed2));$temparray = array();$today = date("Y")."-".date("m")."-".date("d");		  foreach ($eventFeed2 as $event2) {			  //$temparray[] = $event2->start["dateTime"];			  $temparray = $event2->start["dateTime"];			  	$lastdate = substr($temparray, 0, 10);			if($today > $lastdate ){$consultar_eventos->deleteEvent($event2->id, $service);}			//print_r($temparray);		 	//$consultar_eventos->deleteEvent($event2->id, $service);			}									}	}}			include("authorize_user.php");$authorize_eventos=new authorize_user;        $teachers=$authorize_eventos->authorizeUser();if ($is_admin_a) {		if ($_REQUEST['action2'] == "Delete Date") {		if (count($_REQUEST['delete']) == 0) {$message = "<br>Must check the date range first.";}else{		foreach ($_REQUEST['delete'] as $id) {   		$sql = 'delete from blokingdays where id = ' . $id;   		mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));   		$message = "<br><strong>Date Range deleted.</strong>";	   		}	}}//$flag = false;//if($_SESSION['action3'] === $_POST['action3'] && isset($_SESSION['action3'])){//    echo "2 refresh";//    $flag = false;//}//else {//    // user submitted once//    $_SESSION['action3'] = $_POST['action3']; //      echo "1 refresh";//      $flag = true;//} 	if ($_POST['action4'] == "Delete Time") {		if (count($_POST['delete1']) == 0) {$message = "<br>Must set the time first.";}else{	$endtimeset = $_POST['delete1'];	foreach($endtimeset as $value){	$sql = "delete from entry_endtime where endtime = " . $value;		mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));        }	echo "<br>A new end time was deleted successfully!";		}}		if ($_REQUEST['action1'] == "Move Dates") {				if($_REQUEST['info'] == " "){echo "If you need block a date, enter one date if you want to move the payday enter two dates";}else		$DateRange = explode("->", $_REQUEST['info']);	 	include_once("datemoves.php");//creamos el objeto $objempleados de la clase datemoves$objblockdays=new datemoves;if ($objblockdays->crear($DateRange[0], $DateRange[1])==true){echo "Registro grabado correctamente";}else{ echo "Registro no grabado...";}}?> <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post"><table border="0" align="center" cellspacing="0" class="pepe1" bgcolor="#ccc" cellpadding="0">  <tr>    <td width="200" rowspan="5" valign="top"><div id="cont"></div>          <input style="text-align: center" readonly="true" name="info" id="info" size="33" />          <br />          <input name="action1" type="submit" id="action" value="Move Dates"></td>  </tr>  <tr>    <td>     <br /><br />      <strong>Search teachers's appointment:</strong><br/><br/>      <select name="q" ><?php echo  $teachers; ?></select>        <input name="action" type="submit" id="action" value="Search"></td>  </tr>  <tr>    <td><br /><br />      <strong>-	THIS CALENDAR IS FOR ADMIN PURPOSES ONLY.<BR />- ALL THE CHANGES MADE WILL TAKE EFFECT IN THE TEACHERS CALENDAR IN THE ADD APPOINTMENT SCREEN.<BR />      -	"SAME DATES", MEANS THE DAY IS BLOCKED FOR TEACHERS.<br />-	"DIFFERENT DATES", MEANS THAT PAY DAY IS FROM X DATE TO Y DATE: EX. MAR 1ST TO MAR 3RD. <br />-	LIST OF DATES:</strong></td>  </tr>  <tr>    <td><?php  	include_once("datemoves.php");			$showdays=new datemoves;			$next_month1 = date('m') - 1;			$next_month2 = date('m') + 1;			$year2 = date('Y');			if($next_month2 < 10)			$next_month2 = "0".$next_month2;			if(date('m') == 12){$next_month1 = "12";$next_month2 = "01"; $year2 = date('Y')+1;}						$lista = $showdays->consultar(date('Y')."-".$next_month1."-01", $year2."-".$next_month2."-31");					//if ($email_exist>0|$username_exist>0) {						if  ( $lista == true )  {			while($rowBlock = mysqli_fetch_array($lista)){				print  $rowBlock["fechas1"]." ".$rowBlock["fechas2"]."<input name='delete[]' type='checkbox' id='delete' value='" . $rowBlock["id"] . "'><br>";		$datereplaced1 = str_replace("-", "", $rowBlock["fechas1"]);	$datereplaced2 = str_replace("-", "", $rowBlock["fechas2"]);		print "<input name='date10' type='hidden' id='date10' value='" . $datereplaced1. "'>";	print "<input name='date20' type='hidden' id='date20' value='" . $datereplaced2. "'>";			     }}else{ $lista = 0; print "<input name='date10' type='hidden' id='date10' value='" .date('Y')."-".date('m')."-01"."'>";	print "<input name='date20' type='hidden' id='date20' value='" .date('Y')."-".date('m')."-31"."'>";}?>                     <input name="action2" type="submit" id="action" value="Delete Date"><br /> Set end time to:        <select name="bdate_hhh"  selected=<?php echo $rowBlock["endtime"];?> type="text" size="1" id="bdate_hhh" > <!-- onChange="return ContinentListOnChange()">-->        <option value="10">10</option>  <option value="11">11</option>  <option value="12">12</option>  <option value="13">13</option>  <option value="14">14</option>  <option value="15">15</option>    </select>     <input name="action3" type="submit" id="action" value="Set Time"><br />    <?php $query = "SELECT endtime FROM entry_endtime";	$result = mysqli_query($link, $query) or die("Invalid query: " . mysqli_error($link));		if  ( $result == true )  {			while($rowBlock = mysqli_fetch_array($result)){				print  $rowBlock["endtime"]."<input name='delete1[]' type='checkbox' id='delete_end' value='" . $rowBlock["endtime"] . "'><br>";	}}?>      <input name="action4" type="submit" id="action4" value="Delete Time">        <input name="action5" type="submit" id="action" value="Delete apoitments">      </td>            <td width="4">      </td>  </tr>    </table></form></div>                  <script type="text/javascript" src="calendar/JSCal2-1.9/src/js/jscal2.js"></script><script type="text/javascript" src="calendar/JSCal2-1.9/src/js/lang/en.js"></script><link rel="stylesheet" type="text/css" media="all" href="calendar/JSCal2-1.9/src/css/jscal2.css"  /><link rel="stylesheet" type="text/css" href="calendar/JSCal2-1.9/src/css/border-radius.css" /><link rel="stylesheet" type="text/css" href="calendar/JSCal2-1.9/src/css/steel/steel.css" /><br/><br/>           <br/>       <div style="text-align:center; left: 320px; top: 0px; ">       <?php echo"<strong><font COLOR=GREEN>########################</font></strong>";?> <br/>       <a href="http://www.canterburyenglish.com/profesores/admin/recursos/Canterbury_English_Agenda_teacher.pdf" target="_blank">View the agenda teacher's guide</a>  </div>      </form>   <?php }?>       <script type="text/javascript">//<![CDATA[      var SELECTED_RANGE = null;      function getSelectionHandler() {              var startDate = null;              var ignoreEvent = false;              return function(cal) {                      var selectionObject = cal.selection;                      // avoid recursion, since selectRange triggers onSelect                      if (ignoreEvent)                              return;                      var selectedDate = selectionObject.get();                      if (startDate == null) {                              startDate = selectedDate;                              SELECTED_RANGE = null;                              document.getElementById("info").value = "Click to select end date";                              // comment out the following two lines and the ones marked (*) in the else branch                              // if you wish to allow selection of an older date (will still select range)                              cal.args.min = Calendar.intToDate(selectedDate);                              cal.refresh();                      } else {                              ignoreEvent = true;                              selectionObject.selectRange(startDate, selectedDate);                              ignoreEvent = false;                              SELECTED_RANGE = selectionObject.sel[0];                              // alert(SELECTED_RANGE.toSource());                              //                              // here SELECTED_RANGE contains two integer numbers: start date and end date.                              // you can get JS Date objects from them using Calendar.intToDate(number)							                               startDate = null;                              document.getElementById("info").value = selectionObject.print("%Y-%m-%d");                               // (*)                              cal.args.min = null;                              cal.refresh();                      }              };      };var currentTime = new Date();var month = currentTime.getMonth() + 1;if(month < 10)month = "0"+month;if(month == 12)var nextmonth = "01";elsevar nextmonth = currentTime.getMonth() + 2;if(nextmonth < 10)nextmonth = "0"+nextmonth;var year = currentTime.getFullYear();date10 = Number(year.toString()+month.toString()+"01");date20 = Number(year.toString()+nextmonth.toString()+"31"); //alert(document.getElementById("date10").value);// alert(document.getElementById("date20").value);var indate1 = Number(document.getElementById("date10").value)-1;var indate2 = Number(document.getElementById("date20").value)+1;//document.write(indate2);      Calendar.setup({              cont          : "cont",              fdow          : 1,			  min			: date10,              max			: date20,			  selectionType : Calendar.SEL_SINGLE,			  disabled      : function(date) {				  if ((date.getDay() == 0) || (date.getDay() == 6) ) {            return true;        } else {				   date = Calendar.dateToInt(date);				 		 /* document.write((date <= document.getElementById("date10").value && date >= document.getElementById("date20").value));						  document.write("DATE");						  document.write(date);						  document.write("VALUE");						  document.write(document.getElementById("date10").value);						  document.write("OTRO");						  document.write(document.getElementById("date20").value);						  */						      			   return (date <= indate1 || date >= indate2);						 }},			  onSelect      : getSelectionHandler()			        });    //]]></script>     <table width="730" border="0" align="center" class="submit-button">  <tr>    <td bordercolor="#000000">       <iframe src="https://calendar.google.com/calendar/embed?showDate=0&amp;showCalendars=0&amp;height=600&amp;wkst=2&amp;bgcolor=%23FFFFFF&amp;src=richardinglesadomicilio%40gmail.com&amp;color=%2329527A&amp;ctz=Europe%2FMadrid" style="border-width:0" width="800" height="600" frameborder="0" scrolling="no"></iframe>    <!--<iframe src="https://www.google.com/calendar/embed?showDate=0&amp;showCalendars=0&amp;showTz=0&amp;height=600&amp;wkst=2&amp;bgcolor=%23FFFFFF&amp;src=richardinglesadomicilio%40gmail.com&amp;color=%232952A3&amp;ctz=Atlantic%2FCanary" style=" border-width:0 " width="800" height="600" frameborder="0" scrolling="no"></iframe>-->    </td></tr></table>    <?php    	echo "<h1>Appointment list</h1>";		//$gdataCal->settingsProperty name="locale" value="en_US";  $seek = "";    if(isset($_POST['q'])) {      $seek = $_POST['q']; }	 	 	echo "<ul>\n";   $eventFeed[100] = "";	     $eventFeed=$consultar_eventos->ver_reg($seek, $service);    if($is_admin_a){  $long = sizeof($eventFeed);  settype($long, "string");    echo "\t<h2>Total:" . $long. "</h2>";  echo"<h2><strong><font COLOR=RED>_________________________________________________________________________________________</font></strong></h2>";  }  	$i = 0;	$add_link = true;		function fmt_gdate( $gdate ) {	  if ($val = $gdate->getDate()) {	 $newdate =  new DateTime($val);    return $newdate->format( 'd/m/Y H:i' );  } else if ($val = $gdate->getDateTime()) {	  $newdate =  new DateTime($val);    return $newdate->format( 'd/m/Y  H:i' );  }}	foreach ($eventFeed->getItems() as $event) {        	 	 if($is_admin_a){	  echo "<h2>".++$i. "</h2>";	  echo "\t<li><h2>" . stripslashes($event->getSummary()) . "</h2></li>";			 	  echo "\t\t <h3>Pay day: <font COLOR=GREEN>" . fmt_gdate($event->getStart()) . "</font></h3>";		 echo "\t\t <h3>Appointment status: <font COLOR=GREEN>" .$event->getLocation(). "</font></h3>";  echo "\t\t <strong>Envelopes Summary: </strong>" . $event->getDescription() . "<br/>\n"; 	  $id = $event->getId();	       echo "<a href=\"edit.php?id=$id\">edit</a> | ";      echo "<a href=\"delete.php?id=$id\">delete</a><br/>\n ";	  	echo"<strong><font COLOR=GREEN>________________________________________________________________________________________________________________________________</font></strong>";	  	  echo "<br/>\n";	  echo "<br/>\n";	 	  }	 	  else if ( $event->getSummary() == $id_arti."-".$first) {		  		   echo "\t<li><h2>" . stripslashes($event->getSummary()) . "</h2></li>";			 	  echo "\t\t <h3>Pay day: <font COLOR=GREEN>" . fmt_gdate($event->getStart()) . "</font></h3>";		  	 $id = $event->getId();      echo "<a href=\"edit.php?id=$id\">edit</a> | ";      echo "<a href=\"delete.php?id=$id\">delete</a><br/>\n ";	  $add_link = false;	  	echo"<strong><font COLOR=GREEN>________________________________________________________________________________________________________________________________</font></strong>";	  	  echo "<br/>\n";	  echo "<br/>\n";	       }	// echo "\t\t</ul>\n";      }    	   echo "</ul>\n";		 if($add_link){		 	 echo "<br/><br/><a href=add.php>Add a new pay appointment</a><br/>\n";	  echo "<br/>\n";}?> <table width="730" border="0" align="center" class="submit-button"> <tr><td align="center"><h1><font COLOR=YELLOW>Pay Appointment Information</font></h1></td>  </tr>  <tr>    <td bordercolor="#000000">      <p><strong><font COLOR=YELLOW>-	The start date that the system allows you to make an appointment is from the 25th (at 00:00 h) for the pay period that begins on the 1st (or 2nd or 3rd if the 1st is a Sat or Sun) and ends on the 5th of every month. <br /><br />       - Please be on time for your appointment. If you arrive more than 10 minutes late, your appointment will be cancelled and you'll have to sign up for the next available appointment. <br /><br />      - If you do not sign up for a pay appointment during the official pay period, or you miss your appointment, then you would have to wait until the next pay period during the following month. In this case, you would still need to come in to pick up your bills to take to your clients for the new month in progress. <br /><br />     - All client payments need to be handed in by the 20th. If you turn in your client payments on the day of your pay appointment, your pay appointment will be cancelled and you will have to sign up for a new appointment on another day.  <br /><br />      - Your teaching hours need to be inputted by the 25th. You also have to input the hours that you will be teaching after the 25th, and then, very important (to avoid confusion and delays during your pay appointment), go back to change them if there are unexpected cancellations after the 25th.<br /><br />- All student reports must be completed before you can get paid (This applies ONLY to the June and December pay periods or before your last pay appointment for a class that has ended). If the student report is not done correctly you will have to sign up for another pay appointment. <br /><br />- The office hours are from 10:00 to 18:00 h Monday through Thursday and from 10:00 to 15:00 h on Friday. The office is NOT open on weekends!</font></strong></p>      <p>&nbsp;</p></td>  </tr></table> <?php  include 'includes/foot.php'?> 	