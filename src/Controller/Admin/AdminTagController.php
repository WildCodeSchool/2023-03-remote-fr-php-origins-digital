<?php

namespace App\Controller\Admin;

use App\Entity\Tag;
use App\Form\TagType;
use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/admin/tag')]
class AdminTagController extends AbstractController
{
    #[Route('/', name: 'app_admin_tag_index', methods: ['GET'])]
    public function index(TagRepository $tagRepository): Response
    {
        return $this->render('admin/admin_tag/index.html.twig', [
            'tags' => $tagRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_tag_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TagRepository $tagRepository, SluggerInterface $slugger): Response
    {
        $tag = new Tag();
        $form = $this->createForm(TagType::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $slug = $slugger->slug($tag->getName());
            $tag->setSlug($slug);
            $tagRepository->save($tag, true);
            $this->addFlash('success', 'Création du tag ' . $tag->getName() . ' avec succès');

            return $this->redirectToRoute('app_admin_tag_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/admin_tag/new.html.twig', [
            'tag' => $tag,
            'form' => $form,
        ]);
    }

    #[Route('/{slug}', name: 'app_admin_tag_show', methods: ['GET'])]
    public function show(Tag $tag): Response
    {
        return $this->render('admin/admin_tag/show.html.twig', [
            'tag' => $tag,
        ]);
    }

    #[Route('/{slug}/edit', name: 'app_admin_tag_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tag $tag, TagRepository $tagRepository, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(TagType::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $slug = $slugger->slug($tag->getName());
            $tag->setSlug($slug);
            $tagRepository->save($tag, true);
            $this->addFlash('success', 'Modification du tag ' . $tag->getName() . ' avec succès');
            return $this->redirectToRoute('app_admin_tag_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/admin_tag/edit.html.twig', [
            'tag' => $tag,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_tag_delete', methods: ['POST'])]
    public function delete(Request $request, Tag $tag, TagRepository $tagRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $tag->getId(), $request->request->get('_token'))) {
            $tagRepository->remove($tag, true);
            $this->addFlash('success', 'Le tag ' . $tag->getName() . ' à été supprimé avec succès');
        }

        return $this->redirectToRoute('app_admin_tag_index', [], Response::HTTP_SEE_OTHER);
    }
}
