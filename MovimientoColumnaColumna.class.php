<?php

class MovimientoColumnaColumna extends MovimientoOrigenDestino
{
	private array $columnas;

	public function __construct(Tapete $tapete)
	{
		parent::__construct('Mover de columna a columna', $tapete);
	}

	public function ejecutar(): void
	{
		$this->origen = $this->tapete->getColumna($this->recoger('De que columna', Tapete::NUM_COLUMNAS));
		$this->destino = $this->tapete->getColumna($this->recoger('A que columna', Tapete::NUM_COLUMNAS));
		parent::ejecutar();
	}
}
