<?php

namespace App\Form;

use App\Entity\Ged;
use App\Entity\Offre;
use App\Entity\Demande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DemandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('information_client')
            ->add('offre', EntityType::class, [
                'class' => Offre::class,
                'choice_label' => 'titre',
                'mapped' => false
            ])
            ->add('type', EntityType::class, [
                'class' => Ged::class,
                'choice_label' => 'nom',
                'mapped' => false
            ])
            ->add('Enregistrer', SubmitType::class)
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Demande::class,
        ]);
    }
}
