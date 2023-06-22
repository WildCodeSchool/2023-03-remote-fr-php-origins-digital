<?php

namespace App\Controller;

use App\Repository\VideoRepository;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/video', name: 'video_')]
class VideoController extends AbstractController
{
    #[Route('/', name: 'search')]
    public function searchForm(
        Request $request,
        VideoRepository $videoRepository,
        PaginatorInterface $paginator,
    ): Response {
        $form = $this->createFormBuilder(null, [
            'method' => 'get',
            'csrf_protection' => false
        ])
            ->add('search', SearchType::class, [
                'attr' => [
                    'class' => 'form-control rounded',
                    'placeholder' => 'Gameplay, League of Legends,..',
                ],
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->get('search')->getData();
            $query = $videoRepository->findLikeName($search);
        } else {
            $query = $videoRepository->queryFindAll();
        }

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            20
        );

        return $this->render('video/search_results.html.twig', [
            'videos' => $pagination,
            'form' => $form,
        ]);
    }
}
