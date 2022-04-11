<?php

namespace App\Controller\Front;

use App\Repository\TypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TypeController extends AbstractController
{
    /**
     * @Route("/type", name="app_type")
     */
    public function index(): Response
    {
        return $this->render('type/index.html.twig', [
            'controller_name' => 'TypeController',
        ]);
    }

    /**
     * @Route("type/insert/", name="type_insert")
     */
    // public function insertType(
    //     Request $request,
    //     EntityManagerInterface $entityManagerInterface,
    //     typePasswordHasherInterface $typePasswordHasherInterface,
    //     MailerInterface $mailerInterface
    // ) {

    //     $type = new type();

    //     $typeForm = $this->createForm(TypeType::class, $type);

    //     $typeForm->handleRequest($request);

    //     if ($typeForm->isSubmitted() && $typeForm->isValid()) {

    //         $entityManagerInterface->persist($type);

    //         $entityManagerInterface->flush();



    //         return $this->redirectToRoute('accueil');
    //     }

    //     return $this->render("front/typeform.html.twig", ['typeForm' => $typeForm->createView()]);
    // }

    /**
     * @Route("update/type", name="type_update")
     */
    public function typeUpdate(
        $id,
        Request $request,
        EntityManagerInterface $entityManagerInterface,
        TypeRepository $typeRepository
    ) {

        // récupère le type connecté
       
        $type = $typeRepository->find($id);

        $typeForm = $this->createForm(TypeType::class, $type);

        $typeForm->handleRequest($request);

        if ($typeForm->isSubmitted() && $typeForm->isValid()) {

           

            $entityManagerInterface->persist($type);

            $entityManagerInterface->flush();

            return $this->redirectToRoute('accueil');
        }

        return $this->render("front/modification.html.twig", ['typeform' => $typeForm->createView()]);
    }

    /**
     * @Route("delete/type", name="type_delete")
     */
    public function deletetype($id,TypeRepository $typeRepository, EntityManagerInterface $entityManagerInterface)
    {

         $type = $typeRepository->find($id);

        $entityManagerInterface->remove($type);

        $entityManagerInterface->flush();

        return $this->redirectToRoute('accueil');
    }   
}
