<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BaseController extends AbstractController
{

    public function index()
    {
    	/*if(isset($_SESSION['prenom'])){
			echo '<a href="./espace.php">'.$_SESSION['prenom'].'</a>';
			return $this->render('base.html.twig',['user' => $_SESSION['prenom']]);
		}else{
			echo '<a href="./connexion.php">S\'identifier</a>';
			return $this->render('base.html.twig',['user' => null]);
		}*/

    }
}
