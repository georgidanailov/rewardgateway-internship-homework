<?php

use PHPUnit\Framework\TestCase;
use src\core\Student;

class StudentTest extends TestCase
{
    public function testAddGrade()
    {
        $student = new Student('john_doe', 'password123', ['Math', 'Science']);
        $student->addGrade('Math', 5);

        $grades = $student->getGrades();
        $this->assertArrayHasKey('Math', $grades);
        $this->assertEquals([5], $grades['Math']);
    }

    public function testAddGradeInvalidSubject()
    {
        $student = new Student('john_doe', 'password123', ['Math']);
        $student->addGrade('Science', 4);

        $grades = $student->getGrades();
        $this->assertArrayNotHasKey('Science', $grades);
    }

    public function testGetSubjects()
    {
        $student = new Student('john_doe', 'password123', ['Math', 'Science']);
        $this->assertEquals(['Math', 'Science'], $student->getSubjects());
    }
}