<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;
use App\Entity\Article;

class IndexController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index()
    {

    	$repository = $this->getDoctrine()->getRepository('App:Article');
        $liste=$repository->findAllLastArticles();
        return $this->render('index.html.twig',array('liste'=>$liste));
    }
}
