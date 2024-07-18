<?php

namespace App\Form;

use App\Entity\Property;
use App\Entity\PropertyFeatures;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertyFeaturesFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type_of_rooms')
            ->add('number_of_bedrooms')
            ->add('floor')
            ->add('property_condition')
            ->add('energy_class')
            ->add('elevator')
            ->add('balcony')
            ->add('parking')
            ->add('heating_type')
            ->add('air_condition')
            // ->add('property', EntityType::class, [
            //     'class' => Property::class,
            //     'choice_label' => 'id',
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PropertyFeatures::class,
        ]);
    }
}
