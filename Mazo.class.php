<?php

abstract class Mazo
{
	protected array $cartas; // array de (Carta)
	protected string $titulo;

	public function __construct(string $titulo)
	{
		$this->cartas = array();
		$this->titulo = $titulo;
	}

	public function getTitulo(): string
	{
		return $this->titulo;
	}

	public function vacia(): bool
	{
		return $this->numeroDeCartas() === 0;
	}

	public function numeroDeCartas(): int
	{
		return count($this->cartas);
	}

	protected function completa(): bool
	{
		return $this->numeroDeCartas() === Baraja::NUM_PALOS * Baraja::NUM_NUMEROS;
	}

	public function cima(): Carta
	{
		assert(!$this->vacia());
		return end($this->cartas);
	}

	public function sacar(): Carta
	{
		assert(!$this->vacia());
		return array_pop($this->cartas);
	}

	public function poner(Carta $carta): void
	{
		assert($carta !== null);
		assert(!$this->completa());
		$this->cartas[] = $carta;
	}

	public function voltearCartas(): void
	{
		foreach ($this->cartas as $carta)
		{
			$carta->voltear();
		}
	}

	public function numeroDeCartasBocaArriba(): int
	{
		assert(!$this->vacia());
		$numCartas = $this->numeroDeCartas();
		$i = $numCartas;
		while ($i > 0 && $this->cartas[$i - 1]->bocaArriba())
		{
			$i--;
		}
		return $numCartas - $i;
	}

	abstract public function apilable(Carta $carta): bool;
}