<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    public function __construct()
    {
        $this->imageCategory = new ArrayCollection();
        $this->videos = new ArrayCollection();
    }
    #[ORM\OneToMany(mappedBy: 'category', targetEntity: ImageCategory::class, orphanRemoval: true)]
    private Collection $imageCategory;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Video::class)]
    private Collection $videos;

    public function __toString(): string
    {
        return $this->name;
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

    /* @return Collection<int, ImageCategory>
    */

    public function getImageCategory(): Collection
    {
        return $this->imageCategory;
    }

    public function addImageCategory(ImageCategory $imageCategory): static
    {
        if (!$this->imageCategory->contains($imageCategory)) {
            $this->imageCategory->add($imageCategory);
            $imageCategory->setCategory($this);
        }

        return $this;
    }

    public function removeImageCategory(ImageCategory $imageCategory): static
    {
        if ($this->imageCategory->removeElement($imageCategory)) {
            // set the owning side to null (unless already changed)
            if ($imageCategory->getCategory() === $this) {
                $imageCategory->setCategory(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection<int, Video>
     */
    public function getVideos(): Collection
    {
        return $this->videos;
    }

    public function addVideo(Video $video): static
    {
        if (!$this->videos->contains($video)) {
            $this->videos->add($video);
            $video->setCategory($this);
        }

        return $this;
    }

    public function removeVideo(Video $video): static
    {
        if ($this->videos->removeElement($video)) {
            // set the owning side to null (unless already changed)
            if ($video->getCategory() === $this) {
                $video->setCategory(null);
            }
        }

        return $this;
    }
}
