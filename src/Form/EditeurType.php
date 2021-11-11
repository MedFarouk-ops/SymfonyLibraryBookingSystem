<?php

namespace App\Form;

use App\Entity\Editeur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType ;
class EditeurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomEditeur',TextType::class , [
                'attr' => [
                    'placeholder' => 'Nom Editeur',
                    'class' => 'form-control form-control-rounded'
                ]
            ])
            ->add('pays',TextType::class , [
                'attr' => [
                    'placeholder' => 'Pays',
                    'class' => 'form-control form-control-rounded'
                ]
            ])
            ->add('address',TextType::class , [
                'attr' => [
                    'placeholder' => 'Address',
                    'class' => 'form-control form-control-rounded'
                ]
            ])
            ->add('telephone' ,TextType::class , [
                'attr' => [
                    'placeholder' => 'Telephone',
                    'class' => 'form-control form-control-rounded'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Editeur::class,
        ]);
    }
}
