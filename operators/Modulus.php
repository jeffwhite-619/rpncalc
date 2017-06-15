<?php

namespace Operators;

class Modulus extends Operator
{
    
    /**
     * Pop the last 2 values from the operands array and perform a modulus operation
     * 
     * @param array $operands
     * @return int
     */
    public function evaluate($operands) 
    {
        $this->validate($operands);
        $divisor = array_pop($operands);
        $dividend = array_pop($operands);
        $modulo = $dividend % $divisor;
        return $modulo;
    }

}