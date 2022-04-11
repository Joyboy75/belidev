<?php

namespace App\Controller\Front;

use App\Entity\Simulation;
use App\Form\SimulationFormType;
use SebastianBergmann\Type\SimpleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SimulationController extends AbstractController
{
    /**
     * @Route("/simulation", name="app_simulation")
     */
    public function index(): Response
    {
        return $this->render('simulation/index.html.twig', [
            'controller_name' => 'SimulationController',
        ]);
    }

    /**
     * @Route("/create/simulation", name="create_simulation")
     */
    public function createSimulation(EntityManagerInterface $entityManagerInterface,
    Request $request,
    MailerInterface $mailerInterface
    ){
        $simulation = new Simulation();

        $simulationForm = $this->createForm(SimulationFormType::class, $simulation);

        $simulationForm->handleRequest($request);

        if($simulationForm->isSubmitted() && $simulationForm->isValid()){
            $entityManagerInterface->persist($simulation);
            $entityManagerInterface->flush();

            $user_site = $simulationForm->get('site')->getData();
            $user_email = $simulationForm->get('email')->getData();
            $user_bdd = $simulationForm->get('bdd')->getData();
            $user_api = $simulationForm->get('api')->getData();
            $user_form = $simulationForm->get('form')->getData();
            $user_user_management = $simulationForm->get('user_management')->getData();

            $email = (new TemplatedEmail())
                    ->from('belidev@contact.com')
                    ->to($user_email)
                    ->subject('Simulation')
                    ->htmlTemplate('front/mail.html.twig')
                    ->context([
                        'emaill' => $user_email,
                        'site' => $user_site,
                        'bdd' => $user_bdd,
                        'api' => $user_api,
                        'form' => $user_form,
                        'user_management' => $user_user_management
                        
                    ]);

                                $mailerInterface->send($email);


            
            return $this->redirectToRoute("accueil");
        }

        return $this->render('front/simulationform.html.twig', [ 'simulationForm' => $simulationForm->createView()]);
    }


}
