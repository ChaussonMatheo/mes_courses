<?php

namespace App\Controller;

use App\Entity\Ligne;
use App\Form\Produit;
use App\Form\LigneType;
use App\Repository\LigneRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/ligne')]
class LigneController extends AbstractController
{
    #[Route('/', name: 'app_ligne_index', methods: ['GET'])]
    public function index(LigneRepository $ligneRepository): Response
    {
        return $this->render('ligne/index.html.twig', [
            'lignes' => $ligneRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_ligne_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $ligne = new Ligne();
        $form = $this->createForm(LigneType::class, $ligne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($ligne);
            $entityManager->flush();


            return $this->redirectToRoute('app_ligne_index', [], Response::HTTP_SEE_OTHER);
        }
        if ($form->isSubmitted() && $form->isValid()) {
            dump($form->getData()); // Vérifie ce qui est envoyé
            dump($ligne->getProduit()); // Vérifie si le produit est défini
            exit();
        }


        return $this->renderForm('ligne/new.html.twig', [
            'ligne' => $ligne,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ligne_show', methods: ['GET'])]
    public function show(Ligne $ligne): Response
    {
        return $this->render('ligne/show.html.twig', [
            'ligne' => $ligne,
        ]);
    }
    
    
    #[Route('/{id}/courses', name: 'app_liste_courses')]
    public function courses(Liste $liste): Response
    {
        return $this->render('liste/courses.html.twig', [
            'liste' => $liste,
            'lignes' => $liste->getLignes(), // Récupère toutes les lignes associées à cette liste
        ]);
    }

    #[Route('/{id}/edit', name: 'app_ligne_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Ligne $ligne, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LigneType::class, $ligne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_ligne_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ligne/edit.html.twig', [
            'ligne' => $ligne,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ligne_delete', methods: ['POST'])]
    public function delete(Request $request, Ligne $ligne, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ligne->getId(), $request->request->get('_token'))) {
            $entityManager->remove($ligne);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_ligne_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/{id}/toggle-caddy', name: 'app_ligne_toggle_caddy', methods: ['POST'])]
    public function toggleDansLeCaddy(Ligne $ligne, EntityManagerInterface $entityManager): JsonResponse
    {
        $ligne->setDansLeCaddy(!$ligne->isDansLeCaddy());
        $entityManager->flush();

        return new JsonResponse([
            'success' => true,
            'dansLeCaddy' => $ligne->isDansLeCaddy(),
        ]);
    }

}
