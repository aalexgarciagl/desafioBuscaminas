<?php

require_once (__DIR__."/utils/Controller.php");
use Controller\Controller; 


header("Content-Type:application/json");
$requestMethod = $_SERVER["REQUEST_METHOD"];
$paths = $_SERVER['REQUEST_URI'];
$argu = explode("/",$paths);
unset($argu[0]); 



if($requestMethod == "GET"){
  if(count($argu) == 3){
    if(Controller::inciarSesionController($argu[1],$argu[2])){
      Controller::developerMode($argu[3]); 
        
    }else{
      
    }
  }
}