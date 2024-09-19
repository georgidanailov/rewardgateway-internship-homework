<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    #[Route('/posts', name: 'app_post_index')]
    public function index(): Response
    {
        // In a real application, you would fetch the posts from the database
        $posts = [
            ['title' => 'First Post', 'content' => 'This is the first post.'],
            ['title' => 'Second Post', 'content' => 'This is the second post.'],
        ];

        return $this->render('post/index.html.twig', [
            'posts' => $posts,
        ]);
    }
}
