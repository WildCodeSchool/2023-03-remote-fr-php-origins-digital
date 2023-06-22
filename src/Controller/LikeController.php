<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Video;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class LikeController extends AbstractController
{
    #[Route('/video/like/{id}', name: 'add_like')]
    #[IsGranted('ROLE_USER')]
    public function addBookmarkRoute(
        Video $video,
        UserRepository $userRepository
    ): Response {
        /** @var User $user */
        $user = $this->getUser();
        $user->addLike($video);
        $userRepository->save($user, true);
        $this->addFlash('success', 'Vous avez aimé ' . $video->getTitle() . '!');
        return $this->redirectToRoute('app_home');
    }
}
