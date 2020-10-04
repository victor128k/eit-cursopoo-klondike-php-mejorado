<?php declare(strict_types=1);

class DrawingTapete
{
	private Tapete $tapete;
	private const LINEAS = 40;
	private const COLUMNAS = 76;
	private array $surface = array();
	private const BACKGROUND = array(
		'     B               E                              Palos',
		'  Baraja         dEscarte            P1         P2         P3         P4',
		' · · · · ·   · · · · ·            · · · · ·  · · · · ·  · · · · ·  · · · · ·',
		' ·       ·   ·       ·            ·       ·  ·       ·  ·       ·  ·       ·',
		' ·       ·   ·       ·            ·       ·  ·       ·  ·       ·  ·       ·',
		' ·       ·   ·       ·            ·       ·  ·       ·  ·       ·  ·       ·',
		' ·       ·   ·       ·            ·       ·  ·       ·  ·       ·  ·       ·',
		' · · · · ·   · · · · ·            · · · · ·  · · · · ·  · · · · ·  · · · · ·',
		'',
		'     1          2          3          4          5          6          7',
		' · · · · ·  · · · · ·  · · · · ·  · · · · ·  · · · · ·  · · · · ·  · · · · ·',
		' ·       ·  ·       ·  ·       ·  ·       ·  ·       ·  ·       ·  ·       ·',
		' ·       ·  ·       ·  ·       ·  ·       ·  ·       ·  ·       ·  ·       ·',
		' ·       ·  ·       ·  ·       ·  ·       ·  ·       ·  ·       ·  ·       ·',
		' ·       ·  ·       ·  ·       ·  ·       ·  ·       ·  ·       ·  ·       ·',
		' · · · · ·  · · · · ·  · · · · ·  · · · · ·  · · · · ·  · · · · ·  · · · · ·'
	);
	private const CARD_FRAME = array(
		',-------.',    // ,-------.
		'|       |',    // | 5P (N)|
		'|       |',    // |       |
		'|       |',    // |       |
		'|       |',    // |(N)    |
		'`-------´'     // `-------´
	);
	// ###################> estudiar si tendría alguna ventaja usar la clase Coordenada aquí
	private const ELEMENT_COORDINATE = array(
		'stock'       => array(2, 1),  // baraja
		'waste'       => array(2, 13), // descarte
		'foundations' => array(array(2, 34), array(2, 45), array(2, 56), array(2, 67)), // palos
		'piles'       => array(array(10, 1), array(10, 12), array(10, 23), array(10, 34), array(10, 45), array(10, 56), array(10, 67)) // columnas
	);

	public function __construct(Tapete $tapete)
	{
		$this->tapete = $tapete;
		$this->clear();
		$this->fillInBackground();
	}

	public function show(): void
	{
		$this->paintStock($this->tapete->getBaraja());
		$this->paintWaste($this->tapete->getDescarte());
		$this->paintFoundations($this->tapete->getPalos());
		$this->paintPiles($this->tapete->getColumnas());

		echo PHP_EOL;
		foreach ($this->surface as $line)
		{
			echo implode($line) . PHP_EOL;
		}
	}

	private function clear(): void
	{
		for ($i = 0; $i < self::LINEAS; $i++)
		{
			for ($j = 0; $j < self::COLUMNAS; $j++)
			{
				$this->surface[$i][$j] = ' ';
			}
		}
	}

	private function fillInBackground(): void
	{
		foreach (self::BACKGROUND as $lineNumber => $lineText)
		{
			$characters = preg_split('//u', $lineText, 0, PREG_SPLIT_NO_EMPTY);
			foreach ($characters as $charIdx => $char)
			{
				$this->surface[$lineNumber][$charIdx] = $char;
			}
		}
	}

	public function paintStock(Baraja $stock): void
	{
		assert($stock !== null);
		$this->clear();
		$this->fillInBackground();
		if (!$stock->vacia())
		{
			$this->fillIn($this->drawCard($stock->cima()), self::ELEMENT_COORDINATE['stock']);
		}
	}

