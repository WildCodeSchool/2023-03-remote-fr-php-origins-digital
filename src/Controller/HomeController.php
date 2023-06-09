<?php

namespace App\Controller;

use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    #[Route('/', name: 'app_home')]
    public function index(VideoRepository $videoRepository): Response
    {
        $user = $this->security->getUser(); // obtenir l'utilisateur actuellement connecté
        $videos = $videoRepository->findAll(); // recup toutes les vidéos de la bdd

        return $this->render('home/index.html.twig', [
            'videos' => $videos,
            'user' => $user,
        ]);
    }
}
