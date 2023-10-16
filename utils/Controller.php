<?php

namespace Controller;
use Constantes\Constantes;

require_once (__DIR__."/../conexion/ConexionBD.php");
require_once (__DIR__."/../Error/Error.php");
require_once (__DIR__."/../model/Partida.php"); 


use ConexionBD\ConexionBD;
use Error\Error;
use Partida\Partida;
use User\User;  
 


class Controller{

  static function crearTableroDefault(){
    $datosJSON = json_decode(file_get_contents("php://input"),true);
    $user = ConexionBD::seleccionarUser($datosJSON["correo"]);

    if($user->password == $datosJSON["pass"]){
      $tablero = array_fill(0,Constantes::SIZE_TABLERO_DEFAULT,0); 
      $tableroOculto = array_fill(0,Constantes::SIZE_TABLERO_DEFAULT,"*");
      for($i = 0; $i<Constantes::NUM_MINAS_DEFAULT; $i++){
        $indiceAle = rand(0, count($tablero)-1);
        if($tablero[$indiceAle] == 0){
          $tablero[$indiceAle] = 1; 
        }else{
          $i--; 
        }
      }
    $partida = new Partida($user->idUsuario,implode("",$tableroOculto),implode("",$tablero),0); 
    ConexionBD::insertarPartida($partida); 
    echo json_encode(["Tamaño" => Constantes::SIZE_TABLERO_DEFAULT,
                      "Minas" => Constantes::NUM_MINAS_DEFAULT,
                      "Estado" => "Creado"]); 
    }else{
      Error::usuarioIncorrecto(); 
    }
  }
  
  static function crearTableroVariable($size,$minas){
    $datosJSON = json_decode(file_get_contents("php://input"),true);
    $user = ConexionBD::seleccionarUser($datosJSON["correo"]);

    if($user->password == $datosJSON["pass"]){
      $tablero = array_fill(0,$size,0); 
      $tableroOculto = array_fill(0,$size,"*");
      for($i = 0; $i<$minas; $i++){
        $indiceAle = rand(0, count($tablero)-1);
        if($tablero[$indiceAle] == 0){
          $tablero[$indiceAle] = 1; 
        }else{
          $i--; 
        }
      }
    $partida = new Partida($user->idUsuario,implode("",$tableroOculto),implode("",$tablero),0); 
    ConexionBD::insertarPartida($partida); 
    echo json_encode(["Tamaño" => $size,
                      "Minas" => $minas,
                      "Estado" => "Creado"]); 
    }else{
      Error::usuarioIncorrecto(); 
    }
  }

  static function registrarJugadorAdmin(){
    $datosJSON = json_decode(file_get_contents("php://input"),true);
    $user = ConexionBD::seleccionarUser($datosJSON["correo"]);     
    if($user->admin == 1 && $user->password == $datosJSON["pass"]){
      $cod = 200;
      $mes = "OK"; 
      header('HTTP/1.1 '.$cod.' '.$mes);
      $newUser = new User(0,$datosJSON["newUserName"],$datosJSON["newUserCorreo"],$datosJSON["newUserPass"],$datosJSON["newEsAdmin"],0,0); 
      ConexionBD::insertarPersona($newUser); 
      return json_encode(["user" => $newUser->correo,
                        "estado" => "insertado"]); 

    }else{
      echo Error::permisosAdminDenegados(); 
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
        echo Error::updatePersona(); 
      }
    }else{
      echo Error::credencialesInvalidos();  
    }
    
  }

  static function borrarUsuario($correo){
    $datosJSON = json_decode(file_get_contents("php://input"),true);
    $admin = ConexionBD::seleccionarUser($datosJSON["correo"]); 
    if($admin->admin == 1 && $admin->password == $datosJSON["pass"]){
      if(ConexionBD::borrarPersona($correo)){
        $cod = 200;
        $mes = "OK";
        header('HTTP/1.1 '.$cod.' '.$mes);
        return json_encode(["cod" => $cod,
                            "mes" => "eliminado correcto"]);
      }else{
        echo Error::eliminarPersona(); 
      }
    }
  }

}

  

