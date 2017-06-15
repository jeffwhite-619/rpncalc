<?php

namespace Operators;

class Cos extends Operator
{
    /**
     * Cos function needs 1 value
     * @return int
     */
    public function getOperandCount()
    {
        return 1;
    }
    
    /**
     * Pop the last value from the operands array and perform cos operation
     * 
     * @param array $operands
     * @return float
     */
    public function evaluate($operands) 
    {
        $this->validate($operands);
        $operand = array_pop($operands);
        $cos = cos($operand);
        return $cos;
    }

}