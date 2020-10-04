<?php

class Palo extends Mazo
{
	public function __construct()
	{
		parent::__construct('Palo');
	}

	// IMPLEMENTS "abstract public function apilable(Carta $carta): bool" in "Mazo"
	public function apilable(Carta $carta): bool
	{
		assert($carta != null);
		assert($carta->bocaArriba());
		return $this->vacia() && $carta->esAs() ||
			!$this->vacia() && $carta->siguiente($this->cima()) && $carta->igualPalo($this->cima());
	}

	// OVERRIDES "protected function completa" in "Mazo"
	protected function completa(): bool
	{
		return $this->numeroDeCartas() === Baraja::NUM_NUMEROS;
	}
}
