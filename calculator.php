<?php
//komentarche
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
$param1 = $options['param1'];
$param2 = $options['param2'];

if ($type === 'arithmetic') {
    switch ($operator) {
        case 'plus':
            echo $param1 + $param2;
            break;
        case 'minus':
            echo $param1 - $param2;
            break;
        case 'multiply':
            echo $param1 * $param2;
            break;
        case 'divide':
            if ($param2 != 0) {
                echo $param1 / $param2;
            } else {
                echo "Error: Division by zero.";
            }
            break;
        default:
            echo "Error: Unknown operator.";
    }
} else {
    echo "Error: Unknown type.";
}
