<?php

namespace App\Controller\Front;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="app_contact")
     */
    public function index(): Response
    {
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }

    /**
     *  @Route("front/contact", name="contact")
     */
    public function createContact ( Request $request, // classe permettant de traiter les infos du formulaires
    EntityManagerInterface $entityManagerInterface){ // classe permettant des interactions avec la bdd

        $contact = new Contact();

        $contactForm = $this->createForm(ContactType::class, $contact);

        $contactForm->handleRequest($request); // Utilisation de request pour récupérer les informations rentrées dans le formualire

        if($contactForm->isSubmitted() && $contactForm->isValid()){
            $entityManagerInterface->persist($contact);
            $entityManagerInterface->flush();

            return $this->redirectToRoute("contact");

        }
        
        return $this->render('front/contact.html.twig', ['contactForm' => $contactForm->createView()]);
        
    }
}
