<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Categorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType; 
use App\Repository\CategorieRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class CategoriesController extends Controller
{
    /**
     * @Route("/categories", name="categories")
     */
    public function index()
    {
        /*$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $idUser = $user->getId();*/
        $repository = $this->getDoctrine()->getRepository('App:Categorie');
        $liste=$repository->findAll();
        return $this->render('admin/categories.html.twig',array('liste'=>$liste));

    }

    /**
     * @Route("/detailcategorie/{id}", name="detailcategorie")
     */
    public function detailArticle($id)
    {
        /*$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $idUser = $user->getId();*/

        $repository = $this->getDoctrine()->getRepository('App:Categorie');
        $article=$repository->find($id);
        return $this->render('admin/detailCategorie.html.twig',['article' => $article]);

    }

    /**
     * @Route("/editercategorie/{id}", name="editercategorie")
     */
    public function editerCategorie(Request $request, $id)
    {
        /*$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $idUser = $user->getId();*/

        $repository = $this->getDoctrine()->getRepository('App:Categorie');
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

            return $this->redirectToRoute('categories');
        }

        return $this->render('admin/editerCategorie.html.twig',array(
            'form' => $form->createView(),
        ));

    }

    /**
     * @Route("/suppcategorie/{id}", name="suppcategorie")
     */
    public function suppArticle($id)
    {
        /*$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $idUser = $user->getId();*/

        $entityManager = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository('App:Categorie');
        $article=$repository->find($id);
        if($article->getSupp()==true){
            $article->setSupp(false);
        }else{
            $article->setSupp(true);
        }
        $entityManager->persist($article);
        $entityManager->flush();
        $this->addFlash('message','Article supprimé');
        return $this->redirectToRoute('categories');

    }
}
