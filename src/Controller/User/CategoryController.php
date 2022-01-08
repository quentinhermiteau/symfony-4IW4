<?php

namespace App\Controller\User;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

        return $this->render('user/categories/index.html.twig', [
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods="GET")
     */
    public function show(Category $category) {
        return $this->render('user/categories/show.html.twig', [
            'categ$category' => $category
        ]);
    }
}