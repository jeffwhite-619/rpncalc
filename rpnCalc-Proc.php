<?php

const ADDITION = '+';
const SUBTRACTION = '-';
const MULTIPLICATION = '*';
const DIVISION = '/';

function add(&$operands) {
    $addend = array_pop($operands);
    $augend = array_pop($operands);
    $newOperand = $augend + $addend;
    return $newOperand;
}

function minus(&$operands) {
    $minuend = array_pop($operands);
    $subtrahend = array_pop($operands);
    $newOperand = $subtrahend - $minuend;
    return $newOperand;
}

function multiply(&$operands) {
    $multiplier = array_pop($operands);
    $multiplicand = array_pop($operands);
    $newOperand = $multiplier * $multiplicand;
    return $newOperand;
}

function divide(&$operands) {
    $divisor = array_pop($operands);
    if (0 === $divisor) {
        throw new Exception("Warning! Divide by zero error detected. Please try a different postfix expression.", 500);
    }
    $dividend = array_pop($operands);
    $newOperand = $dividend / $divisor;
    return $newOperand;
}

function getNewOperand(&$operands, $operator) {
    switch ($operator) {
        case ADDITION:
            $newOperand = add($operands);
            break;
        case SUBTRACTION:
            $newOperand = minus($operands);
            break;
        case MULTIPLICATION:
            $newOperand = multiply($operands);
            break;
        case DIVISION:
            $newOperand = divide($operands);
            break;
        default:
            throw new Exception("Unknown operator", 500);
    }
    return $newOperand;
}

function operate($stack, $position = 0, &$operands = []) {
    $token = $stack[$position];
    $newOperand = (is_numeric($token)) ? $token : getNewOperand($operands, $token);
    array_push($operands, $newOperand);
    $position++;
    if ($position < count($stack)) {
        return operate($stack, $position, $operands);
    } else {
        if (count($operands) > 1) {
            $errorMessage = "<br>Count of operands: " . count($operands) . "<br>";
            $errorMessage .= "Evaluation incomplete. Too many remaining operands: " . print_r($operands, true);
            throw new Exception($errorMessage, 500);
        }
        return array_shift($operands);
    }
}
try {
    $postfix = filter_input(INPUT_POST, 'postfix_expression', FILTER_SANITIZE_STRING);
    if (empty($postfix)) {
        // check command line
        $postfix = filter_input(INPUT_GET, 1, FILTER_SANITIZE_STRING);
    }
    if (!empty($postfix)) {
        $stack = explode(" ", $postfix);
        $result = operate($stack);
    }
    
} catch (Exception $ex) {
    error_log($ex->getMessage() . " | " . $ex->getTraceAsString());
    //throw $ex;
    // Laravel/Monolog ...
    // \Log::error($ex->getMessage() . " | " . $ex->getTraceAsString());
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>RPN (Reverse Polish Notation) Calculator</title>
        <meta charset="utf-8" />
        <meta name="robots" content="noindex,nofollow">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <style>
            input, h1, #supported {
                position: relative;
                margin: 0 auto;
                width: 580px;
                display: block;
            }
            input#calculate {
                width: 70px;
            }
            #result {
                border: 2px solid red;
                width: 100px;
                height: 45px;
                position: relative;
                margin: 0 auto;
                text-align: center;
                font-size: 36px;
            }
        </style>
    </head>
    <body>
        <h1>RPN (Reverse Polish Notation) Calculator</h1>
        <div id="supported">
            Supported operators:<br/>
            + &ndash; Addition<br/>
            - &ndash; Subtraction<br/>
            * &ndash; Multiplication<br/>
            / &ndash; Division<br/>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="rpn_calc_form" id="rpn_calc_form">
            <input type="text" size="100" name="postfix_expression" id="postfix_expression" /><br/>
            <input type="submit" name="calculate" id="calculate" value="Calculate"/>&nbsp;&nbsp;
        </form>
        <?php 
            if (!empty($result)) {
                echo <<<HEREDOC
        <div id="result">$result</div>
HEREDOC;
            }
        ?>
    </body>
</html>
