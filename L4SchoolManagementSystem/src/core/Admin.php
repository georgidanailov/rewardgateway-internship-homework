<?php

namespace src\core;

class Admin extends User
{
    public function __construct($username, $password)
    {
        parent::__construct($username, $password);
    }

    public function displayInfo()
    {
        echo "Admin Username: {$this->username}\n";
    }

    public function addSubject($subjectName)
    {
        $subject = new Subject($subjectName);
        Subject::addSubject($subject);
        echo "Subject '{$subjectName}' added successfully.\n";
    }

    public function removeSubject($subjectName)
    {
        Subject::removeSubject($subjectName);
        echo "Subject '{$subjectName}' removed successfully.\n";
    }
}
