<?php

namespace Operators;

class Power extends Operator
{
    
    /**
     * Pop the last 2 values from the operands array and get exponent value
     * of the given base to the given power
     * 
     * @param array $operands
     * @return int|float
     */
    public function evaluate($operands) 
    {
        $this->validate($operands);
        $power = array_pop($operands);
        $base = array_pop($operands);
        $pow = $base ** $power; // same as pow(), available in php 5.6+
        return $pow;
    }

}