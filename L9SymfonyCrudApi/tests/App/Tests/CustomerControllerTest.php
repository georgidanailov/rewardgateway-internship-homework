<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CustomerControllerTest extends WebTestCase
{
    public function testCreateCustomer(): void
    {
        $client = static::createClient();

        $client->request('POST', '/api/customers', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'address' => '123 Main Street',
            'phone' => '555-1234'
        ]));

        $this->assertResponseStatusCodeSame(201);

        $responseContent = $client->getResponse()->getContent();
        $responseData = json_decode($responseContent, true);

        $this->assertArrayHasKey('message', $responseData);
        $this->assertEquals('Customer created successfully!', $responseData['message']);
    }

    public function testGetCustomers(): void
    {
        $client = static::createClient();

        $client->request('POST', '/api/customers', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'address' => '123 Main Street',
            'phone' => '555-1234'
        ]));

        $client->request('GET', '/api/customers');
        $this->assertResponseStatusCodeSame(200);

        $responseContent = $client->getResponse()->getContent();
        $responseData = json_decode($responseContent, true);

        $this->assertIsArray($responseData);
        $this->assertNotEmpty($responseData);
    }

    public function testGetCustomerById(): void
    {
        $client = static::createClient();

        $client->request('POST', '/api/customers', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'address' => '123 Main Street',
            'phone' => '555-1234'
        ]));

        $responseContent = $client->getResponse()->getContent();
        $responseData = json_decode($responseContent, true);
        $customerId = $responseData['customer']['id'];

        $client->request('GET', '/api/customers/' . $customerId);
        $this->assertResponseStatusCodeSame(200);

        $responseContent = $client->getResponse()->getContent();
        $customerData = json_decode($responseContent, true);

        $this->assertArrayHasKey('name', $customerData);
        $this->assertEquals('John Doe', $customerData['name']);
    }

    public function testUpdateCustomer(): void
    {
        $client = static::createClient();

        // First, create a customer
        $client->request('POST', '/api/customers', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'address' => '123 Main Street',
            'phone' => '555-1234'
        ]));

        $responseContent = $client->getResponse()->getContent();
        $responseData = json_decode($responseContent, true);
        $customerId = $responseData['customer']['id'];

        $client->request('PUT', '/api/customers/' . $customerId, [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'Jane Doe',
            'email' => 'jane.doe@example.com',
            'address' => '456 Updated Street',
            'phone' => '555-6789'
        ]));

        $this->assertResponseStatusCodeSame(200);

        $responseContent = $client->getResponse()->getContent();
        $updatedData = json_decode($responseContent, true);

        $this->assertArrayHasKey('message', $updatedData);
        $this->assertEquals('Customer updated successfully!', $updatedData['message']);
    }

    public function testDeleteCustomer(): void
    {
        $client = static::createClient();

        // First, create a customer
        $client->request('POST', '/api/customers', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'address' => '123 Main Street',
            'phone' => '555-1234'
        ]));

        $responseContent = $client->getResponse()->getContent();
        $responseData = json_decode($responseContent, true);
        $customerId = $responseData['customer']['id'];

        $client->request('DELETE', '/api/customers/' . $customerId);
        $this->assertResponseStatusCodeSame(200);

        $responseContent = $client->getResponse()->getContent();
        $deleteResponse = json_decode($responseContent, true);

        $this->assertArrayHasKey('message', $deleteResponse);
        $this->assertEquals('Customer deleted successfully!', $deleteResponse['message']);
    }


}
