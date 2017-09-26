<?php
 include '../../../../includes/constants.php';
// include '../../../../includes/functions.php';
 include '../../../../includes/database.php';
//include '../../../../includes/authorize.php';
error_reporting(E_ALL & ~E_NOTICE);
//This is sigma grid exporting handler 
require_once('GridServerHandler.php');
//This is a php file for data feeding
require_once('testMasterDAOD.php');
//To create grid exporting instant.
$gridHandler = new GridServerHandler();

class Utility { 
    /* 
    * @param array $ary the array we want to sort 
    * @param string $clause a string specifying how to sort the array similar to SQL ORDER BY clause 
    * @param bool $ascending that default sorts fall back to when no direction is specified 
    * @return null 
    */ 
    public static function orderBy(&$ary, $clause, $ascending = true) { 
        $clause = str_ireplace('order by', '', $clause); 
        $clause = preg_replace('/\s+/', ' ', $clause); 
        $keys = explode(',', $clause); 
        $dirMap = array('desc' => 1, 'asc' => -1); 
        $def = $ascending ? -1 : 1; 

        $keyAry = array(); 
        $dirAry = array(); 
        foreach($keys as $key) { 
            $key = explode(' ', trim($key)); 
            $keyAry[] = trim($key[0]); 
            if(isset($key[1])) { 
                $dir = strtolower(trim($key[1])); 
                $dirAry[] = $dirMap[$dir] ? $dirMap[$dir] : $def; 
            } else { 
                $dirAry[] = $def; 
            } 
        } 

        $fnBody = ''; 
        for($i = count($keyAry) - 1; $i >= 0; $i--) { 
            $k = $keyAry[$i]; 
            $t = $dirAry[$i]; 
            $f = -1 * $t; 
            $aStr = '$a[\''.$k.'\']'; 
            $bStr = '$b[\''.$k.'\']'; 
            if(strpos($k, '(') !== false) { 
                $aStr = '$a->'.$k; 
                $bStr = '$b->'.$k; 
            } 

            if($fnBody == '') { 
                $fnBody .= "if({$aStr} == {$bStr}) { return 0; }\n"; 
                $fnBody .= "return ({$aStr} < {$bStr}) ? {$t} : {$f};\n";                
            } else { 
                $fnBody = "if({$aStr} == {$bStr}) {\n" . $fnBody; 
                $fnBody .= "}\n"; 
                $fnBody .= "return ({$aStr} < {$bStr}) ? {$t} : {$f};\n"; 
            } 
        } 

        if($fnBody) { 
            $sortFn = create_function('$a,$b', $fnBody); 
            usort($ary, $sortFn);        
        } 
    } 
} 




$type = getParameter('exportType');

