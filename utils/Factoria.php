<?php namespace Factoria;

require_once (__DIR__."/../phpmailer/src/PHPMailer.php");
require_once (__DIR__."/../phpmailer/src/SMTP.php");


use ConexionBD\ConexionBD;
use FFI\Exception;
use PHPMailer\PHPMailer\PHPMailer; 


class Factoria{

  static function generarContrasenaAleatoria() {
    $caracteresPermitidos = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $longitud = 8;
    $contrasena = '';
    
    for ($i = 0; $i < $longitud; $i++) {
        $indiceAleatorio = mt_rand(0, strlen($caracteresPermitidos) - 1);
        $contrasena .= $caracteresPermitidos[$indiceAleatorio];
    }
    
    return $contrasena;
  }

  static function sendMail($user,$asunto,$cuerpo){
    $correcto = false; 
    try{
      $mail = new PHPMailer();
      $mail->isSMTP();                                   
      $mail->Host       = 'smtp.gmail.com';           
      $mail->SMTPAuth   = true;                          
      $mail->Username   = 'auxiliardaw2@gmail.com';            
      $mail->Password   = 'gaxrwhgytqclfiyd';                      
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;   
      $mail->Port       = 465;

      $mail->setFrom('auxiliardaw2@gmail.com', 'Admin admin');
      $mail->addAddress("alejandro.garcia.2002@gmail.com", $user->nombre);
      $mail->Subject = $asunto; 
      $mail->Body = $cuerpo; 

      $mail->send(); 
      $correcto = true; 
    }catch(Exception $e){
      $correcto = false; 
    }
    return $correcto; 
  }

  static function updatePasswordUser($user){
    $nuevosDatos = ["newUserName" => $user->nombre,
                    "newUserCorreo" => $user->correo,
                    "newEsAdmin" => $user->admin,
                    "newUserPass" => $user->password]; 
    if(ConexionBD::updatePersona($user->correo,$nuevosDatos,true)){
      return json_encode("Nueva contraseña enviada al correo electronico"); 
    }else{
      return json_encode("No se ha podido actualizar la contraseña");
    }
  }
}


