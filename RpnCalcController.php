<?php

// Laravel framework

namespace RPN;

use \Operators;
use App\Http\Controllers\Controller;

class RpnCalcController extends Controller
{
    private $stack = [];
    private $operands = [];
    
    /**
     * Run the calculator
     * 
     */
    public function calculate()
    {
        $postfixExpression = $this->getInput('postfix_expression', []);
        $this->stack = explode(" ", $postfixExpression);
        $result = $this->operate();
        return view('user.profile', ['result' => $result]);
    }
    
    /**
     * Do calculator operation
     * 
     * @param int $position
     * @return int|float
     */
    protected function operate($position = 0) 
    {
        $token = $this->stack[$position];
        if (is_numeric($token)) {
            $newOperand = $token;
        } else {
            $operator = Operators\OperatorFactory::getOperator($token);
	    // TODO: support optional arguments for some operations, based on token
	    // e.g. base parameter for log()
            $newOperand = $operator->evaluate($this->operands);
        }
        array_push($this->operands, $newOperand);
        $position++;
        if ($position < count($this->stack)) {
            return $this->operate($position);
        } else {
            $this->validateFinalOperands();
            return array_shift($this->operands);
        }
    }
    
    /**
     * Check the operands member to ensure all operations are complete
     * 
     * @throws Exception
     */
    protected function validateFinalOperands()
    {
        if (count($this->operands) > 1) {
            $errorMessage = "Count of operands: " . count($this->operands) . PHP_EOL;
            $errorMessage .= "Evaluation incomplete. Too many remaining operands: " . print_r($this->operands, true);
            throw new Exception($errorMessage, 500);
        }
    }
    
}
