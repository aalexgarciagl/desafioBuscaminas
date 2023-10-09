<?php

namespace Controller;

require_once (__DIR__."/../conexion/ConexionBD.php");
require_once (__DIR__."/../utils/Factoria.php");

use ConexionBD\ConexionBD;
use Factoria\Factoria;  


class Controller{

  static function inciarSesionController($correo,$password){
    $cod = 200;
    $mes = "OK";    
    $user = ConexionBD::seleccionarUser($correo); 
    
    if(Factoria::iniciarSesion($correo,$password)){      
      echo json_encode(["Cod" => $cod,
                   "mes" => $mes,
                   "login" => "correcto"]); 
    }else{      
      echo json_encode(["Cod" => $cod,
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

  static function developerMode($modo){
    //modo developer
    if($modo == 1){

    }
    //modo jugador
    elseif($modo == 0){

    }

  }

  

}