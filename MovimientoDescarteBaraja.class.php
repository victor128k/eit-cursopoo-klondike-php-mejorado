<?php

class MovimientoDescarteBaraja extends MovimientoOrigenDestino
{
	public function __construct(Tapete $tapete)
	{
		parent::__construct('Mover de descarte a baraja', $tapete);
	}

	public function ejecutar(): void
	{
		if (!$this->tapete->getBaraja()->vacia())
		{
			$this->error('La baraja no esta vacia');
		}
		else
		{
			$this->origen = $this->tapete->getDescarte();
			$this->destino = $this->tapete->getBaraja();
			while (!$this->origen->vacia())
			{
				parent::ejecutar();
			}
			$this->destino->voltear();
		}
	}
}
