<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{
    #[Route('/first', name: 'app_first')]
    public function index(): Response
    {
        return $this->render('first/index.html.twig');
    }

    #[Route('/sayJeanne', name: 'say_jeanne')]
    public function sayJeanne(): Response
    {
        //return $this->redirectToRoute('app_first');
        //return $this->forward('App\Controller\FirstController::index');
        return $this->render('first/sayJeanne.html.twig', 
        ['name' => 'JEANNE !', 'expression' => 'OSKOUR !']);
    }
}