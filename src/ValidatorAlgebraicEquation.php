<?php

namespace Hitenok;

use InvalidArgumentException;

class ValidatorAlgebraicEquation
{
    public function isCorrectnessParentheses(string $equation)
    {
        $this->checkCorrectSymbols($equation);
        
        if (!$this->checkQuantityParentheses($equation)) {
            return false;
        }

        $length = strlen($equation);
        $numberOpeningParenthesis = 0;
        for ($i = 0; $i < $length; $i++) {
            if ($equation[$i] == '(') {
                $numberOpeningParenthesis++;
            } elseif ($equation[$i] == ')') {
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

    protected function checkQuantityParentheses($equation)
    {
        return substr_count($equation, '(') == substr_count($equation, ')');
    }

    protected function checkCorrectSymbols($equation)
    {
        if (preg_match('/[^() \t\n\r]/', $equation, $matches)) {
            throw new InvalidArgumentException('The equation contains invalid characters');
        }
    }
}