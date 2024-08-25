<?php

namespace Core;

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
        self::$subjects[] = $subject;
    }

    public static function removeSubject($name)
    {
        foreach (self::$subjects as $index => $subject) {
            if ($subject - getName() === $name) {
                unset(self::$subjects[$index]);
                echo "Subject '$name' removed successfully.\n";
                return;
            }
        }
        echo "Subject '$name' not found.\n";
    }

    public static function listSubjects()
    {
        if (empty(self::$subjects)) {
            echo "No subjects available.\n";
            return;
        }

        foreach (self::$subjects as $index => $subject) {
            echo ($index + 1) . ". " . $subject->getName() . "\n";
        }
    }

    public static function getSubjects()
    {
        return self::$subjects;
    }
}
