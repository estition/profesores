<?php

function EnviarCorreo($Destino,$Asunto,$Cuerpo,$Cuerpo_html, $ruta_archivo, $nombre_archivo)	
  {  
	// primero hay que incluir la clase phpmailer para poder instanciar
  //un objeto de la misma
  require 'phpmailer_lib/class.phpmailer.php';

  require 'phpmailer_lib/class.smtp.php';

//  require '/profesores/phpmailer_lib/class.phpmailer.php';

  //instanciamos un objeto de la clase phpmailer al que llamamos 
  //por ejemplo mail
  $mail = new PHPMailer();

  $mail->SetLanguage("en", 'phpmailer_lib/language/');

  //Definimos las propiedades y llamamos a los métodos 
  //correspondientes del objeto mail

  //Con PluginDir le indicamos a la clase phpmailer donde se 
  //encuentra la clase smtp que como he comentado al principio de 
  //este ejemplo va a estar en el subdirectorio includes
  $mail->PluginDir = 'phpmailer_lib/';
//  $mail->PluginDir = '/profesores/phpmailer_lib/';

  $mail->IsSMTP(); // telling the class to use SMTP
$mail->SMTPDebug = 0; 
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
$mail->Port       = 465;                   // set the SMTP port for the GMAIL server

 
  //Le decimos cual es nuestro nombre de usuario y password
  //$mail->Username = "richardinglesadomicilio@gmail.com"; 
  //$mail->Password = "pobox7275";
  
  $mail->Username = "canterbury.mail@canterburyenglish.com"; 
  $mail->Password = "Canterbury1215";
  

  //Indicamos cual es nuestra dirección de correo y el nombre que 
  //queremos que vea el usuario que lee nuestro correo
  
  
  $mail->From = "canterbury.mail@canterburyenglish.com";
  //$mail->AddAddress("richardinglesadomicilio@gmail.com");
  $mail->FromName = "Canterbury English";

  //el valor por defecto 10 de Timeout es un poco escaso dado que voy a usar 
  //una cuenta gratuita, por tanto lo pongo a 30  
  $mail->Timeout=200;

  //Asignamos asunto y cuerpo del mensaje
  //El cuerpo del mensaje lo ponemos en formato html, haciendo 
  //que se vea en negrita
  $mail->Subject = $Asunto;
  $filesclean = array();
  foreach($nombre_archivo as $file){
      if($file != "" && $file != null)
        array_push($filesclean, $file);
  }
  //Indicamos cual es la dirección de destino del correo y le enviamos uno a cada uno.
  $i=0;
  foreach($Destino as $dir_correo){
  	
		//$Cuerpo_html=str_replace("id=ident?", "id=".current($no_id),$Cuerpo_html);									////////////////////TEMP
		//$Cuerpo=str_replace("id=ident?", "id=".current($no_id), $Cuerpo);												////////////////////TEMP
		$mail->Body = $Cuerpo_html;

	  //Definimos AltBody por si el destinatario del correo no admite email con formato html 
	  $mail->AltBody = $Cuerpo;
 
	 //Indicamos el fichero a adjuntar si el usuario seleccionó uno en el formulario
      if (!empty($filesclean)) {
	  //foreach($nombre_archivo as $nombre){
	  		$mail->AddAttachment($ruta_archivo.current($filesclean),current($filesclean)); 
      //}	
	  } 
  
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
	if ($mail->ErrorInfo=="SMTP Error: Data not accepted.") {
	   $exito=true;	   
        }

		
   if(!$exito)
   {
	$mensaje.= 'E-Mail problem '.$dir_correo." ";
	$mensaje.= $mail->ErrorInfo;
   }
   else
   {
	$mensaje.= "<br>E-Mail sent succesfully to ".$dir_correo;	
   } 
   //borramos la direccion del que le acabamos de enviar.
   $mail->ClearAddresses();
   $mail->ClearAttachments();
   
   if(!empty($filesclean)){
		//foreach($nombre_archivo as $archivo){
		unlink($ruta_archivo.current($filesclean));
		//}
	}
	
	//$Cuerpo_html=str_replace("id=".current($no_id), "id=ident?", $Cuerpo_html);
	//$Cuerpo=str_replace("id=".current($no_id), "id=ident?", $Cuerpo);
	next($filesclean);
	//next($no_id);
   }
   
   
   	
	
	
   return $mensaje;
 }
 

/*
if ($attach=="Attach File"){

$target = "attachment_tmp/"; 
$target = $target . basename( $_FILES['attachment']['name']); 
$ok=1;
if(move_uploaded_file($_FILES['attachment']['tmp_name'], $target)) 
		{ 
		$mensaje = "The file <strong>". basename($_FILES['attachment']['name']). "</strong> is attached";
		$attached_files= $attached_files.",".basename($_FILES['attachment']['name']);
		
		} 
	else { 
		$mensaje = "Sorry, there was a problem attaching your file.";
		} 
}
*/
$file_source= "attachment_tmp/";
//$files=separa_en_array($attached_files);
 /////////////////////////////////////////////////////////////	
		?>