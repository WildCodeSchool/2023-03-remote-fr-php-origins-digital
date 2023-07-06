<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Tag;
use App\Repository\VideoRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Services\SortByCatAndTag;

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
        SortByCatAndTag $sortByCatAndTag,
        int $categoryId,
        int $tagId
    ): Response {
        $videos = $videoRepository->findAll();
        $sortedByCatAndTag = $sortByCatAndTag->sortByCatAndTag($categoryId, [$tagId]);
        return $this->render(
            'tags/index.html.twig',
            [
            'category' => $category,
            'tag' => $tag,
            'videos' => $videos,
            'sortedByCatAndTag' => $sortedByCatAndTag,
            ]
        );
    }
}
