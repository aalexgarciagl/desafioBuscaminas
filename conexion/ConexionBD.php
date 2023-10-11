<?php namespace ConexionBD;


require_once (__DIR__."/../utils/Constantes.php");
require_once (__DIR__."/../model/User.php");

use Constantes\Constantes;
use Exception;
use User\User; 



class ConexionBD{

  private static function conectar(){
    $conexion = mysqli_connect(Constantes::URL,Constantes::USER,Constantes::PASSWORD,Constantes::NAME);

    if (!$conexion) {
      print "Fallo al conectar a MySQL: " . mysqli_connect_error();
      die();
    }

    return $conexion; 
  }

  private static function desconectar($conexion){
    mysqli_close($conexion);        
  }

  static function seleccionarUser($correo){
    $user = 0;   
    $conexion = self::conectar(); 
    $stmt = mysqli_prepare($conexion,Constantes::$selecUser); 
    mysqli_stmt_bind_param($stmt,"s",$correo);  
    mysqli_stmt_execute($stmt); 
    $resultado = mysqli_stmt_get_result($stmt);
    while($fila = mysqli_fetch_array($resultado)){
      $user = new User($fila["idUsuario"],$fila["nombre"],$fila["correo"],$fila["pass"],$fila["esAdmin"],$fila["partidasJugadas"],$fila["partidasGanadas"]); 
    }
    self::desconectar($conexion);     
    return $user; 
  }

  static function seleccionarPersonas(){
    $personas = []; 
    $conexion = ConexionBD::conectar(); 
    $stmt = mysqli_prepare($conexion, Constantes::$seleccAllPersonas);
    mysqli_stmt_execute($stmt); 
    $resultados = mysqli_stmt_get_result($stmt);

    while( $fila = mysqli_fetch_array($resultados)){
      $personas[] = new User($fila["idUsuario"],$fila["nombre"],$fila["correo"],$fila["pass"],$fila["esAdmin"],$fila["partidasJugadas"],$fila["partidasGanadas"]);
    }     

    ConexionBD::desconectar($conexion);
    return $personas; 
  }

  static function insertarPersona($persona){
    $conexion = self::conectar(); 
    $stmt = mysqli_prepare($conexion,Constantes::$insertarPersona); 
    mysqli_stmt_bind_param($stmt,"sss",$persona->nombre,$persona->correo,$persona->password); 

    try{
      mysqli_stmt_execute($stmt);
    }catch(Exception $e){
      $e->getMessage();
    }
    ConexionBD::desconectar($conexion); 
  }

}