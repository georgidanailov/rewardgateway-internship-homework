<?php declare(strict_types=1);

namespace GeorgiSimeonov\Lecture3practice;

class Calculator
{
    public function calculate(string $type, string $operator, float $param1, float $param2): string
    {
        if ($type === 'arithmetic') {
            switch ($operator) {
                case 'plus':
                    return (string)($param1 + $param2);
                case 'minus':
                    return (string)($param1 - $param2);
                case 'multiply':
                    return (string)($param1 * $param2);
                case 'divide':
                    if ($param2 != 0) {
                        return (string)($param1 / $param2);
                    } else {
                        return "Error: Division by zero.";
                    }
                default:
                    return "Error: Unknown operator.";
            }
        } else {
            return "Error: Unknown type.";
        }
    }
}
