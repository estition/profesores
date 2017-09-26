<?php include '../../includes/constants.php'?>
<?php include '../../includes/functions.php'?>
<?php include '../../includes/database.php'?>
<?php include '../../includes/authorize.php'?>
<?php if($is_admin_a){ ?>


<html>




  
   <div style="width:100%;"> 
  <head>
    <link href="css/multi-select.css" media="screen" rel="stylesheet" type="text/css">
    
    
  </head>
<div style="float:left; width:41%;">
 <body>
    <form action="search.php" method="post">
    <select multiple="multiple" id="my-select" name="my-select[]">
       <optgroup label='ZONES'>
       <option value="1.7N">7N (L7 North)</option>
        <option value="1.PC">PC (Plaza Castilla)</option>
        <option value="1.N">N (North)</option>
        <option value="1.4NE">4NE (L4 North East)</option>
        <option value="1.8E">8E (L8 East)</option>
        <option value="1.7E">7E (L7 East)</option>
        <option value="1.5E">5E (L5 East)</option>
        <option value="1.2E">2E (L2 East)</option>
        <option value="1.9E" selected="selected">9E (L9 East)</option>

        <option value="1.1S">1S (L1 South)</option>
        <option value="1.3S">3S (L3 South)</option>
        <option value="1.11">11 (L11)</option>
        <option value="1.SW">SW (South West)</option>
        <option value="1.SE">SE (South East)</option>
        <option value="1.CNE">CNE (Central North East)</option>
        <option value="1.CE">CE (Central East)</option>
        <option value="1.CSE">CSE (Central South East)</option>
        <option value="1.CS">CS (Central South)</option>

        <option value="1.CW">CW (Central West)</option>
        <option value="1.CN">CN (Central North)</option>
        <option value="1.12SE">12SE (L12 South East)</option>
        <option value="1.12SW">12SW (L12 South West)</option>
        <option value="1.ML2">ML2 (Metro Ligero 2)</option>
        <option value="1.ML3">ML3 (Metro Ligero 3)</option>
        <option value="1.A">A (Aravaca)</option>
        </optgroup>

  <optgroup label='Certification'>
    <option value='2.TE'>TE</option>
    <option value='2.CE-TEFL'>CE-TEFL</option>
    <option value='2.CELTA'>CELTA</option>
    <option value='2.TEFL'>TEFL</option>
    <option value='2.TESOL'>TESOL</option>
        </optgroup>
        
         <optgroup label='Class type'>
    <option value='3.Company'>Company</option>
    <option value='3.Kids'>Kids</option>
    <option value='3.Teenagers'>Teenagers</option>
    <option value='3.Adults'>Adults</option>
    </optgroup>
         <optgroup label='Gender'>
    <option value='4.Female'>Female</option>
    <option value='4.Male'>Male</option>
    </optgroup>
    
     <optgroup label='Availability'>
    <option value='5.Dec'>Dec</option>
    <option value='5.Feb'>Feb</option>
    <option value='5.May'>May</option>
    <option value='5.June'>June</option>
    <option value='5.July'>July</option>
    <option value='5.Aug'>Aug</option>
    </optgroup>
    
       <optgroup label='Spanish'>
    <option value='6.Low'>Low</option>
    <option value='6.Intermediate'>Intermediate</option>
    <option value='6.High'>High</option>
    <option value='6.Bilingual-Native'>Bilingual-Native</option>
    
    </optgroup>
    </select>
    
     <input type="submit" id="enviar" name="enviar" value="Submit Form"/>
    </form>
 
 
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/bootstrap.js" type="text/javascript"></script>
    <script src="js/jquery.tinysort.js" type="text/javascript"></script>
    <script src="js/jquery.quicksearch.js" type="text/javascript"></script>
    <script src="js/jquery.multi-select.js" type="text/javascript"></script>
    <script src="js/rainbow.js" type="text/javascript"></script>
    <script src="js/application.js" type="text/javascript"></script>
    <script src="js/handlebars.js" type="text/javascript"></script>
    <script src="js/github-api.js" type="text/javascript"></script>
    
         
           <script  type="text/javascript">
		   
    $('#my-select').multiSelect({ selectableOptgroup: true });
	
    </script>
  </body>
</div>
<div style="float:left; width:59%; ">
<?php

    if (isset($_POST['enviar'])) {
		
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


$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
?>
<link href="css/canterbury.css" type="text/css" rel="stylesheet">
<table border="0" cellpadding="1"  align="left" cellspacing="0" bgcolor="#CCCCCC" id="border">
             
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
					print "<td bgcolor='" . $bg ."'>&nbsp;</td>";
	
	
	
	

	print "</tr>";
	$contador++;
}
            
?> 
                   
                      <tr>
                   
                         <table width="313" border="0" align="center">
  <tr>
    <td width="40"><div align="center">
						    <input name="action" type="submit" id="alta" value="Alta">
					    </div></td>
    <td width="42"><div align="center">
						    <input name="action" type="submit" id="action" value="Baja" />
					    </div></td>
    <td width="57"><div align="center">
  <input name="action" type="submit" id="action" value="Delete">
                        </div></td>
    <td width="52"><div align="center">
                           <input type="button" name="Emails" id="Emails" value="Emails" onClick="enviar_correo(<?php echo "'".$contador."'"; ?>)" />
				</div></td>
             
                          <div style="float:right; width:15%; ">
                           <p>Select all E-mails</p>
                       <input type="checkbox" name="allReports" id="allReports" onClick="checkAll(<?php echo $contador; ?>);" />
                         
                           
                          
                        
                         
                           
                          
                        </div> 
  </tr>
</table></tr>
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
?></div>
 
</div>
 
</html>
<?php } else { echo "NOT AUTHORIZED TO SEE THIS PAGE, PLEASE RETURN BACK"; }?>