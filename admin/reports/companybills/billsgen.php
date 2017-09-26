<?php
ini_set("default_charset", "utf-8");
header('Content-type: text/html; charset=UTF-8') ;

$value=$_POST['__gt_html'];
		
		$value=isset($value)?$value:(isset($_GET[$key])?$_GET[$key]:NULL);
	
			$value=stripslashes($value);
		
		

			$tableHTML= (string)$value;
			
	/**
 * Encodes HTML safely for UTF-8. Use instead of htmlentities.
 *
 * @param string $var
 * @return string
 */


      $dom = new DOMDocument();
      @$dom->loadHTML($tableHTML);      
      $xpath = new DOMXPath($dom);
	 
    
	
	$code = $xpath->query("//td[@class='gt-col-mygrid1-codigo'][1]")->item(1)->nodeValue;
	
	$dia_factura = $xpath->query("//td[@class='gt-col-mygrid1-dia_factura1'][1]")->item(1)->nodeValue;
	$mes = $xpath->query("//td[@class='gt-col-mygrid1-months'][1]")->item(2)->nodeValue;
    
	 if ($code == ""){
	$code = $xpath->query("//td[@class='gt-col-mygrid1-codigo'][1]")->item(2)->nodeValue;}
	 
	 if ($dia_factura == ""){
	$dia_factura = $xpath->query("//td[@class='gt-col-mygrid1-dia_factura1'][1]")->item(2)->nodeValue;}
	
	$factura_data = $xpath->query("//td[@class='gt-col-mygrid1-ciudad'][1]")->item(1)->nodeValue;
	
		
     list($company, $cp, $city, $cif, $address) = explode("|", $factura_data);
	 
  
 
 ob_start();
 ini_set("default_charset", "utf-8");
header('Content-type: text/html; charset=UTF-8') ;
		?>

		
        <table cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
        <tr>
            <td>
            </td>
            <td style="color: #444444;">
                <img style="width: 100%;" src="./images/imageCE1.png" alt="Logo"><br>
 
            </td>
        </tr>
    </table>
    <br>
   
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
          
            <td>CLIENTE &nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo utf8_decode($company); 
			
			
			
			?></td>
            
        </tr>
        <tr>
            <td>DOMICILIO :  <?php echo utf8_decode($address); ?> <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                               <?php echo utf8_decode($cp." ".$city); ?>            </td>
        </tr>
        <tr>
            <td colspan="3" style="width:50%;">CIF&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<?php echo utf8_decode($cif); ?> </td>
        </tr>
       
    </table>
    <br>
   

    <i>
        <b>Nº DE FACTURA <u>: <?php echo utf8_decode($code."-".date("Y")); ?> </u></b><br>
                       Canterbury English S.L.<br>
        CIF : B81523292<br>
         Fecha Facturación: <?php echo $dia_factura."-".$mes; ?>
    </i>
   <br>
    <br>
    Desglose de clases:
    <br><br>
          
        <style type="text/css">
		.gt-table {
			
	font-family: arial,sans-serif;
	font-size:11px;
	color:#333333;
	border-width: 1px;
	border-color: #000000;
	 
			width: 8%;
    margin-left:0.10%; 
    margin-right:0.20%;
	
			
		}
		.gt-hd-row {
			border-width: 1px;
	padding: 6px;
	border-style: solid;
	border-color: #000000;
	background-color: #dedede;
		}
		
		.table-sumary{
			font-weight:bold;
			background-color:#000;
			color:#FFF;
			width: 100%;
			}
					
		
		.gt-table td {
			border-right:1px; border-bottom:1px;
			border-width: 1px;
			border:#000;
			width: 104%;
			
		}

		.gt-inner {
		     position:fixed;
			width: 61px;
			
			
						
			
		}
		.gt-col-mygrid1-ciudad {
			
			color:#FFF;
			width:505px;
			
			}
		.gt-col-mygrid1-taught {
			width:65px;}
		.gt-col-mygrid1-name {
			width:97px;}
		.gt-col-mygrid1-daysclass {
			width:10px;}
		.gt-col-mygrid1-cif {
			display:none;}
		.gt-col-mygrid1-nombre {
			display:none;}
		.gt-col-mygrid1-months {
			display:none;}
		.gt-col-mygrid1-codigo {
			display:none;}
		.gt-col-mygrid1-dia_factura1 {
			display:none;}
		
		

		


		</style>
        

		<?php
		
			$template_style = ob_get_clean();
			$_pageD='75mm';
			
						
function getDocumentRoot(){
		#get env variables under apache 
		$document_root = isset($_SERVER["DOCUMENT_ROOT"]) ? $_SERVER["DOCUMENT_ROOT"] : "";
		#get env variables under IIS
		if( !$document_root ){
		  $sf = str_replace("\\","/",$_SERVER["SCRIPT_FILENAME"]);
		  $sn = $_SERVER["SCRIPT_NAME"];
		  $document_root = str_replace( $sn, "", $sf );
		}
		return $document_root;
}
			
			function debug($msg , $file="/_server_log.log"){
		$msg = print_r( $msg ,true );
		error_log($msg."\n", 3,  getDocumentRoot()."/_server_log.log");
}
			
			
		// empty or isset ?
		//raft funtion for once instance change
		
		/**
 * Checks if $string is a valid integer. Integers provided as strings (e.g. '2' vs 2)
 * are also supported.
 * @param mixed $string
 * @return bool Returns boolean TRUE if string is a valid integer, or FALSE if it is not 
 */
