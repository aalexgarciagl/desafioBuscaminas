<?php

namespace Controller;

require_once (__DIR__."/../conexion/ConexionBD.php");


use ConexionBD\ConexionBD;
use User\User;  
 


class Controller{


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

  static function registrarJugadorAdmin(){
    $datosJSON = json_decode(file_get_contents("php://input"),true);
    $user = ConexionBD::seleccionarUser($datosJSON["correo"]);     
    if($user->admin == 1){
      $cod = 200;
      $mes = "OK"; 
      header('HTTP/1.1 '.$cod.' '.$mes);
      $newUser = new User(0,$datosJSON["newUserName"],$datosJSON["newUserCorreo"],$datosJSON["newUserPass"],0,0,0); 
      ConexionBD::insertarPersona($newUser); 
      echo json_encode(["user" => $newUser->correo,
                        "estado" => "insertado"]); 

    }else{
      $cod = 400;
      $mes = "No tienes permisos de administrador";
      header('HTTP/1.1 '.$cod.' '.$mes);
      echo json_encode(["cod" => $cod,
                        "mes" => $mes]); 
    }
  }

}

  

