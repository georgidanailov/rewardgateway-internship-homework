<?php

namespace App\Tests;

use App\Entity\Product;
use App\Entity\Category;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testProductId(): void
    {
        $product = new Product();
        $this->assertNull($product->getId());
    }

    public function testProductName(): void
    {
        $product = new Product();
        $this->assertNull($product->getName());

        $product->setName('Test Product');
        $this->assertEquals('Test Product', $product->getName());
    }

    public function testProductPrice(): void
    {
        $product = new Product();
        $this->assertNull($product->getPrice());

        $product->setPrice(19.99);
        $this->assertEquals(19.99, $product->getPrice());
    }

    public function testProductQuantity(): void
    {
        $product = new Product();
        $this->assertNull($product->getQuantity());

        $product->setQuantity(100);
        $this->assertEquals(100, $product->getQuantity());
    }

    public function testProductDescription(): void
    {
        $product = new Product();
        $this->assertNull($product->getDescription());

        $product->setDescription('This is a test product.');
        $this->assertEquals('This is a test product.', $product->getDescription());

        $product->setDescription(null);
        $this->assertNull($product->getDescription());
    }

    public function testProductCategory(): void
    {
        $product = new Product();
        $this->assertNull($product->getCategory());

        $category = new Category();
        $category->setName('Test Category');
        $product->setCategory($category);

        $this->assertEquals($category, $product->getCategory());
    }
}
