<?php declare(strict_types=1);

namespace GeorgiSimeonov\lecture1practiceCalculator;
function performOperation(string $type, string $operator, float $param1, float $param2)
{
    if ($type === 'arithmetic') {
        switch ($operator) {
            case 'plus':
                return $param1 + $param2;
            case 'minus':
                return $param1 - $param2;
            case 'multiply':
                return $param1 * $param2;
            case 'divide':
                if ($param2 != 0) {
                    return $param1 / $param2;
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

$options = getopt("", [
    "type:",
    "operator:",
    "param1:",
    "param2:"
]);

if (!isset($options['type']) || !isset($options['operator']) || !isset($options['param1']) || !isset($options['param2'])) {
    echo "Error: Missing required parameters.\n";
    exit(1);
}

$type = $options['type'];
$operator = $options['operator'];
$param1 = (float)$options['param1'];
$param2 = (float)$options['param2'];

echo performOperation($type, $operator, $param1, $param2);
