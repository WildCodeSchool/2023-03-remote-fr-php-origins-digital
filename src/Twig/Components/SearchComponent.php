<?php

namespace App\Twig\Components;

use App\Repository\VideoRepository;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent('search')]
final class SearchComponent
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public string $search = '';

    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function searchVideos(): array
    {
        return mb_strlen($this->search) ? $this->videoRepository->findLikeName($this->search)->getResult() : [];
    }
}
