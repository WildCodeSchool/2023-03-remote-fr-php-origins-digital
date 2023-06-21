<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Entity\Categories;
use App\Repository\ImageVideoRepository;
use App\Repository\GenreRepository;
use App\Repository\ImageGenreRepository;
use App\Repository\VideoRepository;
use App\Repository\CategoriesRepository;
use Symfony\Component\HttpFoundation\Request;
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
        ImageVideoRepository $imageVideoRepository,
        ImageGenreRepository $imageGenreRepository
    ): Response {
        $videos = $videoRepository->findAll(); // recup toutes les vidéos de la bdd
        $genres = $genreRepository->findAll();
        $imageVideos = $imageVideoRepository->findAll();
        $genresWithImages = [];

        foreach ($genres as $genre) {
            $imagesGenres = $imageGenreRepository->findBy(['genre' => $genre], ['id' => 'ASC']);

            $images = [];
            foreach ($imagesGenres as $imageGenre) {
                $images[] = [
                    'background' => $imageGenre->getBackground(),
                    'character' => $imageGenre->getGenreCharacter(),
                    'text' => $imageGenre->getGenreName(),
                ];
            }

            $genresWithImages[] = [
                'genre' => $genre,
                'images' => $images,
            ];
        }

        return $this->render('home/index.html.twig', [
            'videos' => $videos,
            'genresWithImages' => $genresWithImages,
            'imagevideos' => $imageVideos,
            'genres' => $genres,
        ]);
    }
}
