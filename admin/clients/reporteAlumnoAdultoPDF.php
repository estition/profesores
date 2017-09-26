<?php
  include('includes/config.php');
  include('includes/constants.php');
  include('includes/database.php');
  
  $group_id = $_REQUEST["group_id"];
  $iduser = $_REQUEST["iduser"];
  
  if($iduser == "admin"){
  $sql = "select c.name,  c.apellido1, c.address1,  c.state, c.zip, c.cif, c.telephone1, c.mobile, c.email, c.days, c.nivel, c.supplement, c.seguimiento, c.objetivos, c.price, c.metro, c.ninos, c.tcontry, c.gender, c.preferencia, c.enterprise, (select count(id) from clients d where group_id = '".$group_id."') as num from groups c where c.id = '".$group_id."' and c.baja = '0'";
  
  }
  else{
  
  
$sql = "select c.name,  c.apellido1, c.address1,  c.state, c.zip, c.cif, c.telephone1, c.mobile, c.email, b.first, b.last1, a.start, a.end, c.days, a.starttime, a.endtime, a.length, c.nivel, a.length, c.objetivos, c.supplement, c.seguimiento, c.price, c.metro, c.ninos, c.tcontry, c.gender, c.preferencia, c.enterprise, (select count(id) from clients d where group_id = '".$group_id."') as num from userGroup a, users b, groups c where a.user_id = '".$iduser."' and b.id = '".$iduser."' and  c.id = '".$group_id."' and a.end is null and c.baja = '0'";}

//$sql = "select * from groups where id = " . $group_id;


$result = mysqli_query($link, $sql) or die("Invalid query: " . mysqli_error($link));

