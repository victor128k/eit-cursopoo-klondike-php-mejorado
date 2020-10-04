<?php

class MovimientoDescartePalo extends MovimientoOrigenDestino
{
	public function __construct(Tapete $tapete)
	{
		parent::__construct('Mover de descarte a palo', $tapete);
	}

	public function ejecutar(): void
	{
		$this->origen = $this->tapete->getDescarte();
		$this->destino = $this->tapete->getPalo($this->recoger('A que palo', Baraja::NUM_PALOS));
		parent::ejecutar();
	}
}
