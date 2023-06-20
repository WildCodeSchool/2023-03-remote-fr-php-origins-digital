<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'categories')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Genre $genre = null;

    #[ORM\OneToMany(mappedBy: 'categories', targetEntity: ImagesCategories::class)]
    private Collection $imagesCategories;

    public function __construct()
    {
        $this->imagesCategories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getGenre(): ?Genre
    {
        return $this->genre;
    }

    public function setGenre(?Genre $genre): static
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * @return Collection<int, ImagesCategories>
     */
    public function getImagesCategories(): Collection
    {
        return $this->imagesCategories;
    }

    public function addImagesCategory(ImagesCategories $imagesCategory): static
    {
        if (!$this->imagesCategories->contains($imagesCategory)) {
            $this->imagesCategories->add($imagesCategory);
            $imagesCategory->setCategories($this);
        }

        return $this;
    }

    public function removeImagesCategory(ImagesCategories $imagesCategory): static
    {
        if ($this->imagesCategories->removeElement($imagesCategory)) {
            // set the owning side to null (unless already changed)
            if ($imagesCategory->getCategories() === $this) {
                $imagesCategory->setCategories(null);
            }
        }

        return $this;
    }
}
