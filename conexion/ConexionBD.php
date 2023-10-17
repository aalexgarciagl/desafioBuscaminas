<?php namespace ConexionBD;


require_once (__DIR__."/../utils/Constantes.php");
require_once (__DIR__."/../model/User.php");

use Constantes\Constantes;
use Exception;
use Partida\Partida;
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
    $persona->password = sha1($persona->password); 
    mysqli_stmt_bind_param($stmt,"sssi",$persona->nombre,$persona->correo,$persona->password,$persona->admin); 

    try{
      mysqli_stmt_execute($stmt);
    }catch(Exception $e){
      $e->getMessage();
    }
    ConexionBD::desconectar($conexion); 
  }

  static function updatePersona($correo,$nuevosDatos,$cambioPass){
    $conexion = ConexionBD::conectar();
    $stmt = mysqli_prepare($conexion, Constantes::$updatePersona);
    if($cambioPass){
      $passwordSha1 = sha1($nuevosDatos["newUserPass"]);
    }else{
      $passwordSha1 = $nuevosDatos["newUserPass"];
    }
    mysqli_stmt_bind_param($stmt, "sssis",$nuevosDatos["newUserName"],$nuevosDatos["newUserCorreo"],$passwordSha1, $nuevosDatos["newEsAdmin"], $correo);

    if (mysqli_stmt_execute($stmt)) {      
      ConexionBD::desconectar($conexion);
      return true;
    } else {      
      ConexionBD::desconectar($conexion);
      return false;
    }
  }

  static function borrarPersona($correo){
    $conexion = ConexionBD::conectar();
    $stmt = mysqli_prepare($conexion, Constantes::$borrarPersona);
    mysqli_stmt_bind_param($stmt, "s", $correo);
    
    if (mysqli_stmt_execute($stmt)) {      
        ConexionBD::desconectar($conexion);
        return true;
    } else {      
        ConexionBD::desconectar($conexion);
        return false;
    }
  }

  static function insertarPartida($partida){
    $conexion = self::conectar(); 
    $stmt = mysqli_prepare($conexion,Constantes::$insertarPartida); 
    mysqli_stmt_bind_param($stmt,"issi",$partida->idPersona,$partida->tablaOculta,$partida->tablaJugador,$partida->finalizada); 

    try{
      mysqli_stmt_execute($stmt);
    }catch(Exception $e){
      $e->getMessage();
    }
    ConexionBD::desconectar($conexion); 
  }

  static function seleccionarPartidasByIdJugador($user){
    $partidas = []; 
    $conexion = self::conectar(); 
    $stmt = mysqli_prepare($conexion,Constantes::$seleccPartidasByIdJugador); 
    $estadoPartida = 0; 
    mysqli_stmt_bind_param($stmt,"ii",$user->idUsuario,$estadoPartida);  
    mysqli_stmt_execute($stmt); 
    $resultado = mysqli_stmt_get_result($stmt);
    while( $fila = mysqli_fetch_array($resultado)){
      $partidas[] = new Partida($fila["idPartida"],$fila["idPersona"],str_split($fila["tablaOculta"]),str_split($fila["tablaJugador"]),$fila["finalizada"]);
    }     

    ConexionBD::desconectar($conexion);
    return $partidas;
  }

  static function seleccionarPartidaByIdTablero($idTablero){
    $partida = 0; 
    $conexion = self::conectar(); 
    $stmt = mysqli_prepare($conexion,Constantes::$seleccPartidaByIdTablero);    
    mysqli_stmt_bind_param($stmt,"i",$idTablero);  
    mysqli_stmt_execute($stmt); 
    $resultado = mysqli_stmt_get_result($stmt);
    while( $fila = mysqli_fetch_array($resultado)){
      $partida = new Partida($fila["idPartida"],$fila["idPersona"],str_split($fila["tablaOculta"]),str_split($fila["tablaJugador"]),$fila["finalizada"]);
    }     

    ConexionBD::desconectar($conexion);
    return $partida;
  }

  static function updatePartida($idPartida,$tablaOculta,$estado){
    $conexion = ConexionBD::conectar();
    $stmt = mysqli_prepare($conexion, Constantes::$updatePartida);
    mysqli_stmt_bind_param($stmt,"sii",$tablaOculta,$estado,$idPartida);

    if (mysqli_stmt_execute($stmt)) {      
      ConexionBD::desconectar($conexion);
      return true;
    } else {      
      ConexionBD::desconectar($conexion);
      return false;
    }
  }

  static function partidaJugada($user){
    $query = "UPDATE usuarios set partidasJugadas = ? where correo = ?";
    $user = self::seleccionarUser($user->correo); 
    $user->partidasJugadas++;       
    $conexion = ConexionBD::conectar();
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt,"is",$user->partidasJugadas,$user->correo);

    if (mysqli_stmt_execute($stmt)) {      
      ConexionBD::desconectar($conexion);
      return true;
    } else {      
      ConexionBD::desconectar($conexion);
      return false;
    }
  }

  static function partidaGanada($user){
    $query = "UPDATE usuarios set partidasGanadas = ? where correo = ?";
    $user = self::seleccionarUser($user->correo); 
    $user->partidasGanadas++;       
    $conexion = ConexionBD::conectar();
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt,"is",$user->partidasGanadas,$user->correo);

    if (mysqli_stmt_execute($stmt)) {      
      ConexionBD::desconectar($conexion);
      return true;
    } else {      
      ConexionBD::desconectar($conexion);
      return false;
    }
  }

}