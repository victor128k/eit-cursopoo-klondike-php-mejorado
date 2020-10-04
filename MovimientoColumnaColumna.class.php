<?php

class MovimientoColumnaColumna extends MovimientoOrigenDestino
{
	private array $columnas;
	private Mano $mano;

	public function __construct(Tapete $tapete)
	{
		parent::__construct('Mover de columna a columna', $tapete);
		$this->mano = new Mano();
	}

	public function ejecutar(): void
	{
		$this->origen = $this->tapete->getColumna($this->recoger('De que columna', Tapete::NUM_COLUMNAS));

		if ($this->origen->vacia())
		{
			$this->error('No hay cartas en ' . $this->origen->getTitulo());
		}
		elseif ($this->origen->numeroDeCartasBocaArriba() < 1)
		{
			$this->error('No hay cartas boca arriba en ' . $this->origen->getTitulo());
		}
		elseif ($this->origen->numeroDeCartasBocaArriba() === 1)
		{
			$this->destino = $this->tapete->getColumna($this->recoger('A que columna', Tapete::NUM_COLUMNAS));
			parent::ejecutar();
		}
		else
		{
			$this->mano->coger(
				$this->origen,
				$this->recoger('Cuantas cartas', $this->origen->numeroDeCartasBocaArriba()) + 1
			);

			$this->destino = $this->tapete->getColumna($this->recoger('A que columna', Tapete::NUM_COLUMNAS));

			if ($this->destino->apilable($this->mano->cima()))
			{
				$this->mano->dejar($this->destino);
			}
			else
			{
				$this->mano->dejar($this->origen);
				$this->error('No se puede realizar ese movimiento');
			}
		}
	}
}
