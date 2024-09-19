<?php

namespace App\Tests\Controller;

use App\Entity\Editor;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class EditorControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private string $path = '/editor/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get(EntityManagerInterface::class);

        // Clean up the database before running each test
        $this->manager->createQuery('DELETE FROM App\Entity\Editor')->execute();
    }

    public function testCreateNewEditor(): void
    {
        $editor = new Editor();
        $editor->setName('Test Editor');
        $editor->setEditorialNumber('ED1234');
        $editor->setSpecialty('Fiction');

        $this->manager->persist($editor);
        $this->manager->flush();

        // Fetch the editor from the database and assert it exists
        $savedEditor = $this->manager->getRepository(Editor::class)->findOneBy(['name' => 'Test Editor']);
        self::assertNotNull($savedEditor);
        self::assertSame('Test Editor', $savedEditor->getName());
        self::assertSame('ED1234', $savedEditor->getEditorialNumber());
        self::assertSame('Fiction', $savedEditor->getSpecialty());
    }

    public function testEditEditor(): void
    {
        $editor = $this->createEditor();

        $editor->setName('Updated Editor');
        $editor->setEditorialNumber('ED5678');
        $editor->setSpecialty('Non-Fiction');

        $this->manager->flush();

        $updatedEditor = $this->manager->getRepository(Editor::class)->find($editor->getId());
        self::assertSame('Updated Editor', $updatedEditor->getName());
        self::assertSame('ED5678', $updatedEditor->getEditorialNumber());
        self::assertSame('Non-Fiction', $updatedEditor->getSpecialty());
    }
    

    private function createEditor(): Editor
    {
        $editor = new Editor();
        $editor->setName('Test Editor');
        $editor->setEditorialNumber('ED1234');
        $editor->setSpecialty('Fiction');

        $this->manager->persist($editor);
        $this->manager->flush();  // Make sure the entity is saved, and the ID is generated

        return $editor;
    }
}
