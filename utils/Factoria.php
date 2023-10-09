<?php 

namespace Factoria;

use ConexionBD\ConexionBD;

require_once (__DIR__."/../conexion/ConexionBD.php");

class Factoria{

  static function iniciarSesion($correo,$password){
    $correct = false; 
    $user = ConexionBD::seleccionarUser($correo); 
    if($user->password == $password){
      $correct = true; 
    }else{
      $correct = false; 
    }
    return $correct; 
  }
  
}