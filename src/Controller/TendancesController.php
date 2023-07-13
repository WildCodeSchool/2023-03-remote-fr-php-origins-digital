<?php

namespace App\Controller;

use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TendancesController extends AbstractController
{
    #[Route('/tendances', name: 'app_tendances')]
    public function index(VideoRepository $videoRepository): Response
    {
        $videos = $videoRepository->findAll();

        return $this->render('tendances/index.html.twig', [
            'videos' => $videos,
        ]);
    }
}
