<?php
// Mostrar los errores de php
ini_set('log_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('display_errors', 0);

require_once('Mazo.class.php');
require_once('Opcion.class.php');
require_once('OpcionKlondike.class.php');
require_once('MovimientoOrigenDestino.class.php');
foreach (glob('./*.class.php') as $filename)
{
	require_once $filename;
}

Class Klondike
{
	private Tapete $tapete;
	private Menu $menu;

	public function __construct()
	{
		$this->tapete = new Tapete();
		$this->menu = new Menu();
		$this->menu->anadir(new MovimientoBarajaDescarte($this->tapete));
		$this->menu->anadir(new MovimientoDescartePalo($this->tapete));
		$this->menu->anadir(new MovimientoDescarteColumna($this->tapete));
		$this->menu->anadir(new MovimientoPaloColumna($this->tapete));
		$this->menu->anadir(new MovimientoColumnaPalo($this->tapete));
		$this->menu->anadir(new MovimientoColumnaColumna($this->tapete));
		$this->menu->anadir(new VolteoEnColumna($this->tapete));
		$this->menu->anadir(new MovimientoDescarteBaraja($this->tapete));
		$this->menu->cerrar();
	}

	public function jugar(): void
	{
		do
		{
			$this->tapete->mostrar();
			$this->menu->mostrar();
			$this->menu->getOpcion()->ejecutar();
		} while (!$this->menu->terminado());
	}
}

(new Klondike())->jugar();
