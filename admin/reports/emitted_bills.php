<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="calendar/calendar.css" rel="stylesheet" type="text/css" />
 <!-- <script language="javascript" src="AjaxCode.js"></script>-->
<script language="javascript" src="calendar/calendar.js"></script>
</head>
<?php include '../../includes/constants.php'?>
<?php include '../../includes/functions.php'?>
<?php include '../../includes/database.php'?>
<?php include '../../includes/authorize.php'?>

 <!--begin dynamic list -->
      <form action="emitted_bills.php" name="edit_directory" id="edit_directory" method="post">
      
       <?php
require_once('calendar/classes/tc_calendar.php');


?>

		  <table align="center" border="0" cellspacing="0" cellpadding="2">
                  <tr><td>
            
	  		<?php					
      $date1_default = "2010-01-01";
      $date2_default = "2011-12-31";

	  $myCalendar = new tc_calendar("date1", true, false);
	  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
	  $myCalendar->setDate(date('d', strtotime($date3_default))
            , date('m', strtotime($date1_default))
            , date('Y', strtotime($date1_default)));
	  $myCalendar->setPath("calendar/");
	  $myCalendar->setYearInterval(1970, 2020);
	  $myCalendar->setDatePair('date1', 'date2', $date2_default);
	  $myCalendar->writeScript();	  
	  
	  $myCalendar = new tc_calendar("date2", true, false);
	  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
	  $myCalendar->setDate(date('d', strtotime($date4_default))
           , date('m', strtotime($date2_default))
           , date('Y', strtotime($date2_default)));
	  $myCalendar->setPath("calendar/");
	  $myCalendar->setYearInterval(1970, 2020);
	  $myCalendar->setAlignment('left', 'bottom');
	  $myCalendar->setDatePair('date1', 'date2', $date1_default);
	  $myCalendar->writeScript();	  
	  ?>             </td></tr><td> <input name="action" type="submit" id="action" value="getdate"></td>
        </table>

<?php include 'includes/top.php'?>
<?php include 'includes/menu.php'?>


 
              <table border="0" width="100%" cellpadding="1" cellspacing="0" bgcolor="#CCCCCC" id="border">
                <tr> 
                  <td><table width="100%" border="0" cellpadding="2" cellspacing="0" bgcolor="#FFFFFF" id="listing">
                      <tr>
                      	<td width="1" bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td width="300"bgcolor="#eeeeee"><div align="center"><font size="-1"><b>Client's name</b></font></div></td>
                        <td width="1" bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td width="20" bgcolor="#eeeeee"><div align="center"><font size="-1"><b>Type</b></font></div></td>
                        <td width="1" bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td width="22" bgcolor="#eeeeee"><div align="center"><font size="-1"><b>Client<br>
                        count</b></font></div></td>
                        <td width="1" bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td width="250" bgcolor="#eeeeee"><div align="center"><font size="-1"><b>Teacher's name</b></font></div></td>
                        <td width="1" bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        
                       
                        
                        
                          
                        
                        
                        <td width="100" bgcolor="#eeeeee"><div align="center"><font size="-1"><b>Start date</b></font></div></td>
                        <td width="6" bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        
                        <td width="20" bgcolor="#eeeeee"><div align="center"><font size="-1"><b>Days</b></font></div></td>
                        <td width="5" bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td width="39" bgcolor="#eeeeee"><div align="center"><font size="-1"><b>Start time</b></font></div></td>
                        <td width="4" bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td width="37" bgcolor="#eeeeee"><div align="center"><font size="-1"><b>Class Length</b></font></div></td>                 
                         <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
      <td bgcolor="#eeeeee" align='center'><font size="-1"><b>Class<br> Taught</b></font>
      <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
      <td bgcolor="#eeeeee" align='center'><font size="-1"><b>Late Student<br />Cancellation</b></font>
      <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
      <td bgcolor="#eeeeee" align='center'><b><font size="-1">Makeup Taught</font><br /><font size="-2">Only preview months</font></b>
      <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
      <td bgcolor="#eeeeee" align='center'><font size="-1"><b>Total<br> Classes</b></font>
      <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
      <td bgcolor="#eeeeee" align='center'><font size="-1"><b>Total<br> Sum</b></font>
      <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
       <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
       <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
       <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
         
                                               
                      </tr>
                  
            <?php     
			  if ($_REQUEST['action'] == "getdate") { 
			  
			  $date01 = isset($_REQUEST["date1"]) ? $_REQUEST["date1"] :  date('y')."-".date('m')."-01";
              $date02 = isset($_REQUEST["date2"]) ? $_REQUEST["date2"] :  date('y')."-".date('m')."-30";

$sql = "select a.id, c.id, b.id as teacher_id, c.name, c.apellido1, c.price, c.supplement, first, c.group_type,
c.days,a.starttime, c.class_type, a.length,(select count(id) from clients d where group_id = c.id) as num from userGroup a, users b, groups c where a.user_id = b.id and  a.group_id = c.id and a.end is null and c.baja = '0'  and a.start >= '" . $date01 . "' and a.start <= '" . $date02 . "' order by c.name";


$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));

