<?php
	/*  Student Reports, version 1.0
		Author: Rafael Tejeda
		Date: July 2009  */
?>
<?php include '../../includes/constants.php'?>
<?php include '../../includes/functions.php'?>
<?php include '../../includes/database.php'?>
<?php include '../../includes/authorize.php'?>
<?php

  
  global $Conexion;
  $Conexion = $link;
  
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////  
    
	function DameAlumnoI($id) {
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
		
	
	function DameNivelI($id) {
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
		
	
    function DameTipoInforme($id) { //Child=1, Adult=0
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
			
	
	function DameTotalHoras($id) { 
     global $Conexion;
	 $sql='SELECT totalHours FROM informes_alumnos2 WHERE ID='.$id.'';	 
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

	
	function DameAnio($id) { 
     global $Conexion;
	 $sql='SELECT A�O_INFORME FROM informes_alumnos2 WHERE ID='.$id.'';	 
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

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////


	require('pdf_lib/fpdf.php');
	
	
	$ids=$identificador;
	$i=0;
	$idsreporte=array();
	$cont_id=0;
	foreach($ids as $id){
			if ($id!= NULL or $id!=""){
				$query= "select ID, email from informes_alumnos2 where ID='".$id."'";
				$resultado=mysqli_query($link, $query) or die("Query error: ".mysqli_error($link));
				$row=mysqli_fetch_row($resultado);				

				if ($cont_id!=0) {
					//$correos.=",".$row['1'];
					$idsreporte[$i]=$row['0'];
					//$idsalumno[$i]=$row['idalumno'];
					$files[$i]="Diploma_".$id.".pdf";	//$row['ID']	//$row['0']
					
					////////////////////////////////////////////////////////CONDICION////////////////////////////////////////////////////////////




//	$id=$_REQUEST['id'];

		$TipoInforme=DameTipoInforme($id); // 1 child, 0 adult
		$Alumno=DameAlumnoI($id);
		$Nivel=DameNivelI($id);
		$TotalHoras=DameTotalHoras($id);
		
	//	require("pdf_lib/fpdf.php");

		
		$pdf=new FPDF('L','cm','Letter');
	   	$pdf->AddPage();
		
			if ($TipoInforme==1)
	    	$pdf->Image('recursos/kids_to_be_mailed.jpg',0.35,1.5,0);
		if ($TipoInforme==0)
	    	$pdf->Image('recursos/adultos_to_be_mailed.jpg',0.35,1.3,0);

		$pdf->SetFont('Arial','B',24);
		$pdf->SetY(9);
		$pdf->Cell(5.5);

		if ($TipoInforme==1){
		$pdf->Cell(14,1,$Alumno,0,1,C);}
		else{
		$pdf->Cell(14,0.6,$Alumno,0,0,C);
		}
		$pdf->SetFont('Arial','B',20);
		$pdf->SetY(10.5);
		$pdf->Cell(4.7);
		if ($TipoInforme==1){
		$pdf->Cell(18.8,0.5,$TotalHoras,0,1,C);}
		else{$pdf->Cell(18.8,0.1,$TotalHoras,0,1,C);}
		
		$pdf->SetY(11.5);
		$pdf->Cell(12.6);
		
		$pdf->SetFont('Arial','B',20);
		if ($TipoInforme==1){
		$pdf->Cell(18.7,2.2, date("F-Y"),0,1,'L');}
		else {$pdf->Cell(18.7,1.8, date("F-Y"),0,1,'L');}
		
		$pdf->SetY(12.5);
		$pdf->Cell(4.2);
		
		$pdf->SetFont('Arial','B',20);
		if ($TipoInforme==1){
		$pdf->Cell(15,3.8,$Nivel,0,0,'C');}
		else {
		$pdf->Cell(14.5,3.5,$Nivel,0,0,C);
		}
		$pdf->Output("attachment_tmp/Diploma_".$id.".pdf", "F");
		
		
		
		
					////////////////////////////////////////////////////////CONDICION////////////////////////////////////////////////////////////
		
					
					$i++;			
				}
				$cont_id++;
			}
	}
		
		
			
		
		
		
?>