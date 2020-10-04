<?php

class MovimientoColumnaPalo extends MovimientoOrigenDestino
{
	public function __construct(Tapete $tapete)
	{
		parent::__construct('Mover de columna a palo', $tapete);
	}

	public function ejecutar(): void
	{
		$this->origen = $this->tapete->getColumna($this->recoger('De que columna', Tapete::NUM_COLUMNAS));
		$this->destino = $this->tapete->getPalo($this->recoger('A que palo', Baraja::NUM_PALOS));
		parent::ejecutar();
	}
}