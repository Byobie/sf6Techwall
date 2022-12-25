<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ToDoController extends AbstractController
{
    #[Route('/todo', name: 'app_to_do')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();
        if ($session->has('todos') === false) {
            $todos = [
                'Achat' => 'Acheter une clé USB.',
                'Cours' => 'Finaliser le cours de Symfony 6.',
                'Correction' => 'Corriger les exercices.',
            ];
            $session->set('todos', $todos);
        };
        return $this->render('to_do/index.html.twig');
    }
}
