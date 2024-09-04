<?php

use PHPUnit\Framework\TestCase;

class SubjectTest extends TestCase
{
    private $subjectsFile;

    protected function setUp(): void
    {
        $this->subjectsFile = 'data/subjects_test.txt';
        file_put_contents($this->subjectsFile, serialize([])); // Ensure a clean start
    }

    protected function tearDown(): void
    {
        unlink($this->subjectsFile);
    }

    public function testAddSubject()
    {
        $subjects = unserialize(file_get_contents($this->subjectsFile));
        $subject_name = 'Biology';

        $subjects[] = $subject_name;
        file_put_contents($this->subjectsFile, serialize($subjects));

        $saved_subjects = unserialize(file_get_contents($this->subjectsFile));

        $this->assertContains($subject_name, $saved_subjects);
    }

    public function testRemoveSubject()
    {
        $subjects = unserialize(file_get_contents($this->subjectsFile));
        $subject_name = 'Chemistry';

        $subjects[] = $subject_name;
        file_put_contents($this->subjectsFile, serialize($subjects));

        $subjects = array_filter($subjects, function ($subject) use ($subject_name) {
            return $subject !== $subject_name;
        });
        file_put_contents($this->subjectsFile, serialize($subjects));

        $saved_subjects = unserialize(file_get_contents($this->subjectsFile));

        $this->assertNotContains($subject_name, $saved_subjects);
    }
}
