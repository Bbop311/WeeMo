<?php

// src/Form/PropertyType.php
namespace App\Form;

use App\Entity\Property;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ListingFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // Ajout des autres champs de Property
            ->add('dateMutation')
            ->add('natureMutation')
            ->add('valeurFonciere')
            ->add('noVoie')
            ->add('bTQ')
            ->add('typeVoie')
            ->add('codeVoie')
            ->add('voie')
            ->add('codePostal')
            ->add('commune')
            ->add('codeDepartement')
            ->add('codeCommune')
            ->add('section')
            ->add('nbLots')
            ->add('codeTypeLocal')
            ->add('typeLocal')
            ->add('surfaceReelleBati')
            ->add('nbPieces')
            ->add('surfaceTerrain')
            ->add('images', CollectionType::class, [
                'entry_type' => ImageUploadFormType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'prototype' => true, // Important pour permettre l'ajout dynamique
            ])
            ->add('propretyFeatures', CollectionType::class, [
                'entry_type' => PropertyFeaturesFormType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'prototype' => true, // Important pour permettre l'ajout dynamique
            ]);


           

          
            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
            
        ]);
    }
}