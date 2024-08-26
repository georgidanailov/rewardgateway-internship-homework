<?php

use PHPUnit\Framework\TestCase;
use src\core\User;

class UserTest extends TestCase
{
    public function testUserProperties()
    {
        $reflection = new \ReflectionClass(User::class);
        $this->assertTrue($reflection->isAbstract());

        $user = $this->getMockForAbstractClass(User::class, ['testuser', 'password123']);
        $this->assertEquals('testuser', $user->getUsername());
        $this->assertEquals('password123', $user->getPassword());
    }
}
