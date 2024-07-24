<?php

namespace App\Form\addProperty\addPropertySteps;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

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

        //file upload inside teh same step
       //->add('img_url', TextType::class);
       ->add('image', FileType::class, [
        'label' => 'Image (JPEG ou PNG sont autorisé)',
        'mapped' => false,
        'required' => false,
        'constraints' => [
            new File([
                'maxSize' => '1024k',
                'mimeTypes' => [
                    'image/jpeg',
                    'image/png',
                ],
                'mimeTypesMessage' => 'Please upload a valid JPEG or PNG image',
            ])
        ],
    ])
    ->add('img_url', HiddenType::class);
            
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([]);
    }
}

