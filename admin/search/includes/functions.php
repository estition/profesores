<?php


function escape($value) {
  	return $value;
}

function newlinesToBreaks($value) {
  	return str_replace("\n", "<br>", $value);
}

function breaksToNewlines($value) {
  	return str_replace("<br>", "\n", $value);
}

function getIcon($type, $filename) {
	if ($type == 0) {
		return "web_icon.gif";
	} else {
		$tmp = explode(".", $filename);

		switch ($tmp[1]) {
		
    case "pdf":
     	return "pdf_icon.gif";
      break;
    
    case "xls":
     	return "excel_icon.gif";
      break;
      
    case "doc":
     	return "word_icon.gif";
      break;
    
    default:
    	return "web_icon.gif";
		}
	}
}
?>