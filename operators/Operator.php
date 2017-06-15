<?php
namespace Operators;

abstract class Operator
{
    /**
     * 
     * @return int
     */
    public function getOperandCount()
    {
        return 2; // most operations need only 2 operands to perform a calculation
    }
    
    /**
     * Validate operand count and data type
     * @param array $operands 
     */
    public function validate($operands)
    {
        $count = $this->getOperandCount();
        $validCount = static::validateOperandCount($operands, $count);
        $validNum = static::validateOperandNum($operands, $count);
        $valid = $validCount && $validNum;
        
        if (!$valid) {
            throw new Exception("Invalid operands: " . print_r($operands, true));
        }
    }
    
    public static function validateOperandCount($operands, $count)
    {
        if (count($operands) >= $count) {
            return true;
        }
        return false;
    }
    
    public static function validateOperandNum($operands, $count)
    {
        $valid = true;
        $reversedStack = array_reverse($operands);
        for ($i = 0; $i < $count; $i++) {
            if (!is_numeric($reversedStack[$i])) {
                $valid = false;
            }
        }
        return $valid;
    }
    
    
    
}
