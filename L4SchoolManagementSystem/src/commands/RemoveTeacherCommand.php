<?php

namespace src\commands;

class RemoveTeacherCommand implements Command
{
    private $username;

    public function __construct($username)
    {
        $this->username = $username;
    }

    public function execute()
    {
        echo "Teacher '{$this->username}' removed successfully.\n";
    }
}
