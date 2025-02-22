<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $message = "Salut les petit chats !";
        return $this->render('main/index.html.twig', [
            'message' => $message,
            'controller_name' => 'MainController',
        ]);
    }
}
