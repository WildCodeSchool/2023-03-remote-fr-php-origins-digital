<?php

namespace App\Controller;

use App\Entity\Video;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/video', name: 'video_')]
class VideoController extends AbstractController
{
    #[Route('/show/{id}', name: 'show')]
    public function show(Video $video): Response
    {
        return $this->render('video/show.html.twig', [
            'video' => $video,
        ]);
    }
    #[Route("/{id}/incrementView", name: "increment_views")]
    public function addView(Video $video, EntityManagerInterface $entityManager): JsonResponse
    {
        $video->setViews($video->getViews() + 1);
        $entityManager->persist($video);
        $entityManager->flush();

        return new JsonResponse(['success' => true]);
    }
}
