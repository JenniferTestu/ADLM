<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EspaceController extends AbstractController
{
    /**
     * @Route("/espace", name="espace")
     */
    public function index()
    {
        return $this->render('espace.html.twig', [
            'controller_name' => 'EspaceController',
        ]);
    }
}
