<?php

namespace App\Controller\Front;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
// use Manuxi\GoogleReviewsBundle\ManuxiGoogleReviews;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    /**
     * @Route("/accueil", name="accueil")
     */
    public function index(): Response
    {
        return $this->render('front/accueil.html.twig');
    }


    /**
     * @Route("/simulation", name="simulation")
     */
    public function simulation(): Response
    {
        return $this->render('front/simulation.html.twig');
    }
}
