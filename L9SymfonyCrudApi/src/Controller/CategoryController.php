<?php

namespace App\Controller;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/api/categories', name: 'create_category', methods: ['POST'])]
    public function createCategory(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (empty($data['name'])) {
            return $this->json(['error' => 'Category name is required'], 400);
        }

        $category = new Category();
        $category->setName($data['name']);
        $category->setDescription($data['description'] ?? null);

        $this->em->persist($category);
        $this->em->flush();

        return $this->json([
            'message' => 'Category created successfully!',
            'category' => $category
        ], 201);
    }

    #[Route('/api/categories', name: 'get_categories', methods: ['GET'])]
    public function getCategories(): JsonResponse
    {
        $categories = $this->em->getRepository(Category::class)->findAll();

        return $this->json($categories, 200);
    }

    #[Route('/api/categories/{id}', name: 'get_category', methods: ['GET'])]
    public function getCategory(int $id): JsonResponse
    {
        $category = $this->em->getRepository(Category::class)->find($id);

        if (!$category) {
            return $this->json(['error' => 'Category not found'], 404);
        }

        return $this->json($category, 200);
    }

    #[Route('/api/categories/{id}', name: 'update_category', methods: ['PUT'])]
    public function updateCategory(int $id, Request $request): JsonResponse
    {
        $category = $this->em->getRepository(Category::class)->find($id);

        if (!$category) {
            return $this->json(['error' => 'Category not found'], 404);
        }

        $data = json_decode($request->getContent(), true);

        if (isset($data['name'])) {
            $category->setName($data['name']);
        }

        if (isset($data['description'])) {
            $category->setDescription($data['description']);
        }

        $this->em->flush();

        return $this->json(['message' => 'Category updated successfully!', 'category' => $category], 200);
    }

    #[Route('/api/categories/{id}', name: 'delete_category', methods: ['DELETE'])]
    public function deleteCategory(int $id): JsonResponse
    {
        $category = $this->em->getRepository(Category::class)->find($id);

        if (!$category) {
            return $this->json(['error' => 'Category not found'], 404);
        }

        $this->em->remove($category);
        $this->em->flush();

        return $this->json(['message' => 'Category deleted successfully!'], 200);
    }
}
