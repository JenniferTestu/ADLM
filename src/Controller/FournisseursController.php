<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Fournisseur;
use App\Entity\Adresse;
use Symfony\Bridge\Doctrine\Form\Type\EntityType; 
use App\Repository\FournisseurRepository;
use App\Repository\AdresseRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class FournisseursController extends Controller
{
    /**
     * @Route("/fournisseurs", name="fournisseurs")
     */
    public function index()
    {
        /*$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $idUser = $user->getId();*/
        $repository = $this->getDoctrine()->getRepository('App:Fournisseur');
        $liste=$repository->findAll();
        return $this->render('admin/fournisseurs.html.twig',array('liste'=>$liste));

    }

    /**
     * @Route("/detailfournisseur/{id}", name="detailfournisseur")
     */
    public function detailFournisseur($id)
    {
        /*$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $idUser = $user->getId();*/

        $repository = $this->getDoctrine()->getRepository('App:Fournisseur');
        $fournisseur=$repository->find($id);
        return $this->render('admin/detailFournisseur.html.twig',['fournisseur' => $fournisseur]);

    }

    /**
     * @Route("/editerfournisseur/{id}", name="editerfournisseur")
     */
    public function editerFournisseur(Request $request, $id)
    {
        /*$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $idUser = $user->getId();*/

        $repository = $this->getDoctrine()->getRepository('App:Fournisseur');
        $fournisseur=$repository->find($id);

        $fournisseur->setNom($fournisseur->getNom());
        $fournisseur->setMail($fournisseur->getMail());
        $fournisseur->setTel($fournisseur->getTel());
        $fournisseur->setDescription($fournisseur->getDescription());
        $fournisseur->setAdresse($fournisseur->getAdresse());

        $form = $this->createFormBuilder($fournisseur)
         ->add('nom',TextType::class)
         ->add('mail', TextType::class)
         ->add('tel', TextType::class)
         ->add('description',TextType::class)
         ->add('adresse',TextType::class)
         ->add('cp',TextType::class)
         ->add('ville',TextType::class)
         ->add('pays',TextType::class)
         ->add('Valider', SubmitType::class, array('label' => 'Modifier'))
         ->getForm();

         $form->handleRequest($request);

         if ($form->isSubmitted() && $form->isValid()) {
            $nom = $form['nom']->getData();
            $mail = $form['mail']->getData();
            $tel = $form['tel']->getData();
            $description = $form['description']->getData();
            $rue = $form['adresse']->getData();
            $cp = $form['cp']->getData();
            $ville = $form['ville']->getData();
            $pays = $form['pays']->getData();

            $adresse->setAdresse($rue);
            $adresse->setCp($cp);
            $adresse->setVille($ville);
            $adresse->setPays($pays);

            $fournisseur->setNom($nom);
            $fournisseur->setMail($mail);
            $fournisseur->setTel($tel);
            $fournisseur->setDescription($description);
            $fournisseur->setAdresse($adresse);

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($fournisseur);
            $entityManager->flush($fournisseur);

            $this->addFlash('message','Modification réussie !');

            return $this->redirectToRoute('fournisseurs');
        }

        return $this->render('admin/editerfournisseur.html.twig',array(
            'form' => $form->createView(),
        ));

    }

    /**
     * @Route("/suppfournisseur/{id}", name="suppfournisseur")
     */
    public function suppFournisseur($id)
    {
        /*$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $idUser = $user->getId();*/

        $entityManager = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository('App:Fournisseur');
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
