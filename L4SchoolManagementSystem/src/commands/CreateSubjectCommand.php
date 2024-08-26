<?php

namespace src\commands;

use src\core\Subject;

class CreateSubjectCommand implements Command
{
    private $subjectName;

    public function __construct(string $subjectName)
    {
        $this->subjectName = $subjectName;
    }

    public function execute()
    {
        if (empty($this->subjectName) || strlen($this->subjectName) < 2) {
            echo "Invalid subject name. It must be at least 2 characters long.\n";
            return;
        }

        $subject = new Subject($this->subjectName);
        Subject::addSubject($subject);
        echo "Subject '{$this->subjectName}' created successfully.\n";
    }
}
