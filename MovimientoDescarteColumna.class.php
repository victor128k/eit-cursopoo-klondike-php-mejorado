<?php

class MovimientoDescarteColumna extends MovimientoOrigenDestino
{
	public function __construct(Tapete $tapete)
	{
		parent::__construct('Mover de descarte a columna', $tapete);
	}

	public function ejecutar(): void
	{
		$this->origen = $this->tapete->getDescarte();
		$this->destino = $this->tapete->getColumna($this->recoger('A que columna', Tapete::NUM_COLUMNAS));
		parent::ejecutar();
	}
}
