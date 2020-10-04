<?php

class Tapete
{
	private array $mazos; // array de objetos de tipo mazo.
	public const NUM_COLUMNAS = 7;

	public function __construct()
	{
		$this->mazos[0] = new Baraja();
		$this->mazos[1] = new Descarte();
		for ($i = 0; $i < Baraja::NUM_PALOS; $i++)
		{
			$this->mazos[$i + 2] = new Palo();
		}
		for ($i = 0; $i < self::NUM_COLUMNAS; $i++)
		{
			$this->mazos[$i + 6] = new Columna($i + 1, $this->getBaraja());
		}
	}

	public function getBaraja(): Baraja
	{
		return $this->mazos[0];
	}

	public function getDescarte(): Descarte
	{
		return $this->mazos[1];
	}

	public function getPalo(int $posicion): Palo
	{
		return $this->mazos[$posicion + 2];
	}

	public function getPalos(): array
	{
		$palos = array();

		for ($i = 0; $i < Baraja::NUM_PALOS; $i++)
		{
			$palos[] = $this->getPalo($i);
		}

		return $palos;
	}

	public function getColumna(int $posicion): Columna
	{
		return $this->mazos[$posicion + 6];
	}

	public function getColumnas(): array
	{
		$columnas = array();

		for ($i = 0; $i < Tapete::NUM_COLUMNAS; $i++)
		{
			$columnas[] = $this->getColumna($i);
		}

		return $columnas;
	}

	public function mostrar(): void
	{
		(new DrawingTapete($this))->show();
	}
}
