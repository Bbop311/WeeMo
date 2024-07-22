<?php

// src/Form/LstingStep2Type.php

namespace App\Form;

use App\Entity\PropertyFeatures;
use App\Entity\Image;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ListingStep2Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('number_of_bedrooms', TextType::class, [
                'mapped' => false,
                'label' => 'Number of Bedrooms'
            ])
            ->add('floor', TextType::class, [
                'mapped' => false,
                'label' => 'Floor'
            ])
            ->add('property_condition', TextType::class, [
                'mapped' => false,
                'label' => 'Property Condition'
            ])
            ->add('img_url', TextType::class, [
                'mapped' => false,
                'label' => 'Image URL'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([]);
    }
}
