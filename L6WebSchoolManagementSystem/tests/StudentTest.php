<?php

use PHPUnit\Framework\TestCase;

class StudentTest extends TestCase
{
    protected function setUp(): void
    {
        $_SESSION['role'] = 'student';
        $_SESSION['username'] = 'student1';
    }

    public function testStudentDashboard()
    {
        file_put_contents(__DIR__ . '/../data/students.txt', serialize([
            'student1' => [
                'password' => 'password',
                'name' => 'John Doe',
                'subjects' => ['Math', 'Science']
            ]
        ]));

        ob_start();
        require_once __DIR__ . '/../student.php';
        $output = ob_get_clean();

        $this->assertStringContainsString('Math', $output);
        $this->assertStringContainsString('Science', $output);
    }
}
