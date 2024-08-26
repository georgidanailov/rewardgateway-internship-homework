<?php

namespace src\core;

class Teacher extends User
{
    private $subjects = [];

    public function __construct($username, $password, array $subjects)
    {
        parent::__construct($username, $password);
        $this->subjects = $subjects;
    }

    public function getSubjects()
    {
        return $this->subjects;
    }

    public function gradeStudent(Student $student, $subject, $grade)
    {
        if (!in_array($subject, $this->subjects)) {
            echo "Teacher is not assigned to the subject '{$subject}'.\n";
            return;
        }

        $student->addGrade($subject, $grade);
        echo "Student '{$student->getUsername()}' graded successfully.\n";
    }
}
