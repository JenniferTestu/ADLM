<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use App\Form\AdresseType;

class InscrireController extends AbstractController
{
    /**
     * @Route("/inscrire", name="inscrire")
     */
    public function index(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {

        $entityManager = $this->getDoctrine()->getManager();
        $user = new Utilisateur();
        $form = $this->createFormBuilder($user)
         ->add('nom',TextType::class)
      	 ->add('prenom', TextType::class)
     	 ->add('mail',EmailType::class)
     	 ->add('mdp',PasswordType::class)
     	 /*->add('adresse', TextType::class)
     	 ->add('cp', AdresseType::class)
     	 ->add('ville', AdresseType::class)
     	 ->add('pays', AdresseType::class)*/
     	 ->add('tel', TextType::class)
     	 ->add('Valider', SubmitType::class, array('label' => 'Enregistrer'))
     	 ->getForm();

     	 $form->handleRequest($request);

     	 if ($form->isSubmitted() && $form->isValid()) {
     	 	$user = $form->getData();
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('connexion');
    	}

        return $this->render('inscrire.html.twig', array(
            'form' => $form->createView(),
        ));

    }
}
