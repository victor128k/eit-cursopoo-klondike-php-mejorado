<?php

class MovimientoOrigenDestino extends OpcionKlondike
{
	protected Mazo $origen;
	protected Mazo $destino;

	protected function __construct(string $titulo, Tapete $tapete)
	{
		parent::__construct($titulo, $tapete);
	}

	public function ejecutar(): void
	{
		if ($this->origen->vacia())
		{
			$this->error('No hay cartas en ' . $this->origen->getTitulo());
		}
		else
		{
			$carta = $this->origen->sacar();
			if ($this->destino->apilable($carta))
			{
				$this->destino->poner($carta);
			}
			else
			{
				$this->origen->poner($carta);
				$this->error('No se puede realizar ese movimiento');
			}
		}
	}
}