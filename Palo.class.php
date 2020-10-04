<?php

class Palo extends Mazo
{
	public function __construct()
	{
		parent::__construct('Palo');
	}

	protected function mostrarContenido()
	{
		$this->cima()->mostrar();
	}

	public function apilable(Carta $carta): bool
	{
		assert($carta != null);
		assert($carta->bocaArriba());
		return $this->vacia() && $carta->esAs() ||
			!$this->vacia() && $carta->siguiente($this->cima()) && $carta->igualPalo($this->cima());
	}
}
