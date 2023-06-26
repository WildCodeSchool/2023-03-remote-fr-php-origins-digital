<?php

namespace App\Entity;

use App\Repository\ImageCategoryRepository;
use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ImageCategoryRepository::class)]
#[Vich\Uploadable]
class ImageCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $background = null;
    #[Vich\UploadableField(mapping: 'image_file', fileNameProperty: 'background')]
    private ?File $fileBackground = null;
    #[ORM\Column(length: 255)]
    private ?string $categoryCharacter = null;
    #[Vich\UploadableField(mapping: 'image_file', fileNameProperty: 'categoryCharacter')]
    private ?File $fileCharacter = null;
    #[ORM\Column(length: 255)]
    private ?string $categoryName = null;
    #[Vich\UploadableField(mapping: 'image_file', fileNameProperty: 'categoryName')]
    private ?File $fileName = null;
    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updated = null;

    #[ORM\ManyToOne(inversedBy: 'imageCategories')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBackground(): ?string
    {
        return $this->background;
    }

    public function setBackground(string $background): self
    {
        $this->background = $background;

        return $this;
    }

    public function getCategoryCharacter(): ?string
    {
        return $this->categoryCharacter;
    }

    public function setCategoryCharacter(string $categoryCharacter): self
    {
        $this->categoryCharacter = $categoryCharacter;

        return $this;
    }

    public function getCategoryName(): ?string
    {
        return $this->categoryName;
    }

    public function setCategoryName(string $categoryName): self
    {
        $this->categoryName = $categoryName;

        return $this;
    }

    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    public function setUpdated(?\DateTimeInterface $updated): self
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }
    public function getFileBackground(): ?File
    {
        return $this->fileBackground;
    }

    public function setFileBackground(File $image = null): ImageCategory
    {
        $this->fileBackground = $image;
        if ($image) {
            $this->updated = new DateTime('now');
        }
        return $this;
    }
    public function getFileCharacter(): ?File
    {
        return $this->fileCharacter;
    }

    public function setFileCharacter(File $image = null): ImageCategory
    {
        $this->fileCharacter = $image;
        if ($image) {
            $this->updated = new DateTime('now');
        }
        return $this;
    }
    public function getFileName(): ?File
    {
        return $this->fileName;
    }

    public function setFileName(File $image = null): ImageCategory
    {
        $this->fileName = $image;
        if ($image) {
            $this->updated = new DateTime('now');
        }
        return $this;
    }
}
