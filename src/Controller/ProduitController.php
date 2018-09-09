<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Entity\ArticlePanier;
use App\Repository\ArticleRepository;
use App\Repository\ArticlePanierRepository;
use App\Entity\Stock;
use App\Repository\StockRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Doctrine\Form\Type\EntityType; 
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProduitController extends AbstractController
{
    /**
     * @Route("/produit/{id}", name="produit")
     */
    public function index(Request $request,$id)
    {
    	$repository = $this->getDoctrine()->getRepository('App:Article');
        $article=$repository->find($id);

        $repository2 = $this->getDoctrine()->getRepository('App:Stock');
        $liste=$repository2->findByArticle($id);

        $entityManager = $this->getDoctrine()->getManager();
        $articlepanier = new ArticlePanier();
        $form = $this->createFormBuilder($articlepanier)
         ->add('taille', ChoiceType::class, [
         	'choices' => $liste,

        ])
        ->add('Valider', SubmitType::class, array('label' => 'Ajouter au panier'))
        ->getForm();

         $form->handleRequest($request);

         if ($form->isSubmitted() && $form->isValid()) {
            $articlepanier = $form->getData();
            $articlepanier->setArticle($article);
            $articlepanier->setPrix($article->getPrix());
            $articlepanier->setQuantite(1);
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($articlepanier);
            $entityManager->flush($articlepanier);

            return $this->redirectToRoute('panier');
        }

        return $this->render('produit.html.twig',array('article' => $article,'liste'=>$liste,'form' => $form->createView()));
        
    }

}
