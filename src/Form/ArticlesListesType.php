<?php

namespace App\Form;

use App\Entity\ArticlesListes;
use App\Entity\Liste;
use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class ArticlesListesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantite')
            ->add('produit', EntityType::class, [
                'class' => Produit::class,
                'choice_label' => 'nom', // Propriété à afficher
                'multiple' => true, // Permet la sélection multiple
                'expanded' => false, // Choix déroulant (false) ou cases à cocher (true)
                'required' => false,
            ])
            ->add('IdListe', EntityType::class, [
                'class' => Liste::class,
                'choice_label' => 'nom', // Propriété à afficher
                'multiple' => false, // Permet la sélection multiple
                'expanded' => false, // Choix déroulant (false) ou cases à cocher (true)
                'required' => false,
            ])
            ->add('IsInList')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ArticlesListes::class,
        ]);
    }
}
