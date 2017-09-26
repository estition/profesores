<?php
  //Developers need to implement this following function.
  //Typically, it should connect to the database and return an 2d array.

	function getTestData($max=20){
// include '../../../../includes/constants.php';
//// include '../../../../includes/functions.php';
// include '../../../../includes/database.php';
//include '../../../../includes/authorize.php';
		
		include_once("../ConnectionManager.php");
 
$json=json_decode(stripslashes($_POST["_gt_json"]));

//echo $json->{'parameters'}->{'id'}."KKKK";

  $nothanded = false;
for ($i = 0; $i < count($json->{'filterInfo'}); $i++) {

    if($json->{'filterInfo'}[$i]->{'logic'} == "equal"){
        $filter .= $json->{'filterInfo'}[$i]->{'columnId'} . " = " . $json->{'filterInfo'}[$i]->{'value'} . " ";
	}elseif($json->{'filterInfo'}[$i]->{'logic'} == "null"){
        $filter .= $json->{'filterInfo'}[$i]->{'columnId'} . " is " . $json->{'filterInfo'}[$i]->{'value'} . " ";
	
	}elseif($json->{'filterInfo'}[$i]->{'logic'} == "notnull"){
		
        $filter .= $json->{'filterInfo'}[$i]->{'columnId'} . " IS NOT " . $json->{'filterInfo'}[$i]->{'value'} . " "; 
		  	  
    }elseif($json->{'filterInfo'}[$i]->{'logic'} == "notEqual"){
        $filter .= $json->{'filterInfo'}[$i]->{'columnId'} . "!='" . $json->{'filterInfo'}[$i]->{'value'} . "' ";    
    }elseif($json->{'filterInfo'}[$i]->{'logic'} == "less"){
        $filter .= $json->{'filterInfo'}[$i]->{'columnId'} . " < " . $json->{'filterInfo'}[$i]->{'value'} . " "; 
    }elseif($json->{'filterInfo'}[$i]->{'logic'} == "lessEqual"){
        $filter .= $json->{'filterInfo'}[$i]->{'columnId'} . " <= '" . $json->{'filterInfo'}[$i]->{'value'} . "' ";    
    }elseif($json->{'filterInfo'}[$i]->{'logic'} == "great"){
        $filter .= $json->{'filterInfo'}[$i]->{'columnId'} . ">" . $json->{'filterInfo'}[$i]->{'value'} . " ";
    }elseif($json->{'filterInfo'}[$i]->{'logic'} == "greatEqual"){
        $filter .= $json->{'filterInfo'}[$i]->{'columnId'} . " >= '" . $json->{'filterInfo'}[$i]->{'value'} . "' "; 
    }elseif($json->{'filterInfo'}[$i]->{'logic'} == "aldia"){
        $filter .= $json->{'filterInfo'}[$i]->{'columnId'} . " >= " . $json->{'filterInfo'}[$i]->{'value'} . " ";   
    }elseif($json->{'filterInfo'}[$i]->{'logic'} == "like"){
        $filter .= $json->{'filterInfo'}[$i]->{'columnId'} . " LIKE '%" . $json->{'filterInfo'}[$i]->{'value'} . "%' ";        
    }elseif($json->{'filterInfo'}[$i]->{'logic'} == "startWith"){
			$nothanded = true; 
        $filter .= $json->{'filterInfo'}[$i]->{'columnId'} . " LIKE '" . $json->{'filterInfo'}[$i]->{'value'} . "%' ";     
    }elseif($json->{'filterInfo'}[$i]->{'logic'} == "endWith"){
        $filter .= $json->{'filterInfo'}[$i]->{'columnId'} . " LIKE '%" . $json->{'filterInfo'}[$i]->{'value'} . "' ";                
    }
    $filter .= " AND ";
}


//print_r($filter);
 
$conManager = new ConManager();
$link = $conManager->getConnection();

										 
 // echo $filter."PPPPP";
  //echo $json->{'filterInfo'}[0]->{'value'}."XXXXX";
 //if(($filter == "") or (empty($filter))){$filter = "eg.startt >= '".date("Y")."-".date("m")."-01' and ";} 
/*$sql = "SELECT a.group_id as codigo, d.name, CONCAT(c.first, ' ', c.last1) AS first, a.total, b.totalr
FROM entry_groups AS a
LEFT JOIN entry_users AS b ON b.entry_group_id = a.id
LEFT JOIN users AS c ON c.id = a.user_id
LEFT JOIN groups AS d ON d.id = a.group_id
where $filter d.enterprise = '0'";*/

//if($json->{'action'} == 'load' && $json->{'parameters'}->{'myname'} != 'save1'){
//$params =  $json->{'filterInfo'}[0]->{'logic'};
$day1 = 01;
$day2 = 30;

 if(($json->{'filterInfo'}[0]->{'value'} == "") ){return array();}else{
 $sql = "SELECT a.id, b.id as group_id, a.user_id, b.name, b.supplement, a.hours, a.class_type, CAST( GROUP_CONCAT(a.concept_id ) AS CHAR( 1000 ) CHARACTER SET utf8 ) as concept, CAST( GROUP_CONCAT( DATE_FORMAT( a.day,  '%d')  ) AS CHAR( 1000 ) CHARACTER SET utf8 ) AS days,  DATE_FORMAT( a.day,  '%M') AS months, a.day, b.days as dias_c FROM entry a, groups b WHERE $filter a.group_id = b.id GROUP BY a.group_id, a.hours "; 
//print_r("pepepeep");
//print_r($sql);
$handle = mysqli_query($link, $sql);    
$retArray = array();
 if (mysqli_num_rows($handle) > 0) {
$i = 0;
 while($retArray[$i] = mysqli_fetch_assoc($handle)) {
	 
	 $sql1 = "SELECT price FROM prices WHERE  type = '".$retArray[$i]["class_type"]."' and hours = '".$retArray[$i]["hours"]."'";
	$result1 = mysqli_query($link, $sql1) or die("Invalid query: " . mysqli_error($link));
	$row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
    
    
     // array_push($names[$row['username']], $row['file']);
	 //print_r($retArray[$i]["concept"]);

	 $concept= explode(",", $retArray[$i]["concept"]);
	  $days= explode(",", $retArray[$i]["days"]);
	 
	  $lookup = array();

 for($j = 0; $j<count($concept); $j++)
 {
	// print_r($concept[$i]);
//echo $concept[$j]."WWWW";
	//echo $days[$j]."XXXXX";
	//echo $j."JJJJJJ";
	 switch ($concept[$j]) {
    case "1":
        $taught[$j] = $days[$j];
		//$taught1 .= " ".$days[$j];
	
        break;
    case "2":                                                                                                                                                                                                                                                                                                                  
        $student_c[$j] = $days[$j];
		//$student_c1 .= " ".$days[$j];
	
        break;
    case "3":
       $late_student[$j] = $days[$j];
	  // $late_student1 .= " ".$days[$j];
	  
        break;
	case "4":
	   $teacher_c[$j] = $days[$j];
	  // $teacher_c1 .= " ".$days[$j];
	
		break;	
		
	case "5":
	   $makeup[$j] = $days[$j];
	   //$makeup1 .= " ".$days[$j];
	
		break;	
}
	 

}
    //print_r($taught);
   //print_r($student_c);
	//$student_c1 = implode(",", $student_c);
   /* $taught1 = implode(",", $taught);
	$student_c1 = implode(",", $student_c);
	$teacher_c1 = implode(",", $teacher_c);
	$late_student1 = implode(",", $late_student);*/
   // echo $pepe."TTTTTTT";
	
	
	//print_r($student_c)."FFF";
 
    $retArray[$i]["taught_total"] = count($taught);
	if($taught != null){
	sort($taught);}
    $retArray[$i]["taught"] =  $taught;
		 
	
	

	$retArray[$i]["student_c_total"] = count($student_c);
	if($student_c != null){
	sort($student_c);}
	$retArray[$i]["student_c"] = $student_c;
		 
	
	$retArray[$i]["teacher_c_total"] = count($teacher_c);
	if($teacher_c != null){
	sort($teacher_c);}
	$retArray[$i]["teacher_c"] = $teacher_c;
	
	 $retArray[$i]["late_student_total"] = count($late_student);
	 if($late_student != null){
	sort($late_student);}
	 $retArray[$i]["late_student"] = $late_student;
	 
	 $retArray[$i]["makeup_classes_total"] = count($makeup);
	 if($makeup != null){
	sort($makeup);}
	  $retArray[$i]["makeup_classes"] = $makeup;
	  
	  $retArray[$i]["size"] = count($taught)+count($late_student)+count($makeup);
	 $retArray[$i]["price"] = $row1["price"]." + ".$retArray[$i]["supplement"];
	 $retArray[$i]["total"] = $retArray[$i]["size"]*($row1["price"]+$retArray[$i]["supplement"]);
	 
	 $retArray[$i]["hxc"] += (($retArray[$i]["hours"])*($retArray[$i]["size"]));
  // $var1 += $retArray[$i]["total"];
   //$var2 += $retArray[$i]["hxc"];
   
  // echo $var1."RRRR";
	
	 unset($taught); 
	unset($student_c); 
	unset($teacher_c); 
	unset($late_student); 
	unset($makeup);
	
	unset($taught1); 
	unset($student_c1); 
	unset($teacher_c1); 
	unset($late_student1); 
	unset($makeup1);
	
	
   
	 // print_r($retArray[$i] );
	 //$retArray[$i]["concept1"] = $retArray[$i]["concept"];
	  $i++;
	    unset($retArray[$i]);                                                                                  
  }
}
// clean up:  
                
  mysqli_free_result($handle);
 
$data = $retArray;

}	



//print_r($data);

   
	
  //$json=json_decode(stripslashes($_POST["_gt_json"]));
  /*
     $sql1 = "SELECT id FROM paysheet WHERE user_id = '".$data[0]["user_id"]."' and day = '".$data[0]["day"]."'"; 
    $result1 = mysqli_query($link, $sql1);
	//echo $sql1;
 if (!$result1){

	   return false;}
	   
	 else  {
		 $row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
		 $theid = $row1["id"];
		 $name_exist = mysqli_num_rows($result1);

		if  ( $name_exist > 0 )  { 
		
	
		
		
		$data[-1]["name"] = "month already closed!!";
				 
		if($json->{'parameters'}->{'myActionUpdate'} == 'customupdate'){
			
	$sql3 = "delete from paysheet where id = '".$theid."'";
	  if(mysqli_query($link, $sql3)==FALSE){
      return array("error MysQl");
	}
		  $data[-1]["name"] = "TOTAL===>";
    		}
			
		return $data ;
	}
		else if($json->{'parameters'}->{'myactionsave'} == 'customupsave'){
			{	
		          
	  $sql = "insert into paysheet (user_id, day, month, changes, total) VALUES ('".$data[0]["user_id"]."','".$data[0]["day"]."','".$data[0]["months"]."','".$var2."','".$var1."')";

	 if(mysqli_query($link, $sql)==FALSE){
     return array("error MysQl");
	 }
	 
	 $theid = mysqli_insert_id();
	 //echo $theid."kkk";
		$criteria =  substr($filter, 0, 72);
	$sql2 = "update entry a set a.paysheet_id = ".$theid." where $criteria";
	//echo $sql2;
	 if(mysqli_query($link, $sql2)==FALSE){
      return array("error MysQl");}
	 
	 
			
		}
		
	
 	}
	
		
  
  }*/
	//print_r($data);
	$json->{'parameters'}->{'myActionUpdate'} = "";
		 $json->{'parameters'}->{'myactionsave'} = "";
	return $data;	 
}
?>