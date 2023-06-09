<?php

namespace App\Controller;

use App\Repository\ImageVideoRepository;
use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(VideoRepository $videoRepository, ImageVideoRepository $imageVideoRepository): Response
    {
        $videos = $videoRepository->findAll();
        $imageVideos = $imageVideoRepository->findAll();
        return $this->render('home/index.html.twig', ['videos' => $videos, 'imagevideos' => $imageVideos]);
    }
}
