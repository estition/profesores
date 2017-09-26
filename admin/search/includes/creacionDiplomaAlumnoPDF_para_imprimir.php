<?php
	/*  Student Reports, version 1.0
		Author: ISC. Gerardo Cataño
		Date: July 2009  */
?>
<?php
  include('includes/config.php');
  include('includes/constants.php');
  include('includes/database.php');
  
  global $Conexion;
  $Conexion = $link;
  
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////  
    
	function DameAlumnoI($id) {
     global $Conexion;
     
	 $sql='SELECT ALUMNO FROM informes_alumnos2 WHERE ID='.$id.'';	  
	 $rs = mysql_query($sql,$Conexion);	 	  			
  	 $fila = mysql_fetch_row($rs);				
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
	 
	 $rs = mysql_query($sql,$Conexion);	   			
  	 $fila = mysql_fetch_row($rs);				
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
	 $rs = mysql_query($sql,$Conexion);	   			
  	 $fila = mysql_fetch_row($rs);				
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
	 $rs = mysql_query($sql,$Conexion);	   			
  	 $fila = mysql_fetch_row($rs);				
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
	 $sql='SELECT AÑO_INFORME FROM informes_alumnos2 WHERE ID='.$id.'';	 
	 $rs = mysql_query($sql,$Conexion);	   			
  	 $fila = mysql_fetch_row($rs);				
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
				$resultado=mysql_query($query) or die("Query error: ".mysql_error());
				$row=mysql_fetch_row($resultado);				

				if ($cont_id!=0) {
					//$correos.=",".$row['1'];
					$idsreporte[$i]=$row['0'];
					//$idsalumno[$i]=$row['idalumno'];
					$files[$i]="Diploma_".$id.".pdf";	//$row['ID']	//$row['0']
					echo count($files);
					
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
	    	$pdf->Image('recursos/diplomaNino.jpg',0.35,1.5,0);
		if ($TipoInforme==0)
	    	$pdf->Image('recursos/diplomaAdulto.jpg',0.35,1.3,0);
		$pdf->SetFont('Arial','B',40);
		$pdf->SetY(9);
		$pdf->Cell(5.5);

		$pdf->Cell(14.5,2,$Alumno,0,0,C);
		$pdf->SetFont('Arial','B',20);
		$pdf->SetY(11);
		$pdf->Cell(12,0,"",0);
		$pdf->Cell(0.5,0.8,$TotalHoras,0,0,C);
		$pdf->Ln(1.5);
		$pdf->Cell(5.5);
		$pdf->SetFont('Arial','B',20);
		$pdf->Cell(14.5,3,$Nivel,0,0,C);
	
		$pdf->Ln(3.5);
		$pdf->SetFont('Arial','B',16);
		$pdf->Cell(41.8,0.80,DameAnio($id),0,0,C);		
		$pdf->Image('recursos/rc.png',9.4,15.5,0);
		$pdf->Image('recursos/jc.png',14.6,15.5,0);
		//$pdf->Output();
		$pdf->Output("attachment_tmp/Diploma_".$id.".pdf", "F");
		
		
		
		
					////////////////////////////////////////////////////////CONDICION////////////////////////////////////////////////////////////
		
					
					$i++;			
				}
				$cont_id++;
			}
			
		
	}
		
		
			
		
		
		
?>