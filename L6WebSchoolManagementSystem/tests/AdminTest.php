<?php

use PHPUnit\Framework\TestCase;

class AdminTest extends TestCase
{
    protected function setUp(): void
    {
        $_SESSION['role'] = 'admin';
    }

    public function testCreateSubject()
    {
        $_POST['create_subject'] = true;
        $_POST['subject_name'] = 'Math';

        ob_start();
        require_once __DIR__ . '/../admin.php';
        $output = ob_get_clean();

        $this->assertStringContainsString("Subject 'Math' created successfully.", $output);
    }
}
