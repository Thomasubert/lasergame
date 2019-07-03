<?php


namespace App\Service;


class CardGenerator
{

    private $codeCentre = 123;
    private $codeCarte = 0;
    private $checkMod = 0;

    /**
     * Generate Card Number
     * @param int $numberDigit
     * @param int $numberModulo
     * @return int
     */
    public function generate(int $numberDigit, int $numberModulo): iterable
    {

        # Generate card code
        $this->codeCarte = $this->intCodeRandom($numberDigit);

        # Check modulo
        $this->checkMod = ($this->codeCentre + $this->codeCarte) % $numberModulo;

        # Return card code
        return [
            'card_number' => $this->codeCentre . $this->codeCarte . $this->checkMod,
            'codeCentre' => $this->codeCentre,
            'codeCarte' => $this->codeCarte,
            'checkMod' => $this->checkMod,
        ];
    }

    private function intCodeRandom($length)
    {
        $intMin = (10 ** $length) / 10; // 100...
        $intMax = (10 ** $length) - 1;  // 999...

        $codeRandom = mt_rand($intMin, $intMax);

        return $codeRandom;
    }

}