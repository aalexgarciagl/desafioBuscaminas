<?php

require_once (__DIR__."/utils/Controller.php");
use Controller\Controller; 


header("Content-Type:application/json");
$requestMethod = $_SERVER["REQUEST_METHOD"];
$paths = $_SERVER['REQUEST_URI'];
$argu = explode("/",$paths);
unset($argu[0]); 



if($requestMethod == "GET"){  
  
  //ADMIN: Lista todos los usuarios.
  if($argu[1] == "admin" && count($argu) == 1){
    echo Controller::mostrarUsuarios(); 
  }

  //ADMIN: Busca usuario por el correo.
  if($argu[1] == "admin" && count($argu) == 2){
    echo Controller::mostrarUsuario($argu[2]); 
  }

}elseif($requestMethod == "POST"){

  //ADMIN: Registra un jugador pasandole los datos por el JSON.
  if($argu[1] == "admin"){
    echo Controller::registrarJugadorAdmin();     
  }

}elseif($requestMethod == "PUT"){
  
  //ADMIN: Modifica los datos del usuario que se le pase por la URL, los nuevos datos los saca del JSON.
  if($argu[1] == "admin" && count($argu) == 2){
    echo Controller::modificarDatos($argu[2]); 
  }
  
}elseif($requestMethod == "DELETE"){
  
  //ADMIN: Elimina al ususario con el correo que le pasemos en la URL. 
  if($argu[1] == "admin" && count($argu) == 2){
    echo Controller::borrarUsuario($argu[2]); 
  }
}