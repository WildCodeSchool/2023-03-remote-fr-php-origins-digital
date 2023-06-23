<?php

namespace App\Controller;

use App\Repository\GenreRepository;
use App\Repository\VideoRepository;
use App\Services\VideoMostViewed;
use App\Services\VideoSorter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/', name: 'app_')]
class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(
        VideoRepository $videoRepository,
        GenreRepository $genreRepository,
        VideoSorter $videoSorter,
        VideoMostViewed $videoMostViewed
    ): Response {
        $videos = $videoRepository->findAll(); // recup toutes les vidéos de la bdd
        $sortedVideos = $videoSorter->sortByLikes();
        $genres = $genreRepository->findAll();
        $mostViewed = $videoMostViewed->mostViewed();

        return $this->render('home/index.html.twig', [
            'sortedVideos' => $sortedVideos,
            'videos' => $videos,
            'genres' => $genres,
            'mostViewed' => $mostViewed,
        ]);
    }
}
