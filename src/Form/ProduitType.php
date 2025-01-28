<?php

namespace App\Form;

use App\Entity\Produit;
use App\Entity\Zone;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;




class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('marque', TextType::class, [
                'required' => false,
            ])
            ->add('nom', TextType::class, [
                'required' => true, 
            ])
            ->add('quantite', TextType::class, [
                'required' => false,
            ])
            ->add('commentaires', TextareaType::class, [
                'required' => false,
            ])
            ->add('zone', EntityType::class, [
                'label' => "Position dans le magasin",
                'class' => Zone::class,
                'choice_label' => 'nom',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
            'csrf_protection' => true, // Doit être à true (par défaut)
            'csrf_field_name' => '_token', // Nom du champ (par défaut)
            'csrf_token_id' => 'produit', // Identifiant unique pour le formulaire
        ]);
    }
}
