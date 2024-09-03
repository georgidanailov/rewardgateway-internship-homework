<?php

use PHPUnit\Framework\TestCase;

class IndexTest extends TestCase
{
    public function testInitializeSystem()
    {
        $_POST['initialize_system'] = true;
        $_POST['username'] = 'admin';
        $_POST['password'] = 'admin123';
        $_POST['confirm_password'] = 'admin123';

        ob_start();
        require_once __DIR__ . '/../index.php';
        $output = ob_get_clean();

        $this->assertStringContainsString("System initialized successfully. You can now log in as admin.", $output);
    }

}
