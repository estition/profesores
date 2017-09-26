<head>
  <link href="calendar/calendar.css" rel="stylesheet" type="text/css" />
  <script language="javascript" src="AjaxCode.js"></script>
<script language="javascript" src="calendar/calendar.js"></script>

<style type="text/css">
body { font-size: 11px; font-family: "verdana"; }

pre { font-family: "verdana"; font-size: 10px; background-color: #FFFFCC; padding: 5px 5px 5px 5px; }
pre .comment { color: #008000; }
pre .builtin { color:#FF0000;  }
</style>

</head>
<?php include 'includes/constants.php'?>
<?php include 'includes/functions.php'?>
<?php include 'includes/database.php'?>
<?php include 'includes/authorize.php'?>
<?php include '../../includes/top.php'?>
<?php
require_once('calendar/classes/tc_calendar.php');


?>

    
<h1>Add a new library Appointment</h1>
  <?php  	
include("authorize_user.php");

$authorize_eventos=new authorize_user;
        $teachers=$authorize_eventos->authorizeUser();?>
         
    <?php if (!isset($_POST['submit'])) { ?>
    
    <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
     
   
     
     
      <p/>
      
       <table border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td><strong>Date :</strong></td>
                    <td>
                    
					<?php
					
	  $next_month = date('m')+1;			
	  $myCalendar = new tc_calendar("date1", true, false);
	  $myCalendar->setIcon("./images/iconCalendar.gif");
	  //$myCalendar->setDate(date('d'), date('m'), date('Y'));
	  $myCalendar->setPath("calendar/");
	  $myCalendar->setYearInterval(2010, 2011);
	  //$myCalendar->dateAllow('2008-05-13', '2010-03-01', false);
	  
	 //obtaining the last day of every month...
	  	   $last = date('d', mktime(0, 0, 0, (date('m') + 1), 0, date('Y')));
		   
		   
	  
	  $myCalendar->dateAllow(date('Y')."-".date('m')."-".date('d'), date('Y')."-".date('m')."-".$last);
	  $myCalendar->setDateFormat('j F Y');
	 
	  //$myCalendar->setHeight(350);	  
	  //$myCalendar->autoSubmit(true, "form1");
	  
	   $myCalendar->writeScript();
	  ?>

	  		</td>
               <td></td>
             </tr>
        </table>
      <br/>
      <strong>Time: </strong>
      
     
  <select name="sdate_hh" type="text" size="1" id="sdate_hh" onChange="return ContinentListOnChange()">
  <option value="09">09</option>
  <option value="10">10</option>
  <option value="11">11</option>
  <option value="12">12</option>
  <option value="13">13</option>
  <option value="14">14</option>
  <option value="15">15</option>
  <option value="16">16</option>
  <option value="17">17</option>
  <option value="18">18</option>
  
  </select>
<strong>:</strong>

  <!-- drop down #2, list contents depend on value selected in drop-down #1 -->
    <!-- code in the file js/AjaxCode.js will populate this drop-down list                  -->
  <select name="sdate_ii" id="sdate_ii" type="text" size="1">
  <option value="00">00</option>
  <option value="30">30</option>
  </select>
  

  <br/>
   <br/>
      <input name="submit" type="submit" value="Save" />      
    </form>
    <?php
    } else {
      // load classes
      require_once 'Zend/Loader.php';
      Zend_Loader::loadClass('Zend_Gdata');
      Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
      Zend_Loader::loadClass('Zend_Gdata_Calendar');
      Zend_Loader::loadClass('Zend_Http_Client');
      
      // connect to service
      $gcal = Zend_Gdata_Calendar::AUTH_SERVICE_NAME;
      $user = "digital.library.org@gmail.com";
      $pass = "hercules";
      $client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $gcal);
      $gcal = new Zend_Gdata_Calendar($client);
      
	
        
     
      //$title = $_POST['teacher_id'];
	  //echo  $id_arti."-".$first." ".$last1." ".$last2;
	   
	  	//$title = $id_arti."-".$first." ".$last1." ".$last2;
		//$start1 =  $_REQUEST["date1"];
		//$start2 = date(DATE_ATOM, mktime($start1));
      //$start = date(DATE_RSS, mktime($_POST['sdate_hh'], $_POST['sdate_ii'], 0, date("m"), $_POST['sdate_dd'], date("Y")));
      //$end = date(DATE_RSS, mktime($_POST['sdate_hh'], $_POST['sdate_ii'], 0, date("m"), $_POST['sdate_dd'], date("Y")));
	    $theDate = isset($_REQUEST["date1"]) ? $_REQUEST["date1"] : "";
	  
	  
	   $yy = intval(substr($theDate,0,4));
	   
	 	$mm = intval(substr($theDate,5,2));

		$dd = intval(substr($theDate,8,2));
		
		if (date('Y') == $yy){
		
		$minutePlus = $_POST['sdate_ii']+5;
		

	
		//$start1 =  $_REQUEST["date1"];
		//$start2 = date(DATE_ATOM, mktime($start1));
      	$start = date(DATE_ATOM, mktime($_REQUEST['sdate_hh'], $_REQUEST['sdate_ii'], 0, $mm, $dd, $yy ));
      	$end = date(DATE_ATOM, mktime($_POST['sdate_hh'], $minutePlus, 0, $mm, $dd, $yy));
		
		$start_1d = date(DATE_ATOM, mktime(10, 0, 0, $mm, $dd, $yy ));
      	$end_1d = date(DATE_ATOM, mktime(16, 0, 0, $mm, $dd, $yy));
	  
		include_once("consult.php");
	
	
      // validate input
	  	      if($_POST['teacher_id'] != '') {
      $compName1 = $_POST['teacher_id']; 
	  	   }
	  
	  else {$compName1 = $id_arti."-".$first." ".$last1." ".$last2;
	  	  	  }
   
		//$compName = substr($compName1,0,6);
		 $consultar_eventos_usuario=new consult;
         
        $eventFeed2=$consultar_eventos_usuario->ver_reg_User_fecha($compName1, $start_1d, $end_1d);
    	$total_fecha_1d = $eventFeed2->totalResults; 
		
		
			
		switch ($total_fecha_1d) {
 case "0":
	
	$eventFeed3=$consultar_eventos_usuario->ver_reg_fecha($start, $end);
    	$total_fecha = $eventFeed3->totalResults;
		
		if ( $total_fecha == "0"){
 try {
 
	
  $newEvent = $gcal->newEventEntry();
  
  $newEvent->title = $gcal->newTitle($compName1);

  $when = $gcal->newWhen();
  $when->startTime = $start;
  $when->endTime = $start;
  $newEvent->when = array($when);

    
  // Upload the event to the calendar server
  // A copy of the event as it is recorded on the server is returned
  $createdEvent = $gcal->insertEvent($newEvent);}
  catch (Zend_Gdata_App_Exception $e) {
        echo "Error: " . $e->getResponse();
      }
  //return $createdEvent->id->text;
  echo '<h3>appointment successfully added!</h3>'; 
   } 
 
   else {echo "<h3>Appointment occupied by another user, Please choose a free one from the appointment list</h3>";}
        break;
    case 1:
        echo "<h3>The system only allow to pick an appointment per day, please go to the appointment list and click on edit link to change the date or create another appointment for a future day</h3>";
        break;
   
}

 	}
	else {echo "<h3>Please choose a correct date</h3>";}
}
 

      // construct event object
      // save to server      
     /* try {
        $event = $gcal->newEventEntry();        
        $event->title = $gcal->newTitle($title);        
        $when = $gcal->newWhen();
        $when->startTime = $start;
        $when->endTime = $end;
        $event->when = array($when);        
        $gcal->insertEvent($event);   
      } catch (Zend_Gdata_App_Exception $e) {
        echo "Error: " . $e->getResponse();
      }
      echo 'Event successfully added!';      
    }*/

    ?>
 <?php  include 'includes/foot.php'?>

