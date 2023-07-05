<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ImageCategoryRepository;
use App\Repository\TagRepository;
use App\Repository\VideoRepository;
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
        CategoryRepository $categoryRepository,
        VideoSorter $videoSorter,
        TagRepository $tagsRepository
    ): Response {
        $videos = $videoRepository->findAll(); // recup toutes les vidéos de la bdd
        $sortedVideos = $videoSorter->sortByLikes();
        $categories = $categoryRepository->findAll();
        $tags = $tagsRepository->findAll();
        return $this->render('home/index.html.twig', [
            'sortedVideos' => $sortedVideos,
            'videos' => $videos,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }
}
