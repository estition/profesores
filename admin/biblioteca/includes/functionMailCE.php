<?php

function EnviarCorreo($Destino,$Asunto,$Cuerpo,$Cuerpo_html, $ruta_archivo, $nombre_archivo)	
  {  
	// primero hay que incluir la clase phpmailer para poder instanciar
  //un objeto de la misma
  require 'phpmailer_lib/class.phpmailer.php';
//  require '/profesores/phpmailer_lib/class.phpmailer.php';

  //instanciamos un objeto de la clase phpmailer al que llamamos 
  //por ejemplo mail
  $mail = new phpmailer();

  //Definimos las propiedades y llamamos a los métodos 
  //correspondientes del objeto mail

  //Con PluginDir le indicamos a la clase phpmailer donde se 
  //encuentra la clase smtp que como he comentado al principio de 
  //este ejemplo va a estar en el subdirectorio includes
  $mail->PluginDir = 'phpmailer_lib/';
//  $mail->PluginDir = '/profesores/phpmailer_lib/';

  //Con la propiedad Mailer le indicamos que vamos a usar un 
  //servidor smtp
  $mail->Mailer = 'smtp';

  //Asignamos a Host el nombre de nuestro servidor smtp
  $mail->Host = 'canterburyenglish.com';

  //Le indicamos que el servidor smtp requiere autenticación
  $mail->SMTPAuth = true;

  //Le decimos cual es nuestro nombre de usuario y password
  $mail->Username = 'teachers@canterburyenglish.com'; 
  $mail->Password = 'av61igqe';

  //Indicamos cual es nuestra dirección de correo y el nombre que 
  //queremos que vea el usuario que lee nuestro correo
  $mail->From = 'teachers@canterburyenglish.com';
  $mail->FromName = 'Canterbury English Teachers';

  //el valor por defecto 10 de Timeout es un poco escaso dado que voy a usar 
  //una cuenta gratuita, por tanto lo pongo a 30  
  $mail->Timeout=200;

   //Indicamos el fichero a adjuntar si el usuario seleccionó uno en el formulario
      if (!empty($nombre_archivo)) {
	  	foreach($nombre_archivo as $nombre){
			$mail->AddAttachment($ruta_archivo.$nombre,$nombre); 
	    }
	  }

  //Asignamos asunto y cuerpo del mensaje
  //El cuerpo del mensaje lo ponemos en formato html, haciendo 
  //que se vea en negrita
  $mail->Subject = $Asunto;
  $mail->Body = $Cuerpo_html;

  //Definimos AltBody por si el destinatario del correo no admite email con formato html 
  $mail->AltBody = $Cuerpo;
  
  //Indicamos cual es la dirección de destino del correo y le enviamos uno a cada uno.
  foreach($Destino as $dir_correo){
  
	  $mail->AddAddress($dir_correo);
	
  //se envia el mensaje, si no ha habido problemas 
  //la variable $exito tendra el valor true
  $exito = $mail->Send();

  //Si el mensaje no ha podido ser enviado se realizaran 4 intentos mas como mucho 
  //para intentar enviar el mensaje, cada intento se hara 5 segundos despues 
  //del anterior, para ello se usa la funcion sleep	
  $intentos=1; 
  while ((!$exito) && ($intentos < 5) && ($mail->ErrorInfo!="SMTP Error: Data not accepted")) {
	sleep(5);
     	
    $exito = $mail->Send();
  $intentos=$intentos+1;	
	
   }
 
 	//La clase phpmailer tiene un pequeño bug y es que cuando envia un mail con
	//attachment la variable ErrorInfo adquiere el valor Data not accepted, dicho 
	//valor no debe confundirnos ya que el mensaje ha sido enviado correctamente
	if ($mail->ErrorInfo=="SMTP Error: Data not accepted") {
	   $exito=true;	   
        }

		
   if(!$exito)
   {
	$mensaje.= 'E-Mail problem '.$dir_correo." ";
	$mensaje.= $mail->ErrorInfo;
	//return $mensaje;
	//exit;	
   }
   else
   {
	$mensaje.= "<br />E-Mail sent succesfully to ".$dir_correo;
   } 
   //borramos la direccion del que le acabamos de enviar.
   $mail->ClearAddresses();
   }   
   
   	if(!empty($nombre_archivo)){
		foreach($nombre_archivo as $archivo){
		unlink($ruta_archivo.$archivo);
		}
	}	
	
   return $mensaje;
 }
 


if ($attach=="Attach File"){

$target = "attachment_tmp/"; 
$target = $target . basename( $_FILES['attachment']['name']); 
$ok=1;
//if(move_uploaded_file($_FILES['attachment']['tmp_name'], $target))
if ( (move_uploaded_file($_FILES['attachment']['tmp_name'], $target)) && ($_FILES["attachment"]["size"] < 256000) && (strpos($_FILES["attachment"]["name"]," ") == false) )
		{ 
		$mensaje = "The file <strong>". basename($_FILES['attachment']['name']). "</strong> is attached";
		$attached_files= $attached_files.",".basename($_FILES['attachment']['name']);
		
		} 
	else { 
		$mensaje = "The file must have a maximum size of 250 KB and its name mustn't contain spaces.";//"Sorry, there was a problem attaching your file.";
		} 
		
}


?>