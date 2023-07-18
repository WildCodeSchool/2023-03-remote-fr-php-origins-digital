<?php

namespace App\Controller;

use App\Entity\Video;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/video', name: 'video_')]
class VideoController extends AbstractController
{
    #[Route('/{slug}', name: 'show')]
    public function show(Video $video, SluggerInterface $slugger): Response
    {

        return $this->render('video/show.html.twig', [
            'video' => $video,
        ]);
    }
}
