<?php

require_once (__DIR__."/utils/Controller.php");
use Controller\Controller; 


header("Content-Type:application/json");
$requestMethod = $_SERVER["REQUEST_METHOD"];
$paths = $_SERVER['REQUEST_URI'];
$argu = explode("/",$paths);
unset($argu[0]); 



if($requestMethod == "GET"){
  
}elseif($requestMethod == "POST"){

  if($argu[1] == "admin"){
    Controller::registrarJugadorAdmin();     
  }

}elseif($requestMethod == "PUT"){
  
}elseif($requestMethod == "DELETE"){
  
}