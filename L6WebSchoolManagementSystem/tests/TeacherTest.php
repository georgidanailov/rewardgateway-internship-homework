<?php

use PHPUnit\Framework\TestCase;

class TeacherTest extends TestCase
{
    private $teachersFile;

    protected function setUp(): void
    {
        $this->teachersFile = 'data/teachers_test.txt';
        file_put_contents($this->teachersFile, serialize([])); // Ensure a clean start
    }

    protected function tearDown(): void
    {
        unlink($this->teachersFile);
    }

    public function testCreateTeacher()
    {
        $teachers = unserialize(file_get_contents($this->teachersFile));
        $username = 'teacher1';
        $password = 'password';
        $name = 'Teacher One';
        $assigned_subjects = ['Math', 'History'];

        $teachers[$username] = [
            'password' => $password,
            'name' => $name,
            'subjects' => $assigned_subjects
        ];
        file_put_contents($this->teachersFile, serialize($teachers));

        $saved_teachers = unserialize(file_get_contents($this->teachersFile));

        $this->assertArrayHasKey($username, $saved_teachers);
        $this->assertEquals($password, $saved_teachers[$username]['password']);
        $this->assertEquals($name, $saved_teachers[$username]['name']);
        $this->assertEquals($assigned_subjects, $saved_teachers[$username]['subjects']);
    }
}
