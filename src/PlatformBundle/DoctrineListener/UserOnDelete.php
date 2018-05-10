<?php

namespace PlatformBundle\DoctrineListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\OnFlushEventArgs;
use PlatformBundle\Entity\User;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Doctrine\ORM\EntityManager;

class UserOnDelete {
     private $em;

    public function __construct(EntityManager $entityManager) {
        $this->em = $entityManager;
    }

    public function onDelete(LifecycleEventArgs $args) {
        $user = $args->getEntity();

        if (!$user instanceof User) {
            return;
        }
        foreach ($user->getPosts() as $post) {
            $post->setUser(NULL);
        }
        //$args->getEntityManager()->flush();
    }

}
