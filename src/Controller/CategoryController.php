<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\TagRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/category', name: 'category_')]
class CategoryController extends AbstractController
{
    #[Route('/{slug}', name: 'index', methods: ['GET'])]
    public function index(
        TagRepository $tagRepository,
        Category $category
    ): Response {
        $activeTags = $tagRepository->findActiveTag($category);
        return $this->render('category/index.html.twig', [
            'activeTags' => $activeTags,
            'category' => $category
        ]);
    }
}
