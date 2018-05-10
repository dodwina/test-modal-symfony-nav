<?php

namespace PlatformBundle\Controller;

use PlatformBundle\Form\RegisterForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlatformBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SecurityController extends Controller {

    /**
     * @Route("/logout", name="security_logout")
     */
    public function logoutAction() {
        $this->addFlash('success', 'You are now successfully logged out');
        return $this->redirectToRoute('platform_homepage');
    }

    /**
     * @Route("", name="security_login")
     */
    public function loginAction() {
        $securityContext = $this->container->get('security.authorization_checker');

        if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED') or ('IS_AUTHENTICATED_FULLY')) {
            $user = $this->getUser();
            $this->addFlash('message', 'Bienvenue '/*.$user->getFirstname()*/);
            return $this->redirectToRoute('platform_homepage');
        }
        $authUtils = $this->get('security.authentication_utils');
        $error = $authUtils->getLastAuthenticationError();
        $lastUsername = $authUtils->getLastUsername();

        return $this->render('PlatformBundle:User:login.html.twig', array(
            'username' => $lastUsername,
            'error' => $error,
        ));
    }

    /**
     * @Route("/", name="security_register")
     */
    public function registerAction(Request $request) {
        /*$securityContext = $this->container->get('security.authorization_checker');
        if ($securityContext->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('platform_homepage');
        }*/

        $user = new User();
        $form = $this->createForm(RegisterForm::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $token = new UsernamePasswordToken(
                    $user, $user->getPassword(), 'main', $user->getRoles()
            );
            $this->get('security.token_storage')->setToken($token);
            $this->get('session')->set('_security_main', serialize($token));

            $this->addFlash('message', $user->getFirstname(). ',vous êtes maintenant inscrit.');
            return $this->redirectToRoute('platform_homepage');
        }
        return $this->render('PlatformBundle:User:register.html.twig', array(
            'form' => $form->createView(),
        ));
    }



    /**
     * @Route("", name="security_requestPassword")
     * @Method("GET|POST")
     */
    public function resettingAction(Request $request)
    {
        $password = new Password();
        $form = $this->createForm('PlatformBundle\Form\RequestPassword', $password);

        if ($this->getRequestPasswordFormHandler()->handle($form, $request)) {
            return $this->redirect($this->generateUrl('platform_homepage'));
        }
        return $this->render('PlatformBundle:User:request_password.html.twig', array(
            'form' => $form->createView(),
        ));
    }




}
