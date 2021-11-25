<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
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
        return $this->render('articles/index.html.twig', [
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/new", name="new", methods="POST")
     */
    public function edit() {
        
    }

    /**
     * @Route("/{id}", name="show", methods="GET")
     */
    public function show(Article $article) {
        // $article = $this->getDoctrine()->getRepository(Article::class)->find();

        return $this->render('articles/show.html.twig', [
            'article' => $article
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