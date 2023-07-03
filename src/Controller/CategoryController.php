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
    #[Route('/{id}', name: 'index', methods: ['GET'])]
    public function index(
        TagRepository $tagRepository,
        Request $request,
        Category $category
    ): Response {
        $categoryId = $request->query->getInt('categoryId');
        $activeTags = $tagRepository->findActiveTag($categoryId);
        return $this->render('category/index.html.twig', [
            'activeTags' => $activeTags,
            'category' => $category
        ]);
    }
}
