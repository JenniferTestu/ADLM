<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProduitListeController extends AbstractController
{
    /**
     * @Route("/produitliste", name="produit_liste")
     */
    public function index()
    {
        return $this->render('produit_liste.html.twig', [
            'controller_name' => 'ProduitListeController',
        ]);
    }
}
