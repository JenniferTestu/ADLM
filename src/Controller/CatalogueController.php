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

class CatalogueController extends Controller
{
    /**
     * @Route("/catalogue", name="catalogue")
     */
    public function index()
    {
        /*$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $idUser = $user->getId();*/
        $repository = $this->getDoctrine()->getRepository('App:Article');
        $liste=$repository->findAll();
        return $this->render('admin/catalogue.html.twig',array('liste'=>$liste));

    }

    /**
     * @Route("/detailarticle/{id}", name="detailarticle")
     */
    public function detailArticle($id)
    {
        /*$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $idUser = $user->getId();*/

        $repository = $this->getDoctrine()->getRepository('App:Article');
        $article=$repository->find($id);
        return $this->render('admin/detailArticle.html.twig',['article' => $article]);

    }

    /**
     * @Route("/editerarticle/{id}", name="editerarticle")
     */
    public function editerArticle(Request $request, $id)
    {
        /*$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $idUser = $user->getId();*/

        $repository = $this->getDoctrine()->getRepository('App:Article');
        $article=$repository->find($id);

        $article->setNom($article->getNom());
        $article->setPrix($article->getPrix());
        $article->setDescription($article->getDescription());
        $article->setCategorie($article->getCategorie());
        //$article->setFournisseurs($article->getFournisseurs());
        $article->setFile($article->getFile());

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
        'class' => 'App\Entity\Fournisseur',
        'query_builder' => function (FournisseurRepository $er) {
            return $er->createQueryBuilder('u')
                ->orderBy('u.nom', 'ASC');
        },
        'choice_label' => 'nom',
        'empty_data'  => null,
        'required' => false,
        'mapped' => false
        ))
        ->add('file', FileType::class, array('label' => 'Photo (png, jpeg)'))
         ->add('Valider', SubmitType::class, array('label' => 'Modifier'))
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

            $this->addFlash('message','Modification réussie !');

            return $this->redirectToRoute('catalogue');
        }

        return $this->render('admin/editerArticle.html.twig',array(
            'form' => $form->createView(),
        ));

    }

    /**
     * @Route("/supparticle/{id}", name="supparticle")
     */
    public function suppArticle($id)
    {
        /*$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $idUser = $user->getId();*/

        $entityManager = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository('App:Article');
        $article=$repository->find($id);
        if($article->getSupp()==true){
            $article->setSupp(false);
        }else{
            $article->setSupp(true);
        }
        $entityManager->persist($article);
        $entityManager->flush();
        $this->addFlash('message','Article supprimé');
        return $this->redirectToRoute('catalogue');

    }
}
