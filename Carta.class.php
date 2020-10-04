<?php

class Carta
{
	private int $palo; // 0 - Picas, 1 - Treboles, 2 - Diamantes, 3 - Corazones
	private int $numero; // [0-12]
	private bool $bocaArriba; // (bool)
	private const PALOS = array('Picas', 'Treboles', 'Diamantes', 'Corazones'); // 0: Picas, 1: Treboles, 2: Diamantes, 3: Corazones
	// private const NEGROS = new Intervalo(0,1); // No permitido en PHP
	// private const ROJOS = new Intervalo(0,1); // En el ejemplo original en JAVA sería así, pero en PHP no está permitido, así que
	// lo hago así:
	private static Intervalo $negros;
	private static Intervalo $rojos;
	private const NUMEROS = array('As', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K');

	public function __construct(int $palo, int $numero)
	{
		assert((new Intervalo(0, Baraja::NUM_PALOS - 1))->incluye($palo));
		assert((new Intervalo(0, Baraja::NUM_NUMEROS - 1))->incluye($numero));
		$this->palo = $palo;
		$this->numero = $numero;
		$this->bocaArriba = false;
		self::$negros = new Intervalo(0, 1);
		self::$rojos = new Intervalo(2, 3);
	}

	public function bocaArriba(): bool
	{
		return $this->bocaArriba;
	}

	public function voltear(): void
	{
		$this->bocaArriba = !$this->bocaArriba;
	}

	public function esAs(): bool
	{
		return $this->numero === 0;
	}

	public function esRey(): bool
	{
		return $this->numero === 12;
	}

	public function siguiente(Carta $carta): bool
	{
		assert($carta !== null);
		return $this->numero === $carta->numero + 1;
	}

	public function igualPalo(Carta $carta): bool
	{
		assert($carta !== null);
		return $this->palo === $carta->palo;
	}

	public function distintoColor(Carta $carta): bool
	{
		assert($carta !== null);
		return $this->rojo() && $carta->negro() || $this->negro() && $carta->rojo();
	}

	private function rojo(): bool
	{
		return self::$rojos->incluye($this->palo);
	}

	private function negro(): bool
	{
		return self::$negros->incluye($this->palo);
	}

	public function mostrar(): void
	{
		$numero = '???'; // símbolos escogidos para mostrar las cartas boca abajo. Sí, es muy feo.
		$palo = '???';
		if ($this->bocaArriba)
		{
			$numero = self::NUMEROS[$this->numero];
			$palo = self::PALOS[$this->palo];
		}
		echo '(' . $numero . ' de ' . $palo . ')';
	}
}