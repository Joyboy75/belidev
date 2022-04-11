<?php

namespace App\Controller\Front;

use App\Entity\User;
use App\Form\UserFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterController extends AbstractController
{
    
    /**
     * @Route("/register", name="app_register")
     */
    public function index(
        Request $request,
        EntityManagerInterface $entityManagerInterface,
        UserPasswordHasherInterface $userPasswordHasherInterface) {

        $user = new User();

        $userForm = $this->createForm(UserFormType::class, $user);

        $userForm->handleRequest($request);

        if($userForm->isSubmitted() && $userForm->isValid()){

            $user->setRoles(["ROLE_USER"]);

            // On récupère le mdp entré dans le formulaire
            $plainPassword = $userForm->get('password')->getData();

            // On hasch le mdp pour le sécuriser
            $hashedPassword = $userPasswordHasherInterface->hashPassword($user, $plainPassword);

            $user->setPassword($hashedPassword);

            $entityManagerInterface->persist($user);
            
            $entityManagerInterface->flush();

            return $this->redirectToRoute('accueil');
        }
        return $this->render('front/inscription.html.twig', [
            'userform' => $userForm->createView()
        ]);
    }
    
}
