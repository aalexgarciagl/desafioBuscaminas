<?php

namespace Controller;

use ConexionBD\ConexionBD;
use Factoria\Factoria; 


class Controller{

  static function inciarSesionController($correo,$password){
    $cod = 200;
    $mes = "OK";    
    $user = ConexionBD::seleccionarUser($correo); 
    
    if(Factoria::iniciarSesion($correo,$password)){      
      json_encode(["Cod" => $cod,
                   "mes" => $mes,
                   "login" => "correcto"]); 
    }else{      
      json_encode(["Cod" => $cod,
                   "mes" => $mes,
                   "login" => "incorrecto"]);
    }
    header('HTTP/1.1 '.$cod.' '.$mes);
    
    //comprueba si el usuario es admin o no. 
    if($user->admin == 0){
      return false; 
    }else{
      return true; 
    }
  }

  static function developerMode(){
    
  }

  

}