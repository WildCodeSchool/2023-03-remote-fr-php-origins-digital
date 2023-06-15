<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Entity\Categories;
use App\Repository\GenreRepository;
use App\Repository\VideoRepository;
use App\Repository\CategoriesRepository;
use App\Repository\ImageGenreRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
        ]);
    }
}
