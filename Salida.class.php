<?php

class Salida extends Opcion
{
	private bool $ejecutada;

	public function __construct()
	{
		parent::__construct('Salir');
		$this->ejecutada = false;
	}

	public function ejecutar(): void
	{
		$this->ejecutada = true;
	}

	public function ejecutada(): bool
	{
		return $this->ejecutada;
	}
}