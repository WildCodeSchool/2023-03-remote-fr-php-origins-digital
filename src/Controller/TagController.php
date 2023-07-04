<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Tag;
use App\Repository\CategoryRepository;
use App\Repository\TagRepository;
use App\Repository\VideoRepository;
use phpDocumentor\Reflection\Types\Integer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/tags', name: 'tags_')]
class TagController extends AbstractController
{
    #[Route('/{category_id}/{tag_id}', name: 'index', methods: ['GET'])]
    #[Entity('category', options: ['mapping' => ['category_id' => 'id']])]
    #[Entity('tag', options: ['mapping' => ['tag_id' => 'id']])]
    public function index(
        Category $category,
        Tag $tag,
        VideoRepository $videoRepository
    ): Response {
        $videos = $videoRepository->findAll();
        return $this->render(
            'tags/index.html.twig',
            [
            'category' => $category,
            'tag' => $tag,
            'videos' => $videos
            ]
        );
    }
}
