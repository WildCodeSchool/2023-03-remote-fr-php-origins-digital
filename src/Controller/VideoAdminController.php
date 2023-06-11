<?php

namespace App\Controller;

use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/video', name: 'video_admin_')]
class VideoAdminController extends AbstractController
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
