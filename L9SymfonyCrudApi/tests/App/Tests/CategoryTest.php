<?php

namespace App\Tests;

use App\Entity\Category;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    public function testCategoryId(): void
    {
        $category = new Category();
        $this->assertNull($category->getId());

        $category->setId(1);
        $this->assertEquals(1, $category->getId());
    }

    public function testCategoryName(): void
    {
        $category = new Category();
        $this->assertNull($category->getName());

        $category->setName('Test Category');
        $this->assertEquals('Test Category', $category->getName());
    }

    public function testCategoryDescription(): void
    {
        $category = new Category();
        $this->assertNull($category->getDescription());

        $category->setDescription('Test Description');
        $this->assertEquals('Test Description', $category->getDescription());

        $category->setDescription(null);
        $this->assertNull($category->getDescription());
    }
}
