<?php

namespace App\Controller;

use App\Entity\Liste;
use App\Entity\Ligne; 
use App\Entity\Produit;
use App\Form\ListeType;
use App\Repository\ListeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route('/liste')]
class ListeController extends AbstractController
{
    #[Route('/', name: 'app_liste_index', methods: ['GET'])]
    public function index(ListeRepository $listeRepository): Response
    {
        return $this->render('liste/index.html.twig', [
            'listes' => $listeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_liste_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $liste = new Liste();
        $form = $this->createForm(ListeType::class, $liste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($liste->getLignes() as $ligne) {
                $ligne->setListe($liste); // Ici on associe la ligne à la liste
            }
            $entityManager->persist($liste);
            $entityManager->flush();

            return $this->redirectToRoute('app_liste_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('liste/new.html.twig', [
            'liste' => $liste,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_liste_show', methods: ['GET'])]
    public function show(Liste $liste, EntityManagerInterface $em): Response
    {
        // Récupération des lignes triées par la position des zones
        $lignes = $em->createQueryBuilder()
            ->select('l')
            ->from('App\Entity\Ligne', 'l')
            ->leftJoin('l.produit', 'p')
            ->leftJoin('p.zone', 'z') // Assurez-vous que Zone est lié via Produit
            ->where('l.liste = :liste')
            ->setParameter('liste', $liste)
            ->orderBy('z.position', 'ASC') // Tri par position de la zone
            ->getQuery()
            ->getResult();
    
        return $this->render('liste/show.html.twig', [
            'liste' => $liste,
            'lignes' => $lignes, // On passe les lignes triées à la vue
        ]);
    }

    #[Route('/{id}/edit', name: 'app_liste_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Liste $liste, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ListeType::class, $liste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_liste_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('liste/edit.html.twig', [
            'liste' => $liste,
            'form' => $form,
        ]);
    }
    #[Route('/liste/{id}/update-caddy', name: 'update_caddy', methods: ['POST'])]
    public function updateCaddy(Request $request, Ligne $ligne, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
    
        if (isset($data['dansLeCaddy'])) {
            $ligne->setDansLeCaddy($data['dansLeCaddy']);
            $em->flush();
            return new JsonResponse(['success' => true, 'message' => 'Statut mis à jour']);
        }
    
        return new JsonResponse(['success' => false, 'message' => 'Données invalides'], 400);
    }
    

    #[Route('/{id}', name: 'app_liste_delete', methods: ['POST'])]
    public function delete(Request $request, Liste $liste, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$liste->getId(), $request->request->get('_token'))) {
            $entityManager->remove($liste);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_liste_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/{id}/courses', name: 'courses_en_cours')]
    public function courseEnCours(Liste $liste): Response {
        return $this->render('liste/courses.html.twig', [
            'liste' => $liste,
            'lignes' => $liste->getLignes(),
        ]);
    }

}
