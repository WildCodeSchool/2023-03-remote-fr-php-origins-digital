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

#[AsLiveComponent('like')]
final class Like
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
    public function toggleLike(): void
    {
        if ($this->user && $this->user->getLikes()->contains($this->video)) {
            $this->user->removeLike($this->video);
        } else {
            $this->user->removeDontLIke($this->video);
            $this->user->addLike($this->video);
        }
        if ($this->user) {
            $this->userRepository->save($this->user, true);
        }
    }

    public function isLiked(): bool
    {
        return $this->user?->getLikes()?->contains($this->video);
    }

    #[LiveAction]
    public function toggleDontLike(): void
    {
        if ($this->user && $this->user->getDontLIkes()->contains($this->video)) {
            $this->user->removeDontLIke($this->video);
        } else {
            $this->user->removeLike($this->video);
            $this->user->addDontLIke($this->video);
        }
        if ($this->user) {
            $this->userRepository->save($this->user, true);
        }
    }

    public function isNotLiked(): bool
    {
        return $this->user?->getDontLIkes()?->contains($this->video);
    }
}
