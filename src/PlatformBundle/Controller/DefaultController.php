<?php

namespace PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class DefaultController extends Controller
{

    /**
     * @Route("/", name="platform_homepage")
     */
    public function indexAction() {

        return $this->render('PlatformBundle:Default:index.html.twig', array(

        ));
    }




}
