
<?php 


class datemoves{
 //constructor	
 

 function datemoves(){
 }	

 // consulta los empledos de la BD
 function consultar($fecha1, $fecha2){
 //Ingresamos los comentarios a su tabla
  
	$query = "SELECT * FROM blokingdays WHERE fechas1 >='$fecha1' and fechas1 <= '$fecha2'";
	//echo $query;
	$result = mysqli_query($link, $query) or die("Invalid query: " . mysqli_error($link));
	$name_exist = mysql_num_rows($result);

	  if  ( $name_exist > 0 )  { 
	  
		return $result;
	   }
	   
	 else  {
		  return false;
		                 
	   }
  		  
				  
}

 //inserta un nuevo empleado en la base de datos
 function crear($fecha1, $fecha2){
  
//Ingresamos los comentarios a su tabla
	$checkname = mysqli_query($link, "SELECT * FROM blokingdays WHERE fechas1 >='$fecha1' and fechas1 <= '$fecha2'");
		$name_exist = mysql_num_rows($checkname);

		//if ($email_exist>0|$username_exist>0) {
		if  ( $name_exist > 0 )  { 	//IF info en BD
		
			
					//echo "El nombre de usuario o la cuenta de correo elect&oacute;nico ya están registrados.";
			echo "<font COLOR=RED><b>No se puede mover el rango de fechas ya que existen un rango ya asignado.</b></font><br/>";
			return false;
		} else {	//ELSE info ok
			
$query = "insert into blokingdays(fechas1, fechas2) values('$fecha1', '$fecha2')";

$result = mysqli_query($link, $query)or die("Invalid query: " . mysqli_error($link));
     if (!$result)
	  return false;
     else
       return true;
//print "<meta http-equiv=refresh content=0 url=vistaLibro.php?id='".$id."'>";

	//header("location: vistaLibro.php?id='".$id);}	
	}
 
}

}
?>