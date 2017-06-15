<?php

namespace Operators;

class Divide extends Operator
{
    
    /**
     * Pop the last 2 values from the operands array and perform division
     * Unlike other basic math operations, the order matters here
     * 
     * @param array $operands
     * @return int|float
     */
    public function evaluate($operands) 
    {
        $this->validate($operands);
        $divisor = array_pop($operands);
        if (0 === $divisor) {
            throw new Exception("Warning! Divide by zero error detected. "
                    . " Please try a different postfix expression.", 500);
        }
        $dividend = array_pop($operands);
        $quotient = $dividend / $divisor;
        return $quotient;
    }

}