<?php

namespace App\Services;

use App\Entity\Video;
use App\Repository\VideoRepository;

class SortByCatAndTag
{
    private VideoRepository $videoRepository;

    public function __construct(VideoRepository $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }

    public function sortByCatAndTag(int $category, array $tagIds): ?Video
    {
        $videos = $this->videoRepository->findAll();

        foreach ($videos as $video) {
            $videoCategoryId = $video->getCategory()->getId();
            $videoTagIds = $video->getTag()->map(fn($tag) => $tag->getId())->toArray();

            if ($videoCategoryId === $category && count(array_intersect($tagIds, $videoTagIds)) > 0) {
                return $video;
            }
        }
        return null;
    }
}
