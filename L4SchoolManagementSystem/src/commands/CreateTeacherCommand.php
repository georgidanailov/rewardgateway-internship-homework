<?php

namespace src\commands;

use src\core\Subject;
use src\core\Teacher;

class CreateTeacherCommand implements Command
{
    private $username;
    private $password;
    private $name;
    private $subjects;

    public function __construct($username, $password, $name, $subjects)
    {
        $this->username = $username;
        $this->password = $password;
        $this->name = $name;
        $this->subjects = $subjects;
    }

    public function execute()
    {
        if (empty($this->username) || strlen($this->username) < 2) {
            echo "Invalid username. It must be at least 2 characters long.\n";
            return;
        }

        if (empty($this->password) || strlen($this->password) < 6) {
            echo "Invalid password. It must be at least 6 characters long.\n";
            return;
        }

        if (empty($this->name) || strlen($this->name) < 2) {
            echo "Invalid name. It must be at least 2 characters long.\n";
            return;
        }

        if (empty($this->subjects)) {
            echo "No subjects assigned to the teacher.\n";
            return;
        }

        $subjectNames = explode(',', $this->subjects);
        $allSubjects = Subject::getSubjects();
        $assignedSubjects = [];

        foreach ($subjectNames as $subjectName) {
            $subjectName = trim($subjectName);
            $found = false;

            foreach ($allSubjects as $subject) {
                if ($subject->getName() === $subjectName) {
                    $assignedSubjects[] = $subjectName;
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                echo "Subject '$subjectName' does not exist.\n";
                return;
            }
        }

        $teacher = new Teacher($this->username, $this->password, $assignedSubjects);
        echo "Teacher '{$this->name}' created successfully with subjects: " . implode(', ', $assignedSubjects) . ".\n";
    }
}
