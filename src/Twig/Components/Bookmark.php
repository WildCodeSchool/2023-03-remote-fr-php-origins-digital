<?php

namespace App\Twig\Components;

use App\Entity\User;
use App\Entity\Video;
use App\Repository\UserRepository;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent('bookmark')]
final class Bookmark
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public Video $video;
    private ?User $user;

    public function __construct(
        private readonly Security $security,
        private readonly UserRepository $userRepository
    ) {
        /** @var User|null $user */
        $user = $this->security->getUser();
        $this->user = $user;
    }

    #[LiveAction]
    public function toggleBookmark(): void
    {
        if ($this->user && $this->user->getBookmarks()->contains($this->video)) {
            $this->user->removeBookmark($this->video);
        } else {
            $this->user->addBookmark($this->video);
        }
        if ($this->user) {
            $this->userRepository->save($this->user, true);
        }
    }

    public function isBookmarked(): bool
    {
        return $this->user?->getBookmarks()?->contains($this->video);
    }
}
