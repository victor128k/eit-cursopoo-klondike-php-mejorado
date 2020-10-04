<?php

class MovimientoBarajaDescarte extends OpcionKlondike
{
	public function __construct(Tapete $tapete)
	{
		parent::__construct('Mover de baraja a descarte', $tapete);
	}

	public function ejecutar(): void
	{
		if ($this->tapete->getBaraja()->vacia())
		{
			$this->error('No hay cartas en baraja');
		}
		else
		{
			$contador = 3;
			while ($contador > 0 && !$this->tapete->getBaraja()->vacia())
			{
				$carta = $this->tapete->getBaraja()->sacar();
				$carta->voltear();
				$this->tapete->getDescarte()->poner($carta);
				$contador--;
			}
		}
	}
}
