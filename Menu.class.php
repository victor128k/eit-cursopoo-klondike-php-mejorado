<?php

class Menu
{
	// Ya sé que estas cosas no se comentan, pero en el código original en JAVA se ve la clase de los elementos al declarar el array.
	// En PHP no permite definirlo, por eso pongo este comemntario al final que dice de qué tipo van a ser los elementos del array.
	private array $opciones; // de clase Opcion (array de opciones polimorficas)
	private int $cantidad;
	private Salida $salida;

	public function __construct()
	{
		// Aquí en java inicializa el array $this->opciones a 100 elementos. En PHP no hace falta.
		$this->cantidad = 0;
		$this->salida = new Salida();
	}

	public function anadir(Opcion $opcion): void
	{
		$this->opciones[$this->cantidad] = $opcion;
		$this->cantidad++;
	}

	public function cerrar(): void
	{
		$this->anadir($this->salida);
	}

	public function mostrar(): void
	{
		for ($i = 0; $i < $this->cantidad; $i++)
		{
			$this->opciones[$i]->mostrar($i + 1);
		}
	}

	public function getOpcion(): Opcion
	{
		do
		{
			echo PHP_EOL . 'Opción? [1-' . $this->cantidad . ']: ';
			$opcion = (int)fgets(fopen('php://stdin', 'rb'));
			$error = !(new Intervalo(1, $this->cantidad))->incluye($opcion);
			if ($error)
			{
				echo 'Error!!! La opción debe ser entre 1 y ' . $this->cantidad . PHP_EOL;
			}
		} while ($error);

		return $this->opciones[$opcion - 1];
	}

	public function terminado(): bool
	{
		return $this->salida->ejecutada();
	}
}