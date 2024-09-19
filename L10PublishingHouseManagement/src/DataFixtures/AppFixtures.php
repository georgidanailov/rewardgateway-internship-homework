<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Editor;
use App\Entity\Genre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $darkFantasy = new Genre();
        $darkFantasy->setName('Dark Fantasy');
        $darkFantasy->setDescription('A subgenre of fantasy that features grim and darker themes.');
        $manager->persist($darkFantasy);

        $adventure = new Genre();
        $adventure->setName('Adventure');
        $adventure->setDescription('A genre featuring exciting journeys and explorations.');
        $manager->persist($adventure);

        $highFantasy = new Genre();
        $highFantasy->setName('High Fantasy');
        $highFantasy->setDescription('A genre featuring epic tales set in imaginary worlds.');
        $manager->persist($highFantasy);

        $youngAdult = new Genre();
        $youngAdult->setName('Young Adult');
        $youngAdult->setDescription('A genre targeting young adult readers.');
        $manager->persist($youngAdult);

        $scienceFiction = new Genre();
        $scienceFiction->setName('Science Fiction');
        $scienceFiction->setDescription('A genre based on speculative science and futuristic themes.');
        $manager->persist($scienceFiction);

        $dystopian = new Genre();
        $dystopian->setName('Dystopian');
        $dystopian->setDescription('A genre depicting an imagined state where everything is unpleasant or bad.');
        $manager->persist($dystopian);

        $politicalFiction = new Genre();
        $politicalFiction->setName('Political Fiction');
        $politicalFiction->setDescription('A genre focused on political affairs and concepts.');
        $manager->persist($politicalFiction);

        $editor1 = new Editor();
        $editor1->setName('Yukari Fujimoto');
        $editor1->setEditorialNumber('12345');
        $editor1->setSpecialty('Manga Editing');
        $manager->persist($editor1);

        $editor2 = new Editor();
        $editor2->setName('Yoko Ueda');
        $editor2->setEditorialNumber('23456');
        $editor2->setSpecialty('Fantasy Editing');
        $manager->persist($editor2);

        $editor3 = new Editor();
        $editor3->setName('Rayner Unwin');
        $editor3->setEditorialNumber('34567');
        $editor3->setSpecialty('Fantasy Editing');
        $manager->persist($editor3);

        $editor4 = new Editor();
        $editor4->setName('Barry Cunningham');
        $editor4->setEditorialNumber('45678');
        $editor4->setSpecialty('Children\'s Literature Editing');
        $manager->persist($editor4);

        $editor5 = new Editor();
        $editor5->setName('John W. Campbell Jr.');
        $editor5->setEditorialNumber('56789');
        $editor5->setSpecialty('Science Fiction Editing');
        $manager->persist($editor5);

        $editor6 = new Editor();
        $editor6->setName('Fredric Warburg');
        $editor6->setEditorialNumber('67890');
        $editor6->setSpecialty('Political Fiction Editing');
        $manager->persist($editor6);

        $author1 = new Author();
        $author1->setName('Kentaro Miura');
        $author1->setBirthYear(1966);
        $author1->setNationality('Japanese');
        $manager->persist($author1);

        $author2 = new Author();
        $author2->setName('J.R.R. Tolkien');
        $author2->setBirthYear(1892);
        $author2->setNationality('British');
        $manager->persist($author2);

        $author3 = new Author();
        $author3->setName('J.K. Rowling');
        $author3->setBirthYear(1965);
        $author3->setNationality('British');
        $manager->persist($author3);

        $author4 = new Author();
        $author4->setName('Frank Herbert');
        $author4->setBirthYear(1920);
        $author4->setNationality('American');
        $manager->persist($author4);

        $author5 = new Author();
        $author5->setName('George Orwell');
        $author5->setBirthYear(1903);
        $author5->setNationality('British');
        $manager->persist($author5);

        $book1 = new Book();
        $book1->setTitle('Berserk');
        $book1->setIsbn('9781593070205');
        $book1->setPublicationYear(1989);
        $book1->setDescription('A dark fantasy epic that follows Guts, a lone mercenary, in his fight against evil forces.');
        $book1->setAuthor($author1);
        $book1->addEditor($editor1);
        $book1->addEditor($editor2);
        $book1->addGenre($darkFantasy);
        $book1->addGenre($adventure);
        $manager->persist($book1);

        $book2 = new Book();
        $book2->setTitle('The Lord of the Rings');
        $book2->setIsbn('9780544003415');
        $book2->setPublicationYear(1954);
        $book2->setDescription('A legendary high-fantasy novel following Frodo Baggins\' journey to destroy the One Ring.');
        $book2->setAuthor($author2);
        $book2->addEditor($editor3);
        $book2->addGenre($highFantasy);
        $book2->addGenre($adventure);
        $manager->persist($book2);

        $book3 = new Book();
        $book3->setTitle('Harry Potter and the Sorcerer\'s Stone');
        $book3->setIsbn('9780439708180');
        $book3->setPublicationYear(1997);
        $book3->setDescription('A young wizard discovers his magical heritage and attends Hogwarts School.');
        $book3->setAuthor($author3);
        $book3->addEditor($editor4);
        $book3->addGenre($youngAdult);
        $manager->persist($book3);

        $book4 = new Book();
        $book4->setTitle('Dune');
        $book4->setIsbn('9780441013593');
        $book4->setPublicationYear(1965);
        $book4->setDescription('Set on the desert planet Arrakis, Dune follows Paul Atreides in his quest for survival.');
        $book4->setAuthor($author4);
        $book4->addEditor($editor5);
        $book4->addGenre($scienceFiction);
        $book4->addGenre($adventure);
        $manager->persist($book4);

        $book5 = new Book();
        $book5->setTitle('1984');
        $book5->setIsbn('9780451524935');
        $book5->setPublicationYear(1949);
        $book5->setDescription('A dystopian novel about the dangers of totalitarianism and extreme political ideology.');
        $book5->setAuthor($author5);
        $book5->addEditor($editor6);
        $book5->addGenre($dystopian);
        $book5->addGenre($politicalFiction);
        $manager->persist($book5);

        $manager->flush();
    }
}
