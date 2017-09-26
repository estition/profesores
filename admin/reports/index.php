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

<?php


$sql = "select a.id, c.id, b.id as teacher_id, c.name, c.apellido1, first, c.group_type, a.start, c.days,a.starttime, c.class_type, a.length, (select count(id) from clients d where group_id = c.id) as num from userGroup a, users b, groups c where a.user_id = b.id and  a.group_id = c.id and a.end is null and c.baja = '0' order by c.name";


$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));

$page_name = "client admin";
?>
<?php include '../../includes/top.php'?>
                   
        <br /> <br />
        
        

    
      <b><font color='#ff9900'><?php echo  $message ?></font></b>
        
              
      <!--begin dynamic list -->
      <form action="index.php" name="edit_directory" id="edit_directory" method="post">
      
       <?php
require_once('calendar/classes/tc_calendar.php');


?>

		  <table border="0" cellspacing="0" cellpadding="2">
                  <tr>
            
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
	  ?>             </tr><td> <input name="action" type="submit" id="action" value="getdate"></td>
        </table>
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

			
				
				$month = (int) date('n', time());

	            $year = (int) date('Y', time());
				
				$days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
	
				$fromday = $year . "-" . $month . "-01";
				
				$today = $year . "-" . $month . "-" . $days;
			
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

if ($_REQUEST['action'] == "getdate") {


    $type = $row['group_type'];
	$end =   $row["end"];
	$id =   $row["id"];
	$name = $row["name"]." ".$row["apellido1"];
	$opciones = $id.",".$end.",".$type;
	$count = $row['num'];
	
	

	$sql2 = "select b.id, hours, name, b.id as group_id, a.class_type from entry a, groups b ";
	$sql2 .= "where a.group_id = b.id and a.user_id = " . $row['teacher_id'] . " and a.day >= '" . $_REQUEST["date1"] . "' and a.day <= '" . $_REQUEST["date2"] . "' ";
	$sql2 .= " and ( a.concept_id = 1 or a.concept_id = 3 or a.concept_id = 5) group by b.id, hours, a.class_type  order by day asc, hours asc";
	//print $sql;
	$result2= mysqli_query($link, $sql2) or die("Invalid query: " . mysqli_error($link));
	$numRows = mysqli_num_rows($result2);
	
	if ($numRows > 0) {
		while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
		

 $sql1 = "select b.id, date_format(day, '%d') as day, name, observations, hours, concept_id, a.class_type, supplement from entry a, groups b ";
 	$sql1 .= "where a.group_id = b.id and a.user_id = " . $row['teacher_id'] . " and day >= '" . $_REQUEST["date1"] . "' and day <= '" . $_REQUEST["date2"] . "' and hours = " . $row["length"] . " and a.class_type = " . $row['class_type'];
				//print $sql1;
				$sql1 .= " and ( concept_id = 1 or concept_id = 3 or concept_id = 5)";
				
	
				$result1 = mysqli_query($link, $sql1) or die("Invalid query: " . mysqli_error($link));
				$all_taught = 0;
				$total_taught = 0;
				$total_noshow = 0;
				$total_makeup = 0;
				//$dates = "";
				
				$row_sum = 0;
				$row_taught = 0;
				
					$sum = 0;
	$taught = 0;
		
	
	$all_noshow = 0;	//late student cancellation$theDate = isset($_REQUEST["date1"]) ? $_REQUEST["date1"] : "";
	$all_makeup = 0;
	
	
			
				while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {

$sql = "select client_price, type from prices where type = " . $row['class_type'] .  " and hours = " . $row['length'];
					$result3 = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
					$row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC);
						if ($row1['concept_id'] == 1) {
						$total_taught += 1;
						$all_taught += 1;
						$taught_sum = $row3['client_price'] + $supplement;
						$row_sum += $taught_sum;
						$row_taught += 1;
					} else {
						$hours = "";
					}
					
					if ($row1['concept_id'] == 3) {
						$total_noshow += 1;
						$all_noshow += 1;
						$noshow_sum = $row3['client_price'] + $supplement;
						$row_sum += $noshow_sum;
						$row_taught += 1;
					} else {
						$hours = "";
					}
					
					if ($row1['concept_id'] == 5) {
						$total_makeup += 1;
						$all_makeup += 1;
						$makeup_sum = $row3['client_price'] + $supplement;
						$row_sum += $makeup_sum;
						$row_taught += 1;
					} else {
						$hours = "";
					}
				
				}
				}
			 	
		 $sum += $row_sum;
			  $taught += $row_taught;
			  }
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
	print "<td bgcolor='" . $bg ."'><a href='" . $edit_page . "?id=" . $row["id"] . "'>" .$name."</a></td>";
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
	
	print "<td align='center' bgcolor='" . $bg ."'>" . $all_taught . "</td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";

	print "<td align='center' bgcolor='" . $bg ."'>" . $all_noshow . "</td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	
	print "<td align='center' bgcolor='" . $bg ."'>" . $all_makeup . "</td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	
	print "<td align='center' bgcolor='" . $bg ."'>" . $taught  . "</td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	
	print "<td align='center' bgcolor='" . $bg ."'>" . $sum . " €</td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	
	
	print "</tr>";
	

			 
	
}
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
