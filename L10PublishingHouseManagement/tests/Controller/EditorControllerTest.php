<?php

namespace App\Tests\Controller;

use App\Entity\Editor;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class EditorControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/editor/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Editor::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Editor index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'editor[name]' => 'Testing',
            'editor[editorial_number]' => 'Testing',
            'editor[specialty]' => 'Testing',
            'editor[books]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Editor();
        $fixture->setName('My Title');
        $fixture->setEditorial_number('My Title');
        $fixture->setSpecialty('My Title');
        $fixture->setBooks('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Editor');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Editor();
        $fixture->setName('Value');
        $fixture->setEditorial_number('Value');
        $fixture->setSpecialty('Value');
        $fixture->setBooks('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'editor[name]' => 'Something New',
            'editor[editorial_number]' => 'Something New',
            'editor[specialty]' => 'Something New',
            'editor[books]' => 'Something New',
        ]);

        self::assertResponseRedirects('/editor/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getEditorial_number());
        self::assertSame('Something New', $fixture[0]->getSpecialty());
        self::assertSame('Something New', $fixture[0]->getBooks());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Editor();
        $fixture->setName('Value');
        $fixture->setEditorial_number('Value');
        $fixture->setSpecialty('Value');
        $fixture->setBooks('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/editor/');
        self::assertSame(0, $this->repository->count([]));
    }
}
