<?php
namespace Operators;

abstract class OperatorFactory
{
    const BASIC_ADDITION = "+";
    const BASIC_SUBTRACTION = "-";
    const BASIC_MULTIPLICATION = "*";
    const BASIC_DIVISION = "/";
    const BASIC_MODULUS = "%";
    const BASIC_POWER = "**";
    const BASIC_EXPONENT = "exp";
    const ALGOR_PYTHAGOREAN = "p";
    const ALGOR_SIN = "sin";
    const ALGOR_COS = "cos";
    const ALGOR_LOGARITHM = "log";
    
    /**
     * Perform math operation
     */
    abstract function evaluate($operands);
    
    /**
     * Return the appropriate object instance for the given symbol
     * 
     * @param string $operatorSymbol
     * @return \Operators
     * @throws Exception
     */
    public static function getOperator($operatorSymbol)
    {
        $operator = null;
        switch ($operatorSymbol) {
            case self::BASIC_ADDITION:
                $operator = new Add;
                break;
            case self::BASIC_SUBTRACTION:
                $operator = new Subtract;
                break;
            case self::BASIC_MULTIPLICATION:
                $operator = new Multiply;
                break;
            case self::BASIC_DIVISION:
                $operator = new Divide;
                break;
            case self::BASIC_MODULUS:
                $operator = new Modulus;
                break;
            case self::BASIC_POWER:
                $operator = new Power;
                break;
            case self::BASIC_EXPONENT:
                $operator = new Exponent;
                break;
            case self::ALGOR_PYTHAGOREAN:
                $operator = new Pythagorean;
                break;
            case self::ALGOR_SIN:
                $operator = new Sin;
                break;
            case self::ALGOR_COS:
                $operator = new Cos;
                break;
            case self::ALGOR_LOGARITHM:
                $operator = new Logarithm;
                break;
            default:
                throw new Exception("Unknown operator: " . print_r($operatorSymbol, true), 500);
        }
        return $operator;
    }
}
