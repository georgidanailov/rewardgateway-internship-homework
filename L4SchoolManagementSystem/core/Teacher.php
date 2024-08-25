<?php

namespace Core;

use Commands\GradeStudentCommand;

class Teacher extends User
{
    private $subjects = [];

    public function __construct($username, $password, $subjects)
    {
        parent::__construct($username, $password);
        $this->subjects = $subjects;
    }

    public function getMenu()
    {
        echo "The subject you teach are: " . implode(', ', $this->subjects) . "\n";
        echo "1. Grade a student \n";
        echo "2. Log out\n";
    }

    public function handleMenuOption($option)
    {
        switch ($option) {
            case 1:
                $command = new GradeStudentCommand();
                $command->execute();
                break;
            case 2:
                echo "Logging out...\n";
                break;
            default:
                echo "Invalid option.\n";
                break;
        }
    }

    public function getSubjects()
    {
        return $this->subjects;
    }
}
