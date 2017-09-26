<?php

    // This is a very simple data provider for the cascading dropdown
    // example. A *real* data provider would most likely connect to
    // a database, use xslt and implement some level of security.

    Header("Content-type: text/xml"); 
    // get query string params
	$filter = $_GET['filter'];

    // build xml content for client JavaScript

	$xml = '';

	If ($filter == "09"){
        $xml = $xml . '<sdate_hh_ii name="09">';
        $xml = $xml . '<sdate_ii_hh id="00">00</sdate_ii_hh>';
		$xml = $xml . '<sdate_ii_hh id="30">30</sdate_ii_hh>';
        $xml = $xml . '</sdate_hh_ii>';
		 }else If ($filter == "10"){
        $xml = $xml . '<sdate_hh_ii name="10">';
       $xml = $xml . '<sdate_ii_hh id="00">00</sdate_ii_hh>';
		$xml = $xml . '<sdate_ii_hh id="30">30</sdate_ii_hh>';
	   $xml = $xml . '</sdate_hh_ii>';
	    }else If ($filter == "11"){
        $xml = $xml . '<sdate_hh_ii name="11">';
       $xml = $xml . '<sdate_ii_hh id="00">00</sdate_ii_hh>';
		$xml = $xml . '<sdate_ii_hh id="30">30</sdate_ii_hh>';
	   $xml = $xml . '</sdate_hh_ii>';
	    }else If ($filter == "12"){
        $xml = $xml . '<sdate_hh_ii name="12">';
       $xml = $xml . '<sdate_ii_hh id="00">00</sdate_ii_hh>';
		$xml = $xml . '<sdate_ii_hh id="30">30</sdate_ii_hh>';
	   $xml = $xml . '</sdate_hh_ii>';
		}else If ($filter == "13"){
        $xml = $xml . '<sdate_hh_ii name="13">';
        $xml = $xml . '<sdate_ii_hh id="00">00</sdate_ii_hh>';
		$xml = $xml . '<sdate_ii_hh id="30">30</sdate_ii_hh>';
        $xml = $xml . '</sdate_hh_ii>';
		}else If ($filter == "14"){
        $xml = $xml . '<sdate_hh_ii name="14">';
       $xml = $xml . '<sdate_ii_hh id="00">00</sdate_ii_hh>';
	   $xml = $xml . '</sdate_hh_ii>';
	   }else If ($filter == "15"){
        $xml = $xml . '<sdate_hh_ii name="15">';
       $xml = $xml . '<sdate_ii_hh id="00">00</sdate_ii_hh>';
		$xml = $xml . '<sdate_ii_hh id="30">30</sdate_ii_hh>';
	   $xml = $xml . '</sdate_hh_ii>';
	    }else If ($filter == "16"){
        $xml = $xml . '<sdate_hh_ii name="16">';
       $xml = $xml . '<sdate_ii_hh id="00">00</sdate_ii_hh>';
		$xml = $xml . '<sdate_ii_hh id="30">30</sdate_ii_hh>';
	   $xml = $xml . '</sdate_hh_ii>';
	    }else If ($filter == "17"){
        $xml = $xml . '<sdate_hh_ii name="17">';
       $xml = $xml . '<sdate_ii_hh id="00">00</sdate_ii_hh>';
		$xml = $xml . '<sdate_ii_hh id="30">30</sdate_ii_hh>';
	   $xml = $xml . '</sdate_hh_ii>';
	   }else If ($filter == "18"){
        $xml = $xml . '<sdate_hh_ii name="18">';
       $xml = $xml . '<sdate_ii_hh id="00">00</sdate_ii_hh>';
		$xml = $xml . '<sdate_ii_hh id="30">30</sdate_ii_hh>';
	   $xml = $xml . '</sdate_hh_ii>';
	}else{
        $xml = $xml . '<sdate_hh_ii name="none">';
        $xml = $xml . '<sdate_ii_hh id="0">no Time found</sdate_ii_hh>';
        $xml = $xml . '</sdate_hh_ii>';
	}

    // send xml to client
	echo( $xml );
?>