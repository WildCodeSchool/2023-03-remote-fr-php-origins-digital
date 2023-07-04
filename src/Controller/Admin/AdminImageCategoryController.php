<?php

namespace App\Controller\Admin;

use App\Entity\ImageCategory;
use App\Form\ImageCategoryType;
use App\Repository\ImageCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/image/category')]
class AdminImageCategoryController extends AbstractController
{
    #[Route('/', name: 'app_admin_image_category_index', methods: ['GET'])]
    public function index(ImageCategoryRepository $imageCatRepository): Response
    {
        return $this->render('admin/admin_image_category/index.html.twig', [
            'image_categories' => $imageCatRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_image_category_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ImageCategoryRepository $imageCatRepository): Response
    {
        $imageCategory = new ImageCategory();
        $form = $this->createForm(ImageCategoryType::class, $imageCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageCatRepository->save($imageCategory, true);
            $this->addFlash('success', 'Vous avez ajouté une nouvelle image à une catégorie');

            return $this->redirectToRoute('app_admin_image_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/admin_image_category/new.html.twig', [
            'image_category' => $imageCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_image_category_show', methods: ['GET'])]
    public function show(ImageCategory $imageCategory): Response
    {
        return $this->render('admin/admin_image_category/show.html.twig', [
            'image_category' => $imageCategory,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_image_category_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        ImageCategory $imageCategory,
        ImageCategoryRepository $imageCatRepository
    ): Response {
        $form = $this->createForm(ImageCategoryType::class, $imageCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageCatRepository->save($imageCategory, true);
            $this->addFlash('success', 'Vous avez modifié une image à la catégorie');

            return $this->redirectToRoute('app_admin_image_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/admin_image_category/edit.html.twig', [
            'image_category' => $imageCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_image_category_delete', methods: ['POST'])]
    public function delete(
        Request $request,
        ImageCategory $imageCategory,
        ImageCategoryRepository $imageCatRepository
    ): Response {
        if ($this->isCsrfTokenValid('delete' . $imageCategory->getId(), $request->request->get('_token'))) {
            $this->addFlash('danger', 'Vous avez supprimé les images de la catégorie ');

            $imageCatRepository->remove($imageCategory, true);
        }

        return $this->redirectToRoute('app_admin_image_category_index', [], Response::HTTP_SEE_OTHER);
    }
}
