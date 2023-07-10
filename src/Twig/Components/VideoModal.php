<?php

namespace App\Twig\Components;

use App\Entity\Video;
use App\Repository\VideoRepository;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent()]
final class VideoModal
{
    use DefaultActionTrait;

    public ?Video $video = null;

    public function __construct(private VideoRepository $videoRepository)
    {
    }

    #[LiveAction]
    public function findVideo(#[LiveArg] int $id): void
    {
        $this->video = $this->videoRepository->find($id);
    }

    public function recentVideos(): array
    {
        return $this->videoRepository->sortByVideo()->getResult();
    }
}
