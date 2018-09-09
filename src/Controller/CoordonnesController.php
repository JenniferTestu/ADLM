<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CoordonnesController extends AbstractController
{
    /**
     * @Route("/coordonnes", name="coordonnes")
     */
    public function index()
    {
        return $this->render('coordonnes.html.twig', [
            'controller_name' => 'CoordonnesController',
        ]);
    }
}
