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
            $this->addFlash(
               'initializing',
               "La liste des todos vient d'être initialisée."
            );
        };
        return $this->render('to_do/index.html.twig');
    }

    #[Route('/todo/add/{name}/{content}', name: 'todo.add')]
    public function addToDo(Request $request, $name, $content): Response
    {
        $session = $request->getSession();
        if ($session->has('todos') === true) {
            $todos = $session->get('todos');
            if (array_key_exists($name, $todos) === true || in_array($content, $todos) === true) {
                $this->addFlash(
                    'error',
                    "Cette tâche existe déjà dans votre liste."
                );
            } else {
                $todos[$name] = $content;
                $session->set('todos', $todos);
                $this->addFlash(
                    'success',
                    "La liste a bien été mise à jour."
                );
            };
        };
        return $this->redirectToRoute('app_to_do');
    }
}
