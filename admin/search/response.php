<?php include '../../includes/constants.php'?>
<?php include '../../includes/functions.php'?>
<?php include '../../includes/database.php'?>
<?php include '../../includes/authorize.php'?>
<?php


  //validador de email
function validaEmail($email) {
    // First, we check that there's one @ symbol, and that the lengths are right
    if (!preg_match("/^[^@]{1,64}@[^@]{1,255}$/", $email)) {
        // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
        return false;
    }
    // Split it into sections to make life easier
    $email_array = explode("@", $email);
    $local_array = explode(".", $email_array[0]);
    for ($i = 0; $i < sizeof($local_array); $i++) {
         if (!preg_match("/^(([A-Za-z0-9!#$%&'*+\/=?^_`{|}~-][A-Za-z0-9!#$%&'*+\/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$/", $local_array[$i])) {
            return false;
        }
    }    
    if (!preg_match("/^\[?[0-9\.]+\]?$/", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
        $domain_array = explode(".", $email_array[1]);
        if (sizeof($domain_array) < 2) {
                return false; // Not enough parts to domain
        }
        for ($i = 0; $i < sizeof($domain_array); $i++) {
            if (!preg_match("/^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$/", $domain_array[$i])) {
                return false;
            }
        }
    }
    return true;
}

//echo $_POST["my-select1"]."RRRR";
if(isset($_POST["my-select1"])) 
{	//check $_POST["content_txt"] is not empty
 
    $contentToSave = $_POST["my-select1"];
	if($contentToSave != 'null' ){
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
	 case "7": 
	$tag7[]  = $tag;
	 break;
	  case "8": 
	$tag8[]  = $tag;
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
		if (empty($tag7)) {$tag7[] = " ";}
		if (empty($tag8)) {$tag8[] = " ";}
		$tag1 = implode("|",$tag1);
		$tag2 = implode("$|^",$tag2); 
		$tag3 = implode("|",$tag3); 
		$tag4 = implode("$|^",$tag4); 
		$tag5 = implode("|",$tag5); 
		$tag6 = implode("|",$tag6);
		$tag7 = implode("|",$tag7);
		$tag8 = implode("|",$tag8);
		
		//echo $tag1."jjj";
		
$sql .= "select id, first, is_admin, CLASS_TYPE, metro, spanish_level, country,  mobile, email from users  where is_active = '1' and baja ='0' and "; 

if ($tag1 != " ") $sql .= "ZONES REGEXP '(,|^){$tag1}(,|$)'";
	if ( ($tag1  != " ") && ($tag2  != " ") ) $sql .= " and ";
	if ($tag2 != " ") $sql .= " CERTIFICATION REGEXP '^{$tag2}$' ";
	if ( (($tag1  != " ") || ($tag2  != " ")) && ($tag3  != " ") ) $sql .= " and ";
	if ($tag3 != " ") $sql .= " CLASS_TYPE REGEXP '(,|^){$tag3}(,|$)'";
	if ( (($tag1  != " ") || ($tag2  != " ") || ($tag3  != " ")) && ($tag4  != " ") ) $sql .= " and ";
	//if ($cb_date) $sql .= " AÑO_INFORME >= " . $y1 . " and AÑO_INFORME <= " . $y2 . " and ";
	if ($tag4 != " ") $sql .= " GENDER REGEXP '^{$tag4}$'";
	if ( (($tag1  != " ") || ($tag2 != " ") || ($tag3 != " ") || ($tag4 != " ")) && ($tag5 != " ") ) $sql .= " and ";
	if ($tag5 != " ") $sql .= " AVAILABILITY REGEXP '(,|^){$tag5}(,|$)' ";
    if ( (($tag1 != " ") || ($tag2 != " ") || ($tag3 != " ") || ($tag4 != " ") || ($tag5 != " ")) && ($tag6 != " ") ) $sql .= " and ";	
	if ($tag6 != " ") $sql .= " spanish_level REGEXP '(,|^){$tag6}(,|$)' ";
	
if ( (($tag1 != " ") || ($tag2 != " ") || ($tag3 != " ") || ($tag4 != " ") || ($tag5 != " ") || ($tag6 != " "))
 && ($tag7 != " ") ) $sql .= " and ";	
	if ($tag7 != " ") $sql .= " country REGEXP '(,|^){$tag7}(,|$)' ";
	
	if ( (($tag1 != " ") || ($tag2 != " ") || ($tag3 != " ") || ($tag4 != " ") || ($tag5 != " ") || ($tag6 != " ") || ($tag7 != " ")) && ($tag8 != " ") ) $sql .= " and ";	
	if ($tag8 != " ") $sql .= " Exam_Prep REGEXP '(,|^){$tag8}(,|$)' ";
	
	 $sql .= " order by first;";
	
//echo $sql."FF";

$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
	
	}?><table border='0' cellpadding='0' align="left" cellspacing='0' width='775px' class="container2" bgcolor='#FFFFFF' id='listing'>
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
	<td bgcolor="#eeeeee" >&nbsp;</td>
    <td bgcolor="#eeeeee" class="noprint"  >Enviar Emails?</td>
	
	
	</tr>
	
	
	<?php
		if($contentToSave != 'null' ){
	$contador=1;
				$cont=0;
			while($row = mysqli_fetch_array($result))
				{
					
	if ($bg == "#FFFFFF") {
		$bg = "#B6C5F2";
	} else {
		$bg = "#FFFFFF";
	}
					
	
	print "<tr>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
    print "<td bgcolor='" . $bg ."'><a href=../users/profile.php?id=" . $row["id"] . ">" .  $row["first"] ."</a></td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td bgcolor='" . $bg ."'><i>" . $row['country'] . "</i></td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td bgcolor='" . $bg ."'><i>" . $row['mobile'] . "</i></td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td bgcolor='" . $bg ."'><i>" . $row['metro'] . "</i></td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	print "<td bgcolor='" . $bg ."'><i>" . $row["spanish_level"] . "</i></td>";
	print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	
		if (validaEmail($row['email'])) {
					    $cont++;	
						echo "<td bgcolor='" . $bg ."' class=\"noprint\"  style=\"text-align:center\"><input type=\"checkbox\" name=\"reportSelection".$contador."\" id=\"reportSelection".$contador."\" value=\"".$row['id']."\" /> </td>";	
						
					} else {
						echo "<td bgcolor='" . $bg ."' class=\"noprint\" style=\"text-align:center\"><input type=\"checkbox\" name=\"reportSelection".$contador."\" id=\"reportSelection".$contador."\" value=\"".$row['id']."\" disabled=\"true\" /> </td>";	
					}
					$contador++;

///////////////////////////////////
							
		
		
	

	print "</tr>";
	
	
}
	
	
	
	
	
	
}}
?>
</table>

<br /><br /><br /><br />

<div id="pepe" class="noprint">
	<?php  echo "Emails ready to be sended: ".$cont; ?> 
               
     <input type="checkbox" name="allReports" id="allReports" onclick="checkAll(<?php echo $contador; ?>);" />
     
	 <input type="button" name="mail_send" id="mail_send" value="Send Emails" onClick="enviar_correo(<?php echo "'".$contador."'"; ?>)" />
      <input type="button" id="print" onClick="javascript:printThis();" value="Print"></div>
     
     <script type="text/javascript">
function printThis() { 
	window.print();
} 
	
	function enviar_correo(contador){
		//var correos="";
		var id;
		var bandId=false;
		for (i=1; i<contador; i++){
			id="reportSelection"+i;
			if (document.getElementById(id).checked==true){		
				//correos+=","+id;
				var identificador=identificador+"|"+document.getElementById(id).value;
				bandId=true;	
			}	
		}
		if (bandId==true) {
			identificador=identificador.substr(1);
		}
		if (bandId==true)  {
			window.location="envioEmailsProfes.php?identificador="+identificador;
		}else {
			alert("Por favor seleccione emails.");
		}
	}
	
	function checkAll(contador){
		if (document.getElementById("allReports").checked == true){
			for (i=1; i<contador; i++){		
				id="reportSelection"+i;
				if (document.getElementById(id).disabled==false)
					document.getElementById(id).checked=true;
			}		
		} else {
			for (i=1; i<contador; i++){		
				id="reportSelection"+i;
				document.getElementById(id).checked=false;
			}
		}		
	}
	
</script>