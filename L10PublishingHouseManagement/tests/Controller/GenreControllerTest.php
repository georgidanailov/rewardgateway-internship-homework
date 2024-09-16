<?php

namespace App\Tests\Controller;

use App\Entity\Genre;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class GenreControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private string $path = '/genre/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get(EntityManagerInterface::class);

        // Clean up the database before running each test
        $this->manager->createQuery('DELETE FROM App\Entity\Genre')->execute();
    }

    public function testCreateNewGenre(): void
    {
        $genre = new Genre();
        $genre->setName('Test Genre');
        $genre->setDescription('Test Description');

        $this->manager->persist($genre);
        $this->manager->flush();

        $savedGenre = $this->manager->getRepository(Genre::class)->findOneBy(['name' => 'Test Genre']);
        self::assertNotNull($savedGenre);
        self::assertSame('Test Genre', $savedGenre->getName());
        self::assertSame('Test Description', $savedGenre->getDescription());
    }

    public function testEditGenre(): void
    {
        $genre = $this->createGenre();

        $genre->setName('Updated Genre');
        $genre->setDescription('Updated Description');
        $this->manager->flush();

        $updatedGenre = $this->manager->getRepository(Genre::class)->find($genre->getId());
        self::assertSame('Updated Genre', $updatedGenre->getName());
        self::assertSame('Updated Description', $updatedGenre->getDescription());
    }

    private function createGenre(): Genre
    {
        $genre = new Genre();
        $genre->setName('Test Genre');
        $genre->setDescription('Test Description');

        $this->manager->persist($genre);
        $this->manager->flush();

        return $genre;
    }
}
