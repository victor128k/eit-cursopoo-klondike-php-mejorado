<?php

abstract class OpcionKlondike extends Opcion
{
	protected Tapete $tapete;

	protected function __construct(string $titulo, Tapete $tapete)
	{
		parent::__construct($titulo);
		$this->tapete = $tapete;
	}

	protected function error(string $mensaje): void
	{
		echo 'Error!!! ', $mensaje;
	}

	protected function recoger(string $mensaje, int $tope): int
	{
		do
		{
			echo '¿', $mensaje, '? [1-', $tope, ']: ';
			$posicion = (int)fgets(fopen('php://stdin', 'rb'));
			$error = !(new Intervalo(1, $tope))->incluye($posicion);
			if ($error)
			{
				$this->error('Debe ser un numero entre 1 y ' . $tope . PHP_EOL);
			}
		} while ($error);
		return $posicion - 1;
	}
}
