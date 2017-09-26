<?php include 'includes/constants.php'?>
<?php include 'includes/functions.php'?>
<?php include 'includes/database.php'?>
<?php include 'includes/authorize.php'?>
<?php include 'includes/config.php'?>
<?php

$page_name = "import";

?>
<?php include 'includes/top.php'?>
<?php include 'includes/menu.php'?>

<?php


//$idiomas = odbc_connect("idiomas", "canterbury", "idiomas");


if ($_POST['action'] == "Import") {
	Conectar();
	
	//Importacion();
	
	}
	/*
	$sql = "select * from profesor";
	$result = odbc_do($idiomas, $sql);
	if (!$result) { 
		exit("Error in SQL");
	} 
	
	$teacher_count = 0;
	while ($row = odbc_fetch_row($result)) {
		$sql = "select * from users where old_id = " . odbc_result($result,"codigo");
		//print $sql . "<br>";
		$result2 = mysqli_query($link, $sql);
		if ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
			print "";
		} else {
			$user = explode(" ", odbc_result($result,"nombre"));
			
			$inital =  substr($user[0], 0, 1);
			$first = $user[0];
			$last = $user[1];
			$last2 = $user[2];
			$active = 0;
			if (odbc_result($result,"contratado") == 1) {
				$active = 1;
			}
	
			for ($i = 3; $i < (count($user) + 1); $i++) {
				$last2 .= " " . $user[$i];
			}
			$last2 = trim($last2);
			
			//print ": " . $first . " " . $last . " " . $last2 . " " . count($user) . "<br>";
	
			$last = str_replace("''", "", $last);
			$sql = "select * from users where user_id = '" . $initial . $last . "'";
			$result7 = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
			if (mysql_num_rows($result7) > 0) {
				$initial = substr($user[1], 0, 1);
				//print substr($user[1], 0, 2) . $user[0];
			}
			
			
			$sql = "select * from users where user_id = '" . $initial . $last . "'";
			$result3 = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
			if (mysql_num_rows($result3) > 0) {
				print "ERROR";
			}
			
			$sql = "insert into users (old_id, user_id, is_admin, is_active, changePassword, password, first, last1, last2) values ";
			$sql = $sql . "(" . odbc_result($result,"codigo") . ", '" . strtolower($inital . $last) . "', 0, " . $active . ", 1, '" . "canterbury1" . "', '" . $first . "', '" . $last . "', '" . $last2 . "')";
			//print $sql;
			mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));

			$teacher_count++;
		}
	}
		

		$sql = "select * from grupos where baja = 0 and historico = 0";
		$result = odbc_do($idiomas, $sql);
		if (!$result) { 
			exit("Error in SQL");
		} 
		
		$client_count = 0;
		while ($row = odbc_fetch_row($result)) {
			$sql = "select old_id from groups where old_id = (" . odbc_result($result,"codigo") . " + 0)";
			$result2 = mysqli_query($link, $sql);
			if ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
				print "";
			} else {
				
				$sql = "insert into groups (old_id, cif, name, start) values ";
				$sql = $sql . "(" . odbc_result($result,"codigo") . ", '" . odbc_result($result,"cif") . "', '" . odbc_result($result,"empresa") . "', '" . odbc_result($result,"fechainicio") . "')";
				//print $sql;
				mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
				$client_count++;
			}
		}

	$sql = "select codigo, codprofesor from grupos where codprofesor is not null and not (codprofesor  = '') and baja = 0 and historico = 0";
	$result = odbc_do($idiomas, $sql);
	if (!$result) { 
		exit("Error in SQL");
	}

	$changes = 0;
	while ($row = odbc_fetch_row($result)) {
			$sql = "select id from groups where old_id = (" . odbc_result($result,"codigo") . " + 0)";
			$result2 = mysqli_query($link, $sql);
			// get the new group id
			if ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
				$new_group_id = $row2['id'];
				//print $new_group_id;
			}
			
			// get the new user id
			$sql = "select id from users where old_id = (" . odbc_result($result,"codprofesor") . " + 0)";
			$result2 = mysqli_query($link, $sql);
			// get the new group id
			if ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
				$new_user_id = $row2['id'];
				//print $new_user_id;
			}
			if ($new_user_id && $new_group_id) {
				
				$sql = "select * from userGroup where user_id = " . $new_user_id . " and group_id = " . $new_group_id;
				$result2 = mysqli_query($link, $sql);
				$count = mysql_num_rows($result2);
				
				if ($count == 0) {
					$sql = "insert into userGroup (user_id, group_id, start, end) values";
					$sql .=	"(" . $new_user_id . ", " . $new_group_id . ", '2004-09-01' , null)";
					mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
					$changes++;
				}
			}
		}


}

*/

?>



 <table width="100%" border="0" cellpadding="10" cellspacing="0" id="body">
        <tr> 
          <td width="100%" valign="top"> <p><b>Import 
              <br><font color='#ff9900'><?php echo  $message ?></font></b></p>
            <!--start dynamic code -->
            <form method="post">
            <?php
            	if ($_POST['action'] == "Import") {
            		print $client_count . " clients imported.<br>";
            		//print $teacher_count . " teachers imported.<br>";
            		print $changes . " teacher/client relationships updated.";
            	} else {
            		print "Click import to begin.  This could take a while.";
            	}
            	?>
              <br><br>
              <table border="0" cellpadding="1" cellspacing="0" bgcolor="#CCCCCC" id="border" width="80%">
                <tr> 
                  <td>
                  <table border="0" cellpadding="2" cellspacing="0" bgcolor="#FFFFFF" id="listing" width="100%">
                     <tr> 

                      <td bgcolor="#eeeeee" align="left"> <input name="action" type="submit" id="action" value="Import"></td>
                    </tr>
                  </table>
    
    						</td>
              </tr>
            </table>
           </form>
                </td>
  </tr>
</table>
<?php include 'includes/foot.php'?>