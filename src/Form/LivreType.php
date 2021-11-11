<?php

namespace App\Form;

use App\Entity\Livre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType ;
class LivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre' ,TextType::class , [
                'attr' => [
                    'placeholder' => 'Titre',
                    'class' => 'form-control form-control-rounded'
                ]
            ])
            ->add('nbPages' ,TextType::class , [
                'attr' => [
                    'placeholder' => 'Nombre de page',
                    'class' => 'form-control form-control-rounded'
                ]
            ])
            ->add('dateEdition')
            ->add('nbExemplaire' ,TextType::class , [
                'attr' => [
                    'placeholder' => 'Nombre des Exemplaires',
                    'class' => 'form-control form-control-rounded'
                ]
            ])
            ->add('prix' ,TextType::class , [
                'attr' => [
                    'placeholder' => 'Prix',
                    'class' => 'form-control form-control-rounded'
                ]
            ]) 
            ->add('isbn' ,TextType::class , [
                'attr' => [
                    'placeholder' => 'isbn',
                    'class' => 'form-control form-control-rounded'
                ]
            ])
            ->add('editeur')
            ->add('auteur')
            ->add('categorie')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Livre::class,
        ]);
    }
}
