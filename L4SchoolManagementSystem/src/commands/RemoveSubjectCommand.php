<?php

namespace src\commands;

use src\core\Subject;

class RemoveSubjectCommand implements Command
{
    private $subjectName;

    public function __construct($subjectName)
    {
        $this->subjectName = $subjectName;
    }

    public function execute()
    {
        if (empty($this->subjectName)) {
            echo "Subject name cannot be empty.\n";
            return;
        }

        Subject::removeSubject($this->subjectName);
    }
}
