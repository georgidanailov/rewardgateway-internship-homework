<?php declare(strict_types=1);

namespace GeorgiSimeonov\Lecture3practice\tests;

use GeorgiSimeonov\Lecture3practice\Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    public function testAddition()
    {
        $calculator = new Calculator();
        $result = $calculator->calculate('arithmetic', 'plus', 3.0, 2.0);
        $this->assertEquals('5', $result);
    }

    public function testSubtraction()
    {
        $calculator = new Calculator();
        $result = $calculator->calculate('arithmetic', 'minus', 5.0, 3.0);
        $this->assertEquals('2', $result);
    }

    public function testMultiplication()
    {
        $calculator = new Calculator();
        $result = $calculator->calculate('arithmetic', 'multiply', 4.0, 5.0);
        $this->assertEquals('20', $result);
    }

    public function testDivision()
    {
        $calculator = new Calculator();
        $result = $calculator->calculate('arithmetic', 'divide', 10.0, 2.0);
        $this->assertEquals('5', $result);
    }

    public function testDivisionByZero()
    {
        $calculator = new Calculator();
        $result = $calculator->calculate('arithmetic', 'divide', 10.0, 0.0);
        $this->assertEquals('Error: Division by zero.', $result);
    }

    public function testUnknownOperator()
    {
        $calculator = new Calculator();
        $result = $calculator->calculate('arithmetic', 'unknown', 10.0, 2.0);
        $this->assertEquals('Error: Unknown operator.', $result);
    }

    public function testUnknownType()
    {
        $calculator = new Calculator();
        $result = $calculator->calculate('unknown', 'plus', 10.0, 2.0);
        $this->assertEquals('Error: Unknown type.', $result);
    }
}
