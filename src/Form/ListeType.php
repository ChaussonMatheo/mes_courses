<?php

namespace App\Form;

use App\Entity\Liste;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ListeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('lignes', CollectionType::class, [
                'entry_type' => LigneType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true, // Permet l'ajout dynamique
                'allow_delete' => true,
                'by_reference' => false,
                'prototype' => true, // Active le prototype pour JS
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Liste::class,
        ]);
    }
}
