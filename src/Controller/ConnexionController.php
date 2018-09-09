<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class ConnexionController extends AbstractController
{
    /**
     * @Route("/connexion", name="connexion")
     */
    public function connexion(Request $request, AuthenticationUtils $authUtils)
    {
    	$error = $authUtils->getLastAuthenticationError();

	    $lastUsername = $authUtils->getLastUsername();
	    return $this->render('connexion.html.twig', array(
	        'last_username' => $lastUsername,
	        'error'         => $error,
	    ));
    }
}
