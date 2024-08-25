<?php declare(strict_types=1);

namespace GeorgiSimeonov\Lecture3practice\tests;

use GeorgiSimeonov\Lecture3practice\ShapesCalculator;
use PHPUnit\Framework\TestCase;

class ShapesCalculatorTest extends TestCase
{
    public function testTriangleArea()
    {
        $calculator = new ShapesCalculator();
        $dimensions = ['base' => 10, 'height' => 5];
        $result = $calculator->calculateArea('triangle', $dimensions);
        $this->assertEquals(25, $result);
    }

    public function testSquareArea()
    {
        $calculator = new ShapesCalculator();
        $dimensions = ['side' => 4];
        $result = $calculator->calculateArea('square', $dimensions);
        $this->assertEquals(16, $result);
    }

    public function testCircleArea()
    {
        $calculator = new ShapesCalculator();
        $dimensions = ['radius' => 3];
        $result = $calculator->calculateArea('circle', $dimensions);
        $this->assertEquals(pi() * 9, $result);
    }

    public function testTrianglePerimeter()
    {
        $calculator = new ShapesCalculator();
        $dimensions = ['side1' => 3, 'side2' => 4, 'side3' => 5];
        $result = $calculator->calculatePerimeter('triangle', $dimensions);
        $this->assertEquals(12, $result);
    }

    public function testSquarePerimeter()
    {
        $calculator = new ShapesCalculator();
        $dimensions = ['side' => 4];
        $result = $calculator->calculatePerimeter('square', $dimensions);
        $this->assertEquals(16, $result);
    }

    public function testCirclePerimeter()
    {
        $calculator = new ShapesCalculator();
        $dimensions = ['radius' => 3];
        $result = $calculator->calculatePerimeter('circle', $dimensions);
        $this->assertEquals(2 * pi() * 3, $result);
    }

    public function testUnknownShapeForArea()
    {
        $calculator = new ShapesCalculator();
        $dimensions = ['side' => 4];
        $result = $calculator->calculateArea('hexagon', $dimensions);
        $this->assertEquals("Shape not recognized.", $result);
    }

    public function testUnknownShapeForPerimeter()
    {
        $calculator = new ShapesCalculator();
        $dimensions = ['side' => 4];
        $result = $calculator->calculatePerimeter('hexagon', $dimensions);
        $this->assertEquals("Shape not recognized.", $result);
    }
}
