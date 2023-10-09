<?php 

namespace Constantes; 


class Constantes{

  const URL = "localhost";
  const USER = "root";
  const PASSWORD = ""; 
  const NAME = "buscaminas"; 

  static $selecUser = "SELECT * FROM usuarios WHERE correo = ?"; 

}