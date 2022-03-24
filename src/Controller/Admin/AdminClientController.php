<?php

namespace App\Controller\Admin;

use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminClientController extends AbstractController {

    //Récupération de tous les éléments de la table Client
    /**
     * @Route("admin/clients", name="admin_client_list")
     */
    public function adminClientList(ClientRepository $clientRepository)
    {

        $clients = $clientRepository->findAll();

        return $this->render("admin/clients.html.twig", ['clients' => $clients]);
    }

    //Récupération d'un élément de la table Client
    /**
     * @Route("admin/client/{id}", name="admin_show_client")
     */
    public function adminClientShow(
        $id,
        ClientRepository $clientRepository
    ) {
        $client = $clientRepository->find($id);

        return $this->render("admin/client.html.twig", ['client' => $client]);
    }


    //Création d'un client
    /**
     *  @Route("admin/create/client", name="admin_create_client")
     */
    public function adminCreateClient ( Request $request, // classe permettant de traiter les infos du formulaires
    EntityManagerInterface $entityManagerInterface){ // classe permettant des interactions avec la bdd

        $client = new Client();

        $clientForm = $this->createForm(ClientType::class, $client);

        $clientForm->handleRequest($request); // Utilisation de request pour récupérer les informations rentrées dans le formualire

        if($clientForm->isSubmitted() && $clientForm->isValid()){
            $entityManagerInterface->persist($client);
            $entityManagerInterface->flush();

            return $this->redirectToRoute("admin_client_list");

        }
        
        return $this->render('admin/clientform.html.twig', ['clientform' => $clientForm->createView()]);
        
    }

    //Modification d'un élément de la table client grâce à son id
    /**
     *@Route("admin/update/client/{id}", name="admin_update_client")
     */
    public function adminUpdateClient(
        $id,
        ClientRepository $clientRepository,
        Request $request, // class permettant d'utiliser le formulaire de récupérer les information 
        EntityManagerInterface $entityManagerInterface // class permettantd'enregistrer ds la bdd
    ) {
        $client = $clientRepository->find($id);

        // Création du formulaire
        $clientForm = $this->createForm(ClientType::class, $client);

        // Utilisation de handleRequest pour demander au formulaire de traiter les informations
        // rentrées dans le formulaire
        // Utilisation de request pour récupérer les informations rentrées dans le formualire
        $clientForm->handleRequest($request);


        if ($clientForm->isSubmitted() && $clientForm->isValid()) {
            // persist prépare l'enregistrement ds la bdd analyse le changement à faire
            $entityManagerInterface->persist($client);
            $id = $clientRepository->find($id);

            // flush enregistre dans la bdd
            $entityManagerInterface->flush();

            $this->addFlash(
                'notice',
                'Le client a bien été modifié !'
            );

            return $this->redirectToRoute('admin_client_list');
        }

        return $this->render('admin/clientform.html.twig', ['clientForm' => $clientForm->createView()]);
    }

        //Suppression d'un élément de la table client grâce à son id

    /**
     * @Route("admin/delete/client/{id}", name="admin_delete_client")
     */
    public function adminDeleteclient(
        $id,
        ClientRepository $clientRepository,
        EntityManagerInterface $entityManagerInterface
    ) {

        $client = $clientRepository->find($id);

        //remove supprime le client et flush enregistre ds la bdd
        $entityManagerInterface->remove($client);
        $entityManagerInterface->flush();

        $this->addFlash(
            'notice',
            'Votre client a bien été supprimé'
        );

        return $this->redirectToRoute('admin_client_list');
    }
}