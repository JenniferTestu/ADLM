<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Article;
use Symfony\Bridge\Doctrine\Form\Type\EntityType; 
use App\Repository\ArticleRepository;
use App\Repository\FournisseurRepository;
use App\Repository\CategorieRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class NewArticleController extends Controller
{
    /**
     * @Route("/newarticle", name="newarticle")
     */
    public function index(Request $request)
    {
	    $entityManager = $this->getDoctrine()->getManager();
        $article = new article();
        $form = $this->createFormBuilder($article)
         ->add('nom',TextType::class)
         ->add('prix', TextType::class)
         ->add('description',TextType::class)
        ->add('categorie', EntityType::class, array(
        'class' => 'App\Entity\Categorie',
        'query_builder' => function (CategorieRepository $er) {
            return $er->createQueryBuilder('u')
                ->orderBy('u.cat', 'ASC');
        },
        'choice_label' => 'CatAndSousCat',
        'empty_data'  => null,
        'required' => false
        ))
        ->add('fournisseurs', EntityType::class, array(
        'multiple' => true,
        'expanded' => true,
        'class' => 'App\Entity\Fournisseur',
        'query_builder' => function (FournisseurRepository $er) {
            return $er->createQueryBuilder('u')
                ->orderBy('u.nom', 'ASC');
        },
        'choice_label' => 'nom',
        'required' => false,
        ))
        ->add('file', FileType::class, array('label' => 'Photo (png, jpeg)'))
        ->add('Valider', SubmitType::class, array('label' => 'Enregistrer'))
        ->getForm();

         $form->handleRequest($request);

         if ($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($article);
            $entityManager->flush($article);

            $file = $article->getFile();
            $nom = $article->getId().'.'.'png';
            $file->move($this->getParameter('uploads_directory'), $nom);

            return $this->redirectToRoute('catalogue');
        }

        return $this->render('admin/newarticle.html.twig', array(
            'form' => $form->createView(),
        ));

    }
}
