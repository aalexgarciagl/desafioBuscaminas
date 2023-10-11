<?php 

namespace Constantes; 


class Constantes{

  const URL = "localhost";
  const USER = "root";
  const PASSWORD = ""; 
  const NAME = "buscaminas"; 

  static $selecUser = "SELECT * FROM usuarios WHERE correo = ?"; 
  static $insertarPersona = "INSERT INTO usuarios VALUES (DEFAULT,?,?,?,DEFAULT,0,0)"; 
  static $seleccAllPersonas = "SELECT * FROM usuarios"; 
}