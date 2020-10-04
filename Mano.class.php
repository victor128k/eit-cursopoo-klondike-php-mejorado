<?php

class Mano extends Mazo
{
	public function __construct()
	{
		parent::__construct('Mano');
	}

	public function apilable(Carta $carta): bool
	{
		assert($carta !== null);
		assert($carta->bocaArriba());
		return true;
	}

	public function puedoCoger(Mazo $mazo, int $cuantasQuieroCoger): bool
	{
		assert(!$mazo->vacia());
		return $cuantasQuieroCoger <= $mazo->numeroDeCartasBocaArriba();
	}

	public function coger(Mazo $mazo, int $numeroDeCartas): void
	{
		assert($this->puedoCoger($mazo, $numeroDeCartas));
		for ($i = 0; $i < $numeroDeCartas; $i++)
		{
			$this->poner($mazo->sacar());
		}
	}

	public function dejar(Mazo $mazo)
	{
		while (!$this->vacia())
		{
			$mazo->poner($this->sacar());
		}
	}
}
