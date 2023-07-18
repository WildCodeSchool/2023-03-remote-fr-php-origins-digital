<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\ImageCategory;
use App\Form\CategoryType;
use App\Form\ImageCategoryType;
use App\Repository\CategoryRepository;
use App\Repository\ImageCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/admin/category')]
class AdminCategoryController extends AbstractController
{
    #[Route('/', name: 'app_admin_category_index', methods: ['GET'])]
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('admin/admin_category/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_category_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        CategoryRepository $categoryRepository,
        SluggerInterface $slugger
    ): Response {

        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $slug = $slugger->slug($category->getName());
            $category->setSlug($slug);
            $categoryRepository->save($category, true);
            $this->addFlash(
                'success',
                'Vous avez ajouté la catégorie ' . $category->getName() . ' avec succès'
            );

            return $this->redirectToRoute('app_admin_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/admin_category/new.html.twig', [
            'category' => $category,
            'form' => $form
        ]);
    }

    #[Route('/{slug}', name: 'app_admin_category_show', methods: ['GET'])]
    public function show(Category $category): Response
    {
        return $this->render('admin/admin_category/show.html.twig', [
            'category' => $category,
        ]);
    }

    #[Route('/{slug}/edit', name: 'app_admin_category_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        Category $category,
        CategoryRepository $categoryRepository,
        SluggerInterface $slugger
    ): Response {

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $slug = $slugger->slug($category->getName());
            $category->setSlug($slug);
            $categoryRepository->save($category, true);
            $this->addFlash(
                'success',
                'La categorie ' . $category->getName() . ' a été modifié avec succès.'
            );

            return $this->redirectToRoute('app_admin_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/admin_category/edit.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_category_delete', methods: ['POST'])]
    public function delete(Request $request, Category $category, CategoryRepository $categoryRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $category->getId(), $request->request->get('_token'))) {
            $categoryRepository->remove($category, true);
            $this->addFlash(
                'success',
                'Vous avez supprimé la catégorie ' . $category->getName() . ' avec succès'
            );
        }

        return $this->redirectToRoute('app_admin_category_index', [], Response::HTTP_SEE_OTHER);
    }
}
