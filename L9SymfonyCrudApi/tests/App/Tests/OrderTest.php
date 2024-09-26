<?php

namespace App\Tests;

use App\Entity\Order;
use App\Entity\Customer;
use App\Entity\OrderEnum;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    public function testOrderId(): void
    {
        $order = new Order();
        $this->assertNull($order->getId());
    }

    public function testOrderDate(): void
    {
        $order = new Order();
        $this->assertNull($order->getOrderDate());

        $date = new \DateTime();
        $order->setOrderDate($date);
        $this->assertEquals($date, $order->getOrderDate());
    }

    public function testOrderTotal(): void
    {
        $order = new Order();
        $this->assertNull($order->getTotal());

        $order->setTotal(99.99);
        $this->assertEquals(99.99, $order->getTotal());
    }

    public function testOrderCustomer(): void
    {
        $order = new Order();
        $this->assertNull($order->getCustomer());

        $customer = new Customer();
        $customer->setName('John Doe');
        $customer->setEmail('john.doe@example.com');
        $customer->setAddress('123 Main St');
        $customer->setPhone('123-456-7890');

        $order->setCustomer($customer);
        $this->assertEquals($customer, $order->getCustomer());
    }
}
