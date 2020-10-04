<?php

class Baraja extends Mazo
{
	public const NUM_PALOS = 4;
	public const NUM_NUMEROS = 13;

	public function __construct()
	{
		parent::__construct('Baraja');
		for ($i = 0; $i < self::NUM_PALOS; $i++) // 4 palos
		{
			for ($j = 0; $j < self::NUM_NUMEROS; $j++) // 13 cartas por palo
			{
				$this->poner(new Carta($i, $j));
			}
		}
		$this->barajar();
	}

	private function barajar(): void
	{
		for ($i = 0; $i < 1000; $i++)
		{
			$origen = random_int(0, $this->ultima - 1);
			$destino = random_int(0, $this->ultima - 1);
			$carta = $this->cartas[$origen];
			$this->cartas[$origen] = $this->cartas[$destino];
			$this->cartas[$destino] = $carta;
		}
	}

	protected function mostrarContenido(): void
	{
		$this->cima()->mostrar();
	}

	public function apilable(Carta $carta): bool
	{
		return true;
	}
}
