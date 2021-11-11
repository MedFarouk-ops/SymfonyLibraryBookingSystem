<?php

namespace App\Form;

use App\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType ;

class CategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('designation',TextType::class , [
                'attr' => [
                    'placeholder' => 'designation',
                    'class' => 'form-control form-control-rounded'
                ]
            ])
            ->add('description' ,TextType::class , [
                'attr' => [
                    'placeholder' => 'description',
                    'class' => 'form-control form-control-rounded'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Categorie::class,
        ]);
    }
}
