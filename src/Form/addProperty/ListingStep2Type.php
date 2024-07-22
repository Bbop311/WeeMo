<?php
namespace App\Form\addProperty;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ListingStep2Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type_of_rooms', ChoiceType::class, [
                'choices' => [
                    'Type 1' => 'type1',
                    'Type 2' => 'type2',
                ],
            ])
            ->add('number_of_bedrooms', ChoiceType::class, [
                'choices' => range(1, 10),
            ])
            ->add('floor', ChoiceType::class, [
                'choices' => range(1, 50),
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
        $resolver->setDefaults([]);
    }
}
