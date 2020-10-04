<?php

class Columna extends Mazo
{
	public function __construct(int $posicion, Baraja $baraja)
	{
		parent::__construct('Columna' . $posicion);
		for ($i = 0; $i < $posicion; $i++)
		{
			$carta = $baraja->sacar();
			if ($i === $posicion - 1)
			{
				$carta->voltear();
			}
			$this->poner($carta);
		}
	}

	protected function mostrarContenido(): void
	{
		for ($i = 0; $i < $this->ultima; $i++)
		{
			$this->cartas[$i]->mostrar();
		}
	}

	public function apilable(Carta $carta): bool
	{
		assert($carta != null);
		assert($carta->bocaArriba());
		return $this->vacia() && $carta->esRey() ||
			!$this->vacia() && $this->cima()->bocaArriba() &&
			$this->cima()->siguiente($carta) && $this->cima()->distintoColor($carta);
	}
}