<?php include '../../includes/constants.php'?>
<?php include '../../includes/functions.php'?>
<?php include '../../includes/database.php'?>
<?php include '../../includes/authorize.php'?>

<script language="javascript">

//var da = (document.all) ? 1 : 0; 
/*var pr = (window.print) ? 1 : 0; 
var mac = (navigator.userAgent.indexOf("Mac") != -1); */

function printThis() { 
	window.print();
} 

</script> 


<?php 

function DameFechas($GrupoId,$fromday,$today,$concept_id)
     {
	 $Resultado = " ";
	 $sqlJBT = "select date_format(entry.day, '%d') as day from entry,groups ";
	 $sqlJBT .= "where entry.day >= '" . $fromday . "' and entry.day <= '" . $today . "' and entry.group_id = " . $GrupoId;
	 $sqlJBT .= " and entry.concept_id = " . $concept_id . " and groups.id = entry.group_id order by entry.day";
	 //$sqlJBT .= "and groups.name REGEXP BINARY '^[ABCDEFGHIJKLMNÑOPQRSTUVWXYZ][ABCDEFGHIJKLMNÑOPQRSTUVWXYZ]'";
	 //print $sqlJBT;
	 
	 //exit;
	 
	 $rsJBT = mysqli_query($link, $sqlJBT) or die("Invalid query: " . mysqli_error($link));
				while ($rowJBT = mysqli_fetch_array($rsJBT, MYSQLI_ASSOC)) {
				   $Resultado .= $rowJBT['day']. " ";
				   }
	 
	 return $Resultado;			   
	 }

$month = $_REQUEST['month'];

if ($month == "") {
	$month = (int) date('n', time());
}

$year = $_REQUEST['year'];
if ($year == "") {
	$year = (int) date('Y', time());
}

for ($j=2004; $j < 2010; $j++) {
	if ($year == $j) {
		$selected = "selected";
	} else {
		$selected = "";
	}
	$years .= "<option " . $selected . " value='" . $j . "'>" . $j . "</option>";
}

		for ($i=1; $i <= 12; $i++) {
			if ($month == $i) {
				$selected = "selected";
			} else {
				$selected = "";
			}
			
			$spelled = date('F', strtotime($j . '-' . $i . '-' . 1));
			$months .= "<option " . $selected . " value='" . $i . "'>" . $spelled . "</option>";
		}



		if ($year != "") {
			$days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
			
			$fromday = $year . "-" . $month . "-01";
			$today = $year . "-" . $month . "-" . $days;
		}
	 
  ?>
		  <script language="javascript">
         function sel() {
                    document.forms.myform.submit();
                }
         </script>
  
<?php $sql = "SELECT first, telephone1, mobile, email, day, observations, total, users.id from users, (Select * from (select user_id, day, observations, total from paysheet where day='".$fromday."') as paysheet1 right join (select user_id from entry where day>='".$fromday."' and day<='".$today."' group by user_id) as entry1 using (user_id)) as resultado where users.id=resultado.user_id order by first;";

$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
$page_name = "Payshee Resume";
?>

 <table width="100%" border="0" cellpadding="10" cellspacing="0" id="body">
        <tr> 
          <td width="100%" valign="top"> <p><b>All Teachers Monthly Paysheet Report </b></p>
            <p>This section show's the teachers that have and have not been paid for the month and year selected.</p>
            
		<table width="100%"><td valign="baseline">
        <form method="post" name="myform" id="myform" action="">
        <input type="hidden" name="fromday" value="<?php echo $fromday?>">
        <input type="hidden" name="today" value="<?php echo $today?>">
        <input type="hidden" name="paysheet_id" value="<?php echo $paysheet_id?>">
        <input type="hidden" name="month" value="<?php echo $month?>">
        <input type="hidden" name="year" value="<?php echo $year?>">
        
        <select name="month" onChange="javascript:sel()"><?php echo  $months; ?></select>
        <select name="year" onChange="javascript:sel()"><?php echo  $years; ?></select>
          
        </form>
        </td><td valign="top"><input type="button" onClick="javascript:printThis();" value="Print List"></td></table>
		
        </tr>


<b><font color='#ff9900'><?php echo $message ?></font></b>

      <form action="index.php" name="edit_directory" id="edit_directory" method="post">
              <table border="0" cellpadding="1" cellspacing="0" bgcolor="#CCCCCC" id="border">
                <tr> 
                  <td>

<table border="0" cellpadding="1" cellspacing="0" bgcolor="#CCCCCC" id="border">
                <tr> 
                  <td><table border="0" cellpadding="2" cellspacing="0" bgcolor="#FFFFFF" id="listing">
                      <tr>
                      	<td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Name</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Telephone 1</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Telephone 2</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Mobile</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>E-mail</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Observations</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>                       
                        <td bgcolor="#eeeeee"><font size="-1"><b>Already Paid?</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Total paid</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        
                      </tr>
<?php
$rowverde=1;
$rowroja=1;

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	
	if ($row["total"] == NULL) {
		if($rowroja==1){
		$bg = "#CC3333";
		$rowroja = 2;
		}else {
		$bg = "#FF3E3E";
		$rowroja = 1;
		}
		$clase="blanco";		
		$fontcolor = "#FFFFFF";
	} else {
		if($rowverde==1){
		$bg = "#66CC33";
		$rowverde=2;
		}else {
		$bg = "#33FF33";
		$rowverde=1;
		}
		$clase="verde";
		$fontcolor = "#000033";		
	}
	
	
	print "<tr>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	if($row["total"]=='NULL') {
	print "<td bgcolor='" . $bg ."'><i><font color='$fontcolor'>" . $row["first"] . "</font></i></td>";
	}
	else
	{
	print "<td bgcolor='" . $bg ."'><i><font color='$fontcolor'><strong>" .  $row["first"] . "</strong></font></i></td>";
	}
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td align='center' bgcolor='" . $bg ."'><i><font color='$fontcolor'>" . $row['telephone1'] . "</font></i></td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td align='center' bgcolor='" . $bg ."'><i><font color='$fontcolor'>" . $row['telephone2'] . "</font></i></td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td align='center' bgcolor='" . $bg ."'><i><font color='$fontcolor'>" . $row['mobile'] . "</font></i></td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td align='center' bgcolor='" . $bg ."'><i><font color='$fontcolor'>" . $row['email'] . "</font></i></td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td align='center' bgcolor='" . $bg ."'><i><font color='$fontcolor'>" . $row['observations'] . "</font></i></td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	if($row["total"]!= NULL) {
	print "<td align='center' bgcolor='" . $bg ."'><font color='$fontcolor'><i> YES </font></i></td>";
	} else {
	print "<td align='center' bgcolor='" . $bg ."'><font color='$fontcolor'><i> NO </font></i></td>";
	}
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td align='center' bgcolor='" . $bg ."'><font color='$fontcolor'><i>" . $row['total'] . "</font></i></td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "</tr>";
}
            
?> 


</table>          
      
      </table>
</table>