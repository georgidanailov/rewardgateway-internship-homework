<?php

namespace App\Tests;

use App\Entity\Post;
use App\Entity\Comment;
use App\Entity\User;
use PHPUnit\Framework\TestCase;
use DateTime;

class PostTest extends TestCase
{
    public function testGettersAndSetters(): void
    {
        $post = new Post();

        // Test ID
        $this->assertNull($post->getId());

        // Test Name
        $name = 'Test Post';
        $post->setName($name);
        $this->assertEquals($name, $post->getName());

        // Test Description
        $description = 'This is a test post description.';
        $post->setDescription($description);
        $this->assertEquals($description, $post->getDescription());

        // Test User
        $user = new User();
        $post->setUser($user);
        $this->assertEquals($user, $post->getUser());

        // Test DateAdded
        $dateAdded = new DateTime();
        $post->setDateAdded($dateAdded);
        $this->assertEquals($dateAdded, $post->getDateAdded());
    }

    public function testComments(): void
    {
        $post = new Post();
        $comment1 = new Comment();
        $comment2 = new Comment();

        // Test initial comments collection is empty
        $this->assertCount(0, $post->getComments());

        // Test adding comments
        $post->addComment($comment1);
        $post->addComment($comment2);

        $this->assertCount(2, $post->getComments());
        $this->assertTrue($post->getComments()->contains($comment1));
        $this->assertTrue($post->getComments()->contains($comment2));
        $this->assertEquals($post, $comment1->getPost());
        $this->assertEquals($post, $comment2->getPost());

        // Test removing a comment
        $post->removeComment($comment1);
        $this->assertCount(1, $post->getComments());
        $this->assertFalse($post->getComments()->contains($comment1));
        $this->assertNull($comment1->getPost());

        // Test orphan removal
        $post->removeComment($comment2);
        $this->assertCount(0, $post->getComments());
        $this->assertNull($comment2->getPost());
    }
}
