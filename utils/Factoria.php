<?php namespace Factoria;

use ConexionBD\ConexionBD;

require (__DIR__."/../conexion/ConexionBD.php");

class Factoria{

  static function iniciarSesion($correo,$password){
    $correct = false; 
    $user = ConexionBD::seleccionarUser($correo); 
    if($user->password == sha1($password)){
      $correct = true; 
    }else{
      $correct = false; 
    }
    return $correct; 
  }
  
}