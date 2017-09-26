
<?php include 'includes/constants.php'?>
<?php include 'includes/functions.php'?>
<?php include 'includes/database.php'?>
<?php include 'includes/authorize.php'?>
<?php



if ($_POST['action'] == "Delete") {
	foreach ($_POST['delete'] as $id) {
   	$sql = 'delete from holidays where id = ' . $id;
   	mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
    $message = "Holiday deleted.";
	}
}

if ($_POST['action'] == "Add holiday") {
  $sql = "insert into holidays (day, description) values ('" . $_REQUEST['day'] . "', '" . $_REQUEST['description'] .  "')";
  mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
  $message = "Holiday added.";
}

$page_name = "classday";
?>
<?php include '../../includes/top.php'?>

<div style="position: relative;" align="right">  
</div>  


 <table width="100%" border="0" class="pepe" cellpadding="10" cellspacing="0" id="body">
        <tr> 
          <td width="100%" valign="top"> <p><b>Classday Admin -  
              <font color='#ff9900'><?php echo  $message ?></font></b></p>
            <!--start dynamic code -->
            <form method="post">
      				The holidays configured on this screen appear in orange on the calendar <br>and warn students who attempt to input classes on them.
              <br><br>
             
                  <table border="0" class="pepe" cellpadding="2" cellspacing="0" bgcolor="#ccc" id="listing" width="100%">
                      <tr>
                      	<td colspan="8" align="right">Date: <input type="text" size="8" name="day"> (YYYY-MM-DD)  
                      	&nbsp;&nbsp;Description: <input type="text" size="20" name="description"> 
                      	<input name="action" type="submit" id="action" value="Add holiday"></td>
                      </tr>
                      <tr>
                      	<td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Date</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Description</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Delete?</b></font></td>
                      </tr>

<?php

$sql = "select * from holidays order by day desc ";
//print $sql;
$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));

$numRows = mysqli_num_rows($result);
 
if ($numRows > 0) {
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		
		if ($bg == "#FFFFFF") {
			$bg = "#B6C5F2";
		} else {
			$bg = "#FFFFFF";
		}
		
		print "<tr>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		print "<td bgcolor='" . $bg ."'>". $row['day'] . "</td>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		print "<td bgcolor='" . $bg ."'>" . $row["description"] . "</td>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		print "<td bgcolor='" . $bg ."'><input name='delete[]' type='checkbox' id='delete' value='" . $row["id"] . "'></td>";
		print "</tr>";
	}
} else {
		print "<tr>";
		print "<td colspan='4'>There are no holidays currently configured in the system.</td>";
		print "</tr>";
}            
?> 


                    <tr> 
                      <td bgcolor="#eeeeee">&nbsp;</td>
                      <td bgcolor="#eeeeee">&nbsp;</td>
                      <td bgcolor="#eeeeee">&nbsp;</td>
                      

                      <td bgcolor="#eeeeee" align="right" colspan="3"><input name="action" type="submit" id="action" value="Delete"> 
                        <br>
                        checked items</td>
                    </tr>
                  </table>
    
           </form>
                </td>
  </tr>
</table>

 </div>  
      
<?php include 'includes/foot.php'?>