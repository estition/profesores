<?php include '../../includes/constants.php'?>
<?php include '../../includes/functions.php'?>
<?php include '../../includes/database.php'?>
<?php include '../../includes/authorize.php'?>

<?php
	$page_name = "schedules";

	$sql = "select id, first, last1, last2, user_id from users where is_active=1 and baja=0 order by last1";
	$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));

	
	$teachers .= "<option value='0'>Select teacher....</option>";
		

	
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		
		$sel_getschedule = "SELECT tid, uri FROM schedules WHERE tid = '".$row['id']."';";
		$sel_getschedule_result = mysqli_query($link, $sel_getschedule) or die("Invalid query: " . mysqli_error($link));
		$sel_rowsget = mysqli_fetch_array($sel_getschedule_result, MYSQLI_ASSOC);
		
		
		
		if ($_POST['teacher_id'] == $row['id']) {
			$selected = "selected";
		} else {
			$selected = "";
		}
		
		if(isset($sel_rowsget['uri'])) {
			$teachers .= "<option " . $selected . " value='" . $row['id'] . "'>" . $row['last1'] . " " . $row['last2'] . ", " . $row['first'] . "  (1) </option>";
		} else { 
			$teachers .= "<option " . $selected . " value='" . $row['id'] . "'>" . $row['last1'] . " " . $row['last2'] . ", " . $row['first'] . "</option>";
		}
		
	}


	import_request_variables('P','p_');
	
	if (isset($p_action) && ($p_teacher_id != '0') && isset($p_uriset)) {
		
		$checkteacher = "SELECT tid FROM schedules WHERE tid = '$p_teacher_id'";
		$teacherresult = mysqli_query($link, $checkteacher) or die("Invalid query: " . mysqli_error($link));
		$teacherresult_count = mysql_num_rows($teacherresult);
		
		if($teacherresult_count >= 1) {
			
			$updateschedule = "UPDATE schedules SET uri = '$p_uri' WHERE tid = '$p_teacher_id';";
			mysqli_query($link, $updateschedule) or die("Invalid query: " . mysqli_error($link));		
		
		} else {
			
			$createschedule = "INSERT INTO schedules (`sid`, `tid`, `uri`) VALUES (NULL, '$p_teacher_id','$p_uri');";
			mysqli_query($link, $createschedule) or die("Invalid query: " . mysqli_error($link));
			
		}

		$message = "Teacher schedule updated successfully";
		
	} else {
		
		$getschedule = "SELECT tid, uri FROM schedules WHERE tid = '$p_teacher_id'";
		$getschedule_result = mysqli_query($link, $getschedule) or die("Invalid query: " . mysqli_error($link));
		$getschedule_count = mysql_num_rows($getschedule_result);
		$rowsget = mysqli_fetch_array($getschedule_result, MYSQLI_ASSOC);
		
	}

?>
<?php include 'includes/top.php'?>
<?php include 'includes/menu.php'?>
<script>
function sel() {
	document.forms._schedule.submit();
}
</script>

      <table width="100%" border="0" cellpadding="10" cellspacing="0" id="body">
        <tr> 
          <td width="100%" valign="top">
          
          <p><b>View and modify teacher schedules with Canterbury</b><br>
          To add a schedule for a teacher, select their name from the dropdown box.
          </p>
          
          <b><font color='#ff9900'><?php echo  $message ?></font></b>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" name="schedule" id="_schedule" method="post">
              <table border="0" cellpadding="1" cellspacing="0" bgcolor="#738FE6" id="border">
                <tr> 
                  <td><table border="0" cellpadding="5" cellspacing="0" id="shell">
                      <tr valign="top"> 
                        <td bgcolor="#0033CC"><b><font class="textW"><a href="<?php echo $_SERVER['PHP_SELF'];?>">Refresh</a></font></b></td>
                      </tr>
                      <tr valign="top"> 
                        <td bgcolor="#B6C5F2"></td>
                      </tr>
                      <tr valign="top"> 
                        <td bgcolor="#FFFFFF"> <table border="0" cellpadding="5" cellspacing="0" id="login">
                      
                            <tr> 
                              <td valign="top"><b>Teacher:</b></td>
                              <td>
                              <select name="teacher_id" onChange="javascript:sel()">
								<?php echo $teachers?> 
							  </select>
                              </td>
                            </tr>
                            
                            <?php if($p_teacher_id): ?>
                            <?php if($getschedule_count == '1') { ?>
                            
                            <tr> 
                              <td valign="top"><b>Current URL:</b></td>
                              <td> <a target="_blank" href="<?php echo $rowsget['uri']; ?>"><?php echo $rowsget['uri']; ?></a></td>
                            </tr>
                                                     
                            <?php } ?>

                            <tr> 
                              <td valign="top"><b>Google Docs URL:</b></td>
                              <td> 
                              <input name="uriset" type="hidden" value="1"> 
                              <input name="uri" type="text" id="_uri" size="35"> 
                              </td>
                            </tr>
                            
							<?php endif; ?>

                          </table></td>
                      </tr>
                      <tr valign="top" bgcolor="#dddddd"> 
                        <td align="right" bgcolor="#B6C5F2"> 
                          <input name="action" type="submit" id="save" class="submit-button" value="Save Changes"> 
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </form>
					</td>
        </tr>
      </table></td>
  </tr>
</table>
<?php include 'includes/foot.php'?>