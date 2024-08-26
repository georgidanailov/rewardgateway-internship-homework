<?php

namespace src\commands;

use src\core\Student;

class GradeStudentCommand implements Command
{
    private $student;
    private $subject;
    private $grade;

    public function __construct(Student $student, $subject, $grade)
    {
        $this->student = $student;
        $this->subject = $subject;
        $this->grade = $grade;
    }

    public function execute()
    {
        if ($this->grade < 2 || $this->grade > 6) {
            echo "Invalid grade. It must be between 2 and 6.\n";
            return;
        }

        $this->student->addGrade($this->subject, $this->grade);
        echo "Student '{$this->student->getUsername()}' graded successfully in '{$this->subject}' with grade '{$this->grade}'.\n";
    }
}
