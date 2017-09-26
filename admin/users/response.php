<?php include '../../includes/constants.php'?>
<?php include '../../includes/functions.php'?>
<?php include '../../includes/database.php'?>
<?php include '../../includes/authorize.php'?>

<?php



//echo $_POST["my-select1"]."RRRR";
if(isset($_POST["my-select1"])) 
{	//check $_POST["content_txt"] is not empty
 
    $contentToSave = $_POST["my-select1"];
	
	//echo $contentToSave."KK";
	
	$contentToSave = explode(",", $contentToSave);
	//sanitize post value, PHP filter FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH Strip tags, encode special characters.
	//$contentToSave = filter_var($_POST["content_txt"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH); 
	//$id = filter_var($_POST["content_id"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
	//echo $id."pepe";
	//echo $contentToSave."PEPE2";
	// Insert sanitize string in record
	//print_r($contentToSave."DDDD");
	    foreach ($contentToSave as $tag){
			// echo $tag."oooo";
			$rest = substr($tag, 0, 1); 
			$tag = substr($tag, 2);
			
			//echo $rest."XX";
			//echo $tag."VV";
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
		
		//echo $tag1."jjj";
		
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
//echo $sql."FF";

$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
	
	?><table border='0' cellpadding='0' align="left" cellspacing='0' width='95%' bgcolor='#FFFFFF' id='listing'>
	<tr>
	<td bgcolor="#eeeeee">&nbsp;</td>
    <td bgcolor="#eeeeee">Profesor</td>
	<td bgcolor="#eeeeee">&nbsp;</td>
	<td bgcolor="#eeeeee">Pais</td>
	<td bgcolor="#eeeeee">&nbsp;</td>
	<td bgcolor="#eeeeee">Movil</td>
	<td bgcolor="#eeeeee">&nbsp;</td>
	<td bgcolor="#eeeeee">Metro</td>
	<td bgcolor="#eeeeee">&nbsp;</td>
	<td bgcolor="#eeeeee">Nivel Español</td>
	<td bgcolor="#eeeeee">&nbsp;</td>
    <td bgcolor="#eeeeee">Enviar Emails?</td>
	
	
	</tr>
	
	
	<?php
	
			while($row = mysqli_fetch_array($result))
				{
					
	if ($bg == "#FFFFFF") {
		$bg = "#B6C5F2";
	} else {
		$bg = "#FFFFFF";
	}
					
	
	print "<tr>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
    print "<td bgcolor='" . $bg ."'><a href='" . $edit_page . "?id=" . $row["id"] . "'>" .  $row["first"] ."</a></td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td bgcolor='" . $bg ."'><i>" . $row['country'] . "</i></td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td bgcolor='" . $bg ."'><i>" . $row['mobile'] . "</i></td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td bgcolor='" . $bg ."'><i>" . $row['metro'] . "</i></td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td bgcolor='" . $bg ."'><i>" . $row["spanish_level"] . "</i></td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	
	if ( ($row['email']!="") && ($row['baja']==0) ) {	
						echo "<td bgcolor='" . $bg ."' style=\"text-align:center\"><input type=\"checkbox\" name=\"reportSelection".$contador."\" id=\"reportSelection".$contador."\" value=\"".$row["id"]."\" /> </td>";	
					} else {
						echo "<td bgcolor='" . $bg ."' style=\"text-align:center\"><input type=\"checkbox\" name=\"reportSelection".$contador."\" id=\"reportSelection".$contador."\" value=\"".$row["id"]."\" disabled=\"true\" /> </td>";	
					}
	
	
	
	

	print "</tr>";
				
					
					
					
					
					
					
					
					
	/*				
					
					
					
					
					
					
					
					
					
 				 echo '<li id="item_'.$contentToSave.'">';
 				 echo '<div class="del_wrapper"><a href="#" class="del_button" id="del-'.$contentToSave.'">';
  				echo '<img src="images_group/icon_del.gif" border="0" />';
 				 echo '</a></div>';
				 
				 echo '<a href="group_profile.php?id="'.$contentToSave.'"><img src="images_group/customer.gif"></a>';
  
 				   echo '<b>'.$row["first"].'  '.$row['country'].'   '.$row['mobile'].'   '.$row['metro'].'   '.$row['spanish_level'].'   '.$row['country'].'</li>';
				   

	if ( ($row['email']!="") && ($row['baja']==0) ) {	
						echo "<a bgcolor='" . $bg ."' style=\"text-align:center\"><input type=\"checkbox\" name=\"reportSelection".$contador."\" id=\"reportSelection".$contador."\" value=\"".$row["id"]."\" /> </a>";	
					} else {
						echo "<a bgcolor='" . $bg ."' style=\"text-align:center\"><input type=\"checkbox\" name=\"reportSelection".$contador."\" id=\"reportSelection".$contador."\" value=\"".$row["id"]."\" disabled=\"true\" /> </a>";	
					}
				 
}
	
	
	
	*/
	
}
	
	
	
	
	
	
	
	
	
}
?>
</table>