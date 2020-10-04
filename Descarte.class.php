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
		$primeraVisible = $this->ultima - 3;
		if ($primeraVisible < 0)
		{
			$primeraVisible = 0;
		}
		for ($i = $primeraVisible; $i < $this->ultima; $i++)
		{
			$this->cartas[$i]->mostrar();
		}
	}

	public function apilable(Carta $carta): bool
	{
		return true;
	}
}