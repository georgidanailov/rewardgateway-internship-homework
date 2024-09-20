<?php

namespace App\Tests;

use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\User;
use PHPUnit\Framework\TestCase;
use DateTime;

class CommentTest extends TestCase
{
    public function testGettersAndSetters(): void
    {
        $comment = new Comment();

        // Test ID
        $this->assertNull($comment->getId());

        // Test Content
        $content = 'This is a test comment.';
        $comment->setContent($content);
        $this->assertEquals($content, $comment->getContent());

        // Test Rating
        $rating = 5;
        $comment->setRating($rating);
        $this->assertEquals($rating, $comment->getRating());

        // Test DateAdded
        $dateAdded = new DateTime();
        $comment->setDateAdded($dateAdded);
        $this->assertEquals($dateAdded, $comment->getDateAdded());

        // Test User
        $user = new User();
        $comment->setUser($user);
        $this->assertEquals($user, $comment->getUser());

        // Test Post
        $post = new Post();
        $comment->setPost($post);
        $this->assertEquals($post, $comment->getPost());
    }
}
