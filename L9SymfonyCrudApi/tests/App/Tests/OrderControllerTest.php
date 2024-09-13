<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class OrderControllerTest extends WebTestCase
{
    public function testCreateOrder(): void
    {
        $client = static::createClient();

        $client->request('POST', '/api/orders', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'total' => 150.00,
            'status' => 'Pending',
            'customer_id' => 1
        ]));

        $this->assertResponseStatusCodeSame(201);

        $responseContent = $client->getResponse()->getContent();
        $responseData = json_decode($responseContent, true);

        $this->assertArrayHasKey('message', $responseData);
        $this->assertEquals('Order created successfully!', $responseData['message']);
    }

    public function testGetOrders(): void
    {
        $client = static::createClient();

        $client->request('POST', '/api/orders', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'total' => 150.00,
            'status' => 'Pending',
            'customer_id' => 1
        ]));

        $client->request('GET', '/api/orders');
        $this->assertResponseStatusCodeSame(200);

        $responseContent = $client->getResponse()->getContent();
        $responseData = json_decode($responseContent, true);

        $this->assertIsArray($responseData);
        $this->assertNotEmpty($responseData);
    }

    public function testGetOrderById(): void
    {
        $client = static::createClient();

        $client->request('POST', '/api/orders', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'total' => 150.00,
            'status' => 'Pending',
            'customer_id' => 1
        ]));

        $responseContent = $client->getResponse()->getContent();
        $responseData = json_decode($responseContent, true);
        $orderId = $responseData['order']['id'];

        $client->request('GET', '/api/orders/' . $orderId);
        $this->assertResponseStatusCodeSame(200);

        $responseContent = $client->getResponse()->getContent();
        $orderData = json_decode($responseContent, true);

        $this->assertArrayHasKey('total', $orderData);
        $this->assertEquals(150.00, $orderData['total']);
    }

    public function testUpdateOrderStatus(): void
    {
        $client = static::createClient();

        $client->request('POST', '/api/orders', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'total' => 150.00,
            'status' => 'Pending',
            'customer_id' => 1
        ]));

        $responseContent = $client->getResponse()->getContent();
        $responseData = json_decode($responseContent, true);
        $orderId = $responseData['order']['id'];

        $client->request('PUT', '/api/orders/' . $orderId, [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'status' => 'Completed'
        ]));

        $this->assertResponseStatusCodeSame(200);

        $responseContent = $client->getResponse()->getContent();
        $updatedData = json_decode($responseContent, true);

        $this->assertArrayHasKey('message', $updatedData);
        $this->assertEquals('Order updated successfully!', $updatedData['message']);
    }


}
