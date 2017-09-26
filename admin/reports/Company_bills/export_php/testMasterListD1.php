<?php
//This is sigma grid exporting handler 
require_once('GridServerHandler.php');
//This is a php file for data feeding
require_once('testMasterDAOD1.php');
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
	//unset($data1[0]);

	             

  }
}
$t = 0;
$q = 0;
$sorting = false;
$concept1 = array();
$lookup = array();

foreach ($data1 as $key => $value) {
	//print_r($data1[$key]["concept"]);
    if($data1[$key]["concept"] == 5 )
	$tatal += $data1[$key]["numer"];
	elseif($data1[$key]["concept"] == 2)  $tatal -= $data1[$key]["numer"];
}

	
$pageSize = $gridHandler->pageInfo["pageSize"];

$data2 = array_slice($data1, 0, $pageSize);


//print_r($data2);
$cola = array("name"=>"TOTAL===>",  "hours"=>"", "class_tupe"=>"", "concept"=>"", "month"=>"", "days"=>"", "numer"=>$tatal, "observations"=>"");
if($data2[0] == ""){

unset($data2[0]);
}
 array_unshift($data2, $cola);


//print_r($data2);

 //unset($data2[1]); 

//var_dump($data2);

//print_r($data2);
//print_r(count($data1));
//for grid presentation
$gridHandler->setData($data2);
$gridHandler->setTotalRowNum(count($data1));
$gridHandler->printLoadResponseText();
	}
}


?>