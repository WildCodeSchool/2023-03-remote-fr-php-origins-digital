<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Repository\CategoriesRepository;
use App\Repository\ImagesCategoriesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoriesController extends AbstractController
{
    #[Route('/categories', name: 'app_categories')]
    public function index(
        CategoriesRepository $categoriesRepository,
        ImagesCategoriesRepository $imagesCatRepository
    ): Response {
        $categories = $categoriesRepository->findAll();
        $imagesCategories = $imagesCatRepository->findAll();

        return $this->render('categories/categories.html.twig', [
            'categories' => $categories,
            'imagescategories' => $imagesCategories
        ]);
    }

    #[Route('categories/{id}', name: 'app_categories_show', methods: ['GET'])]
    public function show(
        Request $request,
        Genre $genre,
        CategoriesRepository $categoriesRepository
    ): Response {
        $categories = $categoriesRepository->findBy(['genre' => $genre]);

        return $this->render('categories/index.html.twig', [
            'categories' => $categories,
            'genre' => $genre,
        ]);
    }
}
