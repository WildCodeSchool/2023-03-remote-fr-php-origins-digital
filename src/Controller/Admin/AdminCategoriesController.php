<?php

namespace App\Controller\Admin;

use App\Entity\Categories;
use App\Form\CategoriesType;
use App\Repository\CategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/categories', name: 'admin_categories_')]
class AdminCategoriesController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(CategoriesRepository $categoryRepository): Response
    {
        return $this->render('admin/admin_categories/index.html.twig', [
            'categories' => $categoryRepository->findAllOrderedByGenre(),
        ]);
    }


    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, CategoriesRepository $categoriesRepository): Response
    {
        $category = new Categories();
        $form = $this->createForm(CategoriesType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoriesRepository->save($category, true);
            return $this->redirectToRoute('admin_categories_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('admin/admin_categories/new.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
        ]);
    }


    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Categories $category): Response
    {
        return $this->render('admin/admin_categories/show.html.twig', [
            'category' => $category,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Categories $category, CategoriesRepository $categoriesRepository): Response
    {
        $form = $this->createForm(CategoriesType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoriesRepository->save($category, true);

            return $this->redirectToRoute('admin_categories_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/admin_categories/edit.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Categories $category, CategoriesRepository $categoriesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $category->getId(), $request->request->get('_token'))) {
            $categoriesRepository->remove($category, true);
        }

        return $this->redirectToRoute('admin_categories_index', [], Response::HTTP_SEE_OTHER);
    }
}
