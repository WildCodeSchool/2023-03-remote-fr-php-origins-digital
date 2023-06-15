<?php

namespace App\Controller;

use App\Repository\GenreRepository;
use App\Repository\ImageGenreRepository;
use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        VideoRepository $videoRepository,
        GenreRepository $genreRepository,
        ImageGenreRepository $imageGenreRepository
    ): Response {
        $videos = $videoRepository->findAll(); // recup toutes les vidéos de la bdd
        $genres = $genreRepository->findAll();

        return $this->render('home/index.html.twig', [
            'videos' => $videos,
            'genres' => $genres,
        ]);
    }
}
