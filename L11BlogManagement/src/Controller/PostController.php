<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Comment;
use App\Form\PostType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/post')]
class PostController extends AbstractController
{
    #[Route('/', name: 'app_post_index', methods: ['GET'])]
    public function index(PostRepository $postRepository): Response
    {
        $posts = $postRepository->findAll();
        $deleteForms = [];

        foreach ($posts as $post) {
            $deleteForms[$post->getId()] = $this->createDeleteForm($post)->createView();
        }

        return $this->render('post/index.html.twig', [
            'posts' => $posts,
            'delete_forms' => $deleteForms,
        ]);
    }

    #[Route('/new', name: 'app_post_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Commented out role checks
        // $this->denyAccessUnlessGranted(['ROLE_AUTHOR', 'ROLE_ADMIN']);

        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post->setUser($this->getUser());
            $post->setDateAdded(new \DateTime());

            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('app_post_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('post/new.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_post_show', methods: ['GET'])]
    public function show(Post $post): Response
    {
        $deletePostForm = $this->createDeleteForm($post);
        $deleteCommentForms = [];

        foreach ($post->getComments() as $comment) {
            $deleteCommentForms[$comment->getId()] = $this->createDeleteCommentForm($comment)->createView();
        }

        return $this->render('post/show.html.twig', [
            'post' => $post,
            'delete_post_form' => $deletePostForm->createView(),
            'delete_comment_forms' => $deleteCommentForms,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_post_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Post $post, EntityManagerInterface $entityManager): Response
    {
        // Commented out role checks
        // $this->denyAccessUnlessGranted(['ROLE_AUTHOR', 'ROLE_ADMIN']);

        if ($post->getUser() !== $this->getUser() && !$this->isGranted('ROLE_ADMIN')) {
            throw $this->createAccessDeniedException('You do not have permission to edit this post.');
        }

        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_post_index', [], Response::HTTP_SEE_OTHER);
        }

        $deletePostForm = $this->createDeleteForm($post);

        return $this->render('post/edit.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
            'delete_post_form' => $deletePostForm->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_post_delete', methods: ['POST'])]
    public function delete(Request $request, Post $post, EntityManagerInterface $entityManager): Response
    {
        // Commented out role checks
        // $this->denyAccessUnlessGranted(['ROLE_AUTHOR', 'ROLE_ADMIN']);

        if ($post->getUser() !== $this->getUser() && !$this->isGranted('ROLE_ADMIN')) {
            throw $this->createAccessDeniedException('You do not have permission to delete this post.');
        }

        if ($this->isCsrfTokenValid('delete' . $post->getId(), $request->request->get('_token'))) {
            $entityManager->remove($post);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_post_index', [], Response::HTTP_SEE_OTHER);
    }

    private function createDeleteForm(Post $post)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('app_post_delete', ['id' => $post->getId()]))
            ->setMethod('DELETE')
            ->getForm();
    }

    private function createDeleteCommentForm(Comment $comment)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('app_comment_delete', ['id' => $comment->getId()]))
            ->setMethod('DELETE')
            ->getForm();
    }
}
