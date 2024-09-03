<?php

use PHPUnit\Framework\TestCase;

class TeacherTest extends TestCase
{
    protected function setUp(): void
    {
        $_SESSION['role'] = 'teacher';
        $_SESSION['username'] = 'teacher1';
    }

    public function testGradeStudent()
    {
        file_put_contents(__DIR__ . '/../data/teachers.txt', serialize([
            'teacher1' => [
                'password' => 'password',
                'name' => 'Jane Doe',
                'subjects' => ['Math']
            ]
        ]));
        file_put_contents(__DIR__ . '/../data/students.txt', serialize([
            'student1' => [
                'password' => 'password',
                'name' => 'John Doe',
                'subjects' => ['Math']
            ]
        ]));
        file_put_contents(__DIR__ . '/../data/grades.txt', serialize([]));

        $_POST['grade_student'] = true;
        $_POST['student_id'] = 'student1';
        $_POST['subject_name'] = 'Math';
        $_POST['grade'] = '5';

        ob_start();
        require_once __DIR__ . '/../teacher.php';
        $output = ob_get_clean();

        $this->assertStringContainsString("Grade for student student1 in Math set to 5.", $output);
    }

}
