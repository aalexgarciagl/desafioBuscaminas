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

  static function destaparCasilla($idTablero){
    $datosJSON = json_decode(file_get_contents("php://input"),true);
    $user = ConexionBD::seleccionarUser($datosJSON["correo"]);
    $minas = 0; 
  
    if($user->password == sha1($datosJSON["pass"])){
      
      if($idTablero > 1){
        $partida = ConexionBD::seleccionarPartidaByIdTablero($idTablero); 
        $minasForWin = 0; 
        $huecosSinVer = 0;         
        for($i = 0;$i<count($partida->tablaJugador);$i++)  {
          if($partida->tablaJugador[$i] == 1){
            $minasForWin++; 
          }
        }      
        if($partida != null){
          $casillaDestapar = $datosJSON["casilla"]; 
          $tableroJugar = $partida->tablaJugador; 
          if($casillaDestapar > count($tableroJugar)){
            Error::fueraRango(); 
          }else{

            if($partida -> tablaJugador[$casillaDestapar] == 0){
              if($casillaDestapar-1 >= 0){
                if($partida -> tablaJugador[$casillaDestapar-1] == 1){
                  $minas++; 
                }
              }
              if($casillaDestapar+1 < count($partida -> tablaJugador)){
                if($partida -> tablaJugador[$casillaDestapar+1] == 1){
                  $minas++; 
                } 
              }
              
              for ($i=0; $i < count($partida->tablaJugador); $i++) { 
                if($partida->tablaOculta[$i] == "*"){
                  $huecosSinVer++; 
                }
              }
              if($minasForWin == $huecosSinVer){
                $strTablaOculta = implode("",$partida->tablaJugador); 
                ConexionBD::updatePartida($partida->idPartida,$strTablaOculta,1); 
                echo json_encode("Partida ganada"); 
              }else{
                $partida -> tablaOculta[$casillaDestapar] = $minas; 
                $minas = 0;  
                $huecosSinVer = 0; 
                $strTablaOculta = implode("",$partida->tablaOculta); 
                ConexionBD::updatePartida($partida->idPartida,$strTablaOculta,0); 
                echo json_encode($partida->tablaOculta); 
              }

                     
            }else{
              //aplastas mina
              $partida -> tablaOculta[$casillaDestapar] = 8; 
              $strTablaJugador = implode("",$partida->tablaJugador); 
              ConexionBD::updatePartida($partida->idPartida,$strTablaJugador,-1); 
              echo json_encode("Has pisado una mina"); 
            }
          }
        }else{
          echo Error::partidaFinalizada(); 
        }
        
        
      }else{
        $partidas = ConexionBD::seleccionarPartidasByIdJugador($user); 
       

        for($i = 0; $i< count($partidas);$i++){
          $partidas[$i]->tablaJugador = "secret"; 
        }

        if(count($partidas)>=1){        
          echo json_encode(["seleccione partida id" => $partidas]); 
        }else{
          echo json_encode(["Crear partida" => "Sin partidas disponibles"]); 
        }
      }

    }else{
      Error::usuarioIncorrecto(); 
    }
  }

  static function crearTableroDefault(){
    $datosJSON = json_decode(file_get_contents("php://input"),true);
    $user = ConexionBD::seleccionarUser($datosJSON["correo"]);

    if($user->password == sha1($datosJSON["pass"])){
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
    $partida = new Partida(0,$user->idUsuario,implode("",$tableroOculto),implode("",$tablero),0); 
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

    if($user->password == sha1($datosJSON["pass"])){
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
    $partida = new Partida(0,$user->idUsuario,implode("",$tableroOculto),implode("",$tablero),0); 
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
    if($user->admin == 1 && $user->password == sha1($datosJSON["pass"])){
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
    $cambioPass = true; 

    if($admin->admin == 1 && $admin->password == sha1($datosJSON["pass"])){
      if($datosJSON["newUserName"] == ""){
        $datosJSON["newUserName"] = $user->nombre; 
      }
      if($datosJSON["newUserCorreo"] == ""){
        $datosJSON["newUserCorreo"] = $user->correo; 
      }
      if($datosJSON["newUserPass"] == ""){
        $datosJSON["newUserPass"] = $user->password; 
        $cambioPass = false; 
      }
      if($datosJSON["newEsAdmin"] == ""){
        $datosJSON["newEsAdmin"] = $user->admin; 
      }
      
  
      if(ConexionBD::updatePersona($correo,$datosJSON,$cambioPass)){
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
    if($admin->admin == 1 && $admin->password == sha1($datosJSON["pass"])){
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