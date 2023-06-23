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
        $videos = $this->videoRepository->findAll();
        $mostViewed = $videos[0];
        foreach ($videos as $video) {
            if ($video->getViews() > $mostViewed->getViews()) {
                $mostViewed = $video;
            }
        }
        return $mostViewed;
    }
}
