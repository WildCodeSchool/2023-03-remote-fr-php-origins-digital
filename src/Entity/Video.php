<?php

namespace App\Entity;

use App\Repository\VideoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VideoRepository::class)]
class Video
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 45)]
    private ?string $title = null;


    #[ORM\Column]
    private ?int $time = null;

    #[ORM\Column(length: 255)]
    private ?string $videoUrl = null;

    #[ORM\Column(nullable: true)]
    private ?int $views = null;

    #[ORM\Column]
    private ?bool $private = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $realeaseDate = null;

    #[ORM\Column]
    private ?bool $upcoming = null;

    #[ORM\OneToMany(mappedBy: 'video', targetEntity: ImageVideo::class)]
    private Collection $imageVideos;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    public function __construct()
    {
        $this->imageVideos = new ArrayCollection();
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


    public function getTime(): ?int
    {
        return $this->time;
    }

    public function setTime(int $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getVideoUrl(): ?string
    {
        return $this->videoUrl;
    }

    public function setVideoUrl(string $videoUrl): self
    {
        $this->videoUrl = $videoUrl;

        return $this;
    }

    public function getViews(): ?int
    {
        return $this->views;
    }

    public function setViews(?int $views): self
    {
        $this->views = $views;

        return $this;
    }

    public function isPrivate(): ?bool
    {
        return $this->private;
    }

    public function setPrivate(bool $private): self
    {
        $this->private = $private;

        return $this;
    }

    public function getRealeaseDate(): ?\DateTimeInterface
    {
        return $this->realeaseDate;
    }

    public function setRealeaseDate(\DateTimeInterface $realeaseDate): self
    {
        $this->realeaseDate = $realeaseDate;

        return $this;
    }

    public function isUpcoming(): ?bool
    {
        return $this->upcoming;
    }

    public function setUpcoming(bool $upcoming): self
    {
        $this->upcoming = $upcoming;

        return $this;
    }

    /**
     * @return Collection<int, ImageVideo>
     */
    public function getImageVideos(): Collection
    {
        return $this->imageVideos;
    }

    public function addImageVideo(ImageVideo $imageVideo): self
    {
        if (!$this->imageVideos->contains($imageVideo)) {
            $this->imageVideos->add($imageVideo);
            $imageVideo->setVideo($this);
        }

        return $this;
    }

    public function removeImageVideo(ImageVideo $imageVideo): self
    {
        if ($this->imageVideos->removeElement($imageVideo)) {
            // set the owning side to null (unless already changed)
            if ($imageVideo->getVideo() === $this) {
                $imageVideo->setVideo(null);
            }
        }

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}