	public function paintWaste(Descarte $waste): void
	{
		assert($waste !== null);
		if (!$waste->vacia())
		{
			$cards = $waste->getVisibleCards();
			$rightShift = 0;
			foreach ($cards as $card)
			{
				$this->fillIn($this->drawCard($card), array(
					self::ELEMENT_COORDINATE['waste'][0],
					self::ELEMENT_COORDINATE['waste'][1] + $rightShift
				));
				$rightShift += 4;
			}
		}
	}

	public function paintFoundations(array $foundations): void
	{
		assert($foundations !== null);
		foreach ($foundations as $foundationIdx => $foundation)
		{
			if (!$foundation->vacia())
			{
				$this->fillIn($this->drawCard($foundation->cima()), self::ELEMENT_COORDINATE['foundations'][$foundationIdx]);
			}
		}
	}

	public function paintPiles(array $piles): void
	{
		assert($piles !== null);
		foreach ($piles as $pileIdx => $pile)
		{
			if (!$pile->vacia())
			{
				$this->paintPile($pile, $pileIdx);
			}
		}
	}

	private function paintPile(Columna $pile, int $pileIndex): void
	{
		$downShift = 0;
		$cards = $pile->getVisibleCards();
		foreach ($cards as $card)
		{
			$this->fillIn($this->drawCard($card), array(
				self::ELEMENT_COORDINATE['piles'][$pileIndex][0] + $downShift,
				self::ELEMENT_COORDINATE['piles'][$pileIndex][1]
			));
			if ($card->bocaArriba())
			{
				$downShift += 2;
			}
			else
			{
				$downShift += 1;
			}
		}
	}

	private function drawCard(Carta $card): array
	{
		assert($card !== null);
		$cardDrawing = self::CARD_FRAME;
		if ($card->bocaArriba())
		{
			$drawingSurface = $this->obtainDrawingSurface($cardDrawing);
			$cardDigits = $this->calculateCardDigits($card);
			$drawingSurface[1][1] = $cardDigits[0];
			$drawingSurface[1][2] = $cardDigits[1];
			$drawingSurface[1][3] = Carta::LETRAS_PALOS[$card->getPalo()];
			$drawingSurface[1][5] = '(';
			$drawingSurface[1][6] = $card->getColorChar();
			$drawingSurface[1][7] = ')';
			$drawingSurface[4][1] = '(';
			$drawingSurface[4][2] = $card->getColorChar();
			$drawingSurface[4][3] = ')';
			$cardDrawing = $this->obtainDrawing($drawingSurface);
		}
		return $cardDrawing;
	}

	private function obtainDrawingSurface(array $lines): array
	{
		assert($lines !== null);
		$drawingSurface = array();
		foreach ($lines as $lineIdx => $line)
		{
			$drawingSurface[$lineIdx] = preg_split('//u', $line, 0, PREG_SPLIT_NO_EMPTY);
		}
		return $drawingSurface;
	}

	private function obtainDrawing(array $drawingSurface): array
	{
		assert($drawingSurface !== null);
		$lines = array();
		foreach ($drawingSurface as $rowIdx => $row)
		{
			$lines[$rowIdx] = implode($row);
		}
		return $lines;
	}

	private function calculateCardDigits(Carta $card): array
	{
		$result = array();
		$digits = preg_split('//u', Carta::NUMEROS[$card->getNumero()], 0, PREG_SPLIT_NO_EMPTY);
		$result[0] = isset($digits[1]) ? $digits[0] : ' ';
		$result[1] = $digits[1] ?? $digits[0]; // null coalescing operator. Es lo mismo que: isset($digits[1]) ? $digits[1] : $digits[0];
		return $result;
	}

	private function fillIn(array $lines, array $coordinates): void
	{
		foreach ($lines as $lineIdx => $line)
		{
			$row = preg_split('//u', $line, 0, PREG_SPLIT_NO_EMPTY);
			foreach ($row as $rowIdx => $char)
			{
				$this->surface[$coordinates[0] + $lineIdx][$coordinates[1] + $rowIdx] = $char;
			}
		}
	}
}
