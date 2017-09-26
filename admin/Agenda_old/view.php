<?php include 'includes/constants.php'?>
<?php include 'includes/functions.php'?>
<?php include 'includes/database.php'?>
<?php include 'includes/authorize.php'?>

<?php include 'includes/top.php'?>
<?php include 'includes/menu.php'?>
  
    <?php
	
	    
	  include_once("consult.php");
	
	  $consultar_eventos=new consult;
      
  if($is_admin_a){
	 if ((date('d') == "01") || (date('d') == "02") || (date('d') == "03") || (date('d') == "04")){
	  	 
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

echo "<h1>Appointment list</h1>";

$authorize_eventos=new authorize_user;
        $teachers=$authorize_eventos->authorizeUser();

	
	//$gdataCal->settingsProperty name="locale" value="en_US";
  $seek = "";
    if(isset($_GET['q'])) {
      $seek = $_GET['q']; }
	 
	 
	echo "<ul>\n";

  $eventFeed=$consultar_eventos->ver_reg($seek);
  
 
  if($is_admin_a){
  $long = $eventFeed->totalResults;
  settype($long, "string");
  
  echo "\t<h2>Total:" . $long. "</h2>";
  echo"<h2><strong><font COLOR=RED>_________________________________________________________________________________________</font></strong></h2>";
  }
  	$i = 0;
  foreach ($eventFeed as $event) {
  
echo "<h2>".++$i. "</h2>";
      echo "\t<li><h2>" . stripslashes($event->title) . "</h2></li>";
	  
	  
	  
	 // echo "\t\t<ul>\n";
	 



    foreach ($event->when as $when) {
	
			
	
	
	$diaEvento=$when->startTime;
	 
	
	    $yy = intval(substr($diaEvento,0,4));

		$mm = intval(substr($diaEvento,5,2));

		$dd = intval(substr($diaEvento,8,2));

		$hh = intval(substr($diaEvento,11,2));

		$min = intval(substr($diaEvento,14,2));
		
			  
	   $tiempo = date(DATE_RSS, mktime($hh , $min, 0, $mm, $dd, $yy ));
	   
	   
	   
	   
		 $name0 = $id_arti."-".$first." ".$last1." ".$last2;
		 $name = intval(substr($name0,0,6));
		 
		 $title0 =  $event->title;
		 
		 $title1 = intval(substr($title0,0,6));
		 
		 
		 
	  echo "\t\t <h3>Pay day: <font COLOR=GREEN>" . substr($tiempo,0,22) . "</font></h3>";
	
	 
	   
	  echo "\t\t <h3>Appointment status: <font COLOR=GREEN>" .$event->where[0]. "</font></h3>";
	
	
	
 if($is_admin_a){
  echo "\t\t <strong>Envelopes Summary: </strong>" . $event->content . "<br/>\n";
 
	  $id = substr($event->id, strrpos($event->id, '/')+1);
	 
      echo "<a href=\"edit.php?id=$id\">edit</a> | ";
      echo "<a href=\"delete.php?id=$id\">delete</a><br/>\n ";
	  }
	  
	  else if ( $title1 == $name) {
	  
	  $id = substr($event->id, strrpos($event->id, '/')+1);
      echo "<a href=\"edit.php?id=$id\">edit</a> | ";
      echo "<a href=\"delete.php?id=$id\">delete</a><br/>\n ";
	 
      }
	echo"<strong><font COLOR=GREEN>________________________________________________________________________________________________________________________________</font></strong>";
	  
	  echo "<br/>\n";
	  echo "<br/>\n";
	// echo "\t\t</ul>\n";
      }
    
	 
    //  $dias[$diaMesEvento] .= $event->title.". Date: ".substr($diaEvento,0,10). "Hora: ".substr($diaEvento,11,5);
	// $dias[$diaMesEvento] .= $event->title.". Hora: ".substr($diaEvento,11,5)." (".substr($diaEvento,23,6).")n";
	// echo "LAAAAAAAAAAAAAA".$hh."/".$min."/".$yy."LAAAAAAAAAAA";
	//echo stripslashes( $dias[$diaMesEvento]) . " <br/>\n";
	    }
		
   echo "</ul>\n";


		$compName1 = $id_arti."-".$first." ".$last1." ".$last2;
		
		
		
         $eventFeed1=$consultar_eventos->ver_reg($compName1);
		
		
		$total = $eventFeed1->totalResults; 
		

 if(($total == "0") && (!$is_admin_a)){
	 echo "<br/><br/><a href=add.php>Add a pay new appointment</a><br/>\n";
	  echo "<br/>\n";}
	
else if ($is_admin_a) {?>


<br/><br/><a href=add.php>Add a new pay appointment</a><p/><br/>

    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="get">
      Search teachers's appointment:<br/><br/>
      <select name="q" ><?php echo  $teachers; ?></select><p/>
      <input type="submit" name="submit" value="Search"/>
      <br/>
  <br/>
       <span style="text-align:center"><a href="http://www.canterburyenglish.com/profesores/admin/recursos/Canterbury_English_Agenda_teacher.pdf" target="_blank">View the agenda teacher's guide</a></span>
      <br/>
  <br/>
  <table width="400" border="0" class="submit-button">
  <tr>
    <td bordercolor="#000000">
      <ul>
        <li><strong><font COLOR=RED> The office is NOT open on weekends!</font></strong></li><br>
             <li> <strong><font COLOR=RED>Please be on time for your appointment, if you arrive more than 10 minutes late, your appointment will be cancelled and you'll have to sign up for the next available appointment!</font></strong></li>
      </ul></td>
  </tr>
 
</table>

  
    </form>
   <?php }

?>
    
 <?php  include 'includes/foot.php'?>
    
