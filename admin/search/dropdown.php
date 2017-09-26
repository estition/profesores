<?php include '../../includes/constants.php'?>
<?php include '../../includes/functions.php'?>
<?php include '../../includes/database.php'?>
<?php include '../../includes/authorize.php'?>
<?php

     print_r($_POST['my-select']);
    if (isset($_POST['enviar'])) {
		echo '<p>Opciones seleccionadas: ';
        foreach ($_POST['my-select'] as $tag){
			 
			$rest = substr($tag, 0, 1); 
			$tag = substr($tag, 2); 
			//echo $rest."XX";
			switch ($rest) {
    case "1": 
	$tag1[]  = $tag;
	 break;
    case "2":
	$tag2[]  .= $tag;
	 break;
	   case "3": 
	$tag3[]  = $tag;
	 break;
    case "4":
	$tag4[]  = $tag;
	break;
	   case "5": 
	$tag5[] = $tag;
	 break;
	 case "6": 
	$tag6[]  = $tag;
	 break;
			}

           }
        echo '</p>';
		//print_r($_POST['my-select']);
		if (empty($tag1)) {$tag1[] = " ";} 
		if (empty($tag2)) {$tag2[] = " ";} 
		if (empty($tag3)) {$tag3[] = " ";} 
		if (empty($tag4)) {$tag4[] = " ";} 
		if (empty($tag5)) {$tag5[] = " ";} 
		if (empty($tag6)) {$tag6[] = " ";} 
		$tag1 = implode("|",$tag1);
		$tag2 = implode("|",$tag2); 
		$tag3 = implode("|",$tag3); 
		$tag4 = implode("|",$tag4); 
		$tag5 = implode("|",$tag5); 
		$tag6 = implode("|",$tag6);
		
$sql .= "select id, first, is_admin, CLASS_TYPE, metro, spanish_level, country,  mobile, email from users  where is_active = '1' and baja ='0' and "; 

if ($tag1 != " ") $sql .= " ZONES REGEXP '(,|^){$tag1}(,|$)'";
	if ( ($tag1  != " ") && ($tag2  != " ") ) $sql .= " and ";
	if ($tag2 != " ") $sql .= "CERTIFICATION REGEXP '(,|^){$tag2}(,|$)' ";
	if ( (($tag1  != " ") || ($tag2  != " ")) && ($tag3  != " ") ) $sql .= " and ";
	if ($tag3 != " ") $sql .= "CLASS_TYPE REGEXP '(,|^){$tag3}(,|$)'";
	if ( (($tag1  != " ") || ($tag2  != " ") || ($tag3  != " ")) && ($tag4  != " ") ) $sql .= " and ";
	//if ($cb_date) $sql .= " AÑO_INFORME >= " . $y1 . " and AÑO_INFORME <= " . $y2 . " and ";
	if ($tag4 != " ") $sql .= " GENDER REGEXP '(,|^){$tag4}(,|$)'";
	if ( (($tag1  != " ") || ($tag2 != " ") || ($tag3 != " ") || ($tag4 != " ")) && ($tag5 != " ") ) $sql .= " and ";
	if ($tag5 != " ") $sql .= " AVAILABILITY REGEXP '(,|^){$tag5}(,|$)' ";
    if ( (($tag1 != " ") || ($tag2 != " ") || ($tag3 != " ") || ($tag4 != " ") || ($tag5 != " ")) && ($tag6 != " ") ) $sql .= " and ";	
	if ($tag6 != " ") $sql .= " spanish_level REGEXP '(,|^){$tag6}(,|$)' ";
	
	$sql .= " order by first;";


print $sql."cccccc";
$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
?>
<link href="css/canterbury.css" type="text/css" rel="stylesheet">
<table border="0" cellpadding="1" cellspacing="0" bgcolor="#CCCCCC" id="border">
                <tr> 
                  <td><table border="0" cellpadding="2" cellspacing="0" bgcolor="#FFFFFF" id="listing">
                      <tr>
                      	<td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Name</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Group</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Country</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Mobile</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Metro</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
						<td bgcolor="#eeeeee"><font size="-1"><b>Spanish Level</b></font></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><font size="-1"><b>Delete?</b></font></td>
						<td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><div align="center"><font size="-1"><b>Dar de baja?</b></font></div></td>
						<td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><div align="center"><font size="-1"><b>Dar de alta?</b></font></div></td>
                        <td bgcolor="#eeeeee"><font size="-1">&nbsp;</font></td>
                        <td bgcolor="#eeeeee"><div align="center"><font size="-1"><b>Send Email?</b></font></div></td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                      </tr>
                      <tr>
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
                 
<?php
$contador=1;
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	$type = "Teacher";
	$edit_page = "profile.php";
	if ($row["is_active"]) {
		$type = "Active Teacher";
	} else {
		$type = "Inactive Teacher";
	}
	
	if ($row["is_admin"]) {
		$type = "Administrator";
	}

	if ($bg == "#FFFFFF") {
		$bg = "#B6C5F2";
	} else {
		$bg = "#FFFFFF";
	}
	
	
	print "<tr>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	if($row["baja"]=='1') {
	print "<td bgcolor='" . $bg ."'><a href='" . $edit_page . "?id=" . $row["id"] . "'>" .  $row["first"] ."</a></td>";
	}
	else
	{
	print "<td bgcolor='" . $bg ."'><a href='" . $edit_page . "?id=" . $row["id"] . "'><strong>".  $row["first"] . "</strong></a></td>";
	}
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td bgcolor='" . $bg ."'><i>" . $row['group_type'] . "</i></td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td bgcolor='" . $bg ."'><i>" . $row['country'] . "</i></td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td bgcolor='" . $bg ."'><i>" . $row['mobile'] . "</i></td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td bgcolor='" . $bg ."'><i>" . $row['metro'] . "</i></td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td bgcolor='" . $bg ."'><i>" . $row["spanish_level"] . "</i></td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td bgcolor='" . $bg ."'> <div align='center'> </strong> <input name='delete[]' type='checkbox' id='delete' value='" . $row["id"] . "'> </div> </td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td bgcolor='" . $bg ."'> <div align='center'> <input name='baja[]' type='checkbox' id='baja' value='" . $row["id"] . "'> </div> </td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td bgcolor='" . $bg ."'> <div align='center'> <input name='alta[]' type='checkbox' id='alta' value='" . $row["id"] . "'> </div> </td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	
	if ( ($row['email']!="") && ($row['baja']==0) ) {	
						echo "<td bgcolor='" . $bg ."' style=\"text-align:center\"><input type=\"checkbox\" name=\"reportSelection".$contador."\" id=\"reportSelection".$contador."\" value=\"".$row["id"]."\" /> </td>";	
					} else {
						echo "<td bgcolor='" . $bg ."' style=\"text-align:center\"><input type=\"checkbox\" name=\"reportSelection".$contador."\" id=\"reportSelection".$contador."\" value=\"".$row["id"]."\" disabled=\"true\" /> </td>";	
					}
	
	
	
	

	print "</tr>";
	$contador++;
}
            
?> 
                      <tr> 
                       <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee"></td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee"></td>
                        <td bgcolor="#eeeeee"></td>
                        <td bgcolor="#eeeeee"></td>
                        <td bgcolor="#eeeeee"></td>
                        <td bgcolor="#eeeeee"></td>
                        <td bgcolor="#eeeeee"></td>
                        <td bgcolor="#eeeeee"></td>
                        <td bgcolor="#eeeeee"></td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                      <td bgcolor="#eeeeee">&nbsp;</td>
                      <td bgcolor="#eeeeee">&nbsp;</td>
                      <td bgcolor="#eeeeee">&nbsp;</td>                    </tr>
                      <tr>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td colspan="18" bgcolor="#eeeeee">
                        
  
                          
                        </div></td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                      </tr>
                      <tr>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                        <td bgcolor="#eeeeee">&nbsp;</td>
                      <td colspan="5" bgcolor="#eeeeee"></td>
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
		
<?php		
    }
?>