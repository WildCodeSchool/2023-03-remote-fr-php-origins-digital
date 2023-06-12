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
        $user = $this->getUser(); // obtenir l'utilisateur actuellement connecté
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
            'user' => $user,
            'genresWithImages' => $genresWithImages,
        ]);
    }
}
