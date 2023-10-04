<?php namespace Partida;


class Partida{
  public $idPartida;
  public $idPersona; 
  public $tablaOculta; 
  public $tablaJugador;
  public $finalizada;

	public function __construct($idPartida, $idPersona, $tablaOculta, $tablaJugador, $finalizada) {

		$this->idPartida = $idPartida;
		$this->idPersona = $idPersona;
		$this->tablaOculta = $tablaOculta;
		$this->tablaJugador = $tablaJugador;
		$this->finalizada = $finalizada;
	}
}