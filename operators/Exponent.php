<?php

namespace Operators;

class Exponent extends Operator
{
    
    /**
     * Exp function needs 1 value
     * @return int
     */
    public function getOperandCount()
    {
        return 1;
    }
    
    /**
     * Pop the last value from the operands array and get exponent of 'e'
     * raised to the given power
     * 
     * @param array $operands
     * @return int|float
     */
    public function evaluate($operands) 
    {
        $this->validate($operands);
        $power = array_pop($operands);
        $exponent = exp($power);
        return $exponent;
    }

}