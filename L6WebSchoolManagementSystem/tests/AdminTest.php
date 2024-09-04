<?php

use PHPUnit\Framework\TestCase;

class AdminTest extends TestCase
{
    private $adminsFile;

    protected function setUp(): void
    {
        $this->adminsFile = 'data/admins_test.txt';
        file_put_contents($this->adminsFile, serialize([])); // Ensure a clean start
    }

    protected function tearDown(): void
    {
        unlink($this->adminsFile);
    }

    public function testCreateAdmin()
    {
        $admins = unserialize(file_get_contents($this->adminsFile));
        $username = 'admin1';
        $password = 'adminpassword';
        $name = 'Admin One';

        $admins[$username] = [
            'password' => $password,
            'name' => $name
        ];
        file_put_contents($this->adminsFile, serialize($admins));

        $saved_admins = unserialize(file_get_contents($this->adminsFile));

        $this->assertArrayHasKey($username, $saved_admins);
        $this->assertEquals($password, $saved_admins[$username]['password']);
        $this->assertEquals($name, $saved_admins[$username]['name']);
    }

    public function testUpdateAdmin()
    {
        $admins = unserialize(file_get_contents($this->adminsFile));
        $username = 'admin1';
        $password = 'adminpassword';
        $name = 'Admin One';

        $admins[$username] = [
            'password' => $password,
            'name' => $name
        ];
        file_put_contents($this->adminsFile, serialize($admins));

        // Update admin details
        $admins[$username]['name'] = 'Updated Admin One';
        file_put_contents($this->adminsFile, serialize($admins));

        $saved_admins = unserialize(file_get_contents($this->adminsFile));

        $this->assertEquals('Updated Admin One', $saved_admins[$username]['name']);
    }

    public function testDeleteAdmin()
    {
        $admins = unserialize(file_get_contents($this->adminsFile));
        $username = 'admin1';
        $password = 'adminpassword';
        $name = 'Admin One';

        $admins[$username] = [
            'password' => $password,
            'name' => $name
        ];
        file_put_contents($this->adminsFile, serialize($admins));

        // Delete admin
        unset($admins[$username]);
        file_put_contents($this->adminsFile, serialize($admins));

        $saved_admins = unserialize(file_get_contents($this->adminsFile));

        $this->assertArrayNotHasKey($username, $saved_admins);
    }
}
