<?php

namespace App\DataFixtures;

use App\Entity\Book;
use App\Entity\Author;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $author = new Author();
        $author->setName('Test Author');
        $author->setBirthYear(1975);
        $author->setNationality('American');

        $manager->persist($author);

        $book = new Book();
        $book->setTitle('Test Book');
        $book->setIsbn('1234567890123');
        $book->setPublicationYear(2020);
        $book->setAuthor($author);

        $manager->persist($book);

        $manager->flush();
    }
}
