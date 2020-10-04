<?php

abstract class Opcion
{
	protected string $titulo;

	protected function __construct(string $titulo)
	{
		$this->titulo = $titulo;
	}

	public function mostrar(int $posicion): void
	{
		echo PHP_EOL, $posicion, '. ', $this->titulo;
	}

	abstract public function ejecutar(): void;
}