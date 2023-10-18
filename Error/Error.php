<?php namespace Error;


class Error{

  static function partidaFinalizada(){
    $cod = 400;
    $mes = "Partida finalizada";
    header('HTTP/1.1 '.$cod.' '.$mes);
    return json_encode(["cod" => $cod,
                        "mes" => $mes]); 
  }

  static function fueraRango(){
    $cod = 400;
    $mes = "Casilla fuera de rango";
    header('HTTP/1.1 '.$cod.' '.$mes);
    return json_encode(["cod" => $cod,
                        "mes" => $mes]); 
  }

  static function permisosAdminDenegados(){
    $cod = 400;
    $mes = "No tienes permisos de administrador";
    header('HTTP/1.1 '.$cod.' '.$mes);
    return json_encode(["cod" => $cod,
                        "mes" => $mes]); 
  }

  static function usuarioIncorrecto(){
    $cod = 400;
    $mes = "Login incorrecto";
    header('HTTP/1.1 '.$cod.' '.$mes);
    return json_encode(["cod" => $cod,
                        "mes" => $mes]); 
  }


  static function updatePersona(){
    $cod = 400;
    $mes = "No se ha podido actualizar datos";
    header('HTTP/1.1 '.$cod.' '.$mes);
    return json_encode(["cod" => $cod,
                        "mes" => $mes]); 
  }

  static function credencialesInvalidos(){
    $cod = 400;
    $mes = "Credenciales invalidos";
    header('HTTP/1.1 '.$cod.' '.$mes);
    return json_encode(["cod" => $cod,
                        "mes" => $mes]);
  }


  static function eliminarPersona(){
    $cod = 400;
    $mes = "fallo al eliminar";
    header('HTTP/1.1 '.$cod.' '.$mes);
    return json_encode(["cod" => $cod,
                        "mes" => $mes]);
  }

  static function demasiadosArgumentos(){
    $cod = 400;
    $mes = "demasiados argumentos";
    header('HTTP/1.1 '.$cod.' '.$mes);
    return json_encode(["cod" => $cod,
                        "mes" => $mes]);
  }

  static function noArgumentos(){
    $cod = 400;
    $mes = "sin argumentos";
    header('HTTP/1.1 '.$cod.' '.$mes);
    return json_encode(["cod" => $cod,
                        "mes" => $mes]);
  }

  static function usuarioNoExiste(){
    $cod = 400;
    $mes = "Usuario no encontrado";
    header('HTTP/1.1 '.$cod.' '.$mes);
    return json_encode(["cod" => $cod,
                        "mes" => $mes]);
  }  
}