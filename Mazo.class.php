<?php

abstract class Mazo
{
	protected array $cartas;
	protected int $ultima;
	protected string $titulo;

	protected function __construct(string $titulo)
	{
		$this->ultima = 0;
		$this->titulo = $titulo;
		// Aquí en el ejemplo JAVA, recibe como parámetro un entero $cantidad en el constructor, que se utiliza
		// para dimensioar el array $this->cartas al tamaño máximo de cartas que va a tener el mazo.
		// En PHP no dimensionamos los arrays así que no recibo el parámetro.
	}

	public function getTitulo()
	{
		return $this->titulo;
	}

	public function vacia(): bool
	{
		return $this->ultima === 0;
	}

	protected function completa(): bool
	{
		return $this->ultima === Baraja::NUM_PALOS * Baraja::NUM_NUMEROS;
	}

	public function cima(): Carta
	{
		assert(!$this->vacia());
		return $this->cartas[$this->ultima - 1];
	}

	public function sacar(): Carta
	{
		assert(!$this->vacia());
		$this->ultima--;
		return $this->cartas[$this->ultima];
	}

	public function poner(Carta $carta): void
	{
		assert($carta !== null);
		// assert(!$carta->bocaArriba()); // Este assert aparece en el código original en JAVA, pero cuando pongo en una columna o en un palo, sí
		// que puede ir boca arriba, de modo que lo quitamos.
		assert(!$this->completa());
		$this->cartas[$this->ultima] = $carta;
		$this->ultima++;
	}

	public function mostrar(): void
	{
		echo PHP_EOL . $this->titulo . ': ';
		if ($this->vacia())
		{
			echo '<VACIA>';
		}
		else
		{
			$this->mostrarContenido();
		}
	}

	public function voltear(): void
	{
		for ($i = 0; $i < $this->ultima; $i++)
		{
			$this->cartas[$i]->voltear();
		}
	}

	abstract protected function mostrarContenido();

	abstract public function apilable(Carta $carta): bool;
}