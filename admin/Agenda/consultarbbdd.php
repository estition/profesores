
<?php 

//implementamos la clase empleado
class consultarbbdd{
 //constructor	
 

 function consultarbbdd(){
 }	
 
 // consulta los empledos de la BD
 function consultar(){
 //Ingresamos los comentarios a su tabla

 //$first_date = date('Y')."-".date('m')."-04";
 //$second_date = date('Y')."-".date('m')."-21";
 //$next_month = date('m');	
   if(date('d') == 25 || date('d') == 26 || date('d') == 27 || date('d') == 28 || date('d') == 29 || date('d') == 30 ||  date('d') == 31  || date('d') == 01 || date('d') == 02 || date('d') == 03 || date('d') == 04 || date('d') == 05){
 $next_month = date('m')+1;}else{$next_month = date('m');}
 
 if(date('m') == 12){$next_month = 1;}
 
  $first_date = date('Y')."-".$next_month."-01";
 //$first_date = date('Y')."-".date('m')."-04";
 $second_date = date('Y')."-".$next_month."-21";
 
 
	$query = "SELECT * FROM blokingdays WHERE fechas >= '$first_date' && fechas <= '$second_date'";
	 $result = @mysqli_query($link, $query);
 if (!$result){
		error_log("Query $myquery failed: " . mysqli_error($link));
	   return false;}
	   
	 else  {
	                           
	   return $result;}
  		  
				  
}

 //inserta un nuevo empleado en la base de datos
 function crear($fecha){
  
//Ingresamos los comentarios a su tabla
	$checkname = mysqli_query($link, "SELECT * FROM blokingdays WHERE fechas='$fecha'");
		$name_exist = mysql_num_rows($checkname);

		//if ($email_exist>0|$username_exist>0) {
		if  ( $name_exist > 0 )  { 	//IF info en BD
		
			
					//echo "El nombre de usuario o la cuenta de correo elect&oacute;nico ya están registrados.";
			echo "<font COLOR=RED><b>Este dia ya ha sido bloqueado.</b></font><br/>";
			return false;
		} else {	//ELSE info ok
			
$query = "insert into blokingdays(fechas) values('$fecha')";

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