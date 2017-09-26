<?php //include('config.php'); 
////////////////////////////////////////////////////////////////////////	 
 function EnviarCorreo2($Destino,$Asunto,$Cuerpo,$NombreFichero,&$Error,$From,$FromName,$mail)	
  {	
	//print '==========';
	
	 //mail('javier.buira@sgs.com','Prueba','Hola #############');
	// primero hay que incluir la clase phpmailer para poder instanciar
  //un objeto de la misma
  

  //Definimos las propiedades y llamamos a los métodos 
  //correspondientes del objeto mail

  //Con PluginDir le indicamos a la clase phpmailer donde se 
  //encuentra la clase smtp que como he comentado al principio de 
  //este ejemplo va a estar en el subdirectorio includes
  $mail->PluginDir = 'phpmailer_lib/';

  //Con la propiedad Mailer le indicamos que vamos a usar un 
  //servidor smtp
  $mail->Mailer = 'smtp';

  //Asignamos a Host el nombre de nuestro servidor smtp
  $mail->Host = 'smtp.solucionesjbt.com';

  //Le indicamos que el servidor smtp requiere autenticación
  $mail->SMTPAuth = true;

  //Le decimos cual es nuestro nombre de usuario y password
  //$mail->Username = 'seguimientoobras@solucionesjbt.com'; 
  //$mail->Password = 'seguimientoobras';
  
   $mail->Username = 'rafael@canterburyenglish.com'; 
  $mail->Password = 'hijo72';

  //Indicamos cual es nuestra dirección de correo y el nombre que 
  //queremos que vea el usuario que lee nuestro correo
  $mail->From = $From; //'seguimientoobras@munimadrid.es';
  //$mail->ReplyTo = 'javier.buira@canterburyenglish.com';
  $mail->FromName = $FromName; //'Seguimiento Obras';

  //el valor por defecto 10 de Timeout es un poco escaso dado que voy a usar 
  //una cuenta gratuita, por tanto lo pongo a 30  
  $mail->Timeout=30;

  //Indicamos cual es la dirección de destino del correo
  $mail->AddAddress($Destino); //"javier.buira@sgs.com"

  //Asignamos asunto y cuerpo del mensaje
  //El cuerpo del mensaje lo ponemos en formato html, haciendo 
  //que se vea en negrita
  $mail->Subject = $Asunto;
  $mail->Body = $Cuerpo;

  //Definimos AltBody por si el destinatario del correo no admite email con formato html 
  $mail->AltBody = $Cuerpo;
  
  $mail->AddAttachment($NombreFichero,$NombreFichero);
  //se envia el mensaje, si no ha habido problemas 
  //la variable $exito tendra el valor true
  $exito = $mail->Send();
   
  //Si el mensaje no ha podido ser enviado se realizaran 4 intentos mas como mucho 
  //para intentar enviar el mensaje, cada intento se hara 5 segundos despues 
  //del anterior, para ello se usa la funcion sleep	
  $intentos=1; 
  //while ((!$exito) && ($intentos < 5)) {
	//sleep(5);
     	//echo $mail->ErrorInfo;
     	//$exito = $mail->Send();
  $intentos=$intentos+1;	
	
   //}
 
		
   if(!$exito)
   {
	//echo 'Problemas enviando correo electrónico a '.$Destino;
	$Error=$mail->ErrorInfo;
	return false;	
   }
   else
   {
	//echo "Mensaje enviado correctamente";
   $Error='';
   return true;
   } 
 }
 
 //////////////////////////////////////////////7
 
 function DameTipo($Tipo)
   {
   /*
   Logging incorrect">0</option>
    <option value="Forget Pass Word">1</option>
    <option value="No clients">2</option>
    <option value="Others">3
   */
   
   switch ($Tipo) {
    case 0:
        return "Logging incorrect";
        break;
    case 1:
        return "Forget Pass Word";
        break;
    case 2:
        return "No clients";
        break;
	case 3:
        return "Others";
        break;	
	}
   
   
   
   }
 ?>
 <html>
	<head>
	<link href="css/canterbury.css" type="text/css" rel="stylesheet">
	<title>Canterbury Hours</title>
	</head>
	<body>
      <table width="63%" border="0" cellpadding="10" cellspacing="0" id="body">
        <tr> 
          <td width="100%" valign="top"><b><font color='#ff9900'><?php echo  $message ?></font></b>
