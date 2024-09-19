<?php

namespace App\Tests;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testUserGettersAndSetters(): void
    {
        $user = new User();

        $this->assertNull($user->getId());

        $email = 'user@example.com';
        $user->setEmail($email);
        $this->assertEquals($email, $user->getEmail());
        $this->assertEquals($email, $user->getUserIdentifier());

        $name = 'John Doe';
        $user->setName($name);
        $this->assertEquals($name, $user->getName());

        $roles = ['ROLE_ADMIN'];
        $user->setRoles($roles);
        $this->assertEquals(['ROLE_ADMIN', 'ROLE_USER'], $user->getRoles());

        $password = 'password123';
        $user->setPassword($password);
        $this->assertEquals($password, $user->getPassword());

        $plainPassword = 'plain_password123';
        $user->setPlainPassword($plainPassword);
        $this->assertEquals($plainPassword, $user->getPlainPassword());

        $token = 'sometoken123';
        $user->setToken($token);
        $this->assertEquals($token, $user->getToken());

        $user->eraseCredentials();
        $this->assertNull($user->getPlainPassword());
    }
}

