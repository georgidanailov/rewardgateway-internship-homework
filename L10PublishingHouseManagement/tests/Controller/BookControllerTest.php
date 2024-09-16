<?php

namespace App\Tests\Controller;

use App\Entity\Book;
use App\Entity\Author;
use App\Entity\Editor;
use App\Entity\Genre;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class BookControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private string $path = '/book/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get(EntityManagerInterface::class);

        // Clean up the database before each test
        $this->manager->createQuery('DELETE FROM App\Entity\Book')->execute();
        $this->manager->createQuery('DELETE FROM App\Entity\Author')->execute();
        $this->manager->createQuery('DELETE FROM App\Entity\Editor')->execute();
        $this->manager->createQuery('DELETE FROM App\Entity\Genre')->execute();
    }

    public function testCreateNewBook(): void
    {
        $author = $this->createAuthor();
        $editor = $this->createEditor();
        $genre = $this->createGenre();

        $book = new Book();
        $book->setTitle('Test Book');
        $book->setIsbn('1234567890123');
        $book->setPublicationYear(2021);
        $book->setAuthor($author);
        $book->addEditor($editor);
        $book->addGenre($genre);

        $this->manager->persist($book);
        $this->manager->flush();

        $savedBook = $this->manager->getRepository(Book::class)->findOneBy(['title' => 'Test Book']);
        self::assertNotNull($savedBook);
        self::assertSame('Test Book', $savedBook->getTitle());
        self::assertSame('1234567890123', $savedBook->getIsbn());
        self::assertSame(2021, $savedBook->getPublicationYear());
    }

    public function testEditBook(): void
    {
        $book = $this->createBook();

        $book->setTitle('Updated Book');
        $book->setIsbn('9876543210987');
        $book->setPublicationYear(2022);

        $this->manager->flush();

        $updatedBook = $this->manager->getRepository(Book::class)->find($book->getId());
        self::assertSame('Updated Book', $updatedBook->getTitle());
        self::assertSame('9876543210987', $updatedBook->getIsbn());
        self::assertSame(2022, $updatedBook->getPublicationYear());
    }

    private function createAuthor(): Author
    {
        $author = new Author();
        $author->setName('Test Author');
        $author->setBirthYear(1980);
        $author->setNationality('Test Nationality');

        $this->manager->persist($author);
        $this->manager->flush();

        return $author;
    }

    private function createEditor(): Editor
    {
        $editor = new Editor();
        $editor->setName('Test Editor');
        $editor->setEditorialNumber('ED1234');
        $editor->setSpecialty('Fiction');

        $this->manager->persist($editor);
        $this->manager->flush();

        return $editor;
    }

    private function createGenre(): Genre
    {
        $genre = new Genre();
        $genre->setName('Test Genre');
        $genre->setDescription('A test genre description.');

        $this->manager->persist($genre);
        $this->manager->flush();

        return $genre;
    }

    private function createBook(): Book
    {
        $author = $this->createAuthor();
        $editor = $this->createEditor();
        $genre = $this->createGenre();

        $book = new Book();
        $book->setTitle('Test Book');
        $book->setIsbn('1234567890123');
        $book->setPublicationYear(2021);
        $book->setAuthor($author);
        $book->addEditor($editor);
        $book->addGenre($genre);

        $this->manager->persist($book);
        $this->manager->flush();

        return $book;
    }
}
