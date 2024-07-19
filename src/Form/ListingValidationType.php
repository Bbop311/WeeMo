<?php

namespace App\Form;

use App\Entity\Listing;
use App\Entity\property;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ListingValidationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'active' => 'active',
                    'inactive' => 'inactive',
                    'expired' => 'expired',
                    'suspended' => 'suspended',
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Save Status',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Listing::class,
        ]);
    }
}