if ( $type == 'pdf' ){
	// to use html2pdf to export pdf
	// param1 : Orientation. 'P' for Portrait , 'L' for Landscape
	// param2 : Paper size. Could be A3, A4, A5, LETTER, LEGAL
	// param3 : Relative picture path to this php file
	
  $gridHandler->exportPDF('P' ,'A4', '../');

}else {
	
	if ( $type == 'xml' ){
		//exporting to xml
		$gridHandler->exportXML($data1);
	}else if ( $type == 'xls' ){
		//exporting to xls
		$gridHandler->exportXLS($data1);
	}else if ( $type == 'csv' ){
		//exporting to csv
		$gridHandler->exportCSV($data1);
	}else{
	
	$data1 = getTestData();
	
	if( $gridHandler->sortInfo){
  //echo "sortinfo:true<br>";
  $sortOrder = $gridHandler->sortInfo[0]["sortOrder"];
  //echo var_dump($gridHandler->sortInfo[0]);
  if($sortOrder!="defaultsort"){
    $comp_field = $gridHandler->sortInfo[0]["columnId"];
    //echo "sortOrder:". $comp_field;
    //echo $comp_field . " " . $sortOrder . "\n";
    //usort($data1, "mycompare");
    Utility::orderBy($data1, $comp_field . " " . $sortOrder); 
  }
}

$t = 0;
$q = 0;
$sorting = false;
$concept1 = array();
$lookup = array();

foreach ($data1 as $key => $value) {
	 
	
	$sz += $data1[$key]["size"];
	$th += $data1[$key]["hxc"];
	
	$pc += $data1[$key]["price"];
	$total += $data1[$key]["total"];
	$num_taught += $data1[$key]["taught_total"];
	$sc += $data1[$key]["student_c_total"];
	$tc += $data1[$key]["teacher_c_total"];
	$lsc += $data1[$key]["late_student_total"];
	$mk += $data1[$key]["makeup_classes_total"];
	
	if($data1[0]["user_id"] != ""){
	if ($data1[$key]["group_id"] != ""){
	$group_id = $data1[$key]["group_id"];
	
	$user_id = $data1[$key]["user_id"];
$rest = substr($data1[0]["day"], 0, -3);
 $sql1 = "SELECT b.observations FROM users a, entry_users b WHERE  a.id = b.user_id and a.id =".$user_id." 
 and b.group_id = ".$group_id." and b.startt LIKE  '%".$rest."%'";
 //print_r($sql1);
	$result1 = mysqli_query($link, $sql1) or die("Invalid query: " . mysqli_error($link));
	$row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
	
	 if($row1["observations"] != ""){
	$obss .= "|".$data1[$key]["name"]." : ".$row1["observations"];
	
	
	}
	
		 }};

	
 /*$days = explode(",",$data1[$key]["days"]);
 $concept = explode(",",$data1[$key]["concept"]);
 
 //print_r($days);
 foreach ($concept as $key1 => $value1) {
 switch ($concept[$key1]) {
    case 1:
        $lookup[$days[$key1]] = 1;
        break;
    case 2:
        $lookup[$days[$key1]] = 2;
        break;
    case 3:
        $lookup[$days[$key1]] = 3;
        break;
	case 4:
       $lookup[$days[$key1]] = 4;
        break;	
}
 }
 // print_r($lookup);
 //$lookup[$days] = $concept;*/

// array_push($lookup[$days], $concept);
 //$t +=  $value["taught"];
 //$q +=  $value["totalr"];

 
}
if ($data1[-1]["name"] != "")
$ads = $data1[-1]["name"];
else $ads = "TOTAL===>";

$start = $gridHandler->pageInfo["startRowNum"];
$pageSize = $gridHandler->pageInfo["pageSize"];

	if($start == 1){

		$start = 0;
		}

$data2 = array_slice($data1, $start, $pageSize);
//$total_emitido = number_format($t, 2);
 //$total_r = number_format($q, 2);
 //$diff = $q - $t;
 //print_r($q);
 //$total_diff = number_format($diff, 2);
//print_r($start);
//echo $th."cccc";
if($user_id){
$sql1 = "SELECT first FROM users WHERE  id =".$user_id;
	$result1 = mysqli_query($link, $sql1) or die("Invalid query: " . mysqli_error($link));
	$row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
    
    $teacher[0] = $row1["first"];
	(string)$rest = substr($data1[0]["day"], 0, -3);
	//echo $rest."FFF";
}
	//echo $row1["first"]."TTT";
	//echo $row1["observations"]."GGGGGGGG";
$cola = array("hide"=>$teacher[0]."|".$rest." ".$obss, "name"=>"$ads", "taught"=>"$num_taught",  "student_c"=>"$sc",  "teacher_c"=>"$tc",  "late_student"=>"$lsc",  "makeup_classes"=>"$mk",  "size"=>"$sz", "total"=>"$total", "hxc"=>$th);
if($data2[0] == ""){

unset($data2[0]);
}
 array_unshift($data2, $cola);

//print_r($data2);

//$cola = array("name"=>"total", "class_type"=>"pepe", "start"=>"", "end"=>"", "bill"=>"pepe");

//array_unshift($data2, $cola);

//print_r($data2[5]->name);
//print_r(count($data1));
//for grid presentation
$gridHandler->setData($data2);
$gridHandler->setTotalRowNum(count($data1));
$gridHandler->printLoadResponseText();
	}
}


?>