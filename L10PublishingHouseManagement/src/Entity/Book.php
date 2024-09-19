<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 13)]
    private ?string $isbn = null;

    #[ORM\Column]
    private ?int $publication_year = null;

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'books')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Author $author = null;

    #[ORM\ManyToMany(targetEntity: Editor::class, mappedBy: 'books')]
    private Collection $editors;

    #[ORM\ManyToMany(targetEntity: Genre::class, mappedBy: 'books')]
    private Collection $genres;

    public function __construct()
    {
        $this->editors = new ArrayCollection();
        $this->genres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function setIsbn(string $isbn): self
    {
        $this->isbn = $isbn;

        return $this;
    }

    public function getPublicationYear(): ?int
    {
        return $this->publication_year;
    }

    public function setPublicationYear(int $publication_year): self
    {
        $this->publication_year = $publication_year;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function setAuthor(?Author $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getEditors(): Collection
    {
        return $this->editors;
    }

    public function addEditor(Editor $editor): self
    {
        if (!$this->editors->contains($editor)) {
            $this->editors->add($editor);
            $editor->addBook($this);
        }

        return $this;
    }

    public function removeEditor(Editor $editor): self
    {
        if ($this->editors->removeElement($editor)) {
            $editor->removeBook($this);
        }

        return $this;
    }

    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(Genre $genre): self
    {
        if (!$this->genres->contains($genre)) {
            $this->genres->add($genre);
            $genre->addBook($this);
        }

        return $this;
    }

    public function removeGenre(Genre $genre): self
    {
        if ($this->genres->removeElement($genre)) {
            $genre->removeBook($this);
        }

        return $this;
    }
}
