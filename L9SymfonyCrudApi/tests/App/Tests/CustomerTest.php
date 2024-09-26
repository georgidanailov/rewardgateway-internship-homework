<?php

namespace App\Tests;

use App\Entity\Customer;
use PHPUnit\Framework\TestCase;

class CustomerTest extends TestCase
{
    public function testCustomerId(): void
    {
        $customer = new Customer();
        $this->assertNull($customer->getId());
    }

    public function testCustomerName(): void
    {
        $customer = new Customer();
        $this->assertNull($customer->getName());

        $customer->setName('John Doe');
        $this->assertEquals('John Doe', $customer->getName());
    }

    public function testCustomerEmail(): void
    {
        $customer = new Customer();
        $this->assertNull($customer->getEmail());

        $customer->setEmail('john.doe@example.com');
        $this->assertEquals('john.doe@example.com', $customer->getEmail());
    }

    public function testCustomerPhone(): void
    {
        $customer = new Customer();
        $this->assertNull($customer->getPhone());

        $customer->setPhone('123-456-7890');
        $this->assertEquals('123-456-7890', $customer->getPhone());

        $customer->setPhone(null);
        $this->assertNull($customer->getPhone());
    }

    public function testCustomerAddress(): void
    {
        $customer = new Customer();
        $this->assertNull($customer->getAddress());

        $customer->setAddress('123 Main St');
        $this->assertEquals('123 Main St', $customer->getAddress());
    }
}
