<?php

function generarForm(){
    // check that a form was submitted
    if(isset($_POST) && is_array($_POST) && count($_POST)){
        // we will use this array to pass to the createFDF function
        $data=array();
        
        // This displays all the data that was submitted. You can
        // remove this without effecting how the FDF data is generated.
        //echo'<pre>POST '; print_r($_POST);echo '</pre>';

        if(isset($_POST['txtProfesor'])){
            // the name field was submitted
            $pat='`[^a-z0-9\s]+$`i';
            if(empty($_POST['txtProfesor']) || preg_match($pat,$_POST['txtProfesor'])){
                // no value was submitted or something other than a
                // number, letter or space was included
                die('Invalid input for txtProfesor field.');
            }else{
                // if this passed our tests, this is safe
                $data['txtProfesor']=$_POST['txtProfesor'];
            }
            
            if(!isset($_POST['txtEstudiante'])){
                // Why this? What if someone is spoofing form submissions
                // to see how your script works? Only allow the script to
                // continue with expected data, don't be lazy and insecure ;)
                die('You did not submit the correct form.');
            }
            
            // Check your data for ALL FIELDS that you expect, ignore ones you
            // don't care about. This is just an example to illustrate, so I
            // won't check anymore, but I will add them blindly (you don't want
            // to do this in a production environment).
			$data['txtEmailProfesor']=$_POST['txtEmailProfesor'];
            $data['txtEstudiante']=$_POST['txtEstudiante'];
            $data['txtDuracion']=$_POST['txtDuracion'];
            $data['txtObjLeccion']=$_POST['txtObjLeccion'];
            
            $data['txtObjPersonal']=$_POST['txtObjPersonal'];
            $data['txtConociemiento']=$_POST['txtConociemiento'];
            $data['txtVocabulario']=$_POST['txtVocabulario'];
            
            $data['txtProblemas']=$_POST['txtProblemas'];
            $data['txtRecupeClases']=$_POST['txtRecupeClases'];
            
			
			$data['txtTimeWarm']=$_POST['txtTimeWarm'];
            $data['txtTimeReview']=$_POST['txtTimeReview'];
            $data['txtTimeTeaching']=$_POST['txtTimeTeaching'];
            
            $data['txtTimePractice']=$_POST['txtTimePractice'];
            $data['txtTimeBackup']=$_POST['txtTimeBackup'];
            $data['txtActivitiesWarm']=$_POST['txtActivitiesWarm'];
            
            $data['txtActivitiesReview']=$_POST['txtActivitiesReview'];
            $data['txtActivitiesTeaching']=$_POST['txtActivitiesTeaching'];
			
            $data['txtActivitiesPractice']=$_POST['txtActivitiesPractice'];
            $data['txtActivitiesBackup']=$_POST['txtActivitiesBackup'];
            // I wanted to add the date to the submissions
            $data['txtFecha']=date('Y-m-d');
            
         

	$file_source= 'attachment_tmp/';
	$files= $pdf_doc;
	$to1 = addslashes("lessonplan@canterburytefl.com");
	$subject1 = "Lesson Plan del estudiante ".$data['txtEstudiante']."";	
	$mensaje1="<br /><br /><div align=center>  <b>".$data['txtEmailProfesor']." </b>ha enviado un plan de lecciones perteneciente a ".$data['txtEstudiante']."<br /><br /></a><br /> <br /></div>";
	$mensajeHtml1=str_replace("\r","<br />",$mensaje1);
 /////////////////////////////////////////////////////////////

	EnviarCorreo1($to1,$subject1,$mensaje1,$mensajeHtml1, $file_source, $files);
        }
    }else{
        echo 'You did not submit a form.';
    }
	}
			   
////////////////////////////////////////////////////////////////////////	 
 function EnviarCorreo1($Destino,$Asunto,$Cuerpo,$Cuerpo_html, $ruta_archivo, $nombre_archivo)	
  {	
	 //mail('javier.buira@sgs.com','Prueba','Hola #############');
	// primero hay que incluir la clase phpmailer para poder instanciar
  //un objeto de la misma
   require_once 'phpmailer_lib/class.phpmailer.php';

  //instanciamos un objeto de la clase phpmailer al que llamamos 
  //por ejemplo mail
  $mail = new phpmailer();

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
  $mail->Host = 'canterburytefl.com';

  //Le indicamos que el servidor smtp requiere autenticación
  $mail->SMTPAuth = true;

  //Le decimos cual es nuestro nombre de usuario y password
  $mail->Username = 'lessonplan@canterburytefl.com'; 
  $mail->Password = 'hercules';

  //Indicamos cual es nuestra dirección de correo y el nombre que 
  //queremos que vea el usuario que lee nuestro correo
  $mail->From = 'lessonplan@canterburytefl.com';
  $mail->FromName = 'Canterbury Tefl Courses';

  //el valor por defecto 10 de Timeout es un poco escaso dado que voy a usar 
  //una cuenta gratuita, por tanto lo pongo a 30  
  $mail->Timeout=60;
  
  //Indicamos el fichero a adjuntar si el usuario seleccionó uno en el formulario
      if (!empty($nombre_archivo)) {
	 
	 // echo "<TR><TD colspan='2'><p><span class='style13'>".$ruta_archivo.$nombre_archivo."</span></p></TD></TR>";
	
			$mail->AddAttachment($ruta_archivo.$nombre_archivo,$nombre_archivo); 
			//echo "<TR><TD colspan='2'><p><span class='style13'>".$ruta_archivo.$nombre_archivo."</span></p></TD></TR>";
      
	  }

  //Asignamos asunto y cuerpo del mensaje
  //El cuerpo del mensaje lo ponemos en formato html, haciendo 
  //que se vea en negrita
  $mail->Subject = $Asunto;
  $mail->Body = $Cuerpo_html;

  //Definimos AltBody por si el destinatario del correo no admite email con formato html 
  $mail->AltBody = $Cuerpo;
  
  
	  $mail->AddAddress($Destino);
	
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
	$mensaje.= "<br>E-Mail sent succesfully to ".$dir_correo;	
   } 
   //borramos la direccion del que le acabamos de enviar.
   $mail->ClearAddresses();
   
   	if(!empty($nombre_archivo)){
	
		
	
		unlink($ruta_archivo.$nombre_archivo);
		
	}
	
	
   return $mensaje;
 }
?>