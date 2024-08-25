<?php

namespace Core;

class Student extends User
{
    private $subjects = [];
    private $grades = [];

    public function __construct($username, $password, $subjects)
    {
        parent::__construct($username, $password);
        $this->subjects = $subjects;
    }

    public function getMenu()
    {
        echo "1. Check grades for a subject\n";
        echo "2. log out\n";
    }

    public function handleMenuOption($option)
    {
        switch ($option) {
            case 1:
                $this->checkGrades();
                break;
            case 2:
                echo "Logging out...\n";
                break;
            default:
                echo "Invalid option.\n";
                break;
        }
    }

    public function addGrade($subject, $grade)
    {
        if (!isset($this->grades[$subject])) {
            $this->grades[$subject] = [];
        }
        $this->grades[$subject][] = $grade;
    }

    private function checkGrades()
    {
        echo "Your subjects are:\n";
        foreach ($this->subjects as $index => $subject) {
            echo ($index + 1) . ". $subject\n";
        }

        echo "Enter the subject number to see grades: ";
        $subjectIndex = trim(fgets(STDIN)) - 1;

        if (isset($this->subjects[$subjectIndex])) {
            $selectedSubject = $this->subjects[$subjectIndex];
            if (isset($this->grades[$selectedSubject])) {
                $grades = $this->grades[$selectedSubject];
                echo "Your $selectedSubject grades are: " . implode(", ", $grades) . "\n";
                echo "Average: " . number_format(array_sum($grades) / count($grades), 2) . "\n";
            } else {
                echo "No grades recorded for $selectedSubject.\n";
            }
        } else {
            echo "Invalid subject number.\n";
        }
    }

    public function getSubjects()
    {
        return $this->subjects;
    }
}