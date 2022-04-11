<?php

namespace App\Form;

use App\Entity\Simulation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SimulationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('site',ChoiceType::class,array(
 
                // 'attr' => array(
                //     "class" => "selectpicker",
                //     "data-live-search" =>"true",
                //     "data-show-subtext" =>"true",
                //     "multiple"=> "true",
                // ),
 
                'choices' => array(
                    "Vitrine"    =>   "Vitrine"    ,
                    "E-commerce" =>   "E-commerce" ,
                    "Application"   =>   "Application"   )))
            
            ->add('bdd')
            ->add('api')
            ->add('form')
            ->add('user_management')
            ->add('Enregistrer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Simulation::class,
        ]);
    }
}
