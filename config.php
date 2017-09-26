<?php
 
 //CONFIGURACION BASE DE DATOS MYSQL ////////////////////////////
 
 /*
 function DameUsuario()
  {
  return 'CALAS';
  }
  
  function DameContrasenia()
  {
  
  return 'CALAS';
  }
  
   function DameHost()
  {
  
  return '172.179.4.139';
  }
  
  function DameBaseDeDatos()
  {
  return 'CALAS';
  }
  
  /////////////////////////////////////////////////////////////////////////
  
  
  // TITULOS /////////////////////////////////////////////////////////////
  function DameTitulo()
  {
  return 'Control fuera de plazo';
  }
  
  function DameTitulo2()
  {
  return 'SGS España S.A.';
  }
  
  function DameTitulo3()
  {
  return 'SGS Espa&ntilde;a S.A.';
  }
  ////////////////////////////////////////////////////////////////////////
  */
  
  
  function DameUsuario()
  {
  return 'Administrador';
  }
  
  function DameContrasenia()
  {
  
  return 'hercules';
  }
  
   function DameHost()
  {
  
  return 'localhost';
  }
  
  function DameBaseDeDatos()
  {
  return 'canterburyproto';
  }
  
 
  // TITULOS /////////////////////////////////////////////////////////////
  function DameTitulo()
  {
  return 'Gestión Canterbury';
  }
  
  function DameTitulo2()
  {
  return 'Canterbury English';
  }
  
  function DameTitulo3()
  {
  return 'Canterbury English';
  }
  
  function DameLink()
  {
  return 'http://www.canterburyenglish.com/';
  }
  
  function DameAccion($val)
   {
   switch ($val) {
    case '0':
        $resul="alumnos.php?listado=1";
        break;
    case '1':
        $resul="boletines.php?listado=1";
        break;
    case '2':
        $resul="";
        break;
		}
   return $resul;
   }
  
  
  function DamePromotor($Id)
   {
    
	
	$Resultado='';
	
	
	
	switch($Id)
	{
	 case 'MB':
	  $Resultado='AUNA BARRIOS';
	  break;
	 case 'AY': 
	  $Resultado='AYUNTAMIENTO DE MADRID';
	  break;
	 case 'BO': 
	  $Resultado='BROADBAND OPTICAL ACCESS S.A.';
	 break;
	 case 'BT': 
	  $Resultado='BT ESPAÑA COMPAÑÍA DE SERVICIOS';
	  break;
	 case 'CW':
	  $Resultado='CABLE WIRELESS S.A.España';
	  break;
	 case 'CY':
	  $Resultado='CANAL DE ISABEL II';
	  break;
	 case 'TE':
	  $Resultado='CIA TELEFONICA DE ESPAÑA S.A.U.';
	  break;
	 case 'CN':
	  $Resultado='CITYNET ESPAÑA, S.A.';
	  break;
	 case 'CT':
	  $Resultado='COLT TELECOM ESPAÑA S.A.';
	  break;
	 case 'ZZ':
	  $Resultado='DESCONOCIDO';
	  break;
	 case 'GN':
	  $Resultado='GAS NATURAL DISTRIBUCIÓN SDG, SA';
	  break;
	 case 'GC':
	  $Resultado='GC PAN EUROPEAN CROSSIN ESPAÑA S.L.';
	  break;
	 case 'GM':
	  $Resultado='GLOBAL METRO NETWORKS SPAIN,SL';
	  break;
	 case 'GP':
	  $Resultado='GRAN PROMOTOR';
	  break;
	 case 'GI':
	  $Resultado='GRUPALIA INTERNET, S.A.';
	  break;
	 case 'GT':
	  $Resultado='GTS NETWORK (IRELAND) LIMITED';
	  break;
	 case 'IB':
	  $Resultado='IBERDROLA DIST. ELECT. S.A.';
	  break;
	 case 'IR':
	  $Resultado='IBERDROLA, S.A.(Iberdrola Redes)';
	  break;
	 case 'IT':
	  $Resultado='INTEROUTE IBERIA, S.A.U';
	  break;
	 case 'JT':
	  $Resultado='JAZZ TELECOM, S.A.';
      break;
	 case 'LD':
	  $Resultado='LOUIS DREYFUS COMUNICATION,S.A';
	  break;
	 case 'ME':
	  $Resultado='METRO DE MADRID  S.A.';
	  break;
	 case 'MK':
	  $Resultado='MKI'; 
	  break;
	 case 'CE':
	  $Resultado='O.N.O. EMPRESAS - CABLEUROPA S.A.';
	  break;
	 case 'MT':
	  $Resultado='ONO'; 
	  break;
	 case 'PA':
	 $Resultado='PARTICULARES';
	 break;
	 case 'RT': 
	  $Resultado='RETEVISION S.A.';
     break;
	 case 'RS':	  
	  $Resultado='RSL COMMUNICATIONS SPAIN (ALO)';
	 break;
	 case 'AB': 
	  $Resultado='T - ONLINE TELECOMMUNICATIONS SPAIN, SAU';
	break;
	 case 'TC':  
	  $Resultado='TELEFONICA CABLE SAU';
	break;
	 case 'U2':  
	  $Resultado='UNI2 LINCE';
	break;
	 case 'FE':  
	  $Resultado='UNION FENOSA DISTRIBUCION S.A.';
	 break;
	 case 'UF': 
	  $Resultado='UNION FENOSA REDES TELECM. S.L.';
	 break;
	 case 'AT': 
	  $Resultado='VODAFONE';
	 }
	  
	return $Resultado;
   }
   
   
    function DameSeleccionCnf($Cad1,$Cad2)
  {
   if (strcmp($Cad1,$Cad2)==0)
  	{
    //print $Texto1.'|************************************************************************************|'.$Texto2;
	return 'selected';
	}
  else
    return ' ';
  };  
  
 
	 
	 ////////////
  function DameOpcionesHorariosAsignados($IdAlumno)
   {
     global $Conexion;
  
	 $rs = mysql_query('SELECT HORARIOS.* FROM horarios,horarios_alumnos WHERE HORARIOS.ID=HORARIOS_ALUMNOS.IDHORARIO AND HORARIOS_ALUMNOS.IDALUMNO='.$IdAlumno,$Conexion);
	  				
  	 $fila = mysql_fetch_row($rs);
				
	 $NumeroRegistros = mysql_num_rows($rs);
	
	 for($i=0;$i<$NumeroRegistros;$i++)
	   {
	   $str=$str.'<option value="'.$fila[0].'">'.$fila[1].' '.$fila[2].' '.$fila[3].' '.$fila[4].'</option>';
	   
	   $fila = mysql_fetch_row($rs);
	   }
	   
	 mysql_free_result($rs);
	
	return $str;
	}
	 
	 /////////////
	 
  ////////////
  function DameOpciones($registro,$tabla,$orderby)
   {
     global $Conexion;
  
	 $rs = mysql_query('SELECT * FROM '.strtolower($tabla).' ORDER BY '.$orderby,$Conexion);
	 
	  
	 //print 'SELECT * FROM '.strtolower($tabla).' ORDER BY '.$orderby;
	 
	 //exit();
	  				
  	 $fila = mysql_fetch_row($rs);
				
	 $NumeroRegistros = mysql_num_rows($rs);
	 
	 //print $NumeroRegistros;
	 
	 $resul='';
	 for($i=0;$i<$NumeroRegistros;$i++)  {
	   $resul=$resul.'<option value="'.$fila[0].'" '.DameSeleccionCnf($registro,$fila[0]).'>'.$fila[1].'</option>';
	   
	   $fila = mysql_fetch_row($rs);
	   }
	   
	 mysql_free_result($rs);
	
	return $resul; //'.DameSeleccionCnf($registro,$fila[0]).'
	}
	 
	 
	 /////////////
	 
	 
	 function DameChecked($Campo) 
	 {
	 if ($Campo=='on') {
						   $chk=' checked';
						   }
						  else {
						   $chk='';
						  }
	return $chk;					
	}		
	
	/////////////
	 
	 function DameChecked2($Campo) 
	 {
	 if ($Campo==1) {
						   $chk=' checked';
						   }
						  else {
						   $chk='';
						  }
	return $chk;					
	}	
	
	function DameCheckedUpdate($Campo) 
	 {
	 if ($Campo=='on') {
						   $chk='1';
						   }
						  else {
						   $chk='0';
						  }
	return $chk;					
	}
	
	/////////////////////////////////////////////////
	function DameBotonMenos($NumeroDePagina,$NumeroRegistros) 
	  {
	  
	  			   if($NumeroDePagina!=1) {
				       $Resultado='<A class=image href="javascript:PaginaMenos();"><img src="ficheros/flecha_izq.gif" border=0></A>';                   
				       }
				   else {
				       $Resultado='';                   
				   }
		return $Resultado;  	
	  }	
	  
	  //////////////////////////////////////////////////////
	  function DameBotonMas($NumeroDePagina,$NumeroRegistros) 
	  {
	 
				   if(($NumeroDePagina*20)<$NumeroRegistros) {
				       $Resultado='<A class=image href="javascript:PaginaMas();"><img src="ficheros/flecha_der.gif" border=0></A>';                   
				       } 
				   else {
				       $Resultado='';                   
				   }
		return $Resultado; 
			
	  }
	  //////////////
	  
	 ///////////////
  function DameOpciones2($registro,$tabla,$orderby1,$orderby2)
   {
     global $Conexion;
  
	 $rs = mysql_query('SELECT ID,'.$orderby1.','.$orderby2.' FROM '.strtolower($tabla).' ORDER BY '.$orderby1.','.$orderby2,$Conexion);
	 
	  
	 //print 'SELECT ID,'.$orderby1.','.$orderby2.' FROM '.strtolower($tabla).' ORDER BY '.$orderby1.','.$orderby2;
	 
	 //exit();
	  				
  	 $fila = mysql_fetch_row($rs);
				
	 $NumeroRegistros = mysql_num_rows($rs);
	 
	 //print $NumeroRegistros;
	 
	 $resul='';
	 for($i=0;$i<$NumeroRegistros;$i++)  {
	   $resul=$resul.'<option value="'.$fila[0].'" '.DameSeleccionCnf($registro,$fila[0]).'>'.$fila[1].' '.$fila[2].'</option>';
	   
	   $fila = mysql_fetch_row($rs);
	   }
	   
	 mysql_free_result($rs);
	
	return $resul; //'.DameSeleccionCnf($registro,$fila[0]).'
	}
	/////////////
	 
	////////////
  function DameFuncionJavaAlumnos()
   {
     global $Conexion;
	 
	 $sql='SELECT ID,APELLIDO1,NOMBRE FROM alumnos2';
  
	 $rs = mysql_query($sql,$Conexion);
	  				
  	 $fila = mysql_fetch_row($rs);
				
	 $NumeroRegistros = mysql_num_rows($rs);

	 
	 $resultado=$resultado.'function DameAlumnoConId(ID)';
     $resultado=$resultado.'{';
	 $resultado=$resultado.'resultado = "";';
	 $resultado=$resultado.'switch(ID)';
	 $resultado=$resultado.'{'; 	 
	 
	 for($i=0;$i<$NumeroRegistros;$i++)  {
	   $resultado=$resultado.'case "'.$fila[0].'":';
	   $resultado=$resultado.'resultado ="'.$fila[1].' '.$fila[2].'";';
	   $resultado=$resultado.'break;';
	   $fila = mysql_fetch_row($rs);
	   }
	   
	 $resultado=$resultado.'}';
	 $resultado=$resultado.'return resultado;';
	 $resultado=$resultado.'}';
	   
	 mysql_free_result($rs);
	
	return $resultado;
	}
	 
   /////////////
	 
  ////////////
  function DameIdUltimo($tabla)
   {
     global $Conexion;
  
	 $rs = mysql_query('SELECT ID FROM '.strtolower($tabla).' ORDER BY ID DESC',$Conexion);
	 
	  
	 //print 'SELECT ID,'.$orderby1.','.$orderby2.' FROM '.strtolower($tabla).' ORDER BY '.$orderby1.','.$orderby2;
	 
	 //exit();
	  				
  	 $fila = mysql_fetch_row($rs);
				
	 $NumeroRegistros = mysql_num_rows($rs);
	 
	 //print $NumeroRegistros;
	 
	 $resul='';
	 //for($i=0;$i<$NumeroRegistros;$i++)  {
	   $resul=$fila[0];
	   
	   $fila = mysql_fetch_row($rs);
	   
	   
	 mysql_free_result($rs);
	
	return $resul; //'.DameSeleccionCnf($registro,$fila[0]).'
	}
	
	///////////////////////////////////////////////////////////
	
	function AsignarAlumnos($strIdsAlumnos,$IdGrupo)
	 {
	 
	 if($strIdsAlumnos!='')
	  {
	 
	 $Alumnos=explode('#',$strIdsAlumnos);
	 
	 for($i=0;$i<count($Alumnos);$i++)
	   {
	   if($Alumnos[$i]!='') {
	      $str=$str.','.$Alumnos[$i];
		  }
	   }
	   
	   $str=substr($str,1);
	 
				$Update='UPDATE alumnos2 SET IDGRUPO='.$IdGrupo.' WHERE ID IN ('.$str.')'; 
				  
				  //exit();
				    
			      $Res = mysql_query($Update);
				  if (!$Res)
			         {
			         print 'Error tipo Update: '.$Update;
			         exit;
			         }
	 
	 
	  }
	 }
   
    //////////////////////////////////////////////////////////
	function AsignarHorarios($strHorarios,$IdGrupo)
	 {//LM____@12:00@14:00#__XJ__@12:00@14:00#
	 
	 if($strHorarios!='')
	  {
	 
	 $Horarios=explode('#',$strHorarios);
	 
	 for($i=0;$i<count($Horarios);$i++)  {
	        if($Horarios[$i]!='') {
			$Horarios2=explode('@',$Horarios[$i]);
	   		$Dias=$Horarios2[0];
			$Hora1=$Horarios2[1];
			$Hora2=$Horarios2[2];
			//////////////////// INSERTAMOS NUEVO //////////////////
				  $Insert='INSERT INTO horarios2(HORA_INICIO,HORA_FIN,DIAS,IDGRUPO)';  
			      $Insert=$Insert.' VALUES("'.$Hora1.'","'.$Hora2.'","'.$Dias.'",'.$IdGrupo.')';
				  //$Insert=$Insert.'"'.$_POST['txtPrecio'].'","'.$_POST['txtPrecioInformado'].'","'.$_POST['txtIdProfesor'].'","'.$_POST['txtObjetivos'].',"'.$_POST['txtSeguimiento'].',"'.$_POST['txtIdInformadoPor'].'","'.$_POST['txtPersonaInformadora'].'","'.$_POST['txtInformadoCancelacion'].'","'.$_POST['txtInformadoPago'].',"'.$_POST['txtInformadoClub'].'","'.$_POST['txtIdHorarioPreferencia'].'","'.$_POST['txtPreferenciaHM'].'","'.$_POST['txtPreferenciaIB'].'","'.$_POST['txtDesaFactura'].'","'.$_POST['txtDeseaNota'].'","'.$_POST['txtNiños'].'")';
				  $Res = mysql_query($Insert);
				  if (!$Res)
			         {
			         print 'Error tipo Insert: '.$Insert;
			         exit;
			         }
	        }// if($Horarios[$i]!='') {
	   }
	   
	  }
	 }
	 ////////////////////////////////////////
	 
	 ////////////////////////////////////////
	 function DameHorarioDeGrupo($IdGrupo)
	   {
	   global $Conexion;
  
	 $rs = mysql_query('SELECT * FROM horarios2 WHERE IDGRUPO='.$IdGrupo,$Conexion);
	 
	  
	 //print 'SELECT ID,'.$orderby1.','.$orderby2.' FROM '.strtolower($tabla).' ORDER BY '.$orderby1.','.$orderby2;
	 
	 //exit();
	  				
  	 $fila = mysql_fetch_row($rs);
				
	 $NumeroRegistros = mysql_num_rows($rs);
	 
	 //print $NumeroRegistros;
	 
	 $resul='';
	 for($i=0;$i<$NumeroRegistros;$i++)  {
	   $resul=$resul.$fila[3].' '.$fila[1].' '.$fila[2].chr(10);
	   
	   $fila = mysql_fetch_row($rs);
	   }
	   
	   mysql_free_result($rs);
	
	   return $resul; //'.DameSeleccionCnf($registro,$fila[0]).'

	   
	   
	   }
	   
	   function DameHorarioDeGrupo2($IdGrupo)
	   {
	   global $Conexion;
  
	 $rs = mysql_query('SELECT * FROM horarios2 WHERE IDGRUPO='.$IdGrupo,$Conexion);
	 
	  
	 //print 'SELECT ID,'.$orderby1.','.$orderby2.' FROM '.strtolower($tabla).' ORDER BY '.$orderby1.','.$orderby2;
	 
	 //exit();
	  				
  	 $fila = mysql_fetch_row($rs);
				
	 $NumeroRegistros = mysql_num_rows($rs);
	 
	 //print $NumeroRegistros;
	 
	 $resul='';
	 for($i=0;$i<$NumeroRegistros;$i++)  {
	   $resul=$resul.$fila[3].'@'.$fila[1].'@'.$fila[2].'#';
	   
	   $fila = mysql_fetch_row($rs);
	   }
	   
	   mysql_free_result($rs);
	
	   return $resul; //'.DameSeleccionCnf($registro,$fila[0]).'

	   
	   
	   }
	   
	   
	 /////////////////////////////////////
	 
	 function DameAlumnosDeGrupo($IdGrupo)
	   {
	   global $Conexion;
  
	 $rs = mysql_query('SELECT NOMBRE,APELLIDO1 FROM alumnos2 WHERE IDGRUPO='.$IdGrupo,$Conexion);
	 
	  
	 //print 'SELECT ID,'.$orderby1.','.$orderby2.' FROM '.strtolower($tabla).' ORDER BY '.$orderby1.','.$orderby2;
	 
	 //exit();
	  				
  	 $fila = mysql_fetch_row($rs);
				
	 $NumeroRegistros = mysql_num_rows($rs);
	 
	 //print $NumeroRegistros;
	 
	 $resul='';
	 for($i=0;$i<$NumeroRegistros;$i++)  {//2 apel1 3 apel2 4 nombre
	   $resul=$resul.$fila[1].' '.$fila[0].chr(10);
	   
	   $fila = mysql_fetch_row($rs);
	   }
	   
	   mysql_free_result($rs);
	
	   return $resul; //'.DameSeleccionCnf($registro,$fila[0]).'

	   
	   
	   }
	   
	   //////////////////////////////////////
	   
	   function DameAlumnosDeGrupo2($IdGrupo)
	   {
	   global $Conexion;
  
	 $rs = mysql_query('SELECT ID FROM alumnos2 WHERE IDGRUPO='.$IdGrupo,$Conexion);
	 
	  
	 //print 'SELECT ID,'.$orderby1.','.$orderby2.' FROM '.strtolower($tabla).' ORDER BY '.$orderby1.','.$orderby2;
	 
	 //exit();
	  				
  	 $fila = mysql_fetch_row($rs);
				
	 $NumeroRegistros = mysql_num_rows($rs);
	 
	 //print $NumeroRegistros;
	 
	 $resul='';
	 for($i=0;$i<$NumeroRegistros;$i++)  {//2 apel1 3 apel2 4 nombre
	   $resul=$resul.$fila[0].'#';
	   
	   $fila = mysql_fetch_row($rs);
	   }
	   
	   mysql_free_result($rs);
	
	   return $resul; //'.DameSeleccionCnf($registro,$fila[0]).'

	   
	   
	   }
	   
	   //////////////////////////////////////////
	   
	   /*
	   
	   EliminarHorarioDeGrupo($strIdSel);
				  
		EliminarAlumnosDeGrupo($strIdSel);
	   */
	   
	   /////////////////////////////////////////
	   function EliminarHorarioDeGrupo($IdGrupo)
	     {
		 
				  $Delete='DELETE FROM horarios2 WHERE IDGRUPO='.$IdGrupo;  
			      //$Insert=$Insert.' VALUES('.$_POST['txtDistrito'].',"'.$_POST['txtPromotor'].'","'.$_POST['txtTipoObra'].'",'.$_POST['txtLicencia'].',"'.$_POST['txtDireccion'].'","'.$_POST['txtFinPrevisto'].'","'.$_POST['txtComprobacion'].'","'.$_POST['txtUltimaInspeccion'].'","'.$_POST['txtFinFax'].'","'.$_POST['txtProrroga'].'","'.$_POST['txtComentario'].'","'.$_POST['txtJustificacion'].'") ';
				  $Res = mysql_query($Delete);
				  if (!$Res)
			         {
			         print 'Error tipo Delete: (EliminarHorarioDeGrupo) '.$Delete;
			         exit;
			         }
		 
		 
		 
		 
		 }
		   
	  	/////////////////////////////////////////
		function EliminarAlumnosDeGrupo($IdGrupo)
	     {
		 
		 
				  $Delete='UPDATE alumnos2 SET IDGRUPO = NULL WHERE IDGRUPO='.$IdGrupo;  
			      //$Insert=$Insert.' VALUES('.$_POST['txtDistrito'].',"'.$_POST['txtPromotor'].'","'.$_POST['txtTipoObra'].'",'.$_POST['txtLicencia'].',"'.$_POST['txtDireccion'].'","'.$_POST['txtFinPrevisto'].'","'.$_POST['txtComprobacion'].'","'.$_POST['txtUltimaInspeccion'].'","'.$_POST['txtFinFax'].'","'.$_POST['txtProrroga'].'","'.$_POST['txtComentario'].'","'.$_POST['txtJustificacion'].'") ';
				  $Res = mysql_query($Delete);
				  if (!$Res)
			         {
			         print 'Error tipo Delete: (EliminarAlumnosDeGrupo) '.$Delete;
			         exit;
			         }
		 
		 
		 
		 }
		
		///////////////////////////////////////////////////// 
	function AltaNuevaEmpresa($strEmpresa)
	 {
	 
			//////////////////// INSERTAMOS NUEVO //////////////////
				  $Insert='INSERT INTO empresas2(RAZON_SOLCIAL)';  
			      $Insert=$Insert.' VALUES("'.$strEmpresa.'")';
				  //$Insert=$Insert.'"'.$_POST['txtPrecio'].'","'.$_POST['txtPrecioInformado'].'","'.$_POST['txtIdProfesor'].'","'.$_POST['txtObjetivos'].',"'.$_POST['txtSeguimiento'].',"'.$_POST['txtIdInformadoPor'].'","'.$_POST['txtPersonaInformadora'].'","'.$_POST['txtInformadoCancelacion'].'","'.$_POST['txtInformadoPago'].',"'.$_POST['txtInformadoClub'].'","'.$_POST['txtIdHorarioPreferencia'].'","'.$_POST['txtPreferenciaHM'].'","'.$_POST['txtPreferenciaIB'].'","'.$_POST['txtDesaFactura'].'","'.$_POST['txtDeseaNota'].'","'.$_POST['txtNiños'].'")';
				  $Res = mysql_query($Insert);
				  if (!$Res)
			         {
			         print 'Error tipo Insert: '.$Insert;
			         exit;
			         }
	       
	   return DameIdUltimo('empresas2');
	   }
		
	/////////////////////////////////////////////////////////
	function DameDiaSemana($int)
	 {
	 switch($Id)
	 {
	 case 0:
	  $Resultado='Lunes';
	  break;
	 case 1: 
	  $Resultado='Martes';
	  break;
	 case 2:
	  $Resultado='Miercoles';
	  break;
	 case 3: 
	  $Resultado='Jueves';
	  break;
	 case 4:
	  $Resultado='Viernes';
	  break;
	 case 5: 
	  $Resultado='Sabado';
	  break;
	  }
	  
	  return $Resultado; 
   }
   
   
   //////////////////////////////////////
	   /*
	   function DamePrecios($Id)
	   {
	   global $Conexion;
  
	   $rs = mysql_query('SELECT ID FROM alumnos2 WHERE IDGRUPO='.$IdGrupo,$Conexion);
	 
	   $resultado=$resultado.'<tr>';
	   $resultado=$resultado.'<td width="30%" align="right">Precio:&nbsp;</td>';
	   $resultado=$resultado.'<td><input name="txtPrecio" id="txtPrecio" type="text"/>';
       $resultado=$resultado.'&nbsp;&nbsp;&nbsp;Horas:&nbsp;';
	   $resultado=$resultado.'<input name="txtHoras" id="txtHoras" type="text" /></td>';
	   $resultado=$resultado.'</tr>';
	    
	
	  				
  	 $fila = mysql_fetch_row($rs);
				
	 $NumeroRegistros = mysql_num_rows($rs);
	 
	 $resultado='';
	 for($i=0;$i<$NumeroRegistros;$i++)  {
	   $resultado=$resultado.'<tr>';
	   $resultado=$resultado.'<td width="30%" align="right">Precio'.$i.':&nbsp;</td>';
	   $resultado=$resultado.'<td><input name="txtPrecio'.$i.'" id="txtPrecio'.$i.'" type="text"/>';
       $resultado=$resultado.'&nbsp;&nbsp;&nbsp;Horas'.$i.':&nbsp;';
	   $resultado=$resultado.'<input name="txtHoras'.$i.'" id="txtHoras'.$i.'" type="text" /></td>';
	   $resultado=$resultado.'</tr>';
	   
	   $fila = mysql_fetch_row($rs);
	   }
	   
	   mysql_free_result($rs);
	
	   return $resultado; 

	   }
	   */
	   //////////////////////////////////////////
	   
	   function DamePreciosDeRecibo2($IdRecibo)
	   {
	   global $Conexion;
  
	   $rs = mysql_query('SELECT * FROM recibos_precios2 WHERE IDRECIBO='.$IdRecibo,$Conexion);
	  			
	   //print 'SELECT * FROM recibos_precios2 WHERE IDRECIBO='.$IdRecibo;	
					
  	   $fila = mysql_fetch_row($rs);
				
	   $NumeroRegistros = mysql_num_rows($rs);
	 
	   $resul='';
	   for($i=0;$i<$NumeroRegistros;$i++)  {
	      $resul=$resul.$fila[3].' horas '.$fila[2].' €'.chr(10);
	      $fila = mysql_fetch_row($rs);
	      }
	   
	   mysql_free_result($rs);
	
	   return $resul; 
	   }
	   
	   
	   
	  ////////////////////////////////////////////////////// 
	    function DamePreciosDeRecibo3($IdRecibo)
	   {
	   global $Conexion;
  
	   $rs = mysql_query('SELECT * FROM recibos_precios2 WHERE IDRECIBO='.$IdRecibo,$Conexion);
	  			
	   //print 'SELECT * FROM recibos_precios2 WHERE IDRECIBO='.$IdRecibo;	
					
  	   $fila = mysql_fetch_row($rs);
				
	   $NumeroRegistros = mysql_num_rows($rs);
	 
	   $resul='';
	   for($i=0;$i<$NumeroRegistros;$i++)  {
	      $resul=$resul.$fila[3].'@'.$fila[2].'#';
	      $fila = mysql_fetch_row($rs);
	      }
	   
	   mysql_free_result($rs);
	
	   return $resul; 
	   }
	 /////////////////////////////////////
	 
	 
	 	
	 ////////////////////////////////////
	function AltaPreciosRecibos($strPrecios,$IdRecibo)
	 {
	 $Precios=explode('#',$strPrecios);
	 //print 'Alat de '.$strPrecios.' ';
	 
	 
	 for($i=0;$i<count($Precios);$i++)  {
	        //print $Precios[$i].' ';
	        if($Precios[$i]!='') {
			$Precios2=explode('@',$Precios[$i]);
	   		$Horas=$Precios2[0];
			$Precio=$Precios2[1];
			//////////////////// INSERTAMOS NUEVO //////////////////
				  $Insert='INSERT INTO recibos_precios2(IDRECIBO,PRECIO,HORAS)';  
			      $Insert=$Insert.' VALUES('.$IdRecibo.','.$Precio.','.$Horas.')';
				  //$Insert=$Insert.'"'.$_POST['txtPrecio'].'","'.$_POST['txtPrecioInformado'].'","'.$_POST['txtIdProfesor'].'","'.$_POST['txtObjetivos'].',"'.$_POST['txtSeguimiento'].',"'.$_POST['txtIdInformadoPor'].'","'.$_POST['txtPersonaInformadora'].'","'.$_POST['txtInformadoCancelacion'].'","'.$_POST['txtInformadoPago'].',"'.$_POST['txtInformadoClub'].'","'.$_POST['txtIdHorarioPreferencia'].'","'.$_POST['txtPreferenciaHM'].'","'.$_POST['txtPreferenciaIB'].'","'.$_POST['txtDesaFactura'].'","'.$_POST['txtDeseaNota'].'","'.$_POST['txtNiños'].'")';
				  $Res = mysql_query($Insert);
				  if (!$Res)
			         {
			         print 'Error tipo Insert: '.$Insert;
			         exit;
			         }
	        }// if($Horarios[$i]!='') {
	   }
	 
	 
	 
	 }
    ///////////////////////////////////////// 
	
	/////////////////////////////////////////
	   function EliminarPrecios($IdRecibo)
	     {
		 
				  $Delete='DELETE FROM recibos_precios2 WHERE IDRECIBO='.$IdRecibo;  
			      //$Insert=$Insert.' VALUES('.$_POST['txtDistrito'].',"'.$_POST['txtPromotor'].'","'.$_POST['txtTipoObra'].'",'.$_POST['txtLicencia'].',"'.$_POST['txtDireccion'].'","'.$_POST['txtFinPrevisto'].'","'.$_POST['txtComprobacion'].'","'.$_POST['txtUltimaInspeccion'].'","'.$_POST['txtFinFax'].'","'.$_POST['txtProrroga'].'","'.$_POST['txtComentario'].'","'.$_POST['txtJustificacion'].'") ';
				  //print $Delete;
				  
				  $Res = mysql_query($Delete);
				  if (!$Res)
			         {
			         print 'Error tipo Delete: (EliminarPrecios) '.$Delete;
			         exit;
			         }
		 
		 
		 
		 
		 }
		   
	  	/////////////////////////////////////////
		
		function DameGrupo($IdGrupo)
	   {
	   global $Conexion;
       if($IdGrupo!='') {
	 $rs = mysql_query('SELECT NOMBRE_GRUPO FROM grupos2 WHERE ID='.$IdGrupo,$Conexion);
	 
	  //print 'SELECT NOMBRE_GRUPO FROM grupos2 WHERE ID='.$IdGrupo;
	 //print 'SELECT ID,'.$orderby1.','.$orderby2.' FROM '.strtolower($tabla).' ORDER BY '.$orderby1.','.$orderby2;
	 
	 //exit();
	  				
  	 $fila = mysql_fetch_row($rs);
				
	 $NumeroRegistros = mysql_num_rows($rs);
	 
	 //print $NumeroRegistros;
	 
	 $resul='';
	 if($NumeroRegistros==0) {
	  $resul='';
	 } 
	 else {
	  $resul=$fila[0];
	 }   
	 
	   
	   mysql_free_result($rs);
	
	   return $resul; //'.DameSeleccionCnf($registro,$fila[0]).'

	   }
	   
	   }
	   
	   
	 /////////////////////////////////////
	 
	 function DameCliente($IdCliente)
	   {
	   global $Conexion;
       if($IdCliente!='') {
	 $rs = mysql_query('SELECT APELLIDO1,NOMBRE FROM clientes2 WHERE ID='.$IdCliente,$Conexion);
	 
	  //print 'SELECT NOMBRE_GRUPO FROM grupos2 WHERE ID='.$IdGrupo;
	 //print 'SELECT ID,'.$orderby1.','.$orderby2.' FROM '.strtolower($tabla).' ORDER BY '.$orderby1.','.$orderby2;
	 
	 //exit();
	  				
  	 $fila = mysql_fetch_row($rs);
				
	 $NumeroRegistros = mysql_num_rows($rs);
	 
	 //print $NumeroRegistros;
	 
	 $resul='';
	 if($NumeroRegistros==0) {
	  $resul='';
	 } 
	 else {
	  $resul=$fila[1].''.$fila[0];
	 }   
	 
	   
	   mysql_free_result($rs);
	
	   return $resul; //'.DameSeleccionCnf($registro,$fila[0]).'

	   }
	   
	   }
	   
	   
	 /////////////////////////////////////
		function GuardarBoletin($RutaBoletin,$RutaBoletinAnterior1,$RutaBoletinAnterior2,$RutaBoletinAnterior3)
	     {
		 global $Conexion;
		 
				  $Delete='UPDATE boletines2 SET RUTA_BOLETIN="'.$RutaBoletin.'",RUTA_BOLETIN_ANTERIOR_1="'.$RutaBoletinAnterior1.'",RUTA_BOLETIN_ANTERIOR_2="'.$RutaBoletinAnterior2.'",RUTA_BOLETIN_ANTERIOR_3="'.$RutaBoletinAnterior3.'"  WHERE ID=1';  
			      //$Insert=$Insert.' VALUES('.$_POST['txtDistrito'].',"'.$_POST['txtPromotor'].'","'.$_POST['txtTipoObra'].'",'.$_POST['txtLicencia'].',"'.$_POST['txtDireccion'].'","'.$_POST['txtFinPrevisto'].'","'.$_POST['txtComprobacion'].'","'.$_POST['txtUltimaInspeccion'].'","'.$_POST['txtFinFax'].'","'.$_POST['txtProrroga'].'","'.$_POST['txtComentario'].'","'.$_POST['txtJustificacion'].'") ';
				  $Res = mysql_query($Delete,$Conexion);
				  if (!$Res)
			         {
			         print 'Error tipo Update: (GuardarBoletin) '.$Delete;
			         exit;
			         }
		 
		 
		 
		 }
		 
		 ////////////////////////////////////
		 function DameRutaBoletin($NumeroCampo)
	   {
	   global $Conexion;
      
	  $sql='SELECT * FROM boletines2 WHERE ID=1';
	  
	  //print $sql;
	  
	  $rs = mysql_query($sql,$Conexion);
	 
	  //print 'SELECT NOMBRE_GRUPO FROM grupos2 WHERE ID='.$IdGrupo;
	 //print 'SELECT ID,'.$orderby1.','.$orderby2.' FROM '.strtolower($tabla).' ORDER BY '.$orderby1.','.$orderby2;
	 
	 //exit();
	  				
  	 $fila = mysql_fetch_row($rs);
				
	 $NumeroRegistros = mysql_num_rows($rs);
	 
	 //print $NumeroRegistros;
	 
	 $resul='';
	 if($NumeroRegistros==0) {
	  $resul='';
	 } 
	 else {
	  $resul=$fila[$NumeroCampo];
	 }   
	 
	   
	   mysql_free_result($rs);
	
	   return $resul; //'.DameSeleccionCnf($registro,$fila[0]).'

	
	   
	   }
	  
	  ////////////////////////////////////////////////////
	  function GuardarBoletinFechas($FechaBoletinAnterior1,$FechaBoletinAnterior2,$FechaBoletinAnterior3)
	     {
		 global $Conexion;
		 
				  $Delete='UPDATE boletines2 SET NOMBRE_BOLETIN_ANTERIOR_1="'.$FechaBoletinAnterior1.'",NOMBRE_BOLETIN_ANTERIOR_2="'.$FechaBoletinAnterior2.'",NOMBRE_BOLETIN_ANTERIOR_3="'.$FechaBoletinAnterior3.'"  WHERE ID=1';  
			      //$Insert=$Insert.' VALUES('.$_POST['txtDistrito'].',"'.$_POST['txtPromotor'].'","'.$_POST['txtTipoObra'].'",'.$_POST['txtLicencia'].',"'.$_POST['txtDireccion'].'","'.$_POST['txtFinPrevisto'].'","'.$_POST['txtComprobacion'].'","'.$_POST['txtUltimaInspeccion'].'","'.$_POST['txtFinFax'].'","'.$_POST['txtProrroga'].'","'.$_POST['txtComentario'].'","'.$_POST['txtJustificacion'].'") ';
				  $Res = mysql_query($Delete,$Conexion);
				  if (!$Res)
			         {
			         print 'Error tipo Update: (GuardarBoletin) '.$Delete;
			         exit;
			         }
		 
		 
		 
		 } 
		 
		 //////////////////////////////////////7
		function Conectar()
		{ 
		 global $Conexion; 
  
  		$user = DameUsuario();
  		$pass = DameContrasenia();
  		$host = DameHost();
  		$db_name = DameBaseDeDatos(); //panel_de_control
 	
  		$Conexion = mysql_connect($host,$user,$pass);
  
  		$int = mysql_select_db($db_name); 
		 }
		 
		/////////////////////////////// 
  function DameFechaActual()
     {
	 $Tabla=array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');

	 
	 $Año=date('y');
     $Dia=date('d');
     $Mes=date('m');
	 
	 
	 /*
	 if(strlen($Año)<4)
      $strFechaActual=$Dia.'/'.$Tabla[$Mes-1].'/20'.$Año;
    else
      
	  $strFechaActual=$Dia.' de '.$Tabla[$Mes-1].' del '.$Año;
	 */
	 
	 $strFechaActual=$Dia.'/'.$Tabla[$Mes-1].'/20'.$Año;
	 
	 return $strFechaActual;
	 }
	 
	 
	 /////////////////////////////////////////////////
	  /////////////////////////////////////
	 
	 function DameIdUsuario($Login)
	   {
	   global $Conexion;
       if($Login!='') {
	   
	 $sql='SELECT ID FROM usuarios2 WHERE user_id ="'.$Login.'"';
	   
	 $rs = mysql_query($sql,$Conexion);
	 
	  //print 'SELECT NOMBRE_GRUPO FROM grupos2 WHERE ID='.$IdGrupo;
	 //print 'SELECT ID,'.$orderby1.','.$orderby2.' FROM '.strtolower($tabla).' ORDER BY '.$orderby1.','.$orderby2;
	 
	 //print $sql;
	 //exit();
	  				
  	 $fila = mysql_fetch_row($rs);
				
	 $NumeroRegistros = mysql_num_rows($rs);
	 
	 //print $NumeroRegistros;
	 
	 $resul='';
	 if($NumeroRegistros==0) {
	  $resul='';
	 } 
	 else {
	  $resul=$fila[0];
	 }   
	 
	   
	   mysql_free_result($rs);
	
	   return $resul; //'.DameSeleccionCnf($registro,$fila[0]).'

	   }
	   
	   }
	   
	 /////////////////////////////////////
	 ///////////////////////////////////////////////////
	   function Importacion()
	    {
		
		global $Conexion;
		
		//Borramos todo 
		$sql_borrado='DELETE FROM userGroup,groups';
		
		//Guardamos relacion de grupos y profesores
		$sql_relacion='SELECT grupos2.IDPROFESOR,grupos2.IDCLIENTE,grupos2.FECHA_INICIO,grupos2.FECHA_FIN ';
		$sql_relacion=$sql_relacion.'INTO userGroup(user_id,group_id,start,end) ';
		$sql_relacion=$sql_relacion.'FROM grupos2 ';
		$sql_relacion=$sql_relacion.'WHERE grupos2.IMPORTADO=0';
		
		
		//Introducimos los clientes en la tabla groups
		$sql_grupos1='SELECT CONCAT(clientes2.APELLIDO1," ",clientes2.NOMBRE," (",grupos2.NOMBRE_GRUPO,")") AS NAME,grupos2.FECHA_INICIO,grupos2.FECHA_FIN ';
		$sql_grupos1=$sql_grupos1.'INTO groups(name,start,end) ';
		$sql_grupos1=$sql_grupos1.'FROM grupos2,clientes2 ';
        $sql_grupos1=$sql_grupos1.'WHERE grupos2.IMPORTADO=0 ';
        $sql_grupos1=$sql_grupos1.'AND grupos2.IDCLIENTE=clientes2.ID ';
		$sql_grupos1=$sql_grupos1.'AND clientes2.ES_EMPRESA=0';
		
		//Introducimos los clientes en la tabla groups (empresas)
		$sql_grupos2='SELECT CONCAT(empresas2.RAZON_SOCIAL," (",grupos2.NOMBRE_GRUPO,")") AS NAME,grupos2.FECHA_INICIO,grupos2.FECHA_FIN ';
		$sql_grupos2=$sql_grupos2.'INTO groups(NAME,START,END) ';
		$sql_grupos2=$sql_grupos2.'FROM grupos2,clientes2,empresas2 ';
        $sql_grupos2=$sql_grupos2.'WHERE grupos2.IMPORTADO=0 ';
        $sql_grupos2=$sql_grupos2.'AND grupos2.IDCLIENTE=clientes2.ID ';
		$sql_grupos2=$sql_grupos2.'AND clientes2.ES_EMPRESA=1 ';
		$sql_grupos2=$sql_grupos2.'AND empresas2.ID=clientes2.IDEMPRESA';
		
		//Actualizamos campo
		$sql_update='UPDATE grupos2 SET IMPORTADO=1';		 
				  
				  
				  /////////////////
				  $Res = mysql_query($sql_borrado,$Conexion);
				  if (!$Res)
			         {
			         print 'Error tipo Importacion()'.$sql_borrado;
			         exit;
			         }
				  ////////////////	 
				  $Res = mysql_query($sql_relacion,$Conexion);
				  if (!$Res)
			         {
			         print 'Error tipo Importacion() '.$sql_relacion;
			         exit;
			         }
				  /////////////////////
				  $Res = mysql_query($sql_grupos1,$Conexion);
				  if (!$Res)
			         {
			         print 'Error tipo Importacion() '.$sql_grupos1;
			         exit;
			         }
				  ///////////////////////
				  $Res = mysql_query($sql_grupos2,$Conexion);
				  if (!$Res)
			         {
			         print 'Error tipo Importacion() '.$sql_grupos2;
			         exit;
			         }
				  ////////////////////////
				  $Res = mysql_query($sql_update,$Conexion);
				  if (!$Res)
			         {
			         print 'Error tipo Importacion() '.$sql_update;
			         exit;
			         }	 	 	 	 
		

		}
	   
?>