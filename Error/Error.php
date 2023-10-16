<?php namespace Error;


class Error{

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
    $mes = "error";
    header('HTTP/1.1 '.$cod.' '.$mes);
    return json_encode(["cod" => $cod,
                        "mes" => "fallo al eliminar"]);
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
    $mes = "argumento no soportado";
    header('HTTP/1.1 '.$cod.' '.$mes);
    return json_encode(["cod" => $cod,
                        "mes" => $mes]);
  }
}