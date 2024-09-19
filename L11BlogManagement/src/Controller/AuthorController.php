<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    #[Route('/authors', name: 'app_author_index')]
    public function index(): Response
    {
        // In a real application, you would fetch the authors from the database
        $authors = [
            ['name' => 'Author One', 'bio' => 'Bio of Author One.'],
            ['name' => 'Author Two', 'bio' => 'Bio of Author Two.'],
        ];

        return $this->render('author/index.html.twig', [
            'authors' => $authors,
        ]);
    }
}
