<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Repository\CategoriesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoriesController extends AbstractController
{
    #[Route('/categories', name: 'app_categories')]
    public function index(
        CategoriesRepository $categoriesRepository,
    ): Response {
        $categories = $categoriesRepository->findAll();


        return $this->render('categories/categories.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/categories/{id}', name: 'app_categories_show', methods: ['GET'])]
    public function show(
        Genre $genre,
    ): Response {

        return $this->render('categories/show.html.twig', [
            'genre' => $genre,
        ]);
    }
}
