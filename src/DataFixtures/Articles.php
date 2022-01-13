<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Repository\CategoryRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class Articles extends Fixture implements DependentFixtureInterface
{
    public $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {
            $article = new Article();
            $article->setTitle('title'.$i);
            $article->setContent('content'.$i);
            $category = $this->categoryRepository->findOneBy(['name' => "category$i" ]);
            $article->setCategory($category);
            $manager->persist($article);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            Categories::class,
        ];
    }
}