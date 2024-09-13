<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductControllerTest extends WebTestCase
{
    public function testCreateProduct(): void
    {
        $client = static::createClient();

        $client->request('POST', '/api/products', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'Test Product',
            'price' => 99.99,
            'quantity' => 10,
            'description' => 'A sample product',
            'category_id' => 1
        ]));

        $this->assertResponseStatusCodeSame(201);

        $responseContent = $client->getResponse()->getContent();
        $responseData = json_decode($responseContent, true);

        $this->assertArrayHasKey('message', $responseData);
        $this->assertEquals('Product created successfully!', $responseData['message']);
    }

    public function testGetProducts(): void
    {
        $client = static::createClient();

        $client->request('POST', '/api/products', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'Test Product',
            'price' => 99.99,
            'quantity' => 10,
            'description' => 'A sample product',
            'category_id' => 1
        ]));

        $client->request('GET', '/api/products');
        $this->assertResponseStatusCodeSame(200);

        $responseContent = $client->getResponse()->getContent();
        $responseData = json_decode($responseContent, true);

        $this->assertIsArray($responseData);
        $this->assertNotEmpty($responseData);
    }

    public function testGetProductById(): void
    {
        $client = static::createClient();


        $client->request('POST', '/api/products', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'Test Product',
            'price' => 99.99,
            'quantity' => 10,
            'description' => 'A sample product',
            'category_id' => 1
        ]));

        $responseContent = $client->getResponse()->getContent();
        $responseData = json_decode($responseContent, true);
        $productId = $responseData['product']['id'];

        $client->request('GET', '/api/products/' . $productId);
        $this->assertResponseStatusCodeSame(200);

        $responseContent = $client->getResponse()->getContent();
        $productData = json_decode($responseContent, true);

        $this->assertArrayHasKey('name', $productData);
        $this->assertEquals('Test Product', $productData['name']);
    }

    public function testUpdateProduct(): void
    {
        $client = static::createClient();

        $client->request('POST', '/api/products', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'Test Product',
            'price' => 99.99,
            'quantity' => 10,
            'description' => 'A sample product',
            'category_id' => 1
        ]));

        $responseContent = $client->getResponse()->getContent();
        $responseData = json_decode($responseContent, true);
        $productId = $responseData['product']['id'];

        $client->request('PUT', '/api/products/' . $productId, [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'Updated Product',
            'price' => 120.00,
            'quantity' => 5,
            'description' => 'Updated description',
            'category_id' => 1
        ]));

        $this->assertResponseStatusCodeSame(200);

        $responseContent = $client->getResponse()->getContent();
        $updatedData = json_decode($responseContent, true);

        $this->assertArrayHasKey('message', $updatedData);
        $this->assertEquals('Product updated successfully!', $updatedData['message']);
    }

    public function testDeleteProduct(): void
    {
        $client = static::createClient();

        $client->request('POST', '/api/products', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'Test Product',
            'price' => 99.99,
            'quantity' => 10,
            'description' => 'A sample product',
            'category_id' => 1
        ]));

        $responseContent = $client->getResponse()->getContent();
        $responseData = json_decode($responseContent, true);
        $productId = $responseData['product']['id'];

        $client->request('DELETE', '/api/products/' . $productId);
        $this->assertResponseStatusCodeSame(200);

        $responseContent = $client->getResponse()->getContent();
        $deleteResponse = json_decode($responseContent, true);

        $this->assertArrayHasKey('message', $deleteResponse);
        $this->assertEquals('Product deleted successfully!', $deleteResponse['message']);
    }
    
}