if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

		$name =  utf8_decode(stripslashes($row["name"]));
		$apellido =  utf8_decode(stripslashes($row["apellido1"]));
		$first1 =  utf8_decode(stripslashes($row["first"]));
		$last1 =  utf8_decode(stripslashes($row["last1"]));
		
		$cif =  stripslashes($row["cif"]);
		$telephone1 = $row["telephone1"];
		$mobile = $row["mobile"];
		$email = utf8_decode($row["email"]);
		$address1 = utf8_decode($row["address1"]);
		//$city = $row["city"];
		$state = utf8_decode($row["state"]);
		$zip = $row["zip"];
		  if($iduser != "admin"){
		$start = date('j F Y',strtotime($row["start"]));
		
		if($row["end"] == ""){	
		$end  = ""; }else{
		$end =   date('j F Y',strtotime($row["end"]));}}
		$nivel = $row["nivel"];
		$supplement = $row["supplement"];
		$preferencia = utf8_decode($row["preferencia"]);
	
	
		$price = $row["price"];
		$diasString = $row["days"];
		
		$dias = explode(',',$diasString);
		
		$hora_ini = substr($row["starttime"], 0, 5);
		
		$hora_fin = substr($row["endtime"], 0, 5);
		$Metro = utf8_decode($row["metro"]);
		$Seguimiento = utf8_decode($row["seguimiento"]);
		$Objetivos = utf8_decode($row["objetivos"]);
		$nino1 = $row["ninos"];
		if($nino1==1){$nino = "yes";}else{$nino = "no";} 
		$contry = $row["tcontry"];
		$gender = $row["gender"];
		$length = $row["length"];
		$num = $row["num"];
		$enterprise1 = $row["enterprise"];
		if($enterprise1==1){$enterprise = "yes";}else{$enterprise = "no";} 
	
	/////////////////////////////////////////
	
	require('pdf_lib/fpdf.php');
	
	$id=$_REQUEST['id'];
	
	/*$Cliente=DameClienteI($id);
	$Profesor=DameProfesorI($id);
	$Alumno=DameAlumnoI($id);
	$Curso=DameCursoI($id);
	$Nivel=DameNivelI($id);
	$MaterialUsado=DameMaterialI($id);
	$Comentario=DameComentarioI($id);
	$NecesitaMejorar=DameNecesitaMejorarI($id);*/
	
	
		$pdf=new FPDF();
	   
	   	$pdf->AddPage();
		
		$pdf->Image('includes/logo_pq.jpg',90,5,0);
	
	      //-------------------------------------
		//Logo Canterbury
    	//$pdf->Image('recursos/logo_pq.jpg',90,5,0);
		//$pdf->Image('ficheros/logo_sgs.jpg',10,8,0);
    	//Arial bold 15
    	$pdf->SetFont('Arial','B',15);
    	//$pdf->Ln(7);
	    //Movernos a la derecha
   		//$pdf->Cell(5);
		//Título2
		$pdf->SetXY(39,29); 
   		$pdf->Cell(300,10, $name." ".$apellido ,0,0,'L');
		
		//$pdf->SetXY(120,29); 
   		//$pdf->Cell(300,10,'Date:'.date("d-M-Y"),0,0,'L');
		//Salto de línea
    	
		$pdf->SetFont('Arial','',11);
		
		
		$pdf->SetXY(28,42); 
		$pdf->Cell(160,45,'',1,0,'L');
		$pdf->SetXY(28,45);
		//$pdf->SetXY(28,42); 
		$pdf->Cell(40,2,'Id: '.$group_id,0,0,'L');
		
		
		$pdf->SetXY(120,45); 
		$pdf->Cell(40,2,'ZIP: '.$zip,0,0,'L');
		
		
		$pdf->SetXY(28,54); 
		$pdf->Cell(40,2,'Client: '.$name." ".$apellido,0,0,'L');
		
		$pdf->SetXY(28,62); 
		$pdf->Cell(40,2,'Email: '.$email,0,0,'L');
				
		
		//$pdf->SetXY(120,54); 
		//$pdf->Cell(40,2,'Date:'.date("d-M-Y"),0,0,'L');
		
		
		$pdf->SetXY(120,62); 
		$pdf->Cell(40,2,'Cell phone: '.$mobile,0,0,'L');
		
		//
		
		$pdf->SetXY(28,70); 
		$pdf->Cell(40,2,'Telephone: '.$telephone1,0,0,'L');
		
		$pdf->SetXY(28,78); 
		$pdf->Cell(40,2,'Address: '.$address1,0,0,'L');
				
		
		$pdf->SetXY(120,70); 
		$pdf->Cell(40,2,'Metro: '.$Metro,0,0,'L');
		
		//$pdf->SetXY(120,78); 
		//$pdf->Cell(40,2,'Cell phone: '.$mobile,0,0,'L');
		
		//ÑÑÑÑÑÑÑÑÑÑÑÑÑÑÑÑÑÑÑÑÑÑÑÑÑÑÑÑÑÑÑÑÑÑÑÑÑÑÑÑÑÑÑÑÑÑÑ
	
		//Recuadro de material usado
		
		
		//Recuadro calificaciones
		$pdf->SetXY(28,88); 
		$pdf->Cell(160,35,'',1,0,'L');
		$pdf->SetXY(28,88);
		
		$pdf->SetXY(28,90); 
		$pdf->Cell(40,6,'Start date:'.$start,0,0,'L');
		$pdf->SetXY(28,98); 
		$pdf->Cell(40,6,'Start time:'.$hora_ini,0,0,'L');
		
		$pdf->SetXY(120,90); 
		$pdf->Cell(40,6,'End date:'.$end,0,0,'L');
		$pdf->SetXY(120,98); 
		$pdf->Cell(40,6,'End time:'.$hora_fin,0,0,'L');
		
		
		$pdf->SetXY(28,106); 
		$pdf->Cell(40,6,'Days:'.$diasString,0,0,'L');
		$pdf->SetXY(28,114); 
		$pdf->Cell(40,6,'Teacher: '.$first1." ".$last1,0,0,'L');
		
		$pdf->SetXY(120,106); 
		$pdf->Cell(40,6,'Level:'. $nivel,0,0,'L');
		//$pdf->SetXY(120,114); 
		//$pdf->Cell(40,6,'Supplement: '.$supplement,0,0,'L');
		
		
		$pdf->SetXY(28,124); 
		$pdf->Cell(160,35,'',1,0,'L');
		$pdf->SetXY(28,124);
		
		$pdf->SetXY(28,125); 
		$pdf->MultiCell(165,4,'Objectives: '.$Objetivos,0,'L');
		
		$pdf->SetXY(28,160); 
		$pdf->Cell(160,37,'',1,0,'L');
		$pdf->SetXY(28,160);
		
			
		$pdf->SetXY(28,161); 
		$pdf->MultiCell(165,4,'Follow up: '. $Seguimiento,0,'L');
		
	    $pdf->SetXY(28,198); 
		$pdf->Cell(160,33,'',1,0,'L');
		$pdf->SetXY(28,198);
		
		$pdf->SetXY(28,199); 
		$pdf->MultiCell(165,4,'Preferences: '. $preferencia,0,'L');
		//$pdf->MultiCell(160,5,'Necesita mejorar: '.$NecesitaMejorar,0,'L');
		
		$pdf->SetXY(28,232); 
		$pdf->Cell(160,42,'',1,0,'L');
		$pdf->SetXY(28,232);
		
		$pdf->SetXY(28,233); 
		$pdf->Cell(40,6,'Kids?:'.$nino,0,0,'L');
		$pdf->SetXY(28,241); 
		$pdf->Cell(40,6,'Teacher country:'.$contry ,0,0,'L');
		$pdf->SetXY(55,233); 
		$pdf->Cell(40,6,'Registered date:'.date("d-M-Y"),0,0,'L');
		
		$pdf->SetXY(120,233); 
		$pdf->Cell(40,6,'Gender:'.$gender,0,0,'L');
		$pdf->SetXY(120,241); 
		$pdf->Cell(40,6,'Class length:'.$length,0,0,'L');
		
		
		$pdf->SetXY(28,249); 
		$pdf->Cell(40,6,'Contacto:'.$email,0,0,'L');
		$pdf->SetXY(28,257); 
		$pdf->Cell(40,6,'Price:'.$price,0,0,'L');
		
		$pdf->SetXY(120,249); 
		$pdf->Cell(40,6,'Students:'.$num,0,0,'L');
		$pdf->SetXY(120,257); 
		$pdf->Cell(40,6,'Company:'.$enterprise,0,0,'L');
		
		$pdf->SetXY(28,265); 
		$pdf->Cell(40,6,'CIF: '.$cif,0,0,'L');
		$pdf->SetXY(120,265); 
		$pdf->Cell(40,6,'Supplement: '.$supplement,0,0,'L');
		
		
		
		
		
	
		
		
//###################################################################################################################		
		//}//del for()
		
		
		$pdf->Output();
		}
		/*
		}   
    else
    {
	mysql_free_result($rs);
	print 'Cargando informe...  ';
	//print '<a href="index.php">Inicio</a>';
    $Correcto=0;
	}	
	
	mysql_close();
	//print '</html>';
	*/
	
	//print '->'.$VariableQueContegaNombredeFuncion.'<-'; *********
?> 