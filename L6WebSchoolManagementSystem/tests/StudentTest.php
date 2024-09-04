<?php

use PHPUnit\Framework\TestCase;

class StudentTest extends TestCase
{
    private $studentsFile;

    protected function setUp(): void
    {
        $this->studentsFile = 'data/students_test.txt';
        file_put_contents($this->studentsFile, serialize([])); // Ensure a clean start
    }

    protected function tearDown(): void
    {
        unlink($this->studentsFile);
    }

    public function testCreateStudent()
    {
        $students = unserialize(file_get_contents($this->studentsFile));
        $username = 'student1';
        $password = 'password';
        $name = 'Student One';
        $assigned_subjects = ['Math', 'Science'];

        $students[$username] = [
            'password' => $password,
            'name' => $name,
            'subjects' => $assigned_subjects
        ];
        file_put_contents($this->studentsFile, serialize($students));

        $saved_students = unserialize(file_get_contents($this->studentsFile));

        $this->assertArrayHasKey($username, $saved_students);
        $this->assertEquals($password, $saved_students[$username]['password']);
        $this->assertEquals($name, $saved_students[$username]['name']);
        $this->assertEquals($assigned_subjects, $saved_students[$username]['subjects']);
    }
}
