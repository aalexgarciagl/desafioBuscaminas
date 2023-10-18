<?php namespace Error;


class Error {
  static function partidaFinalizada() {
    $cod = 403; // Cambiado a 403 (Forbidden)
    $mes = "Partida finalizada";
    header('HTTP/1.1 ' . $cod . ' ' . $mes);
    return json_encode(["cod" => $cod, "mes" => $mes]);
  }

  static function fueraRango() {
    $cod = 400; // Código de estado válido
    $mes = "Casilla fuera de rango";
    header('HTTP/1.1 ' . $cod . ' ' . $mes);
    return json_encode(["cod" => $cod, "mes" => $mes]);
  }

  static function permisosAdminDenegados() {
    $cod = 403; // Cambiado a 403 (Forbidden)
    $mes = "No tienes permisos de administrador";
    header('HTTP/1.1 ' . $cod . ' ' . $mes);
    return json_encode(["cod" => $cod, "mes" => $mes]);
  }

  static function usuarioIncorrecto() {
    $cod = 401; // Cambiado a 401 (Unauthorized)
    $mes = "Login incorrecto";
    header('HTTP/1.1 ' . $cod . ' ' . $mes);
    return json_encode(["cod" => $cod, "mes" => $mes]);
  }

  static function updatePersona() {
    $cod = 500; // Cambiado a 500 (Internal Server Error)
    $mes = "No se ha podido actualizar datos";
    header('HTTP/1.1 ' . $cod . ' ' . $mes);
    return json_encode(["cod" => $cod, "mes" => $mes]);
  }

  static function credencialesInvalidos() {
    $cod = 401; // Cambiado a 401 (Unauthorized)
    $mes = "Credenciales inválidos";
    header('HTTP/1.1 ' . $cod . ' ' . $mes);
    return json_encode(["cod" => $cod, "mes" => $mes]);
  }

  static function eliminarPersona() {
    $cod = 500; // Cambiado a 500 (Internal Server Error)
    $mes = "Fallo al eliminar";
    header('HTTP/1.1 ' . $cod . ' ' . $mes);
    return json_encode(["cod" => $cod, "mes" => $mes]);
  }

  static function demasiadosArgumentos() {
    $cod = 400; // Código de estado válido
    $mes = "Demasiados argumentos";
    header('HTTP/1.1 ' . $cod . ' ' . $mes);
    return json_encode(["cod" => $cod, "mes" => $mes]);
  }

  static function noArgumentos() {
    $cod = 400; // Código de estado válido
    $mes = "Sin argumentos";
    header('HTTP/1.1 ' . $cod . ' ' . $mes);
    return json_encode(["cod" => $cod, "mes" => $mes]);
  }

  static function usuarioNoExiste() {
    $cod = 404; // Cambiado a 404 (Not Found)
    $mes = "Usuario no encontrado";
    header('HTTP/1.1 ' . $cod . ' ' . $mes);
    return json_encode(["cod" => $cod, "mes" => $mes]);
  }
}
