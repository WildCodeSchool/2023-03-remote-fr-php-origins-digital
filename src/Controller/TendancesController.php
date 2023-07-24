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
        $videos = $videoRepository->sortByLikes();

        return $this->render('tendances/index.html.twig', [
            'videos' => $videos,
        ]);
    }

    #[Route('/cat/{categoryId}/{tagId}', name: 'app_tendances_cat')]
    public function show(
        VideoRepository $videoRepository,
        int $categoryId,
        int $tagId
    ): Response {
        $videos = $videoRepository->findVideoByCatAndTagSortedByLikes($categoryId, $tagId);

        return $this->render('tendances/tendancesCat.html.twig', [
        'videos' => $videos,
        ]);
    }
}
