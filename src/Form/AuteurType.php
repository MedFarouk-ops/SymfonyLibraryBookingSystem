<?php

namespace App\Form;

use App\Entity\Auteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType ;

class AuteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenom' ,TextType::class , [
                'attr' => [
                    'placeholder' => 'Nom',
                    'class' => 'form-control form-control-rounded'
                ]
            ])
            ->add('nom' ,TextType::class , [
                'attr' => [
                    'placeholder' => 'Prenom',
                    'class' => 'form-control form-control-rounded'
                ]
            ])
            ->add('biographie' ,TextType::class , [
                'attr' => [
                    'placeholder' => 'Biographie',
                    'class' => 'form-control form-control-rounded'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Auteur::class,
        ]);
    }
}
