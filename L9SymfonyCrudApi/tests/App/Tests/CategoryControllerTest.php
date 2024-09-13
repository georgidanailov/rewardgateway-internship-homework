<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoryControllerTest extends WebTestCase
{
    public function testCreateCategory(): void
    {
        $client = static::createClient();

        $client->request('POST', '/api/categories', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'Test Category',
            'description' => 'Test Description',
        ]));

        $this->assertResponseStatusCodeSame(201);

        $responseContent = $client->getResponse()->getContent();
        $responseData = json_decode($responseContent, true);

        $this->assertArrayHasKey('message', $responseData);
        $this->assertEquals('Category created successfully!', $responseData['message']);
    }


    public function testGetCategories(): void
    {
        $client = static::createClient();

        $client->request('POST', '/api/categories', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'Test Category',
            'description' => 'Test Description',
        ]));

        $client->request('GET', '/api/categories');
        $this->assertResponseStatusCodeSame(200);

        $responseContent = $client->getResponse()->getContent();
        $responseData = json_decode($responseContent, true);

        $this->assertIsArray($responseData);
        $this->assertNotEmpty($responseData);
    }

    public function testGetCategoryById(): void
    {
        $client = static::createClient();

        $client->request('POST', '/api/categories', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'Test Category',
            'description' => 'Test Description',
        ]));

        $responseContent = $client->getResponse()->getContent();
        $responseData = json_decode($responseContent, true);
        $categoryId = $responseData['category']['id'];

        $client->request('GET', '/api/categories/' . $categoryId);
        $this->assertResponseStatusCodeSame(200);

        $responseContent = $client->getResponse()->getContent();
        $categoryData = json_decode($responseContent, true);

        $this->assertArrayHasKey('name', $categoryData);
        $this->assertEquals('Test Category', $categoryData['name']);
    }

    public function testUpdateCategory(): void
    {
        $client = static::createClient();

        $client->request('POST', '/api/categories', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'Test Category',
            'description' => 'Test Description',
        ]));

        $responseContent = $client->getResponse()->getContent();
        $responseData = json_decode($responseContent, true);
        $categoryId = $responseData['category']['id'];

        $client->request('PUT', '/api/categories/' . $categoryId, [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'Updated Category',
            'description' => 'Updated Description',
        ]));

        $this->assertResponseStatusCodeSame(200);

        $responseContent = $client->getResponse()->getContent();
        $updatedData = json_decode($responseContent, true);

        $this->assertArrayHasKey('message', $updatedData);
        $this->assertEquals('Category updated successfully!', $updatedData['message']);
    }

    public function testDeleteCategory(): void
    {
        $client = static::createClient();

        $client->request('POST', '/api/categories', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'Test Category',
            'description' => 'Test Description',
        ]));

        $responseContent = $client->getResponse()->getContent();
        $responseData = json_decode($responseContent, true);
        $categoryId = $responseData['category']['id'];

        $client->request('DELETE', '/api/categories/' . $categoryId);
        $this->assertResponseStatusCodeSame(200);

        $responseContent = $client->getResponse()->getContent();
        $deleteResponse = json_decode($responseContent, true);

        $this->assertArrayHasKey('message', $deleteResponse);
        $this->assertEquals('Category deleted successfully!', $deleteResponse['message']);
    }
    
}

