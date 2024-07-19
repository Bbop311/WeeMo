<?php

namespace App\Form;

use App\Entity\Listing;
use App\Entity\Property;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddListingFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('listing_title')
            ->add('listing_description')
            // ->add('start_date', null, [
            //     'widget' => 'single_text',
            // ])
            // ->add('end_date', null, [
            //     'widget' => 'single_text',
            // ])
            ->add('status')
            ->add('property', EntityType::class, [
                'class' => property::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Listing::class,
        ]);
    }
}
