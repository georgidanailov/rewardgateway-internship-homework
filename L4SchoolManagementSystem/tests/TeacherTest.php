<?php

use PHPUnit\Framework\TestCase;
use src\core\Teacher;
use src\core\Student;

class TeacherTest extends TestCase
{
    public function testGradeStudent()
    {
        $student = new Student('jane_doe', 'password123', ['Math']);
        $teacher = new Teacher('mr_smith', 'teacherpass', ['Math']);
        $teacher->gradeStudent($student, 'Math', 4);

        $grades = $student->getGrades();
        $this->assertArrayHasKey('Math', $grades);
        $this->assertEquals([4], $grades['Math']);
    }

    public function testGradeStudentInvalidSubject()
    {
        $student = new Student('jane_doe', 'password123', ['Math']);
        $teacher = new Teacher('mr_smith', 'teacherpass', ['Science']);
        $teacher->gradeStudent($student, 'Math', 4);

        $grades = $student->getGrades();
        $this->assertArrayNotHasKey('Math', $grades);
    }
}