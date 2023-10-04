<?php namespace User; 


class User{
  public $idUsuario;
  public $nombre; 
  public $correo; 
  public $password; 
  public $admin; 
  public $partidasJugadas; 
  public $partidasGanadas;

	public function __construct($idUsuario, $nombre, $correo, $password, $admin, $partidasJugadas, $partidasGanadas) {

		$this->idUsuario = $idUsuario;
		$this->nombre = $nombre;
		$this->correo = $correo;
		$this->password = $password;
		$this->admin = $admin;
		$this->partidasJugadas = $partidasJugadas;
		$this->partidasGanadas = $partidasGanadas;
	}
}