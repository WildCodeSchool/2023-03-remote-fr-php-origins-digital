<?php

namespace App\Services;

use App\Repository\VideoRepository;

class VideoSorter
{
    private VideoRepository $videoRepository;

    public function __construct(VideoRepository $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }

    public function sortByLikes(): array
    {
        $sortedVideos = $this->videoRepository->findAll();
        usort($sortedVideos, function ($video1, $video2) {
            return $video2->getUserLikes() <=> $video1->getUserLikes();
        });

        return $sortedVideos;
    }
}
