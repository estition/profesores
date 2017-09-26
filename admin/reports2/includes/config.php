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
  return 'Gestión Canterbury 1.0';
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
  function DameOpciones($registro,$tabla,$orderby)
   {
     global $Conexion;
  
	 $rs = mysql_query('SELECT * FROM PROVINCIAS',$Conexion);
	  
  	 $fila = mysql_fetch_row($rs);
				
	 $NumeroRegistros = mysql_num_rows($rs);
	
	 for($i=0;$i<$NumeroRegistros;$i++)
	   {
	   $str=$str.'<option value="'.$fila[0].'" '.DameSeleccionCnf($registro,$fila[0]).'>'.$fila[1].'</option>';
	   
	   $fila = mysql_fetch_row($rs);
	   }
	   
	 mysql_free_result($rs);
	
	return $str;
	}
	 
	 /////////////
	 
	 ////////////
  function DameOpcionesHorariosAsignados($IdAlumno)
   {
     global $Conexion;
  
	 $rs = mysql_query('SELECT HORARIOS.* FROM HORARIOS,HORARIOS_ALUMNOS WHERE HORARIOS.ID=HORARIOS_ALUMNOS.IDHORARIO AND HORARIOS_ALUMNOS.IDALUMNO='.$IdAlumno,$Conexion);
	  				
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
?>