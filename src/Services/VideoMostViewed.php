<?php

namespace App\Services;

use App\Entity\Video;
use App\Repository\VideoRepository;

class VideoMostViewed
{
    private VideoRepository $videoRepository;

    public function __construct(VideoRepository $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }

    public function mostViewed(): ?Video
    {
        return $this->videoRepository->findOneBy([], ['views' => 'DESC']);
    }
}
