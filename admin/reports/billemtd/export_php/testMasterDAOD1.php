<?php
  //Developers need to implement this following function.
  //Typically, it should connect to the database and return an 2d array.
	function getTestData($max=20){
include_once("../ConnectionManager.php");
 
$json=json_decode(stripslashes($_POST["_gt_json"]));

  
for ($i = 0; $i < count($json->{'filterInfo'}); $i++) {
    if($json->{'filterInfo'}[$i]->{'logic'} == "equal"){
        $filter .= $json->{'filterInfo'}[$i]->{'columnId'} . "='" . $json->{'filterInfo'}[$i]->{'value'} . "' ";
    }elseif($json->{'filterInfo'}[$i]->{'logic'} == "notEqual"){
        $filter .= $json->{'filterInfo'}[$i]->{'columnId'} . "!='" . $json->{'filterInfo'}[$i]->{'value'} . "' ";    
    }elseif($json->{'filterInfo'}[$i]->{'logic'} == "less"){
        $filter .= $json->{'filterInfo'}[$i]->{'columnId'} . "<" . $json->{'filterInfo'}[$i]->{'value'} . " ";
    }elseif($json->{'filterInfo'}[$i]->{'logic'} == "lessEqual"){
        $filter .= $json->{'filterInfo'}[$i]->{'columnId'} . "<=" . $json->{'filterInfo'}[$i]->{'value'} . " ";    
    }elseif($json->{'filterInfo'}[$i]->{'logic'} == "great"){
        $filter .= $json->{'filterInfo'}[$i]->{'columnId'} . ">" . $json->{'filterInfo'}[$i]->{'value'} . " ";
    }elseif($json->{'filterInfo'}[$i]->{'logic'} == "greatEqual"){
        $filter .= $json->{'filterInfo'}[$i]->{'columnId'} . " >= '" . $json->{'filterInfo'}[$i]->{'value'} . "' ";        
    }elseif($json->{'filterInfo'}[$i]->{'logic'} == "like"){
        $filter .= $json->{'filterInfo'}[$i]->{'columnId'} . " LIKE '%" . $json->{'filterInfo'}[$i]->{'value'} . "%' ";        
    }elseif($json->{'filterInfo'}[$i]->{'logic'} == "startWith"){
	    
		$filter .= $json->{'filterInfo'}[$i]->{'columnId'} . " LIKE '" . $json->{'filterInfo'}[$i]->{'value'} . "%' ";      
    }elseif($json->{'filterInfo'}[$i]->{'logic'} == "endWith"){
        $filter .= $json->{'filterInfo'}[$i]->{'columnId'} . " LIKE '%" . $json->{'filterInfo'}[$i]->{'value'} . "' ";                
    }
    $filter .= " AND ";
}


// print_r($filter);
 
$conManager = new ConManager();
$conManager->getConnection();

if($json->{'action'} == 'load'){
  $params = $json->{'parameters'}->id;
  $params1 = $json->{'parameters'}->user_id;
  $params2 = $json->{'parameters'}->entry_id;
  $params3 = $json->{'parameters'}->partdate;
  //echo $params."pepe";
  //echo $params1."nono";
 // print_r($json->{'parameters'});
  if ($params != '' and $params1 != '') {
  $group_id  = trim($params);
  $user_id  = trim($params1);
  $entry_id  = trim($params2);
  $day  = trim($params3);
  //echo $day."EE";
  $day1 = $day."-01";
  //echo $day1."aa";
$newdate = strtotime ( '-4 month' , strtotime ( $day1 ) ) ;
$newdate = date ( 'Y-m-j' , $newdate );

   //pageno starts with 1 instead of 0
 $sql = "SELECT b.name, a.id, a.group_id, a.concept_id  as concept, count(a.concept_id) as numer, a.observations,  CAST( GROUP_CONCAT( DATE_FORMAT( a.day,  '%d') ) AS CHAR( 1000 ) CHARACTER SET utf8 ) AS days, date_format(a.day, '%m') as month FROM entry a, groups b WHERE a.group_id = b.id  and a.group_id = '".$group_id."' and a.user_id = '".$user_id."' and a.day >  '".$newdate."' and (a.concept_id = 2  or a.concept_id = 5) group by month, a.concept_id,  a.hours";
//echo $sql;
$handle = mysqli_query($link, $sql);    
$retArray = array();
 if (mysqli_num_rows($handle) > 0) {
$i = 0;
 while($retArray[$i] = mysqli_fetch_assoc($handle)) {
      $i++;
	    unset($retArray[$i]);                                                                                  
  }
}
// clean up:  
                
  mysqli_free_result($handle);
$data = $retArray;
 return $data;
 }  
else return array();

}
else if($json->{'action'} == 'save'){
  $sql = "";
  $params = array();
  $errors = "";
  
  //deal with those deleted
  $deletedRecords = $json->{'deletedRecords'};
  foreach ($deletedRecords as $value){
    $params[] = $value->id;
  }
  $sql = "delete from entry where id in ("  . join(",", $params) .  ")";
 // print($sql);
  if(mysqli_query($link, $sql)==FALSE){
    $errors .= mysqli_error($link);
	
  }
  
  //deal with those updated
  $sql = "";
  $updatedRecords = $json->{'updatedRecords'};
  foreach ($updatedRecords as $value){
    $sql = "update `entry` set ".
      "`admin_obs`='".$value->admin_obs . "' ".
      "where `id`=".$value->id;
	  //print($sql);
      if(mysqli_query($link, $sql)==FALSE){
        $errors .= mysqli_error($link);
      }
  }
  
  unset($data);  
 
  $data[0] = array("success"=>true, "exception"=>'' );
  
 return $data;
}
}
?>