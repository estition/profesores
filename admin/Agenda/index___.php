<?php include 'includes/constants.php'?>
<?php include 'includes/functions.php'?>
<?php include 'includes/database.php'?>
<?php include 'includes/authorize.php'?>

<?php include 'includes/top.php'?>
<?php include 'includes/menu.php'?>
  <?php


echo "<iframe src=\"https://www.google.com/calendar/embed?height=1120&amp;wkst=2&amp;hl=en&amp;bgcolor=%23FFFFFF&amp;src=richardinglesadomicilio%40gmail.com&amp;color=%232952A3&amp;ctz=Europe%2FMadrid\" style=\" border:solid 1px #777 \" width=\"1300\" height=\"1120\" frameborder=\"0\" scrolling=\"no\"></iframe>"; ?>
    <?php
	
	    
	  include_once("consult.php");
	
	  $consultar_eventos=new consult;
      
  if($is_admin_a){
	 if (date('d') == "24") {
	  	 
		    $last = date('d', mktime(0, 0, 0, (date('m') - 1), 0, date('Y')));
		   	$prevmonth = date('m') - 1;
		 	$startdel = date('Y')."-".$prevmonth."-01";
		 	$enddel   = date('Y')."-".$prevmonth."-".$last;
         $eventFeed2=$consultar_eventos->ver_reg_fecha($startdel, $enddel);
    	 $total_fecha = $eventFeed2->totalResults;
		 if(  $total_fecha != 0){
		    
		  foreach ($eventFeed2 as $event2) {
  		    $id = substr($event->id, strrpos($event->id, '/')+1);
	  
		 	$consultar_eventos->deleteEvent($id);}
		}
	}
}
include("authorize_user.php");

$authorize_eventos=new authorize_user;
        $teachers=$authorize_eventos->authorizeUser();

	
	//$gdataCal->settingsProperty name="locale" value="en_US";
  $seek = "";
    if(isset($_GET['q'])) {
      $seek = $_GET['q']; }
	 
	 
	echo "<ul>\n";
   $eventFeed[100] = "";	
   
  $eventFeed=$consultar_eventos->ver_reg($seek);
  
 
  if($is_admin_a){
  $long = $eventFeed->totalResults;
  settype($long, "string");
  
  echo "\t<h2>Total:" . $long. "</h2>";
  echo"<h2><strong><font COLOR=RED>_________________________________________________________________________________________</font></strong></h2>";
  }
  	$i = 0;
  foreach ($eventFeed as $event) {
  
   foreach ($event->when as $when) {
	
		 $name0 = $id_arti."-".$first." ".$last1." ".$last2;
		 $name = intval(substr($name0,0,6));
		 
		 $title0 =  $event->title;
		 
		 $title1 = intval(substr($title0,0,6));
		 
if ( $title1 == $name) {
	  
	  $id = substr($event->id, strrpos($event->id, '/')+1);
      echo "<a href=\"edit.php?id=$id\">edit</a> | ";
      echo "<a href=\"delete.php?id=$id\">delete</a><br/>\n ";
	 
      }
	
      }
    
	 
    //  $dias[$diaMesEvento] .= $event->title.". Date: ".substr($diaEvento,0,10). "Hora: ".substr($diaEvento,11,5);
	// $dias[$diaMesEvento] .= $event->title.". Hora: ".substr($diaEvento,11,5)." (".substr($diaEvento,23,6).")n";
	// echo "LAAAAAAAAAAAAAA".$hh."/".$min."/".$yy."LAAAAAAAAAAA";
	//echo stripslashes( $dias[$diaMesEvento]) . " <br/>\n";
	    }
		
   echo "</ul>\n";


		$compName1 = $id_arti."-".$first." ".$last1." ".$last2;
		
		
		
         $eventFeed1=$consultar_eventos->ver_reg($id_arti);
		
		
		$total = $eventFeed1->totalResults; 
	 
 if(($total == "0") && (!$is_admin_a)){
	 echo "<br/><br/><a href=add.php>Add a new pay appointment</a><br/>\n";
	  echo "<br/>\n";}
	
else if ($is_admin_a) {

if ($_REQUEST['action'] == "Block") {
$theDate = isset($_REQUEST["date1"]) ? $_REQUEST["date1"] : "";
	include_once("consultarbbdd.php");

//creamos el objeto $objempleados de la clase cEmpleado
$objblockdays=new consultarbbdd;

if ($objblockdays->crear($theDate)==true){
echo "Registro grabado correctamente";
}else{ echo "Registro no grabado...";}
}
echo"<strong><font COLOR=GREEN>########################</font></strong>";
?>



<br/><br/><a href=add.php>Add a new pay appointment</a><p/><br/>
 <?php echo"<strong><font COLOR=GREEN>########################</font></strong>";?>
 
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="get">
            Block one or more days<br/><br/>
      
      <link href="calendar/calendar.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="calendar/calendar.js"></script>
<?php
require_once('calendar/classes/tc_calendar.php');


?>
  <table border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td><strong>Date :</strong></td>
                    <td><?php
					
	 // $next_month = date('m')+1;		
	 // $next_month = date('m');	
	  $myCalendar = new tc_calendar("date1", true, false);
	  $myCalendar->setIcon("./images/iconCalendar.gif");
	  $myCalendar->setPath("calendar/");
	  $myCalendar->setYearInterval(date('Y'), date('Y'));
	  
	   
	 	   
		  if ((date('d') == 25) || (date('d') == 26) || (date('d') == 27) || (date('d') == 28) || (date('d') == 29) || (date('d') == 30) || (date('d') == 31)){
		   
		    $offday = 1;
		     $offday1 = 10;
			 $next_month = date('m')+1;}
		   else{ $offday = date('d');
		          $offday1 = 10;
				  $next_month = date('m');}
		
	
	  		
	  
	  $myCalendar->dateAllow(date('Y')."-".$next_month."-".$offday, date('Y')."-".$next_month."-".$offday1, false);
	   $myCalendar->disabledDay('Sat');
	   $myCalendar->disabledDay('Sun');
	  $myCalendar->setDateFormat('j F Y');
	  $myCalendar->writeScript();
	  ?></td>
                    <td></td>
                  </tr>
                </table>
      <br/>
  <br/>
    
      <input name="action" type="submit" id="action" value="Block">
      <br/>
  <br/>
    <?php echo"<strong><font COLOR=GREEN>########################</font></strong>";?> <?php }

?><br/>
  <br/>
       <span style="text-align:center"><a href="http://www.canterburyenglish.com/profesores/admin/recursos/Canterbury_English_Agenda_teacher.pdf" target="_blank">View the agenda teacher's guide</a></span>
      <br/>
  <br/>
   <table width="730" border="0" class="submit-button">
  <tr>
    <td bordercolor="#000000">
      <p><strong><font COLOR=YELLOW>•	The start date on which the system allows you to make an appointment is from the 25th (at 00:00 h) for the pay period that begins on the 1st and ends on the 10th of every month. <br /><br />
        •	The office is NOT open on weekends! <br /><br />
        •	Please be on time for your appointment, if you arrive more than 10 minutes late, your appointment will be cancelled and you'll have to sign up for the next available appointment! <br /><br />
        •	All student reports must be completed before you can get paid (This applies ONLY to the June and December pay periods or before your last pay appointment for a class that has ended). If the student report is not done correctly you will have to sign up for another pay appointment. <br /><br />
        •To access the reports, go to the Student Reports menu option. </font></strong></p></td>
  </tr>
 
</table>

  
    </form>
   
    
 <?php  include 'includes/foot.php'?>
    


