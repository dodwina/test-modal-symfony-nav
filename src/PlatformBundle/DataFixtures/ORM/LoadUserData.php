<?php

namespace PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PlatformBundle\Entity\User;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUser  extends AbstractFixture  implements  FixtureInterface, ContainerAwareInterface {

    private $container;

    public function setContainer(ContainerInterface $container = null){
        $this->container = $container;

    }
    /*l'objet $manager est l'EntityManager*/
    public function load(ObjectManager $manager) {

        $user = new User();
        $user->setUsername('martin');
        $user->setFirstName('dupont');
        $user->setEmail('martin@gmail.com');
        $user->setPassword('Martin4#');
        $user->setPasswordConfirm('Martin4#');
        $user->setJob(['infirmier']);
        $user->setLocalisation(['paris']);
        $user->setRoles(['ROLE_ETUDIANT']);
        $user->setCreationDate(["2017"]["04"]["07"]);
        $user->setLastVisit(["2018"]["04"]["07"]);
        $manager->persist($user);
        
        $user2 = new User();
        $user2->setUsername('alex');
        $user2->setFirstName('dwne');
        $user2->setEmail('alex@gmail.com');
        $user2->setPassword('Alex4#');
        $user2->setPasswordConfirm('Alex4#');
        $user2->setJob(['integrateur web']);
        $user2->setLocalisation(['nantes']);
        $user2->setRoles(['ROLE_ADMIN']);
        $user2->setCreationDate(["2017"]["02"]["07"]);
        $user2->setLastVisit(["2018"]["02"]["04"]);
        $manager->persist($user2);
        
        $user3 = new User();
        $user3->setUsername('virginie');
        $user3->setFirstName('dwn');
        $user3->setEmail('virginie@gmail.com');
        $user2->setPassword('Alex4#');
        $user2->setPasswordConfirm('Alex4#');
        $user3->setJob(['developpeur web']);
        $user3->setLocalisation(['montreal']);
        $user3->setRoles(['ROLE_ADMIN']);
        $user3->setCreationDate(["2017"]["02"]["07"]);
        $user3->setLastVisit(["2018"]["04"]["11"]);
        $manager->persist($user3);
        
        $manager->flush();
    }

}
