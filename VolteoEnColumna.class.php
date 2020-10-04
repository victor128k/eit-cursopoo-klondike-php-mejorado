<?php

class VolteoEnColumna extends OpcionKlondike
{
	public function __construct(Tapete $tapete)
	{
		parent::__construct('Voltear en columna', $tapete);
	}

	public function ejecutar(): void
	{
		$columna = $this->tapete->getColumna($this->recoger('Que columna', Tapete::NUM_COLUMNAS));
		if ($columna->vacia())
		{
			$this->error('No hay cartas en esa columna');
		}
		elseif ($columna->cima()->bocaArriba())
		{
			$this->error('La carta esta boca arriba');
		}
		else
		{
			$columna->cima()->voltear();
		}
	}
}
