<?php

namespace acmjBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class SecurityController
 * @package acmjBundle\Controller
 */
class SecurityController extends Controller
{
    /**
     * loginAction : permettre au visiteur de se connecter a l'application (facilité par Security de symfony)
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function loginAction() {
        $authenticationUtils = $this->get('security.authentication_utils');
        $error =$authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('@acmj/Security/login.html.twig',array(
            'last_username'=>$lastUsername,
            'error'=> $error
        ));
    }
}
