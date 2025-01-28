<?php

namespace App\Controller;

use App\Entity\Ligne;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LigneToggleController extends AbstractController
    {
        #[Route('/ligne/{id}/update-caddy', name: 'update_caddy', methods: ['POST'])]
        public function updateCaddy(Request $request, Ligne $ligne, EntityManagerInterface $em): JsonResponse
        {
        $data = json_decode($request->getContent(), true);

        // Vérification des données
        if (!isset($data['DansLeCaddy'])) {
        return new JsonResponse(['success' => false, 'message' => 'Données invalides'], 400);
        }

        // Mise à jour du statut "dans_le_caddy"
        $ligne->setDansLeCaddy($data['DansLeCaddy']);
        $em->flush();

        return new JsonResponse([
        'success' => true,
        'message' => 'Statut mis à jour',
        'dansLeCaddy' => $ligne->isDansLeCaddy(),
        ]);
        }
    }
