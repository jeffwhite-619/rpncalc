<?php

namespace Operators;

class Pythagorean extends Operator
{
    /**
     * Pythagorean theorem needs 3 values to evaluate boolean state
     * @return int
     */
    public function getOperandCount()
    {
        return 3;
    }
    
    /**
     * Pop the last 3 values from the operands array and determine if the
     * Pythagorean theorem successfully applies to the values
     * 
     * @param array $operands
     * @return int
     */
    public function evaluate($operands) 
    {
        $this->validate($operands);
        $C = array_pop($operands);
        $B = array_pop($operands);
        $A = array_pop($operands);
        $evaluation = pow($A, 2) + pow($B, 2);
        $expectedResult = pow($C, 2);
        if ($evaluation === $expectedResult) {
            return 1;
        }
        return 0;
    }

}