<form action="alta_incidencia.php" name="alta_incidencia" id="alta_incidencia" method="post">
              <table border="0" cellpadding="1" cellspacing="0" bgcolor="#738FE6" id="border">
                <tr> 
                  <td><table border="0" cellpadding="5" cellspacing="0" id="shell">
                      <tr valign="top"> 
                        <td width="501" bgcolor="#0033CC"><b><font class="textW">Technical Incidents</font></b></td>
                      </tr>
                      <tr valign="top"> 
                        <td bgcolor="#B6C5F2">Enter technical incidents</td>
                      </tr>
                      <tr valign="top"> 
                        <td bgcolor="#FFFFFF"> <table width="490" border="0" cellpadding="5" cellspacing="0" id="login">
                            <tr> 
                              <td width="82" valign="top"><b>User Name (first last1):</b></td>
                              <td width="291"> 
							  <input type="text" name="txtNombre" id="txtNombre" size="60">
                              </td>
                            </tr>
							<tr> 
                              <td width="82" valign="top"><b>Mail:</b></td>
                              <td width="291"> 
							  <input type="text" name="txtMail" id="txtMail" size="60">
                              </td>
                            </tr>
                            <tr> 
                              <td width="82" valign="top"><b>Type:</b></td>
                              <td width="291"> 
							  <select name="txtTipo" id="txtTipo">
    <option value="0">Logging incorrect</option>
    <option value="1">Forget Pass Word</option>
    <option value="2">No clients</option>
    <option value="3">Others</option>
  </select> 
                              </td>
                            </tr>
                            <tr> 
                              <td valign="top"><b>Description / Clients* :</b></td>
                              <td><textarea name="txtDescripcion" cols="50" rows="4" type="txtDescripcion"></textarea> 
                                <i></i></td>
                            </tr>
                            <tr> 
                              <td valign="top"><b></b></td>
                              <td>* Please if type no clients put the list clients 
                                <i></i></td>
                            </tr> 
                            
                          </table></td>
                      </tr>
                      <tr valign="top" bgcolor="#dddddd"> 
                        <td align="right" bgcolor="#B6C5F2"> 
                          <?php if($_POST['txtNombre']!='') { 
						  require 'phpmailer_lib/class.phpmailer.php';

  						 //instanciamos un objeto de la clase phpmailer al que llamamos 
  						 //por ejemplo mail
  						  $mail = new phpmailer();  
						  EnviarCorreo2('rafael@canterburyenglish.com','INCIDENCIA '.DameTipo($_POST['txtTipo']),' Usuario: '.$_POST['txtNombre'].' | Descripcion: '.$_POST['txtDescripcion'].' | Mail: '.$_POST['txtMail'],'',&$Error,'incidencias@canterburyenglish.com','Sistema Incidencias',$mail);
                          $mail = NULL; 
						  $mail = new phpmailer();
						  EnviarCorreo2('library.ce@gmail.com','INCIDENCIA '.DameTipo($_POST['txtTipo']),' Usuario: '.$_POST['txtNombre'].' | Descripcion: '.$_POST['txtDescripcion'].' | Mail: '.$_POST['txtMail'],'',&$Error,'incidencias@canterburyenglish.com','Sistema Incidencias',$mail);
						  print 'Successfully...';
						  } ?><input name="action" type="submit" id="save" class="submit-button" value="Enter"> 
                        </td>
                      </tr>
                    </table>
                    
                  </td>
                </tr>
              </table>
            </form>
		  </td>
        </tr>
      </table></td>
  </tr>
</table>
