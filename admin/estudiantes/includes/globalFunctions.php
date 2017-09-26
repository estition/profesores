<?php

/////////////////////////////////////////////
  	function obtenNombreCliente($x){
	 $sql="SELECT name FROM groups WHERE ID = ".$x;
	 $result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));	
		if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			return $row["name"];
		}
	}	
	
function DameTotalHoras($client_id1) { 
     global $Conexion;
	 $sql='SELECT sum( hours ) as sum FROM entry WHERE group_id ='.$client_id1.'';
	 $rs = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));	
	if ($fila = mysqli_fetch_row($rs, MYSQLI_ASSOC)){				
	if($fila["sum"] == "0" || $fila["sum"] == null)
			$resul = "20";
		else
			$resul=$fila["sum"];
		}
	 else {	
	   $resul='';
	   }	
	mysql_free_result($rs);
		
	return $resul; 
	}	

	function obtenNombreProfesor($x) {
	 $sql="SELECT FIRST FROM users WHERE ID = ".$x;
	 $result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));	
		if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			//return $row["FIRST"].' '.$row["LAST1"];
			return $row["FIRST"];
		}
	} 
	
	function obtenLoginProfesor($x) {
	 $sql="SELECT user_id FROM users WHERE ID = ".$x;
	 $result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));	
		if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			return $row["user_id"];
		}
	}  
/////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////////////////////////////////


	function DameIdUsers($Login) {
        if($Login!='') {	   
			$sql='SELECT ID FROM users WHERE  user_id="'.$Login.'"';	   
			$rs = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));//mysqli_query($link, $sql,$Conexion);	 
		  	$fila = mysqli_fetch_row($rs);				
			$NumeroRegistros = mysql_num_rows($rs);
	 		$resul='';
	 		if($NumeroRegistros==0) {
			$resul='';
			} else {
				$resul=$fila[0];
	 		}	   
	   		mysql_free_result($rs);
			return $resul; 
		}
	}
	  
	
	   
	function DameOpcionesStudents($IdStudent, $idalumno) {
	
	
  			$sql = "select id as ident, name, apellido1 FROM clients where group_id = '" . $IdStudent .  "' order by name";
		
		$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
		$numfilas = mysqli_num_rows($result);
	
	if ($numfilas <= 0) {
		
		$sql = "select a.id as ident, a.name FROM groups a where a.id = '" . $IdStudent .  "' order by a.name";
		$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$id = $row['ident'];
			$alumno = $row["name"];
			$opciones1 = $id.",".$alumno;
			$students = $students. "<option value='" .$opciones1. "'" . DameSeleccionCnf($IdStudent,$row['ident']) . ">" . $row["name"]. "</option>\n";  			
	   	}  
	}else{
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$id = $row['ident'];
			$alumno = $row["name"]." ".$row["apellido1"];
			$opciones1 = $id.",".$alumno;
			$students = $students. "<option value='" .$opciones1. "'" . DameSeleccionCnf($idalumno,$row['ident']) . ">" . $row["name"]." ".$row["apellido1"]. "</option>\n";  			
	   	}  
	}
			return $students;
	} 

  
	function DameOpcionesClients($teacher, $IdClient) {
		
     $month = date('m') - 6;
	$year =  date("Y",strtotime("-1 year"));
	$datereport = $year."-01-01";
	 
	 		if ($teacher == "admin"){
		  
			$sql = "SELECT a.id as ident, a.name, a.email, b.end, b.id, class_type, length FROM groups a, userGroup b 
			where b.group_id = a.id and (b.end is null or b.end >= '".$datereport."') order by name";
			
		} else {
  			$sql = "select a.end, b.id, a.name, a.email, a.class_type, length, a.id as ident from groups a, userGroup b, users c ";
			$sql = $sql . "where a.id = b.group_id and b.user_id = c.id and c.user_id = '" . $teacher .  "' order by a.name";  
			
			//echo $sql."CCCC";
		}
		$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$id = $row['ident'];
			$email = $row['email'];
			$opciones = $id.",".$email;
			$clients = $clients . "<option value='" .$opciones. "'" . DameSeleccionCnf($IdClient,$row['ident']) . ">" .$row["name"].  $row['end'] . "</option>\n";     			
	   	}   
		return $clients;
	}  

 //echo DameOpcionesClients("alfred.aguilar", $IdClient);
 function DameOpciones($registro,$tabla,$orderby) {
	 $rs = mysqli_query($link, 'SELECT * FROM '.strtolower($tabla).' ORDER BY '.$orderby);
  	 $fila = mysqli_fetch_row($rs);			
	 $NumeroRegistros = mysql_num_rows($rs);
	 $resul='';
	 for($i=0;$i<$NumeroRegistros;$i++)  {
	   $resul=$resul.'<option value="'.$fila[0].'"'.DameSeleccionCnf($registro,$fila[0]).'>'.$fila[1].'</option>';	   
	   $fila = mysqli_fetch_row($rs);
	 }	   
	 mysql_free_result($rs);	
	return $resul; //'.DameSeleccionCnf($registro,$fila[0]).'
	}


  function DameSeleccionCnf($Cad1,$Cad2) {	 	//echo "<script>alert(\" ".$Cad1."--".$Cad2." \"...";
    if (strcmp($Cad1,$Cad2)==0) {
		return ' selected="selected" ';
	} else
    	return '';
  };


/////////////////////////////////////////////////////////////////////////////////////////////////////////
	function addZero($x) {
		if ($x<10) return "0".$x;
		else return $x;
	}
///////////////////	
///////////////////////////////// validador de email ////////////////////////////////
function validarEmail($email) {
    // First, we check that there's one @ symbol, and that the lengths are right
    if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
        // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
        return false;
    }
    // Split it into sections to make life easier
    $email_array = explode("@", $email);
    $local_array = explode(".", $email_array[0]);
    for ($i = 0; $i < sizeof($local_array); $i++) {
         if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {
            return false;
        }
    }    
    if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
        $domain_array = explode(".", $email_array[1]);
        if (sizeof($domain_array) < 2) {
                return false; // Not enough parts to domain
        }
        for ($i = 0; $i < sizeof($domain_array); $i++) {
            if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) {
                return false;
            }
        }
    }
    return true;
}
///////////////////////////////// validador de email ////////////////////////////////

?>