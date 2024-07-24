<?php

namespace App\Form\addProperty\addPropertySteps;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\Listing;

class Step3Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('listing_title', TextType::class, [
            'label' => 'Titre',
            'attr' => [
                'class' => 'listing-title-class',
                'placeholder' => 'Ajoutez un titre vendeur à votre annonce'
            ],
        ])
        ->add('listing_description', TextareaType::class, [
            'label' => 'Ajoutez une déscription de votre bien',
            'attr' => [
                'class' => 'listing-description-class tinymce',
                'placeholder' => 'Déscription du Bien exemple : Environnement, liste des pièces, prestations,
                 mode de chauffage, proximité des commerces, transports et écoles, charges et impôts...',
                'rows' => 10, // Set the height using rows
            ],
            
        ])
        ->add('status', HiddenType::class, [
            'data' => 'Inactive'
        ])

       ->add('img_url', TextType::class);
            
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([]);
    }
}

