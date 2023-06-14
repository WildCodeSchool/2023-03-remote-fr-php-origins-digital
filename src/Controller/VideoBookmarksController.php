<?php

namespace App\Controller;

use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VideoBookmarksController extends AbstractController
{
    #[Route('/bookmarks', name: 'app_bookmarks')]
    public function show(VideoRepository $videoRepository): Response
    {
        $videos = $videoRepository->findAll();
        return $this->render(
            'bookmarks/video_bookmarks.html.twig',
            [
            'videos' => $videos,
            ]
        );
    }
}
