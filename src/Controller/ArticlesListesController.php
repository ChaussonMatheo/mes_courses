<?php

namespace App\Controller;

use App\Entity\ArticlesListes;
use App\Form\ArticlesListesType;
use App\Repository\ArticlesListesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/articles/listes')]
class ArticlesListesController extends AbstractController
{
    #[Route('/', name: 'app_articles_listes_index', methods: ['GET'])]
    public function index(ArticlesListesRepository $articlesListesRepository): Response
    {
        return $this->render('articles_listes/index.html.twig', [
            'articles_listes' => $articlesListesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_articles_listes_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $articlesListe = new ArticlesListes();
        $form = $this->createForm(ArticlesListesType::class, $articlesListe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($articlesListe);
            $entityManager->flush();

            return $this->redirectToRoute('app_articles_listes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('articles_listes/new.html.twig', [
            'articles_liste' => $articlesListe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_articles_listes_show', methods: ['GET'])]
    public function show(ArticlesListes $articlesListe): Response
    {
        return $this->render('articles_listes/show.html.twig', [
            'articles_liste' => $articlesListe,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_articles_listes_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ArticlesListes $articlesListe, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ArticlesListesType::class, $articlesListe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_articles_listes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('articles_listes/edit.html.twig', [
            'articles_liste' => $articlesListe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_articles_listes_delete', methods: ['POST'])]
    public function delete(Request $request, ArticlesListes $articlesListe, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$articlesListe->getId(), $request->request->get('_token'))) {
            $entityManager->remove($articlesListe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_articles_listes_index', [], Response::HTTP_SEE_OTHER);
    }
}