$page_name = "client admin"; 
			  
				
	         function dateconvert($date,$func) {
if ($func == 1){ //insert conversion
list($day, $month, $year) = split('[/.-]', $date); 
$date = "$year-$month-$day"; 
return $date;
}
if ($func == 2){ //output conversion
list($year, $month, $day) = split('[-.]', $date); 
$date = "$day-$month-$year"; 
return $date;
}

} 


		$date1Conv = dateconvert($date01,2); 
		$date2Conv = dateconvert($date02,2);
		
			    $section = array(
										0   => 0, 
										1   => 0,
										2	=> 0,
										3 	=> 0,
										4	=> 0,
										5   => 0,
										6   => 0);
				
				for($i=strtotime($date1Conv); $i<=strtotime($date2Conv); $i+=86400){
					
					   
					   $numerodiasemana = date('w', mktime(0,0,0,intval(substr(date("d-m-Y", $i),3,2)),intval(substr(date("d-m-Y", $i),0,2)),intval(substr(date("d-m-Y", $i),6,4)))); 
									
						  if ($numerodiasemana == 0) 
      	 						$numerodiasemana = 6; 
  							 	else 
    							  	 $numerodiasemana--; 
						
									 
									  $section[$numerodiasemana]++;
									  
									 // echo $numerodiasemana."QQQ";
																   	
					  } //print_r($section);
					  						
					
			   while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {	  
					
					  
		$sql1 = "SELECT price, client_price FROM prices WHERE  type = ".$row["class_type"]." and hours= ".$row["length"]." ";
	$result1 = mysqli_query($link, $sql1) or die("Invalid query: " . mysqli_error($link));
	$row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
	
	$total = 0;
	$opciones = explode(',',$row["days"]);
	
	  $section1 = array(
										0   => 9, 
										1   => 0,
										2	=> 0,
										3 	=> 0,
										4	=> 0,
										5   => 0,
										6   => 0);	  
	
	  foreach($section as $c=>$v){

	 switch ($opciones[$c]){
	 
	 case 'L':
	 $section1[0] = 0;
	 
		break;	
	 case 'M':
	  $section1[1] = 1;
	 
		 break;	
	 case 'X':
	  $section1[2] = 2;
	    
		 break;	
	 case 'J':
	  $section1[3] = 3;
	 
	  break;
	 case 'V':
	  $section1[4] = 4;
	  
	 break;}
	 
	
	 
	 if ($c == $section1[$c]){
	 
	   $total += $v;}
	}
	$total_cliente = $total * $row1["client_price"];
	$total_teacher = $total * $row1["price"];
	
	                  	if ($type == "Client") {
		$edit_page = "client_profile1.php";
	} else if ($type == "Group") {
		$edit_page = "group_profile.php";
	}
	
	if ($bg == "#FFFFFF") {
		$bg = "#B6C5F2";
	} else {
		$bg = "#FFFFFF";
	}
	
	print "<tr >";
	print "<td bgcolor='" . $bg ."' >&nbsp;</td>";
	print "<td bgcolor='" . $bg ."'><a href='" . $edit_page . "?id=" . $row["id"] . "'>" . $row["name"]." ". $row["apellido1"]."</a></td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td bgcolor='" . $bg ."'><i>" . $type . "</i></td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td align='center' bgcolor='" . $bg ."'>" . $count . "</td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td align='center' bgcolor='" . $bg ."'>" . $row["first"]. "</td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	
	print "<td align='center' bgcolor='" . $bg ."'>" . $row["start"] . "</td>";
    print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td align='center' bgcolor='" . $bg ."'>" . $row["days"] . "</td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td align='center' bgcolor='" . $bg ."'>" . $row["starttime"] . "</td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td align='center' bgcolor='" . $bg ."'>" . $row["length"] . "</td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	
	print "<td align='center' bgcolor='" . $bg ."'>" . $total . "</td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	
	
	print "<td align='center' bgcolor='" . $bg ."'>" . $total_cliente. "</td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";

	print "<td align='center' bgcolor='" . $bg ."'>" . $total_teacher . "</td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	
		
	print "</tr>";
	
				   
				   //echo $total."dias";	  
					  }//fin
					

}
            
?> 

                      <tr> 
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                         <td bgcolor="#eeeeee">&nbsp;</td>
                        
                       
                        <td bgcolor="#eeeeee">&nbsp;</td>
                          <td bgcolor="#eeeeee"></td>
                            <td bgcolor="#eeeeee"></td>
    
                         <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                       <td bgcolor="#eeeeee"><div align="right">
                           
                        </div></td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee"><div align="left">
                         
                        </div></td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                         <td bgcolor="#eeeeee"><div align="left">
                         
                        </div></td>
                           <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                       <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee"></td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        
                       
                       <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                         <td bgcolor="#eeeeee">&nbsp;</td>
                           <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                       <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                      </tr>
                  </table></td>
                </tr>
              </table>
              <!--end dynamic list -->
            </form>
           
    </td>
        </tr>
      </table></td>
  </tr>
</table>
<?php include 'includes/foot.php'?>