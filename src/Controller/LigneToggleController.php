<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LigneToggleController extends AbstractController
{
    #[Route('/ligne/toggle', name: 'app_ligne_toggle')]
    public function index(): Response
    {
        return $this->render('ligne_toggle/index.html.twig', [
            'controller_name' => 'LigneToggleController',
        ]);
    }
    #[Route('/liste/{id}/update-caddy', name: 'update_caddy', methods: ['POST'])]
    public function updateCaddy(Request $request, Ligne $ligne, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
    
        // Met à jour le champ "dans_le_caddy"
        if (isset($data['DansLeCaddy'])) {
            $ligne->setDansLeCaddy($data['DansLeCaddy']);
            $em->flush();
            return new JsonResponse(['success' => true, 'message' => 'Statut mis à jour']);
        }
    
        return new JsonResponse(['success' => false, 'message' => 'Données invalides'], 400);
    }
}
