<?php

namespace App\Controller;

use App\Entity\Zone;
use App\Repository\ZoneRepository;
use App\Form\ZoneType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

#[Route('/zone')]
class ZoneController extends AbstractController
{
    private $zoneRepository;

    public function __construct(ZoneRepository $zoneRepository)
    {
        $this->zoneRepository = $zoneRepository;
    }

    #[Route('/', name: 'zone_index')]
    public function index(): Response
    {
        $zones = $this->zoneRepository->findBy([], ['position' => 'ASC']);
        return $this->render('zone/index.html.twig', [
            'controller_name' => 'ZoneController',
            'zones' => $zones,
        ]);
    }
    #[Route('/new', name: 'zone_create')]
    public function new(Request $request): Response {
        $zone = new Zone();
        $form = $this->createForm(ZoneType::class, $zone);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->zoneRepository->add($zone, true);
            return $this->redirectToRoute('zone_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('zone/new.html.twig', [
            'zone' => $zone,
            'form' => $form,
        ]);
    }
}