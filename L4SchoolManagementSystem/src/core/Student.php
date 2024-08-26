<?php

namespace src\core;

class Student extends User
{
    private $grades = [];
    private $subjects = [];

    public function __construct($username, $password, array $subjects)
    {
        parent::__construct($username, $password);
        $this->subjects = $subjects;
    }

    public function addGrade($subject, $grade)
    {
        if (!in_array($subject, $this->subjects)) {
            echo "Subject '{$subject}' is not assigned to this student.\n";
            return;
        }

        if (!isset($this->grades[$subject])) {
            $this->grades[$subject] = [];
        }

        $this->grades[$subject][] = $grade;
        echo "Grade added successfully.\n";
    }

    public function getGrades()
    {
        return $this->grades;
    }

    public function getSubjects()
    {
        return $this->subjects;
    }
}
