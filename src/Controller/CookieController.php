<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/privacy-statement', name: 'app_')]
class CookieController extends AbstractController
{
    #[Route('/', name: 'cookie')]
    public function index(): Response
    {
        return $this->render('cookie/consent.html.twig');
    }
}
