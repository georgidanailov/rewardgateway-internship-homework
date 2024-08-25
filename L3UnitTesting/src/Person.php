<?php declare(strict_types=1);

namespace GeorgiSimeonov\Lecture3practice;

class Person
{
    private int $age;
    private string $name;

    public function __construct(int $age, string $name)
    {
        $this->age = $age;
        $this->name = $name;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function getName()
    {
        return $this->name;
    }
}