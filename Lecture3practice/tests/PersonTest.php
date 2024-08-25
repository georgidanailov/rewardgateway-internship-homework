<?php declare(strict_types=1);

namespace GeorgiSimeonov\Lecture3practice\tests;

use GeorgiSimeonov\Lecture3practice\Person;
use PHPUnit\Framework\TestCase;

class PersonTest extends TestCase
{
    public function testGetName()
    {
        $person = new Person(25, 'John Doe');
        $this->assertEquals('John Doe', $person->getName());
    }

    public function testGetAge()
    {
        $person = new Person(25, 'John Doe');
        $this->assertEquals(25, $person->getAge());
    }
}