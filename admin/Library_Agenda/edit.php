<?php include 'includes/constants.php'?>
<?php include 'includes/functions.php'?>
<?php include 'includes/database.php'?>
<?php include 'includes/authorize.php'?>
<?php include '../../includes/top.php'?>
<?php
require_once('calendar/classes/tc_calendar.php');


?>
  <script language="javascript" src="AjaxCode.js"></script>
  <link href="calendar/calendar.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="calendar/calendar.js"></script>

<style type="text/css">
body { font-size: 11px; font-family: "verdana"; }

pre { font-family: "verdana"; font-size: 10px; background-color: #FFFFCC; padding: 5px 5px 5px 5px; }
pre .comment { color: #008000; }
pre .builtin { color:#FF0000;  }
</style>
  
    <h1>Update a Library Appointment</h1>
  
    <?php
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
     
    // get event details
    if (!isset($_POST['submit'])) {
      if (isset($_GET['id'])) {
        try {          
          $event = $gcal->getCalendarEventEntry('http://www.google.com/calendar/feeds/default/private/full/' . $_GET['id']);
        } catch (Zend_Gdata_App_Exception $e) {
          echo "Error: " . $e->getResponse();
        }
      } else {
          die('ERROR: No event ID available!');  
      }  
      
      // format data into human-readable form
      // populate a Web form with the record
      $title = $event->title;
      $when = $event->getWhen();
      $startTime = strtotime($when[0]->getStartTime());
      $sdate_dd = date('d', $startTime);
      $sdate_mm = date('m', $startTime);
      $sdate_yy = date('Y', $startTime);
      $sdate_hh = date('H', $startTime);
      $sdate_ii = date('i', $startTime);

	 	
    ?>
    <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
      <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
      <strong>Teacher ID:</strong> 
      <span><?php echo $title; ?></span><p/>
      
       <table border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td><strong>Date :</strong></td>
                    <td><?php
					
		$next_month = date('m')+1;			
	  $myCalendar = new tc_calendar("date1", true, false);
	  $myCalendar->setIcon("./images/iconCalendar.gif");
	  //$myCalendar->setDate($sdate_dd, $sdate_mm, $sdate_yy);
	  $myCalendar->setPath("calendar/");
	  $myCalendar->setYearInterval(2000, 2012);
	  //$myCalendar->dateAllow('2008-05-13', '2010-03-01', false);
	  //obtaining the last day of every month...
	  	  $last = date('d', mktime(0, 0, 0, (date('m') + 1), 0, date('Y')));
		   
		   
	  
	  $myCalendar->dateAllow(date('Y')."-".date('m')."-01", date('Y')."-".date('m')."-".$last);
	 
	  $myCalendar->setDateFormat('j F Y');
	  //$myCalendar->setHeight(350);	  
	  //$myCalendar->autoSubmit(true, "form1");
	  $myCalendar->writeScript();
	  ?></td>
                    <td></td>
                  </tr>
                </table>
                
               <br/>
      <strong>Time: </strong>
      
<select name="sdate_hh" type="text" size="1" id="sdate_hh" onChange="return ContinentListOnChange()">
  <option value="<?php echo $sdate_hh?>" ><?php echo $sdate_hh?></option>
  <option value="11">11</option>
  <option value="12">12</option>
  <option value="13">13</option>
  <option value="14">14</option>
  <option value="15">15</option>
  
</select>
<strong>:</strong>

 <!-- drop down #2, list contents depend on value selected in drop-down #1 -->
    <!-- code in the file js/AjaxCode.js will populate this drop-down list                  -->
  <select name="sdate_ii" id="sdate_ii" type="text" size="1">
  <option value="<?php echo $sdate_ii; ?>"><?php echo $sdate_ii; ?></option>
  <option value="00">00</option>
</select>
  
<br/>
<br/>
        
  
<input name="submit" type="submit" value="Save" /> 
      
    </form> 
    
 
    <?php
   
                 
    } else {
      // if form submitted
      // validate input
      if (empty($_POST['id'])) {
        die('ERROR: Missing event ID');
      } 
      
      $theDate = isset($_REQUEST["date1"]) ? $_REQUEST["date1"] : "";
	  
	  
	   $yy = intval(substr($theDate,0,4));
	   
	 	$mm = intval(substr($theDate,5,2));

		$dd = intval(substr($theDate,8,2));
		
		if (date('Y') == $yy){
		
		$minutePlus = $_POST['sdate_ii']+5;
	
		//$start1 =  $_REQUEST["date1"];
		//$start2 = date(DATE_ATOM, mktime($start1));
      $start = date(DATE_ATOM, mktime($_POST['sdate_hh'], $_POST['sdate_ii'], 0, $mm, $dd, $yy ));
      $end = date(DATE_ATOM, mktime($_POST['sdate_hh'], $minutePlus, 0, $mm, $dd, $yy ));
	  
      include_once("consult.php");
	  $consultar_eventos_fecha=new consult;
		
        $eventFeed2=$consultar_eventos_fecha->ver_reg_fecha($start, $end);
    	$total_fecha = $eventFeed2->totalResults; 
			
		switch ($total_fecha) {
    case "0":
	
      try {
	    
        $event = $gcal->getCalendarEventEntry('http://www.google.com/calendar/feeds/default/private/full/' . $_POST['id']);
		$when = $gcal->newWhen();
        $when->startTime = $start;
        $when->endTime = $end;
        $event->when = array($when);        
        $event->save();   
      } catch (Zend_Gdata_App_Exception $e) {
        die("Error: " . $e->getResponse());
      }
      echo '<h3>Appointment successfully modified!</h3>'; 
	   break;
    case 1:
        echo "<h3>Appointment occupied by another user, Please choose a free one from the appointment list</h3>";
        break;
 
	  }
	}
	else {echo "<h3>Please choose a correct date</h3>";}   
}    
    ?>
