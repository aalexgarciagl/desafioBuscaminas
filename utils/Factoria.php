<?php namespace Factoria;

use FFI\Exception;
use PHPMailer\PHPMailer\PHPMailer; 


class Factoria{


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
      $mail->addAddress($user->correo, $user->nombre);
      $mail->Subject = $asunto; 
      $mail->Body = $cuerpo; 

      $mail->send(); 
      $correcto = true; 
    }catch(Exception $e){
      $correcto = false; 
    }
    return $correcto; 
  }
}


