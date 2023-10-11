<?php 

namespace Constantes; 


class Constantes{

  const URL = "localhost";
  const USER = "root";
  const PASSWORD = ""; 
  const NAME = "buscaminas"; 

  const SIZE_TABLERO_DEFAULT = 10; 
  const NUM_MINAS_DEFAULT = 3; 

  static $selecUser = "SELECT * FROM usuarios WHERE correo = ?"; 
  static $insertarPersona = "INSERT INTO usuarios VALUES (DEFAULT,?,?,?,?,0,0)"; 
  static $seleccAllPersonas = "SELECT * FROM usuarios"; 
  static $updatePersona = "UPDATE usuarios SET nombre = ?, correo = ?, pass = ?, esAdmin = ? WHERE correo = ?";
  static $borrarPersona = "DELETE FROM usuarios WHERE correo = ?";

  static $insertarPartida = "INSERT INTO partida VALUES (DEFAULT,?,?,?,?)"; 


}