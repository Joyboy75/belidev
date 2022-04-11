<?php

namespace App\Controller\Front;

use App\Repository\OffreRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OffreController extends AbstractController
{
    /**
     * @Route("/offre", name="app_offre")
     */
    public function index(): Response
    {
        return $this->render('offre/index.html.twig', [
            'controller_name' => 'OffreController',
        ]);
    }

    //Récupération de tous les éléments de la table Offre
    /**
     * @Route("front/offres", name="offres_list")
     */
    public function offreList(OffreRepository $offreRepository)
    {

        $offres = $offreRepository->findAll();

        return $this->render("front/offres.html.twig", ['offres' => $offres]);
    }
}
