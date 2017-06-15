<?php

namespace Operators;

class Subtract extends Operator
{
    
    /**
     * Pop the last 2 values from the operands array and perform subtraction
     * 
     * @param array $operands
     * @return int|float
     */
    public function evaluate($operands) 
    {
        $this->validate($operands);
        $minuend = array_pop($operands);
        $subtrahend = array_pop($operands);
        $difference = $subtrahend - $minuend;
        return $difference;
    }

}