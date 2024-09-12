<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/api/products', name: 'create_product', methods: ['POST'])]
    public function createProduct(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (empty($data['name']) || empty($data['price']) || empty($data['quantity']) || empty($data['category_id'])) {
            return $this->json(['error' => 'Missing required fields'], 400);
        }

        $category = $this->em->getRepository(Category::class)->find($data['category_id']);
        if (!$category) {
            return $this->json(['error' => 'Category not found'], 404);
        }

        $product = new Product();
        $product->setName($data['name']);
        $product->setPrice($data['price']);
        $product->setQuantity($data['quantity']);
        $product->setDescription($data['description'] ?? null);
        $product->setCategory($category);

        $this->em->persist($product);
        $this->em->flush();

        return $this->json([
            'message' => 'Product created successfully!',
            'product' => $product
        ], 201);
    }

    #[Route('/api/products', name: 'get_products', methods: ['GET'])]
    public function getProducts(): JsonResponse
    {
        $products = $this->em->getRepository(Product::class)->findAll();
        return $this->json($products, 200);
    }

    #[Route('/api/products/{id}', name: 'get_product', methods: ['GET'])]
    public function getProduct(int $id): JsonResponse
    {
        $product = $this->em->getRepository(Product::class)->find($id);

        if (!$product) {
            return $this->json(['error' => 'Product not found'], 404);
        }

        return $this->json($product, 200);
    }

    #[Route('/api/products/{id}', name: 'update_product', methods: ['PUT'])]
    public function updateProduct(int $id, Request $request): JsonResponse
    {
        $product = $this->em->getRepository(Product::class)->find($id);

        if (!$product) {
            return $this->json(['error' => 'Product not found'], 404);
        }

        $data = json_decode($request->getContent(), true);

        if (isset($data['name'])) {
            $product->setName($data['name']);
        }

        if (isset($data['price'])) {
            $product->setPrice($data['price']);
        }

        if (isset($data['quantity'])) {
            $product->setQuantity($data['quantity']);
        }

        if (isset($data['description'])) {
            $product->setDescription($data['description']);
        }

        if (isset($data['category_id'])) {
            $category = $this->em->getRepository(Category::class)->find($data['category_id']);
            if (!$category) {
                return $this->json(['error' => 'Category not found'], 404);
            }
            $product->setCategory($category);
        }

        $this->em->flush();

        return $this->json(['message' => 'Product updated successfully!', 'product' => $product], 200);
    }

    #[Route('/api/products/{id}', name: 'delete_product', methods: ['DELETE'])]
    public function deleteProduct(int $id): JsonResponse
    {
        $product = $this->em->getRepository(Product::class)->find($id);

        if (!$product) {
            return $this->json(['error' => 'Product not found'], 404);
        }

        $this->em->remove($product);
        $this->em->flush();

        return $this->json(['message' => 'Product deleted successfully!'], 200);
    }
}
