<?php

namespace Operators;

class Sin extends Operator
{
    /**
     * Sin function needs 1 value
     * @return int
     */
    public function getOperandCount()
    {
        return 1;
    }
    
    /**
     * Pop the last value from the operands array and perform sin operation
     * 
     * @param array $operands
     * @return float
     */
    public function evaluate($operands) 
    {
        $this->validate($operands);
        $operand = array_pop($operands);
        $sin = sin($operand);
        return $sin;
    }

}