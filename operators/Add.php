<?php

namespace Operators;

class Add extends Operator
{
    
    /**
     * Pop the last 2 values from the operands array and perform addition
     * 
     * @param array $operands
     * @return int|float
     */
    public function evaluate($operands) 
    {
        $this->validate($operands);
        $augend = array_pop($operands);
        $addend = array_pop($operands);
        $sum = $augend + $addend;
        return $sum;
    }

}