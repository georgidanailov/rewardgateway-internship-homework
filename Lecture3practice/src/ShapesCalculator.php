<?php declare(strict_types=1);

namespace GeorgiSimeonov\Lecture3practice;

class ShapesCalculator
{
    public function calculateArea(string $shape, array $dimensions): float|string
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

    public function calculatePerimeter(string $shape, array $dimensions): float|string
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
}
