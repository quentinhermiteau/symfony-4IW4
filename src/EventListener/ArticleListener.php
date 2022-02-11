<?php

namespace App\EventListener;

use App\Entity\Article;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class ArticleListener
{
    // the listener methods receive an argument which gives you access to
    // both the entity object of the event and the entity manager itself
    public function postPersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        // if this listener only applies to certain entity types,
        // add some code to check the entity type as early as possible
        if (!$entity instanceof Article) {
            return;
        }

        $entityManager = $args->getObjectManager();
        // ... do something with the Product entity
    }
}