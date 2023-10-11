<?php namespace Partida;


class Partida{
  public $idPartida;
  public $idPersona; 
  public $tablaOculta; 
  public $tablaJugador;
  public $finalizada;

	public function __construct($idPersona, $tablaOculta, $tablaJugador, $finalizada) {

		$this->idPersona = $idPersona;
		$this->tablaOculta = $tablaOculta;
		$this->tablaJugador = $tablaJugador;
    /**
     * -1 La partida esta acabada y perdida
     *  0 La partida esta en curso
     *  1 La partida esta acabada y ganada
    */
		$this->finalizada = $finalizada;
	}
}