<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Video;
use App\Repository\UserRepository;
use App\Repository\VideoRepository;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\BookmarkType;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class VideoBookmarksController extends AbstractController
{
    #[Route('/bookmarks', name: 'app_bookmarks')]
    #[IsGranted('ROLE_USER')]
    public function show(VideoRepository $videoRepository): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $videos = $user->getBookmarks();

        return $this->render(
            'bookmarks/video_bookmarks.html.twig',
            [
                'videos' => $videos,
            ]
        );
    }

    #[Route('/bookmarks/save/{id}', name: 'add_bookmark')]
    #[IsGranted('ROLE_USER')]
    public function addBookmarkRoute(
        Request $request,
        Video $video,
        UserRepository $userRepository
    ): Response {
        /** @var User $user */
        $user = $this->getUser();
        $user->addBookmark($video);
        $userRepository->save($user, true);
        $this->addFlash('success', 'Votre video a ete mis en favoris');
        return $this->redirectToRoute('app_bookmarks');
    }
}