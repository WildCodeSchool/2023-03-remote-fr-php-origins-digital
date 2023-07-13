<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Tag;
use App\Repository\VideoRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/tags', name: 'tags_')]
class TagController extends AbstractController
{
    #[Route('/{categoryId}/{tagId}', name: 'index', methods: ['GET'])]
    #[Entity('category', options: ['mapping' => ['categoryId' => 'id']])]
    #[Entity('tag', options: ['mapping' => ['tagId' => 'id']])]
    public function index(
        Category $category,
        Tag $tag,
        VideoRepository $videoRepository,
        int $categoryId,
        int $tagId
    ): Response {
        $videos = $videoRepository->findVideoByCatAndTag($categoryId, $tagId);
        $sortedByFavourites = $videoRepository->findVideoByFavourites($categoryId, $tagId);
        $sortedVideos = $videoRepository->sortByLikes();
        $nextVideos = $videoRepository->findBy(['upcoming' => true]);
        return $this->render(
            'tags/index.html.twig',
            [
            'category' => $category,
            'sortedVideos' => $sortedVideos,
            'tag' => $tag,
            'videos' => $videos,
            'sortedByFavourites' => $sortedByFavourites,
             'nextVideos' => $nextVideos,
            ]
        );
    }
}
