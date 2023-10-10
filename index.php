<?php

require_once (__DIR__."/utils/Controller.php");
use Controller\Controller; 


header("Content-Type:application/json");
$requestMethod = $_SERVER["REQUEST_METHOD"];
$paths = $_SERVER['REQUEST_URI'];
$argu = explode("/",$paths);
unset($argu[0]); 



if($requestMethod == "GET"){
  /**
   * Para admin:
   *  Listar usuarios
   *  Buscar usuario por correo
  */
  
}elseif($requestMethod == "POST"){

  if($argu[1] == "admin"){
    Controller::registrarJugadorAdmin();     
  }

}elseif($requestMethod == "PUT"){
  /**
   * Para admin: 
   *  Modificar datos de cualquier usuario añadiendo los nuevos datos al JSON e indicando el correo en la URL
  */
  
}elseif($requestMethod == "DELETE"){
  /**
   * Para admin: 
   *  Le pasaremos por la URL el correo del usuasrio que queremos eliminar
  */
}