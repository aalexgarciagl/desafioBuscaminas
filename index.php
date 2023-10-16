<?php

require_once (__DIR__."/utils/Controller.php");
require_once (__DIR__."/Error/Error.php"); 

use Controller\Controller; 
use Error\Error; 


header("Content-Type:application/json");
$requestMethod = $_SERVER["REQUEST_METHOD"];
$paths = $_SERVER['REQUEST_URI'];
$argu = explode("/",$paths);
unset($argu[0]); 



if($requestMethod == "GET"){  
  
  //ADMIN. 
  if($argu[1] == "admin"){

    if(count($argu) == 1){

      //ADMIN: Lista todos los usuarios.
      echo Controller::mostrarUsuarios(); 

    }elseif(count($argu) == 2){

      //ADMIN: Busca usuario por el correo.
      echo Controller::mostrarUsuario($argu[2]); 
      
    }else{
      echo Error::demasiadosArgumentos();
    }

  }

  //USER. 
  elseif($argu[1] == "user"){
    
    
  
    

  }else{
    echo Error::noArgumentos();
  }  
  

}elseif($requestMethod == "POST"){

  //ADMIN: Registra un jugador pasandole los datos por el JSON.
  if($argu[1] == "admin"){
    if(count($argu) > 1){
      echo Error::demasiadosArgumentos(); 
    }else{
      echo Controller::registrarJugadorAdmin();  
    }       
  }
  
  //USER: 
  elseif($argu[1] == "user"){

    if(count($argu) == 1){
      //Crea tablero tamaño predeterminado
      Controller::crearTableroDefault(); 

    }elseif(count($argu) >= 2 && $argu[2] != "play"){
      //Crea tablero con tamaño y minas dados
      $size = $argu[2];
      $minas = $argu[3];
      Controller::crearTableroVariable($size,$minas);

    }elseif($argu[2] == "play" && count($argu) < 3){
      Controller::destaparCasilla(null); 
    }elseif($argu[2] == "play" && count($argu) == 3){
      Controller::destaparCasilla($argu[3]);  
    }
  
    /**
     * USER: 
     *  Se le mostrara las partidas que tenga activas, en caso de no tener una partida activa se le pedira que cree una. Si este tiene alguna partida abierta se le mostrara todas las disponibles y se le pedira que seleccione una de ellas. Una vez seleccionada podremos jugar. 
     * 
     *  Le indicaremos en el JSON la casilla que queremos destapar
    */
  }

}elseif($requestMethod == "PUT"){  
  
  if($argu[1] == "admin"){

    if(count($argu) == 2){

      //ADMIN: Modifica los datos del usuario que se le pase por la URL, los nuevos datos los saca del JSON.
      echo Controller::modificarDatos($argu[2]);

    }elseif(count($argu) > 2){
      echo Error::demasiadosArgumentos(); 
    }else{
      echo Error::noArgumentos(); 
    }
     
  }
  //USER: 
  elseif($argu[1] == "user"){

  }
  
}elseif($requestMethod == "DELETE"){
  
  //ADMIN: Elimina al ususario con el correo que le pasemos en la URL. 
  if($argu[1] == "admin"){
    if(count($argu) == 2){
      echo Controller::borrarUsuario($argu[2]);
    }elseif(count($argu) > 2){
      echo Error::demasiadosArgumentos(); 
    }else{
      echo Error::noArgumentos(); 
    }
  }

  elseif($argu[1] == "user"){

  }
}