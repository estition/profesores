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
	 
	 ///////////////////////////////////////////////////
	   function Importacion()
	    {
		
		global $Conexion;
		
		//Borramos todo 
		$sql_borrado1='DELETE FROM userGroup';
		$sql_borrado2='DELETE FROM groups';
		
		//Guardamos relacion de grupos y profesores
		$sql_relacion=$sql_relacion.'INSERT INTO userGroup(user_id,group_id,start,end) ';
		$sql_relacion='SELECT grupos2.IDPROFESOR,grupos2.IDCLIENTE,grupos2.FECHA_INICIO,grupos2.FECHA_FIN ';
		$sql_relacion=$sql_relacion.'FROM grupos2 ';
		$sql_relacion=$sql_relacion.'WHERE grupos2.IMPORTADO=0';
		
		
		//Introducimos los clientes en la tabla groups
		$sql_grupos1=$sql_grupos1.'INSERT INTO groups(name,start,end) ';
		$sql_grupos1='SELECT CONCAT(clientes2.APELLIDO1," ",clientes2.NOMBRE," (",grupos2.NOMBRE_GRUPO,")") AS NAME,grupos2.FECHA_INICIO,grupos2.FECHA_FIN ';
		$sql_grupos1=$sql_grupos1.'FROM grupos2,clientes2 ';
        $sql_grupos1=$sql_grupos1.'WHERE grupos2.IMPORTADO=0 ';
        $sql_grupos1=$sql_grupos1.'AND grupos2.IDCLIENTE=clientes2.ID ';
		$sql_grupos1=$sql_grupos1.'AND clientes2.ES_EMPRESA=0';
		
		//Introducimos los clientes en la tabla groups (empresas)
		$sql_grupos2=$sql_grupos2.'INSERT INTO groups(NAME,START,END) ';
		$sql_grupos2='SELECT CONCAT(empresas2.RAZON_SOCIAL," (",grupos2.NOMBRE_GRUPO,")") AS NAME,grupos2.FECHA_INICIO,grupos2.FECHA_FIN ';
		$sql_grupos2=$sql_grupos2.'FROM grupos2,clientes2,empresas2 ';
        $sql_grupos2=$sql_grupos2.'WHERE grupos2.IMPORTADO=0 ';
        $sql_grupos2=$sql_grupos2.'AND grupos2.IDCLIENTE=clientes2.ID ';
		$sql_grupos2=$sql_grupos2.'AND clientes2.ES_EMPRESA=1 ';
		$sql_grupos2=$sql_grupos2.'AND empresas2.ID=clientes2.IDEMPRESA';
		
		//Actualizamos campo
		$sql_update='UPDATE grupos2 SET IMPORTADO=1';		 
				  
				  
				  /////////////////
				  $Res = mysql_query($sql_borrado1,$Conexion);
				  if (!$Res)
			         {
			         print 'Error tipo Importacion()'.$sql_borrado1;
			         exit;
			         }
					 
				   /////////////////
				  $Res = mysql_query($sql_borrado2,$Conexion);
				  if (!$Res)
			         {
			         print 'Error tipo Importacion()'.$sql_borrado2;
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
?>