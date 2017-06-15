<?php

namespace Operators;

class Multiply extends Operator
{
    
    /**
     * Pop the last 2 values from the operands array and perform multiplication
     * 
     * @param array $operands
     * @return int|float
     */
    public function evaluate($operands) 
    {
        $this->validate($operands);
        $multiplier = array_pop($operands);
        $multiplicand = array_pop($operands);
        $product = $multiplicand * $multiplier;
        return $product;
    }

}