function valid_integer($string){
    // 1. Cast as string (in case integer is provided)
    // 1. Convert the string to an integer and back to a string
    // 2. Check if identical (note: 'identical', NOT just 'equal')
    // Note: TRUE, FALSE, and NULL $string values all return FALSE
    $string = strval($string);
    return ($string===strval(intval($string)));
}

/**
 * Replace $limit occurences of the search string with the replacement string
 * @param mixed $search The value being searched for, otherwise known as the needle. An
 * array may be used to designate multiple needles.
 * @param mixed $replace The replacement value that replaces found search values. An
 * array may be used to designate multiple replacements.
 * @param mixed $subject The string or array being searched and replaced on, otherwise
 * known as the haystack. If subject is an array, then the search and replace is
 * performed with every entry of subject, and the return value is an array as well. 
 * @param string $count If passed, this will be set to the number of replacements
 * performed.
 * @param int $limit The maximum possible replacements for each pattern in each subject
 * string. Defaults to -1 (no limit).
 * @return string This function returns a string with the replaced values.
 */
function str_replace_limit(
        $search,
        $replace,
        $subject,
        &$count,
        $limit = -1
    ){

    // Set some defaults
    $count = 0;

    // Invalid $limit provided. Throw a warning.
    if(!valid_integer($limit)){
        $backtrace = debug_backtrace();
        trigger_error('Invalid $limit `'.$limit.'` provided to '.__function__.'() in '.
                '`'.$backtrace[0]['file'].'` on line '.$backtrace[0]['line'].'. Expecting an '.
                'integer', E_USER_WARNING);
        return $subject;
    }

    // Invalid $limit provided. Throw a warning.
    if($limit<-1){
        $backtrace = debug_backtrace();
        trigger_error('Invalid $limit `'.$limit.'` provided to '.__function__.'() in '.
                '`'.$backtrace[0]['file'].'` on line '.$backtrace[0]['line'].'. Expecting -1 or '.
                'a positive integer', E_USER_WARNING);
        return $subject;
    }

    // No replacements necessary. Throw a notice as this was most likely not the intended
    // use. And, if it was (e.g. part of a loop, setting $limit dynamically), it can be
    // worked around by simply checking to see if $limit===0, and if it does, skip the
    // function call (and set $count to 0, if applicable).
    if($limit===0){
        $backtrace = debug_backtrace();
        trigger_error('Invalid $limit `'.$limit.'` provided to '.__function__.'() in '.
                '`'.$backtrace[0]['file'].'` on line '.$backtrace[0]['line'].'. Expecting -1 or '.
                'a positive integer', E_USER_NOTICE);
        return $subject;
    }

    // Use str_replace() whenever possible (for performance reasons)
    if($limit===-1){
        return str_replace($search, $replace, $subject, $count);
    }

    if(is_array($subject)){

        // Loop through $subject values and call this function for each one.
        foreach($subject as $key => $this_subject){

            // Skip values that are arrays (to match str_replace()).
            if(!is_array($this_subject)){

                // Call this function again for
                $this_function = __FUNCTION__;
                $subject[$key] = $this_function(
                        $search,
                        $replace,
                        $this_subject,
                        $this_count,
                        $limit
                );

                // Adjust $count
                $count += $this_count;

                // Adjust $limit, if not -1
                if($limit!=-1){
                    $limit -= $this_count;
                }

                // Reached $limit, return $subject
                if($limit===0){
                    return $subject;
                }

            }

        }

        return $subject;

    } elseif(is_array($search)){
        // Only treat $replace as an array if $search is also an array (to match str_replace())

        // Clear keys of $search (to match str_replace()).
        $search = array_values($search);

        // Clear keys of $replace, if applicable (to match str_replace()).
        if(is_array($replace)){
            $replace = array_values($replace);
        }

        // Loop through $search array.
        foreach($search as $key => $this_search){

            // Don't support multi-dimensional arrays (to match str_replace()).
            $this_search = strval($this_search);

            // If $replace is an array, use the value of $replace[$key] as the replacement. If
            // $replace[$key] doesn't exist, just an empty string (to match str_replace()).
            if(is_array($replace)){
                if(array_key_exists($key, $replace)){
                    $this_replace = strval($replace[$key]);
                } else {
                    $this_replace = '';
                }
            } else {
                $this_replace = strval($replace);
            }

            // Call this function again for
            $this_function = __FUNCTION__;
            $subject = $this_function(
                    $this_search,
                    $this_replace,
                    $subject,
                    $this_count,
                    $limit
            );

            // Adjust $count
            $count += $this_count;

            // Adjust $limit, if not -1
            if($limit!=-1){
                $limit -= $this_count;
            }

            // Reached $limit, return $subject
            if($limit===0){
                return $subject;
            }

        }

        return $subject;

    } else {
        $search = strval($search);
        $replace = strval($replace);

        // Get position of first $search
        $pos = strpos($subject, $search);

        // Return $subject if $search cannot be found
        if($pos===false){
            return $subject;
        }

        // Get length of $search, to make proper replacement later on
        $search_len = strlen($search);

        // Loop until $search can no longer be found, or $limit is reached
        for($i=0;(($i<$limit)||($limit===-1));$i++){

            // Replace 
            $subject = substr_replace($subject, $replace, $pos, $search_len);

            // Increase $count
            $count++;

            // Get location of next $search
            $pos = strpos($subject, $search);

            // Break out of loop if $needle
            if($pos===false){
                break;
            }

        }

        // Return new $subject
        return $subject;

    }

}

			
			//$headS = strpos($tableHTML, '<!-- gt : head start  -->')+strlen('<!-- gt : head start  -->');
			
			//$headE = strpos($tableHTML, '<!-- gt : head end  -->') +strlen('<!-- gt : head end  -->'); 
			//$tableStartHTML = substr($tableHTML , 200,$headE );
			$limit  = 1;
		
			$tableHTML= str_replace('.gt-grid ','',$tableHTML);
			$tableHTML= str_replace('class="gt-inner  gt-inner-left','',$tableHTML);
			//$new_str = preg_replace('/string$/', '', $str);
		    //$tableHTML= str_replace('<td  class="gt-col-mygrid1-cp" >','</tr>',$tableHTML);
	
		    //chop($tableHTML,'<td  class="gt-col-mygrid1-ciudad" ><div  " >');
			$tableHTML = str_replace_limit('gt-row-even', 'table-sumary', $tableHTML, $count, $limit);
		
			
			//$tableHTML= str_replace('rowspan="2"','rowspan="0"',$tableHTML);
			
			$tableHTML=str_replace('<!-- gt : page separator  -->','</tbody></table></page><page backtop="'.$_pageD.'" backbottom="'.$_pageD.'">'.$tableStartHTML.'<tbody>',$tableHTML);
			
				
			//debug ( $template_style );
						//debug ("----------------\n");
			//debug ( $tableHTML );
			////////////////////////////////////////////////////////////////////////
			//begin !!the following lines exist for enhance exporting performance
      ////////////////////////////////////////////////////////////////////////
			
			preg_match_all('/\.([a-z0-9_\-]+)\s+\{(.*?)display:none;(.*?)\}/', $tableHTML, $result, PREG_SET_ORDER);
	    $patternArray = array();
	    $replaceArray = array();
      for ($matchi = 0; $matchi < count($result); $matchi++) {
		     $patternArray[$matchi] ='/<td\s+class="([a-z0-9_\-]+\s+)*' . $result[$matchi][1] . '(\s+[a-z0-9_\-]+)*\s*"[^>]*>(.*?)<\/td>/';
		     //debug($patternArray[$matchi] ."\n");
		     $replaceArray[$matchi] = '';
	    }
	    $tableHTML = preg_replace($patternArray,$replaceArray,$tableHTML);
	    
      ////////////////////////////////////////////////////////////////////////
			//end !!
      ////////////////////////////////////////////////////////////////////////
	    //debug ("----------------\n")  footer="date;heure;page";
			
			//debug($tableHTML);
			
		

			$page_content = '<page backtop="'.$_pageD.'" backcolor="#FEFEFE" backimg="./images/bas_page1.png" backimgx="center" backimgy="bottom" backimgw="100%"  backtop="0" style="font-size: 10pt" align="left" backbottom=>' .
				$template_style.$tableHTML.'<br><strong>Forma de Pago: </strong><font COLOR=BLUE>Transferencia Bancaria al BBVA Nº de Cta. Cte. ES79-0182-0947-26-0201556780.</font> <br>Operación exenta de I.V.A. según Art. 20.1.9º de la Ley 37/1992.<br><ul><li>SC* &nbsp;&nbsp;= Student Cancellation (Cancelación por el alumno)</li>
<li>LSC* = Late Student Cancellation (Cancelación a ultima hora por el alumno)</li>
<li>TC* &nbsp;&nbsp;= Teacher Cancellation (Cancelación por el profesor). Esta se detalla en la factura pero no se cobra.</li></ul><br></page>';
				//$page_content = html_entity_decode($page_content1);
				
				
				debug($page_content);
	require_once('export_php/html2pdf_v4.03/html2pdf.class.php');	
  try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'es');
       // $html2pdf->pdf->SetDisplayMode('fullpage');
//      $html2pdf->pdf->SetProtection(array('print'), 'spipu');
        $html2pdf->writeHTML($page_content);
       return $html2pdf->Output('bills.pdf', 'D');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
?>