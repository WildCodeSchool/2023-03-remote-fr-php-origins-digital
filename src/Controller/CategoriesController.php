<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Repository\CategoriesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/categories', name: 'categories_')]
class CategoriesController extends AbstractController
{
    #[Route('/{id}', name: 'index', methods: ['GET'])]
    public function index(
        Genre $genre,
    ): Response {

        return $this->render('categories/index.html.twig', [
            'genre' => $genre,
        ]);
    }
}
