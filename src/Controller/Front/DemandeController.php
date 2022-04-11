<?php

namespace App\Controller\Front;

use App\Entity\Demande;
use App\Form\DemandeType;
use App\Repository\DemandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DemandeController extends AbstractController
{
    /**
     * @Route("/demande", name="app_demande")
     */
    public function index(): Response
    {
        return $this->render('demande/index.html.twig', [
            'controller_name' => 'DemandeController',
        ]);
    }

    //Récupération de tous les éléments de la table Client
    /**
     * @Route("/demandes", name="demande_list")
     */
    public function demandesList(DemandeRepository $demandeRepository)
    {

        $demandes = $demandeRepository->findAll();

        return $this->render("/demandes.html.twig", ['demandes' => $demandes]);
    }

    //Récupération d'un élément de la table Client
    /**
     * @Route("/demande/{id}", name="show_demande")
     */
    public function demandeShow(
        $id,
        DemandeRepository $demandeRepository
    ) {
        $demande = $demandeRepository->find($id);

        return $this->render("/demande.html.twig", ['demande' => $demande]);
    }


    //Création d'un demande
    /**
     *  @Route("/create/demande", name="create_demande")
     */
    public function createDemande ( Request $request, // classe permettant de traiter les infos du formulaires
    EntityManagerInterface $entityManagerInterface){ // classe permettant des interactions avec la bdd

        $demande = new Demande();

        $demandeForm = $this->createForm(DemandeType::class, $demande);

        $demandeForm->handleRequest($request); // Utilisation de request pour récupérer les informations rentrées dans le formulaire

        if($demandeForm->isSubmitted() && $demandeForm->isValid()){
            $entityManagerInterface->persist($demande);
            $entityManagerInterface->flush();

            return $this->redirectToRoute("demande_list");

        }
        
        return $this->render('front/demandeform.html.twig', ['demandeForm' => $demandeForm->createView()]);
        
    }

    //Mise à jour d'un demande grâce à son id
    /**
     *@Route("/update/demande/{id}", name="update_demande")
     */
    public function UpdateClient(
        $id,
        DemandeRepository $demandeRepository,
        Request $request, // class permettant d'utiliser le formulaire de récupérer les information 
        EntityManagerInterface $entityManagerInterface // class permettantd'enregistrer ds la bdd
    ) {
        $demande = $demandeRepository->find($id);

        // Création du formulaire
        $demandeForm = $this->createForm(DemandeType::class, $demande);

        // Utilisation de handleRequest pour demander au formulaire de traiter les informations
        // rentrées dans le formulaire
        // Utilisation de request pour récupérer les informations rentrées dans le formualire
        $demandeForm->handleRequest($request);


        if ($demandeForm->isSubmitted() && $demandeForm->isValid()) {
            // persist prépare l'enregistrement ds la bdd analyse le changement à faire
            $entityManagerInterface->persist($demande);
            $id = $demandeRepository->find($id);

            // flush enregistre dans la bdd
            $entityManagerInterface->flush();

            // $this->addFlash(
            //     'notice',
            //     'Le demande a bien été modifié !'
            // );

            return $this->redirectToRoute('demande_list');
        }

        return $this->render('front/demandeform.html.twig', ['demandeForm' => $demandeForm->createView()]);
    }

        //Suppression d'un élément de la table demande grâce à son id

    /**
     * @Route("/delete/demande/{id}", name="delete_demande")
     */
    public function Deletedemande(
        $id,
        DemandeRepository $demandeRepository,
        EntityManagerInterface $entityManagerInterface
    ) {

        $demande = $demandeRepository->find($id);

        //remove supprime le demande et flush enregistre ds la bdd
        $entityManagerInterface->remove($demande);
        $entityManagerInterface->flush();

        // $this->addFlash(
        //     'notice',
        //     'Votre demande a bien été supprimé'
        // );

        return $this->redirectToRoute('demande_list');
    }
}
