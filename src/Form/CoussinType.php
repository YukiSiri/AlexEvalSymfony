<?php

namespace App\Form;

use App\Entity\Coussin;
use App\Entity\Marque;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoussinType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Titre')
            ->add('Description')
            ->add('Contenance')
            ->add('Matiere')
            ->add('Dimensions')
            ->add('AccessoireVenduSeparement')
            ->add('PoidsPlein')
            //je veux que l'utilisateur puisse choisir une marque
            ->add('Marque', EntityType::class, [
                'class' => Marque::class,
                'choice_label' => 'Nom',
                'placeholder' => 'Choisir une marque',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Coussin::class,
        ]);
    }
}
