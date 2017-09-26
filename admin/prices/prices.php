
<?php include '../../includes/constants.php'?>
<?php include '../../includes/functions.php'?>
<?php include '../../includes/database.php'?>
<?php include '../../includes/authorize.php'?>
<?php
if($is_admin_a) {


if ($_POST['action'] == "Delete") {
	foreach ($_POST['delete'] as $id) {
   	$sql = 'delete from prices where id = ' . $id;
   	mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
    $message = "Price entry deleted.";
	}
}

if ($_POST['action'] == "Add") {
		//**********************modificado por SVI*************************************
		
		$sql1 = "SELECT * FROM prices WHERE type ='".$_REQUEST['type']."' AND hours ='".$_REQUEST['hours']."'";
		$query= mysqli_query($link, $sql1);
		$row = mysqli_fetch_array($query, MYSQLI_ASSOC);
		
		
		if ($row["type"]!= ""){
		
				if ($row["type"] == 1) {
			$type = "Individual Class";
			}else if ($row["type"] == 2) {
			$type = "Group Class I";
			}else if ($row["type"] == 3) {
			$type = "Group Class II";
			}else if ($row["type"] == 4) {
			$type = "Group Class II";
			} else {
			$type = "Individual Class TE";
			}
		
		
		$message= "The ".$row['hours']. " hour(s) ".$type." already has a price of " .$row['price']. "� if you want to change it, please delete the old value";
		} else {
		
  		$sql = "insert into prices (type, price, hours) values ('" . $_REQUEST['type'] . "', '" . $_REQUEST['price'] .  "', '" . $_REQUEST['hours'] .  "')";
  		mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
  		$message = "Price entry added.";
  				}
}
//**********************fin modificaciones por SVI*************************************
$page_name = "prices";
?>
<?php include '../../includes/top.php'?>

<div style="position: relative;" align="right">  
</div>  


 <table width="100%" border="0" class="pepe" cellpadding="10" cellspacing="0" id="body">
        <tr> 
          <td width="100%" valign="top"> <p><b>Price entry admin -  
              <font color='#ff9900'><?php echo  $message ?></font></b></p>
            <!--start dynamic code -->
            <form method="post">
      				The price entries entered on this screen are the basis of calculations made on the teacher hours report.<br>
      				Enter the price that coincides with the class length and class type.
              <br><br>
            
                  <table border="0"  class="pepe" cellpadding="2" cellspacing="0" bgcolor="#ccc" id="listing" width="100%">
                      <tr>
                      	<td colspan="8" align="right">Hours: (ex. 1, 1.5) <input type="text" size="3" name="hours">  
                      	&nbsp;&nbsp; Type: <select name="type">
                      											<option value="1">Individual Class</option>
                                                                 <option value="5">Individual Class TE</option>
                      											<option value="2">Group Class I</option>
                                                                <option value="3">Group Class II</option>
                                                                <option value="4">Group Class III</option>
                                                                
                      										</select>
                      	&nbsp;&nbsp; Price: <input type="text" size="8" name="price">  
                      	&nbsp;&nbsp; <input name="action" type="submit" id="action" value="Add"></td>
                      </tr>
                      <tr>
                      	<td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Hours</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Type</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Price</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Delete?</b></font></td>
                      </tr>

<?php

$sql = "select * from prices order by hours, type ";
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
		//************************************************************************
		//***********************modificado por SVI*******************************
		//************************************************************************
		
		if ($row["type"] == 1) {
			$type = "Individual Class";
		}
		else if ($row["type"] == 5){
			$type = "Individual Class TE";
		}
		else if ($row["type"] == 2) {
			$type = "Group Class I";
		}
		
		else if ($row["type"] == 3) {
			$type = "Group Class II";
		} else {
			$type = "Group Class III";
		}
		//*************************************************************************
		//*****************termina modificaci�n por SVI****************************
		//*************************************************************************
		print "<tr>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		print "<td bgcolor='" . $bg ."'>". $row['hours'] . "</td>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		print "<td bgcolor='" . $bg ."'>" . $type . "</td>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		print "<td bgcolor='" . $bg ."'>" . $row["price"] . " �</td>";
		print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
		print "<td bgcolor='" . $bg ."'><input name='delete[]' type='checkbox' id='delete' value='" . $row["id"] . "'></td>";
		print "</tr>";
	}
} else {
		print "<tr>";
		print "<td colspan='4'>There are no prices currently configured in the system.</td>";
		print "</tr>";
}            
?> 


                    <tr> 
                      <td bgcolor="#eeeeee">&nbsp;</td>
                      <td bgcolor="#eeeeee">&nbsp;</td>
                      <td bgcolor="#eeeeee">&nbsp;</td>

                      <td bgcolor="#eeeeee" align="right" colspan="5"><input name="action" type="submit" id="action" value="Delete"> 
                        <br>
                        checked items</td>
                    </tr>
                  </table>
    
           </form>
                </td>
  </tr>
</table>

<?php include 'includes/foot.php'?>
<?php } else { echo "NOT AUTHORIZED TO SEE THIS PAGE, PLEASE RETURN BACK"; }?>