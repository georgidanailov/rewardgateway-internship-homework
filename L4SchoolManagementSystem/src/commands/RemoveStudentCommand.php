<?php

namespace src\commands;

class RemoveStudentCommand implements Command
{
    private $username;

    public function __construct($username)
    {
        $this->username = $username;
    }

    public function execute()
    {
        echo "Student '{$this->username}' removed successfully.\n";
    }
}
