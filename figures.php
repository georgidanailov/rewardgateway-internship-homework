<?php

function calculateArea($shape, $dimensions)
{
    switch ($shape) {
        case 'triangle':
            return 0.5 * $dimensions['base'] * $dimensions['height'];
        case 'square':
            return $dimensions['side'] * $dimensions['side'];
        case 'circle':
            return pi() * $dimensions['radius'] * $dimensions['radius'];
        default:
            return "Shape not recognized.";
    }
}

function calculatePerimeter($shape, $dimensions)
{
    switch ($shape) {
        case 'triangle':
            return $dimensions['side1'] + $dimensions['side2'] + $dimensions['side3'];
        case 'square':
            return 4 * $dimensions['side'];
        case 'circle':
            return 2 * pi() * $dimensions['radius'];
        default:
            return "Shape not recognized.";
    }
}

$options = getopt("", [
    "type:",
    "calculation:",
    "shape:",
    "radius::",
    "side::",
    "base::",
    "height::",
    "side1::",
    "side2::",
    "side3::"
]);

if (!isset($options['type']) || !isset($options['calculation']) || !isset($options['shape'])) {
    echo "Failed attempt. Usage example: php figures.php --type=shape --calculation=area --shape=circle --radius=10\n";
    exit(1);
}

$type = $options['type'];
$calculation = $options['calculation'];
$shape = $options['shape'];

$dimensions = [];

switch ($shape) {
    case 'triangle':
        if (!isset($options['base']) || !isset($options['height']) || !isset($options['side1']) || !isset($options['side2']) || !isset($options['side3'])) {
            echo "For a triangle, you need to specify --base, --height, --side1, --side2, and --side3.\n";
            exit(1);
        }
        $dimensions = [
            'base' => $options['base'],
            'height' => $options['height'],
            'side1' => $options['side1'],
            'side2' => $options['side2'],
            'side3' => $options['side3']
        ];
        break;
    case 'square':
        if (!isset($options['side'])) {
            echo "For a square, you need to specify --side.\n";
            exit(1);
        }
        $dimensions = ['side' => $options['side']];
        break;
    case 'circle':
        if (!isset($options['radius'])) {
            echo "For a circle, you need to specify --radius.\n";
            exit(1);
        }
        $dimensions = ['radius' => $options['radius']];
        break;
    default:
        echo "Shape not recognized.\n";
        exit(1);
}

$result = 0;
switch ($calculation) {
    case 'area':
        $result = calculateArea($shape, $dimensions);
        break;
    case 'perimeter':
        $result = calculatePerimeter($shape, $dimensions);
        break;
    default:
        echo "Calculation type not recognized. Use 'area' or 'perimeter'.\n";
        exit(1);
}

echo $result . "\n";