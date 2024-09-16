<?php

namespace App\Tests\Controller;

use App\Entity\Author;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Doctrine\ORM\EntityManagerInterface;

final class AuthorControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get(EntityManagerInterface::class);

        // Clean up database before each test
        foreach ($this->manager->getRepository(Author::class)->findAll() as $author) {
            $this->manager->remove($author);
        }
        $this->manager->flush();
    }

    public function testIndex(): void
    {
        // Check the response of the index page
        $this->client->request('GET', '/author');
        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('h1', 'Author index');
    }

    public function testNew(): void
    {
        $crawler = $this->client->request('GET', '/author/new');
        self::assertResponseIsSuccessful();

        // Submit the form
        $this->client->submitForm('Save', [
            'author[name]' => 'Test Author',
            'author[birth_year]' => 1980,
            'author[nationality]' => 'Test Nationality',
        ]);

        // Follow the redirection after the form submission
        self::assertResponseRedirects('/author');
        $this->client->followRedirect();

        // Ensure that the new author is added
        $newAuthor = $this->manager->getRepository(Author::class)->findOneBy(['name' => 'Test Author']);
        self::assertNotNull($newAuthor);
        self::assertSame(1980, $newAuthor->getBirthYear());
        self::assertSame('Test Nationality', $newAuthor->getNationality());
    }

    public function testEdit(): void
    {
        // Create and persist a new author
        $author = new Author();
        $author->setName('Test Author');
        $author->setBirthYear(1980);
        $author->setNationality('Test Nationality');
        $this->manager->persist($author);
        $this->manager->flush();

        // Request the edit page for the author
        $this->client->request('GET', '/author/' . $author->getId() . '/edit');
        self::assertResponseIsSuccessful();

        // Submit the form with updated values
        $this->client->submitForm('Update', [
            'author[name]' => 'Updated Author',
            'author[birth_year]' => 1990,
            'author[nationality]' => 'Updated Nationality',
        ]);

        // Follow the redirection after the form submission
        self::assertResponseRedirects('/author');
        $this->client->followRedirect();

        // Ensure the author's data has been updated
        $updatedAuthor = $this->manager->getRepository(Author::class)->find($author->getId());
        self::assertSame('Updated Author', $updatedAuthor->getName());
        self::assertSame(1990, $updatedAuthor->getBirthYear());
        self::assertSame('Updated Nationality', $updatedAuthor->getNationality());
    }

    public function testDelete(): void
    {
        // Create and persist a new author
        $author = new Author();
        $author->setName('Test Author');
        $author->setBirthYear(1980);
        $author->setNationality('Test Nationality');
        $this->manager->persist($author);
        $this->manager->flush();

        // Request the delete action
        $this->client->request('GET', '/author/' . $author->getId());
        self::assertResponseIsSuccessful();

        // Submit the delete form
        $this->client->submitForm('Delete');

        // Follow the redirection after deletion
        self::assertResponseRedirects('/author');
        $this->client->followRedirect();

        // Ensure the author has been deleted
        $deletedAuthor = $this->manager->getRepository(Author::class)->find($author->getId());
        self::assertNull($deletedAuthor);
    }
}
