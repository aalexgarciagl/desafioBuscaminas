<?php namespace ConexionBD;

use Constantes\Constantes;

require (__DIR__."/../utils/Constantes.php");



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

}