<?php

class MovimientoPaloColumna extends MovimientoOrigenDestino
{
	public function __construct(Tapete $tapete)
	{
		parent::__construct('Mover de palo a columna', $tapete);
	}

	public function ejecutar(): void
	{
		$this->origen = $this->tapete->getPalo($this->recoger('De que palo', Baraja::NUM_PALOS));
		$this->destino = $this->tapete->getColumna($this->recoger('De que columna', Tapete::NUM_COLUMNAS));
		parent::ejecutar();
	}
}
