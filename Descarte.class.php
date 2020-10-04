<?php

class Descarte extends Mazo
{
	// Aquí en JAVA tiene un constructor que llama al de la clase padre con el número de cartas para inicializar el array de cartas
	// En PHP directamente no lo ponemos ya que no necesitamos inicializar los arrays

	public function __construct()
	{
		parent::__construct('Descarte');
	}

	protected function mostrarContenido(): void
	{
		$primeraVisible = $this->numeroDeCartas() - 3;
		if ($primeraVisible < 0)
		{
			$primeraVisible = 0;
		}
		for ($i = $primeraVisible; $i < $this->numeroDeCartas(); $i++)
		{
			$this->cartas[$i]->mostrar();
		}
	}

	// IMPLEMENTS "abstract public function apilable(Carta $carta): bool" in "Mazo"
	public function apilable(Carta $carta): bool
	{
		return true;
	}
}