<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ListingFullType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('listing_title', TextType::class)
            ->add('date_mutation', DateType::class)
            ->add('nature_mutation', TextType::class)
            ->add('type_of_rooms', ChoiceType::class, [
                'choices' => [
                    'Type 1' => 'type1',
                    'Type 2' => 'type2',
                    // add more as needed
                ],
            ])
            ->add('number_of_bedrooms', ChoiceType::class, [
                'choices' => range(1, 10),
            ])
            ->add('floor', ChoiceType::class, [
                'choices' => range(1, 6),
            ])
            ->add('property_condition', TextType::class)
            ->add('heating_type', TextType::class)
            ->add('energy_class', TextType::class)
            ->add('elevator', ChoiceType::class, [
                'choices' => [
                    'Yes' => true,
                    'No' => false,
                ],
            ])
            ->add('img_url', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}

