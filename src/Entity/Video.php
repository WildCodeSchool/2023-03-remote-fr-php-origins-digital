<?php

namespace App\Entity;

use App\Repository\VideoRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: VideoRepository::class)]
#[Vich\Uploadable]
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

    #[Vich\UploadableField(mapping: 'video_file', fileNameProperty: 'videoUrl')]
    private ?File $videoFile = null;
    #[Vich\UploadableField(mapping: 'image_file', fileNameProperty: 'image')]
    private ?File $posterFile = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\Column]
    private ?bool $upcoming = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'bookmarks')]
    private Collection $userBookmarks;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'likes')]
    private Collection $userLikes;

    #[ORM\ManyToOne(inversedBy: 'videos')]
    private ?Category $category = null;

    #[ORM\ManyToMany(targetEntity: Tags::class, inversedBy: 'videos')]
    #[ORM\JoinTable(name: "video_tags")]
    private Collection $tag;

    public function __construct()
    {
        $this->userBookmarks = new ArrayCollection();
        $this->userLikes = new ArrayCollection();
        $this->tag = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUserBookmarks(): Collection
    {
        return $this->userBookmarks;
    }

    public function addUserBookmark(User $userBookmark): static
    {
        if (!$this->userBookmarks->contains($userBookmark)) {
            $this->userBookmarks->add($userBookmark);
            $userBookmark->addBookmark($this);
        }

        return $this;
    }

    public function removeUserBookmark(User $userBookmark): static
    {
        if ($this->userBookmarks->removeElement($userBookmark)) {
            $userBookmark->removeBookmark($this);
        }

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTimeInterface|null $updatedAt
     */
    public function setUpdatedAt(?\DateTimeInterface $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getVideoFile(): ?File
    {
        return $this->videoFile;
    }

    public function setVideoFile(File $video = null): Video
    {
        $this->videoFile = $video;
        if ($video) {
            $this->updatedAt = new DateTime('now');
        }
        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getPosterFile(): ?File
    {
        return $this->posterFile;
    }

    public function setPosterFile(File $image = null): Video
    {
        $this->posterFile = $image;
        if ($image) {
            $this->updatedAt = new DateTime('now');
        }
        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUserLikes(): Collection
    {
        return $this->userLikes;
    }

    public function addUserLike(User $userLike): static
    {
        if (!$this->userLikes->contains($userLike)) {
            $this->userLikes->add($userLike);
            $userLike->addLike($this);
        }

        return $this;
    }

    public function removeUserLike(User $userLike): static
    {
        if ($this->userLikes->removeElement($userLike)) {
            $userLike->removeLike($this);
        }

        return $this;
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

    /**
     * @return Collection<int, Tags>
     */
    public function getTag(): Collection
    {
        return $this->tag;
    }

    public function addTag(Tags $tag): static
    {
        if (!$this->tag->contains($tag)) {
            $this->tag->add($tag);
        }

        return $this;
    }

    public function removeTag(Tags $tag): static
    {
        $this->tag->removeElement($tag);

        return $this;
    }
}
