<?php

namespace App\Entity;

use App\Repository\GenreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GenreRepository::class)]
class Genre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'genre', targetEntity: ImageGenre::class, orphanRemoval: true)]
    private Collection $imageGenres;

    public function __construct()
    {
        $this->imageGenres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return Collection<int, ImageGenre>
     */
    public function getImageGenres(): Collection
    {
        return $this->imageGenres;
    }

    public function addImageGenre(ImageGenre $imageGenre): static
    {
        if (!$this->imageGenres->contains($imageGenre)) {
            $this->imageGenres->add($imageGenre);
            $imageGenre->setGenre($this);
        }

        return $this;
    }

    public function removeImageGenre(ImageGenre $imageGenre): static
    {
        if ($this->imageGenres->removeElement($imageGenre)) {
            // set the owning side to null (unless already changed)
            if ($imageGenre->getGenre() === $this) {
                $imageGenre->setGenre(null);
            }
        }

        return $this;
    }
}
