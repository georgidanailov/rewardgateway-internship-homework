<?php

use PHPUnit\Framework\TestCase;
use src\core\Subject;

class SubjectTest extends TestCase
{
    public function testAddSubject()
    {
        $subject = new Subject('History');
        Subject::addSubject($subject);

        $subjects = Subject::getSubjects();
        $this->assertArrayHasKey('History', $subjects);
    }

    public function testRemoveSubject()
    {
        $subject = new Subject('Geography');
        Subject::addSubject($subject);
        Subject::removeSubject('Geography');

        $subjects = Subject::getSubjects();
        $this->assertArrayNotHasKey('Geography', $subjects);
    }
}