<?php

namespace App\Controller\Admin;

use App\Entity\Video;
use App\Form\VideoType;
use App\Repository\VideoRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/video')]
class AdminVideoController extends AbstractController
{
    #[Route('/', name: 'app_admin_video_index', methods: ['GET'])]
    public function index(VideoRepository $videoRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $pagination = $paginator->paginate(
            $videoRepository->queryFindAll(),
            $request->query->getInt('page', 1),
            5
        );
        return $this->render('admin/admin_video/index.html.twig', [
            'videos' => $pagination,
        ]);
    }

    #[Route('/new', name: 'app_admin_video_new', methods: ['GET', 'POST'])]
    public function new(Request $request, VideoRepository $videoRepository): Response
    {
        $video = new Video();
        $form = $this->createForm(VideoType::class, $video);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', 'La vidéo ' . $video->getTitle() . ' a été ajouté avec succès.');

            $videoRepository->save($video, true);

            return $this->redirectToRoute('app_admin_video_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/admin_video/new.html.twig', [
            'video' => $video,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_video_show', methods: ['GET'])]
    public function show(Video $video): Response
    {
        return $this->render('admin/admin_video/show.html.twig', [
            'video' => $video,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_video_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Video $video, VideoRepository $videoRepository): Response
    {
        $form = $this->createForm(VideoType::class, $video);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $videoRepository->save($video, true);
            $this->addFlash('success', 'La vidéo ' . $video->getTitle() . ' a été modifié avec succès.');


            return $this->redirectToRoute('app_admin_video_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/admin_video/edit.html.twig', [
            'video' => $video,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_video_delete', methods: ['POST'])]
    public function delete(Request $request, Video $video, VideoRepository $videoRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $video->getId(), $request->request->get('_token'))) {
            $videoRepository->remove($video, true);
            $this->addFlash('success', 'La vidéo ' . $video->getTitle() . ' à été supprimé avec succès.');
        }

        return $this->redirectToRoute('app_admin_video_index', [], Response::HTTP_SEE_OTHER);
    }
}
