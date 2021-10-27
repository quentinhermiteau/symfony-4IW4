<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/articles", name="articles_")
 */
class ArticleController extends AbstractController {
    /**
     * @Route("", name="index", methods="GET")
     */
    public function index(ArticleRepository $articleRepository) {
        // $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();
        $articles = $articleRepository->findAll();

        // return all articles
        return $this->render('articles/viewArticles.html.twig', [
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/{id}", name="view", methods="GET")
     */
    public function view(Article $article) {
        // $article = $this->getDoctrine()->getRepository(Article::class)->find();

        return $this->render('articles/viewArticle.html.twig', [
            'article' => $article
        ]);
    }

    /**
     * @Route("/create", name="create", methods="POST")
     */
    public function create() {
        
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