<?php

namespace App\Controller;

use App\Entity\Genre;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/categories', name: 'categories_')]
class CategoriesController extends AbstractController
{
    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Genre $genre): Response
    {
        return $this->render('categories/show.html.twig', [
            'genre' => $genre,
        ]);
    }
}
