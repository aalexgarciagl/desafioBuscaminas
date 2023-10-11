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
    if($user->admin == 1 && $user->password == $datosJSON["pass"]){
      $cod = 200;
      $mes = "OK"; 
      header('HTTP/1.1 '.$cod.' '.$mes);
      $newUser = new User(0,$datosJSON["newUserName"],$datosJSON["newUserCorreo"],$datosJSON["newUserPass"],0,0,0); 
      ConexionBD::insertarPersona($newUser); 
      return json_encode(["user" => $newUser->correo,
                        "estado" => "insertado"]); 

    }else{
      $cod = 400;
      $mes = "No tienes permisos de administrador";
      header('HTTP/1.1 '.$cod.' '.$mes);
      return json_encode(["cod" => $cod,
                        "mes" => $mes]); 
    }
  }

  static function mostrarUsuarios(){
    $personas = ConexionBD::seleccionarPersonas(); 
    return json_encode($personas); 
  }

  static function mostrarUsuario($correo){
    $usuario = ConexionBD::seleccionarUser($correo); 
    return json_encode($usuario); 
  }

  static function modificarDatos($correo){
    $user = ConexionBD::seleccionarUser($correo); 
    $datosJSON = json_decode(file_get_contents("php://input"),true);
    $admin = ConexionBD::seleccionarUser($datosJSON["correo"]); 

    if($admin->admin == 1 && $admin->password == $datosJSON["pass"]){
      if($datosJSON["newUserName"] == ""){
        $datosJSON["newUserName"] = $user->nombre; 
      }
      if($datosJSON["newUserCorreo"] == ""){
        $datosJSON["newUserCorreo"] = $user->correo; 
      }
      if($datosJSON["newUserPass"] == ""){
        $datosJSON["newUserPass"] = $user->password; 
      }
      if($datosJSON["newEsAdmin"] == ""){
        $datosJSON["newEsAdmin"] = $user->admin; 
      }
      
  
      if(ConexionBD::updatePersona($correo,$datosJSON)){
        return json_encode(["datos antiguos" => $user,
                            "actualizacion" => "correcto"]); 
      }else{
        $cod = 400;
        $mes = "No se ha podido actualizar datos";
        header('HTTP/1.1 '.$cod.' '.$mes);
        return json_encode(["cod" => $cod,
                          "mes" => $mes]); 
      }
    }else{
      $cod = 400;
      $mes = "Credenciales invalidos";
      header('HTTP/1.1 '.$cod.' '.$mes);
      return json_encode(["cod" => $cod,
                          "mes" => $mes]); 
    }
    
  }

  static function borrarUsuario($correo){
    if(ConexionBD::borrarPersona($correo)){
      $cod = 200;
      $mes = "OK";
      header('HTTP/1.1 '.$cod.' '.$mes);
      return json_encode(["cod" => $cod,
                          "mes" => "eliminado correcto"]);
    }else{
      $cod = 400;
      $mes = "error";
      header('HTTP/1.1 '.$cod.' '.$mes);
      return json_encode(["cod" => $cod,
                          "mes" => "fallo al eliminar"]);
    }
  }

}

  

