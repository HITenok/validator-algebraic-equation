<?php

namespace Hitenok;

use InvalidArgumentException;

class ValidatorAlgebraicEquation
{
    private $equation;

    public function __construct(string $equation)
    {
        $this->checkCorrectSymbols($equation);
        $this->equation = $equation;
    }

    public function isCorrectnessParentheses()
    {
        if (!$this->checkQuantityParentheses()) {
            return false;
        }

        $length = strlen($this->equation);
        $numberOpeningParenthesis = 0;
        for ($i = 0; $i < $length; $i++) {
            if ($this->equation[$i] == '(') {
                $numberOpeningParenthesis++;
            } elseif ($this->equation[$i] == ')') {
                $numberOpeningParenthesis--;
            } else {
                continue;
            }

            if ($numberOpeningParenthesis < 0) {
                return false;
            }
        }

        return true;
    }

    protected function checkQuantityParentheses()
    {
        return substr_count($this->equation, '(') == substr_count($this->equation, ')');
    }

    protected function checkCorrectSymbols($equation)
    {
        if (preg_match('/[^() \t\n\r]/', $equation, $matches)) {
            throw new InvalidArgumentException('The equation contains invalid characters');
        }
    }
}