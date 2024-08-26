<?php

namespace src\core;

class Subject
{
    private $name;
    private static $subjects = [];

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public static function addSubject(Subject $subject)
    {
        self::$subjects[$subject->getName()] = $subject;
    }

    public static function removeSubject($name)
    {
        if (isset(self::$subjects[$name])) {
            unset(self::$subjects[$name]);
            echo "Subject '{$name}' removed.\n";
        } else {
            echo "Subject '{$name}' not found.\n";
        }
    }

    public static function getSubjects()
    {
        return self::$subjects;
    }
}
