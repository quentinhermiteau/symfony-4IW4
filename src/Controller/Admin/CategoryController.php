<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/categories", name="categories_")
 */
class CategoryController extends AbstractController {
    /**
     * @Route("", name="index", methods="GET")
     */
    public function index(CategoryRepository $articleRepository) {
        $categories = $articleRepository->findAll();

        return $this->render('admin/categories/list.html.twig', [
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManagerInterface) {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManagerInterface->persist($category);
            $entityManagerInterface->flush();

            return $this->redirectToRoute('categories_index');
        }

        return $this->renderForm('admin/categories/new.html.twig', [
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods="GET")
     */
    public function show(Category $category) {
        return $this->render('admin/categories/show.html.twig', [
            'categ$category' => $category
        ]);
    }

    /**
     * @Route("/update", name="update", methods="PUT")
     */
    public function update() {
        
    }

    /**
     * @Route("/delete", name="delete", methods="DELETE")
     */
    public function delete() {
        
    }
}