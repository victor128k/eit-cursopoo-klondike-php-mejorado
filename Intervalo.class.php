<?php

class Intervalo
{
	private $inferior;
	private $superior;
	// ---JAVA---> En java el constructor se llama como la clase y puedo sobrecargarlo igual que cualquier otro método.
	// En PHP no hay sobrecarga de métodos ni constructores de modo que lo hacemos de este modo tan artesanal (y feo):
	public function __construct(...$arguments)
	{
		$numArgs = count($arguments);

		if ($numArgs === 2 && is_numeric($arguments[0]) && is_numeric($arguments[1]))
		{
			$this->constructExtremos(...$arguments);
		}
		elseif ($numArgs === 0)
		{
			$this->constructCero();
		}
		elseif ($numArgs === 1 && is_numeric($arguments[0]))
		{
			$this->constructCeroExtremo(...$arguments);
		}
		elseif ($numArgs === 1 && is_object($arguments[0]))
		{
			$this->constructSameClassObject(...$arguments);
		}
		else
		{
			throw new Exception('Invalid parameters');
		}
	}

	private function constructExtremos($inferior, $superior): void
	{
		assert($inferior <= $superior, new Exception('El extremo inferior no puede ser mayor que el superior.'));
		$this->inferior = $inferior;
		$this->superior = $superior;
	}

	private function constructCero(): void
	{
		$this->constructExtremos(0, 0);
	}

	private function constructCeroExtremo($extremo): void
	{
		if ($extremo > 0)
		{
			$this->constructExtremos(0, $extremo);
		}
		else
		{
			$this->constructExtremos($extremo, 0);
		}
	}

	private function constructSameClassObject(self $intervalo): void
	{
		$this->constructExtremos($intervalo->inferior, $intervalo->superior);
	}

	public function clone(): Intervalo
	{
		return new Intervalo($this);
	}

	public function longitud()
	{
		return $this->superior - $this->inferior;
	}

	public function desplazar($desplazamiento): void
	{
		$this->inferior += $desplazamiento;
		$this->superior += $desplazamiento;
	}

	public function desplazado($desplazamiento): self
	{
		$intervalo = $this->clone();
		$intervalo->desplazar($desplazamiento);
		return ($intervalo);
	}

	public function equals(self $intervalo): bool
	{
		return ($this->inferior === $intervalo->inferior and $this->superior === $intervalo->superior);
	}

	public function interseccion(Intervalo $intervalo): self
	{
		assert($this->intersecta($intervalo));

		if ($this->incluye($intervalo))
		{
			return $intervalo->clone();
		}

		if ($intervalo->incluye($this))
		{
			return $this->clone();
		}

		if ($this->incluye($intervalo->inferior))
		{
			return new Intervalo($intervalo->inferior, $this->superior);
		}

		return new Intervalo($this->inferior, $intervalo->superior);
	}

	public function intersecta(self $intervalo)// devuelve boolean
	{
		assert(!empty($intervalo));

		return $this->incluye($intervalo->inferior) or $this->incluye($intervalo->superior) or $intervalo->incluye($this);
	}

	public function oponer()
	{
		// convertirme en mi intervalo simétrico respecto al 0.
		$inferiorInicial = $this->inferior;
		$superiorInicial = $this->superior;
		$this->inferior = -$superiorInicial;
		$this->superior = -$inferiorInicial;
	}

	public function doblar()
	{
		$longitudInicial = $this->longitud();
		$this->inferior -= $longitudInicial / 2;
		$this->superior += $longitudInicial / 2;
	}

	public function recoger(): void
	{
		print("\nIntroduce extremo inferior: ");
		$this->inferior = (float)fgets(fopen("php://stdin", "r"));
		print("Introduce extremo superior: ");
		$this->superior = (float)fgets(fopen("php://stdin", "r"));
		print("\n");
	}

	public function mostrar(): void
	{
		print($this->toString());
	}

	public function trocear($numeroTrozos): array
	{
		assert(is_int($numeroTrozos) && $numeroTrozos > 0);

		$longitudTrozo = $this->longitud() / $numeroTrozos;
		$intervalos = array();
		$inferior = $this->inferior;

		for ($i = 1; $i <= $numeroTrozos; $i++)
		{
			$intervalos[] = new Intervalo($inferior, $inferior + $longitudTrozo);
			$inferior += $longitudTrozo;
		}
		return $intervalos;
	}

	public function saluda()
	{
		print(PHP_EOL . "Hola!" . PHP_EOL);
	}

	// ------- SOBRECARGA de métodos:
	// ---JAVA---> Puedo poner el mismo nombre de método si el número o tipo de parámetros es diferente
	// ---PHP---> No puedo poner el mismo nombre. Puedo simularlo haciendo uno que llame luego a otros según los parámetros que le lleguen.
	// En php lo hacemos de esta forma tan entretenida y pintoresca:
	public function incluye(...$arguments): bool
	{
		// Podríamos usar (y suele hacerse) func_get_args() para obtener los parámetros de entrada a la función, y dejar la cabecera de la función
		// sin argumentos de entrada. Pero me parece más claro (por legibilidad) que se vea que sí que hay argumentos de entrada.
		// Lo de los 3 puntos en PHP se llama "splat operator": https://www.php.net/manual/en/functions.arguments.php#functions.variable-arg-list
		$numArgs = count($arguments);

		if ($numArgs === 1 && is_object($arguments[0]))
		{
			return $this->incluyeIntervalo(...$arguments);
		}

		if ($numArgs === 1 && is_numeric($arguments[0]))
		{
			return $this->incluyeValor(...$arguments);
		}

		throw new Exception('Invalid parameters');
	}

	private function incluyeValor($valor): bool
	{
		return ($this->inferior <= $valor && $valor <= $this->superior);
	}

	private function incluyeIntervalo(self $intervalo): bool
	{
		assert(!empty($intervalo));
		// return($this->inferior <= $intervalo->inferior and $intervalo->superior <= $this->superior);
		// La anterior línea fue mi primera solución... pero luego he visto que es mucho mejor la siguiente: ***>
		return ($this->incluye($intervalo->inferior) && $this->incluye($intervalo->superior));
		// Esto es así por lo mismo de siempre, reutilizamos el código y si cambia el método incluye, no tengo que cambiar nada aquí
		// De otra forma si cambia la definición de "inclusión" voy a tener que revisar todos los sitios donde haga un cálculo de este estilo en mi
		// código.
	}

	public function toString(): string
	{
		return '[' . $this->inferior . ',' . $this->superior . ']';
	}
}
