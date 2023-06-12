<?php

namespace App\Controller\Admin;

use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/video', name: 'video_')]
class AdminVideoController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(VideoRepository $videoRepository): Response
    {
        $videos = $videoRepository->findBy([], ['id' => 'asc']);
        return $this->render('admin/video_admin/index.html.twig', [
            'videos' => $videos,
        ]);
    }
}
