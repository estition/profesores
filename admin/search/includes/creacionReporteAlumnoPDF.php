<?php
	/*  Student Reports, version 1.0
		Author: ISC. Gerardo Cata�o
		Date: July 2009  */
?>
<?php include '../../includes/constants.php'?>
<?php include '../../includes/functions.php'?>
<?php include '../../includes/database.php'?>
<?php include '../../includes/authorize.php'?>
<?php

  global $Conexion;
  $Conexion = $link;
  
 /* $user = DameUsuario();
  $pass = DameContrasenia();
  $host = DameHost();
  $db_name = DameBaseDeDatos(); //panel_de_control
 	*/
  //$Conexion = mysql_connect($host,$user,$pass);
  // $Conexion = mysql_connect($mysql_host,$mysql_user,$mysql_pass);
  
  //$int = mysql_select_db($db_name);
  //$int = mysql_select_db($database);
  
  /*
    $Cliente=DameCliente($id);
	$Profesor=DameProfesor($id);
	$Alumno=DameAlumno($id);
	$Curso=DameCurso($id);
	$Nivel=DameNivel($id);
	$MaterialUsado=DameMaterial($id);
	$Comentario=DameComentario($id);
	$NecesitaMejorar=DameNecesitaMejorar($id);
  */
  
  /////////////////////////////////////////////
  function ObtenerCalificaciones(&$calificaciones,$id_informe)
     {
     global $Conexion;
	 /*
	 PRONUNCIACION int(11)   No                 
  GRAMATICA int(11)   No                 
  COMPRENSION_ORAL int(11)   No                 
  COMPRENSION_ESCRITA int(11)   No                 
  EXPRESION_ORAL int(11)   No                 
  EXPRESION_ESCRITA int(11)   No                 
  PARTICIPACION int(11)   No                 
  COMPORTAMIENTO 

	 */
     
	 $sql='SELECT PRONUNCIACION,GRAMATICA,COMPRENSION_ORAL,COMPRENSION_ESCRITA,EXPRESION_ORAL,EXPRESION_ESCRITA,PARTICIPACION,COMPORTAMIENTO FROM informes_alumnos2 where ID='.$id_informe;

	 $rs = mysqli_query($link, $sql,$Conexion);
	  
	 //print $sql;
	 
	 //exit;
	  				
  	 $fila = mysqli_fetch_row($rs);
				
	 
	 $NumeroRegistros = mysql_num_rows($rs);
	 
	 if($NumeroRegistros>0) {
	    
		   $calificaciones[0]=$fila[0]+1;
		   $calificaciones[1]=$fila[1]+1;
		   $calificaciones[2]=$fila[2]+1;
		   $calificaciones[3]=$fila[3]+1;
		   $calificaciones[4]=$fila[4]+1;
		   $calificaciones[5]=$fila[5]+1;
		   $calificaciones[6]=$fila[6]+1;
		   $calificaciones[7]=$fila[7]+1; 
		}
	 else {	
	   
	   }
	    
	 mysql_free_result($rs);
	   
	}
	
	///////////////////////////////
	
	 /////////////////////////////////////////////
  function ObtenerComentarios(&$comentarios,$id_informe)
     {
     global $Conexion;
	 /*
	 PRONUNCIACION int(11)   No                 
  GRAMATICA int(11)   No                 
  COMPRENSION_ORAL int(11)   No                 
  COMPRENSION_ESCRITA int(11)   No                 
  EXPRESION_ORAL int(11)   No                 
  EXPRESION_ESCRITA int(11)   No                 
  PARTICIPACION int(11)   No                 
  COMPORTAMIENTO 

	 */
     
	 $sql='SELECT COMENTARIO1,COMENTARIO2,COMENTARIO3,COMENTARIO4,COMENTARIO5,COMENTARIO6,COMENTARIO7,COMENTARIO8 FROM informes_alumnos2 where ID='.$id_informe;

	 $rs = mysqli_query($link, $sql,$Conexion);
	  
	 //print $sql;
	 
	 //exit;
	  				
  	 $fila = mysqli_fetch_row($rs);
				
	 
	 $NumeroRegistros = mysql_num_rows($rs);
	 
	 if($NumeroRegistros>0) {
	    
		   $comentarios[0]=$fila[0];
		   $comentarios[1]=$fila[1];
		   $comentarios[2]=$fila[2];
		   $comentarios[3]=$fila[3];
		   $comentarios[4]=$fila[4];
		   $comentarios[5]=$fila[5];
		   $comentarios[6]=$fila[6];
		   $comentarios[7]=$fila[7]; 
		}
	 else {	
	   
	   }
	    
	 mysql_free_result($rs);
	   
	}
	
	///////////////////////////////
	
  
  /////////////////////////////////////////////
  function DameClienteI($id)
     {
     global $Conexion;
     
	 //$sql='SELECT NOMBRE,APELLIDO1 FROM clientes2 WHERE ID=(SELECT IDCLIENTE FROM informes_alumnos2 WHERE ID='.$id.')';
     
	 $sql='SELECT name FROM groups WHERE ID=(SELECT IDCLIENTE FROM informes_alumnos2 WHERE ID='.$id.')';


	 $rs = mysqli_query($link, $sql,$Conexion);
	  				
  	 $fila = mysqli_fetch_row($rs);
				
	 $NumeroRegistros = mysql_num_rows($rs);
	 
	 if($NumeroRegistros>0) {
	    $resul=$fila[0].' '.$fila[1];
		}
	 else {	
	   $resul='';
	   }
	   
	   
	   
	 mysql_free_result($rs);
	
	return $resul; 
	}
	
	///////////////////////////////
	
	function DameProfesorI($id)
    {
     global $Conexion;
     
	 //$sql='SELECT FIRST,LAST1 FROM users WHERE ID=(SELECT IDPROFESOR FROM grupos2 WHERE ID=(SELECT IDGRUPO FROM recibos2 WHERE ID='.$id.'))';
	 $sql='SELECT FIRST,LAST1 FROM users WHERE ID=(SELECT IDUSUARIO FROM informes_alumnos2 WHERE ID='.$id.')';
	 
	 $rs = mysqli_query($link, $sql,$Conexion);
	   			
  	 $fila = mysqli_fetch_row($rs);
				
	 $NumeroRegistros = mysql_num_rows($rs);
	 
	 if($NumeroRegistros>0) {
	    $resul=$fila[0].' '.$fila[1];
		}
	 else {	
	   $resul='';
	   }
	   
	   
	   
	 mysql_free_result($rs);
	
	return $resul; 
	}
    
	/////////////////////////////////////////////
	
	function DameAlumnoI($id)
   {
     global $Conexion;
     
	 $sql='SELECT ALUMNO FROM informes_alumnos2 WHERE ID='.$id.'';
	  
	 $rs = mysqli_query($link, $sql,$Conexion);
	 	  			
  	 $fila = mysqli_fetch_row($rs);
				
	 $NumeroRegistros = mysql_num_rows($rs);
	 
	 if($NumeroRegistros>0) {
		   $resul=$resul.$fila[0].' '.$fila[1];
		 }
	 else {	
	   $resul='';
	   }
	    
	 mysql_free_result($rs);
	
	return $resul; 
	}
	
	
	/////////////////////
	function DameNivelI($id)
    {
     global $Conexion;
     
	 //$sql='SELECT FIRST,LAST1 FROM users WHERE ID=(SELECT IDPROFESOR FROM grupos2 WHERE ID=(SELECT IDGRUPO FROM recibos2 WHERE ID='.$id.'))';
	 $sql='SELECT NIVEL FROM niveles2 WHERE ID=(SELECT IDNIVEL FROM informes_alumnos2 WHERE ID='.$id.')';
	 
	 $rs = mysqli_query($link, $sql,$Conexion);
	   			
  	 $fila = mysqli_fetch_row($rs);
				
	 $NumeroRegistros = mysql_num_rows($rs);
	 
	 if($NumeroRegistros>0) {
	    $resul=$fila[0];
		}
	 else {	
	   $resul='';
	   }
	   
	   
	   
	 mysql_free_result($rs);
	
	return $resul; 
	}
    
	/////////////////////////////////////////////
	
	function DameMaterialI($id)
    {
     global $Conexion;
     
	 //$sql='SELECT FIRST,LAST1 FROM users WHERE ID=(SELECT IDPROFESOR FROM grupos2 WHERE ID=(SELECT IDGRUPO FROM recibos2 WHERE ID='.$id.'))';
	 $sql='SELECT MATERIAL_USADO FROM informes_alumnos2 WHERE ID='.$id.'';
	 
	 $rs = mysqli_query($link, $sql,$Conexion);
	   			
  	 $fila = mysqli_fetch_row($rs);
				
	 $NumeroRegistros = mysql_num_rows($rs);
	 
	 if($NumeroRegistros>0) {
	    $resul=$fila[0];
		}
	 else {	
	   $resul='';
	   }
	   
	   
	   
	 mysql_free_result($rs);
	
	return $resul; 
	}
	
	/////////////////////////////////////////////
	
	function DameComentarioI($id)
    {
     global $Conexion;
     
	 //$sql='SELECT FIRST,LAST1 FROM users WHERE ID=(SELECT IDPROFESOR FROM grupos2 WHERE ID=(SELECT IDGRUPO FROM recibos2 WHERE ID='.$id.'))';
	 $sql='SELECT OTROS_COMENTARIOS FROM informes_alumnos2 WHERE ID='.$id.'';
	 
	 $rs = mysqli_query($link, $sql,$Conexion);
	   			
  	 $fila = mysqli_fetch_row($rs);
				
	 $NumeroRegistros = mysql_num_rows($rs);
	 
	 if($NumeroRegistros>0) {
	    $resul=$fila[0];
		}
	 else {	
	   $resul='';
	   }
	   
	   
	   
	 mysql_free_result($rs);
	
	return $resul; 
	}
	
	/////////////////////////////////////////////
	
	function DameNecesitaMejorarI($id)
    {
     global $Conexion;
     
	 //$sql='SELECT FIRST,LAST1 FROM users WHERE ID=(SELECT IDPROFESOR FROM grupos2 WHERE ID=(SELECT IDGRUPO FROM recibos2 WHERE ID='.$id.'))';
	 $sql='SELECT NECESITA_MEJORAR FROM informes_alumnos2 WHERE ID='.$id.'';
	 
	 $rs = mysqli_query($link, $sql,$Conexion);
	   			
  	 $fila = mysqli_fetch_row($rs);
				
	 $NumeroRegistros = mysql_num_rows($rs);
	 
	 if($NumeroRegistros>0) {
	    $resul=$fila[0];
		}
	 else {	
	   $resul='';
	   }
	   
	   
	   
	 mysql_free_result($rs);
	
	return $resul; 
	}
	
	///////////////////////////////////////////
	function DameCursoI($id)
    {
     global $Conexion;
     
	 //$sql='SELECT FIRST,LAST1 FROM users WHERE ID=(SELECT IDPROFESOR FROM grupos2 WHERE ID=(SELECT IDGRUPO FROM recibos2 WHERE ID='.$id.'))';
	 $sql='SELECT IDCURSO FROM informes_alumnos2 WHERE ID='.$id.'';
	 
	 $rs = mysqli_query($link, $sql,$Conexion);
	   			
  	 $fila = mysqli_fetch_row($rs);
				
	 $NumeroRegistros = mysql_num_rows($rs);
	 
	 if($NumeroRegistros>0) {
	    $resul=$fila[0];
		}
	 else {	
	   $resul='';
	   }
	   
	   
	   
	 mysql_free_result($rs);
	 /*
	 <option value="0">May 08</option>
     <option value="1">Dec 08</option>
     <option value="2">May 09</option>
     <option value="3">Dec 09</option>
	 */
	 
	 $Curso[0]='May 2008';
	 $Curso[1]='Dec 2008';
	 $Curso[2]='May 2009';
	 $Curso[3]='Dec 2009';
	 $Curso[4]='May 2010';
	 $Curso[5]='Dec 2010';
	 $Curso[6]='May 2011';
	 $Curso[7]='Dec 2011';
	 $Curso[8]='May 2012';
	 $Curso[9]='Dec 2012';	 	 
	
	return $Curso[$resul]; 
	}
	
	
	/////////////////////////////////////////////
	
	function DameFechaI($id)
    {
     global $Conexion;
     
	 //$sql='SELECT FIRST,LAST1 FROM users WHERE ID=(SELECT IDPROFESOR FROM grupos2 WHERE ID=(SELECT IDGRUPO FROM recibos2 WHERE ID='.$id.'))';
	 $sql='SELECT CONCAT(informes_alumnos2.DIA_INFORME,"/",informes_alumnos2.MES_INFORME,"/",informes_alumnos2.A�O_INFORME) AS FECHA FROM informes_alumnos2 WHERE ID='.$id.'';
	 
	 $rs = mysqli_query($link, $sql,$Conexion);
	   			
  	 $fila = mysqli_fetch_row($rs);
				
	 $NumeroRegistros = mysql_num_rows($rs);
	 
	 if($NumeroRegistros>0) {
	    $resul=$fila[0];
		}
	 else {	
	   $resul='';
	   }
	
	mysql_free_result($rs);
	
	return DameFormatoFecha($resul); 
	}
	//////////////////////////////////////////////
	
    function DameLenghtI($id)
    {
     global $Conexion;
     
	 //$sql='SELECT FIRST,LAST1 FROM users WHERE ID=(SELECT IDPROFESOR FROM grupos2 WHERE ID=(SELECT IDGRUPO FROM recibos2 WHERE ID='.$id.'))';
	 $sql='SELECT DURACION_CLASE FROM informes_alumnos2 WHERE ID='.$id.'';
	 
	 $rs = mysqli_query($link, $sql,$Conexion);
	   			
  	 $fila = mysqli_fetch_row($rs);
				
	 $NumeroRegistros = mysql_num_rows($rs);
	 
	 if($NumeroRegistros>0) {
	    $resul=$fila[0];
		}
	 else {	
	   $resul='';
	   }
	
	mysql_free_result($rs);
	
	return $resul; 
	}
	
	/////////////////////////////////////////////
	function DameFormatoFecha($str)
    {
	$ar=explode('/',$str);
	if(strlen($ar[0])==1)
	  {
	  $elem1='0'.$ar[0];
	  }
	else
	 {
	 $elem1=''.$ar[0];
	 }
	 
	 if(strlen($ar[1])==1)
	  {
	  $elem2='0'.$ar[1];
	  }
	else
	 {
	 $elem2=''.$ar[1];
	 }
	 
	 if(strlen($ar[2])==1)
	  {
	  $elem3=''.$ar[2];
	  }
	else
	 {
	 $elem3=''.$ar[2];
	 }  
	
	return $elem2.' / '.$elem3;  
	}
	
	//////////////////////////////////////////////
	
    function DameTipoInforme($id) //Child=1, Adult=0
    {
     global $Conexion;
	 $sql='SELECT IDTIPO_INFORME FROM informes_alumnos2 WHERE ID='.$id.'';	 
	 $rs = mysqli_query($link, $sql,$Conexion);	   			
  	 $fila = mysqli_fetch_row($rs);				
	 $NumeroRegistros = mysql_num_rows($rs);	 
	 if($NumeroRegistros>0) {
	    $resul=$fila[0];
		}
	 else {	
	   $resul='';
	   }	
	mysql_free_result($rs);	
	return $resul; 
	}
	
	
	
	/////////////////////////////////////////////////
	
	
	require('pdf_lib/fpdf.php');
	
	
	$ids=$identificador;
	
	$idsreporte=array();
	$cont_id=0;
	foreach($ids as $id){
			if ($id!= NULL or $id!=""){
				$query= "select ID, email from informes_alumnos2 where ID='".$id."'";
				$resultado=mysqli_query($link, $query) or die("Query error: ".mysqli_error($link));
				$row=mysqli_fetch_row($resultado);				
		
				if ($cont_id!=0) {
					//$correos.=",".$row['1'];
					$idsreporte[$cont_id]=$row['0'];
					//$idsalumno[$i]=$row['idalumno'];
					$files[$cont_id]="Report_".$id.".pdf";	//$row['ID']	//$row['0']
					//echo count($files);	
					
					
					
					////////////////////////////////////////////////////////CONDICION////////////////////////////////////////////////////////////
					
/*					
					
								
				}
				$cont_id++;
			}
	}
	
*/	
	
	
	///////////////////////////////////////////// INICIO /////////////////////////////////////////////////////
	


	$TipoInforme=DameTipoInforme($id); //para seleccionar tipo de informe
	$Cliente=DameClienteI($id);
	$Profesor=DameProfesorI($id);
	$Alumno=DameAlumnoI($id);
	$Curso=DameCursoI($id);
	$Nivel=DameNivelI($id);
	$MaterialUsado=DameMaterialI($id);
	$Comentario=DameComentarioI($id);
	$NecesitaMejorar=DameNecesitaMejorarI($id);	
	$areas=array(); //inicializar por cada $id
//ninos
	//$Curso='';//DameCursoI($id);
	
	


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////// if $TipoInforme==0(Adult) 
if ($TipoInforme==0) {

	
		$pdf=new FPDF();
	   
	   	$pdf->AddPage();
	
	      //-------------------------------------
		//Logo Canterbury
    	$pdf->Image('recursos/logo_pq.jpg',90,5,0);
		//$pdf->Image('ficheros/logo_sgs.jpg',10,8,0);
    	//Arial bold 15
    	$pdf->SetFont('Arial','B',15);
    	//$pdf->Ln(7);
	    //Movernos a la derecha
   		//$pdf->Cell(5);
		//T�tulo2
		$pdf->SetXY(39,29); 
   		$pdf->Cell(300,10,'Canterbury English - Informe del Alumno/a - Adultos',0,0,'L');
		//Salto de l�nea
    	
		$pdf->SetFont('Arial','B',11);
		
		$pdf->SetXY(28,42); 
		$pdf->Cell(40,2,'Cliente: '.$Cliente,0,0,'L');
		
		
		$pdf->SetXY(28,52); 
		$pdf->Cell(40,2,'Alumno/a: '.$Alumno,0,0,'L');
		
		
		$pdf->SetXY(28,62); 
		$pdf->Cell(40,2,'Profesor/a: '.$Profesor,0,0,'L');
		
		
		$pdf->SetXY(120,42); 
		$pdf->Cell(40,2,'Curso: '.$Curso,0,0,'L');
		
		$pdf->SetXY(120,52); 
		$pdf->Cell(40,2,'Nivel: '.$Nivel,0,0,'L');
		
		//Recuadro de material usado
		$pdf->SetXY(28,76); 
		$pdf->Cell(160,45,'',1,0,'L');
		
		$pdf->SetXY(29,79); 
		$pdf->MultiCell(160,5,'Material usado: '.$MaterialUsado,0,'L');
		
		//Recuadro calificaciones
		$pdf->SetXY(28,130); 
		$pdf->Cell(160,12,'',1,0,'L');
		
		$pdf->SetXY(28,130); 
		$pdf->Cell(160,5,'Calificaciones:',0,0,'L');
		$pdf->SetXY(28,135); 
		$pdf->Cell(160,5,'1 =  Necesita mejorar  2 =  Normal  3 =  Bien  4 =  Excelente  5 = No Aplica',0,0,'L');
		
		
		//Calificaciones:
		//1=  Necesita mejorar  2 =  Normal  3 =  Bien   4 =  Excelente
		/*
		Areas de Evaluaci�n	Calificaci�n:
		*/
		
		//Encabezado
	   
		$pdf->SetXY(65.5,150);
		$pdf->Cell(60,10,'Areas de Evaluaci�n',1,0,'C');
		$pdf->SetXY(65.5+60,150);
		$pdf->Cell(25,10,'Calificaci�n',1,0,'C');
		/*$pdf->SetXY(28+60+20,150);
		$pdf->Cell(100,10,'Comentarios',1,0,'C');*/
		
		
		ObtenerCalificaciones($calificaciones,$id);
		
		ObtenerComentarios($comentarios,$id);
		
		//ObtenerCantidades($cantidades,$id);
		/*
		
Pronunciaci�n

Gram�tica

Comprensi�n Oral

Comprensi�n Escrita

Expresi�n Escrita

Expresi�n Oral

		*/
		$areas[0]='Pronunciaci�n';
		$areas[1]='Gram�tica';
		$areas[2]='Comprensi�n Oral';
		$areas[3]='Comprensi�n Escrita';
		$areas[4]='Expresi�n Escrita';
		$areas[5]='Expresi�n Oral';
		//$areas[6]='';
		//$areas[7]='';
		//$areas[8]='';
		
		
		//Registros
		
		$ajuste=0;
		for($i=0;$i<count($areas);$i++)  {
	      $pdf->SetXY(65.5,150+10+$ajuste);
		  $pdf->Cell(60,5,$areas[$i],1,0,'C');
		  $pdf->SetXY(65.5+60,150+10+$ajuste);
		  $pdf->Cell(25,5,$calificaciones[$i],1,0,'C');
		  $pdf->SetXY(65.5+60+20,150+10+$ajuste);
		  //$pdf->Cell(100,5,$comentarios[$i],1,0,'C');
	      //$total=$total+($cantidades[$i]*$precios[$i]);
		  $ajuste=$ajuste+5;
		  }
		  
		//$ajuste=12;
		//Recuadro
		$pdf->SetXY(28,150+10+$ajuste+12); 
		$pdf->Cell(160,70,'',1,0,'L');
		
		$pdf->SetXY(29,150+10+$ajuste+15); 
		$pdf->MultiCell(160,5,'Comentarios: '.$Comentario,0,'L');
		
		$pdf->SetXY(29,150+10+$ajuste+16+30); 
		//$pdf->MultiCell(160,5,'Necesita mejorar: '.$NecesitaMejorar,0,'L');
		

		
//###################################################################################################################		
		
		
//		$pdf->Output();
		
//		$pdf->Output("attachment_tmp/Report_".$idsalumno[$j]."_". str_replace( "'","",str_replace(" ","_",$nombre) ) .".pdf", "F"); 
		$pdf->Output("attachment_tmp/Report_".$id.".pdf", "F"); 
		
		
		
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////// if $TipoInforme==0(Adult)
 } else { 
		
		
		
		
		
		
		
		
		
		
		
		
	
		$pdf=new FPDF();
	   
	   	$pdf->AddPage();
	
	      //-------------------------------------
		//Logo Canterbury
    	$pdf->Image('recursos/logo_pq.jpg',90,5,0);		
		//$pdf->Image('ficheros/logo_sgs.jpg',10,8,0);
    	//Arial bold 15
    	$pdf->SetFont('Arial','B',15);
    	//$pdf->Ln(7);
	    //Movernos a la derecha
   		//$pdf->Cell(5);
		//T�tulo2
		$pdf->SetXY(39,29); 
   		$pdf->Cell(300,10,'Canterbury English - Informe del Alumno/a - Ni�os',0,0,'L');
		//Salto de l�nea
    	
		$pdf->SetFont('Arial','B',11);
		
		$pdf->SetXY(28,42); 
		$pdf->Cell(40,2,'Cliente: '.$Cliente,0,0,'L');
		
		
		$pdf->SetXY(28,52); 
		$pdf->Cell(40,2,'Alumno/a: '.$Alumno,0,0,'L');
		
		
		$pdf->SetXY(28,62); 
		$pdf->Cell(40,2,'Profesor/a: '.$Profesor,0,0,'L');
		
		/*
		$pdf->SetXY(120,42); 
		$pdf->Cell(40,2,'Curso: '.$Curso,0,0,'L');
		
		$pdf->SetXY(120,52); 
		$pdf->Cell(40,2,'Nivel: '.$Nivel,0,0,'L');
		*/
		//Recuadro de material usado
		$pdf->SetXY(28,76); 
		$pdf->Cell(160,45,'',1,0,'L');
		
		$pdf->SetXY(29,79); 
		$pdf->MultiCell(160,5,'Material usado: '.$MaterialUsado,0,'L');
		
		//Recuadro calificaciones
		$pdf->SetXY(28,130); 
		$pdf->Cell(160,12,'',1,0,'L');
		
		$pdf->SetXY(28,130); 
		$pdf->Cell(160,5,'Calificaciones:',0,0,'L');
		$pdf->SetXY(28,135); 
		$pdf->Cell(160,5,'1 =  Necesita mejorar  2 =  Normal  3 =  Bien  4 =  Excelente  5 = No Aplica',0,0,'L');
		
		
		//Calificaciones:
		//1=  Necesita mejorar  2 =  Normal  3 =  Bien   4 =  Excelente
		/*
		Areas de Evaluaci�n	Calificaci�n:
		*/
		
		//Encabezado
	   
		$pdf->SetXY(65.5,150);
		$pdf->Cell(60,10,'Areas de Evaluaci�n',1,0,'C');
		$pdf->SetXY(65.5+60,150);
		$pdf->Cell(25,10,'Calificaci�n',1,0,'C');
		/*$pdf->SetXY(15+60+20,150);
		$pdf->Cell(100,10,'Comentarios',1,0,'C');*/
		
		
		ObtenerCalificaciones($calificaciones,$id);
		
		ObtenerComentarios($comentarios,$id);
		/*
		
Pronunciaci�n

Gram�tica

Comprensi�n Oral

Comprensi�n Escrita

Expresi�n Escrita

Expresi�n Oral

		*/
		$areas[0]='Pronunciaci�n';
		$areas[1]='Gram�tica';
		$areas[2]='Comprensi�n Oral';
		$areas[3]='Comprensi�n Escrita';
		$areas[4]='Expresi�n Escrita';
		$areas[5]='Expresi�n Oral';
		$areas[6]='Participaci�n';
		$areas[7]='Comportamiento';
		//$areas[8]='';
		
		
		//Registros
		
		$ajuste=0;
		for($i=0;$i<count($areas);$i++)  {
	      $pdf->SetXY(65.5,150+10+$ajuste);
		  $pdf->Cell(60,5,$areas[$i],1,0,'C');
		  $pdf->SetXY(65.5+60,150+10+$ajuste);
		  $pdf->Cell(25,5,$calificaciones[$i],1,0,'C');
		  /*$pdf->SetXY(15+60+20,150+10+$ajuste);
		  $pdf->Cell(100,5,$comentarios[$i],1,0,'C');*/
	      //$total=$total+($cantidades[$i]*$precios[$i]);
		  $ajuste=$ajuste+5;
		  }
		  
		
		
		
		//$ajuste=12;
		//Recuadro
		$pdf->SetXY(15,150+10+$ajuste+12); 
		$pdf->Cell(178,60,'',1,0,'L');
		
		$pdf->SetXY(16,150+10+$ajuste+15); 
		$pdf->MultiCell(175,5,'Comentarios: '.$Comentario,0,'L');
		
		/*
		$pdf->SetXY(28,150+10+$ajuste+16+30); 
		$pdf->MultiCell(40,2,'Necesita mejorar: '.$NecesitaMejorar,0,'L');
		*/
	    /*$pdf->AddPage();
		
		//Logo Canterbury
    	$pdf->Image('recursos/logo_pq.jpg',90,5,0);		
		//$pdf->Image('ficheros/logo_sgs.jpg',10,8,0);
    	//Arial bold 15
    	$pdf->SetFont('Arial','B',15);
    	//$pdf->Ln(7);
	    //Movernos a la derecha
   		//$pdf->Cell(5);
		//T�tulo2  1. Month / Year:
		$pdf->SetXY(39,29); 
   		$pdf->Cell(300,10,'Children�s Report',0,0,'L');
		
		$pdf->SetXY(39,39); 
   		$pdf->Cell(300,10,'Month / Year: '.DameFechaI($id),0,0,'L');
		
		//Recuadro de material usado
		$pdf->SetXY(28,76); 
		$pdf->Cell(160,45,'',1,0,'L');
		
		$pdf->SetXY(28,79); 
		$pdf->MultiCell(155,7,'Material usado: '.$MaterialUsado,0,'L');
		
		$pdf->SetXY(28,124); 
   		$pdf->Cell(300,10,'Level according to age: '.$Nivel,0,0,'L');
		
		$pdf->SetXY(28,130); 
   		$pdf->Cell(300,10,'Class length per student: '.DameLenghtI($id),0,0,'L'); 
		//Describe student. What does the student need to work on?
		$pdf->SetXY(28,160); 
   		$pdf->MultiCell(160,7,'Describe student. What does the student need to work on?: '.$NecesitaMejorar,0,'L'); */
		
//###################################################################################################################		
		//}//del for()
		
		
//		$pdf->Output();
		
		$pdf->Output("attachment_tmp/Report_".$id.".pdf", "F"); 		
		
		
				
	
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////// else $TipoInforme==1(Child)
}



					////////////////////////////////////////////////////////CONDICION////////////////////////////////////////////////////////////
		
					
				
							
				}
			$cont_id++;
				
			}
				
		
			
	}
		
		
		
		
		
?> 