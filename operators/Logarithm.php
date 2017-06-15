<?php

namespace Operators;

class Logarithm extends Operator
{
    
    /**
     * Pop the last 2 values from the operands array and perform addition
     * 
     * @param array $operands
     * @return int|float
     */
    public function evaluate($operands, $useBase = false) 
    {
        $this->validate($operands);
        $base = M_E;
        if ($useBase) {
            $base = array_pop($operands);
        }
        $operand = array_pop($operands);
        $log = log($operand, $base);
        return $log;
    }

}