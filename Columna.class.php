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
		foreach ($this->cartas as $carta)
		{
			$carta->mostrar();
		}
	}

	// IMPLEMENTS "abstract public function apilable(Carta $carta): bool" in "Mazo"
	public function apilable(Carta $carta): bool
	{
		assert($carta != null);
		assert($carta->bocaArriba());
		return $this->vacia() && $carta->esRey() ||
			!$this->vacia() && $this->cima()->bocaArriba() &&
			$this->cima()->siguiente($carta) && $this->cima()->distintoColor($carta);
	}

	// OVERRIDES "protected function completa" in "Mazo"
	protected function completa(): bool
	{
		return $this->numeroDeCartas() === Baraja::NUM_NUMEROS;
	}
}