<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SimulatorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('type_voie', ChoiceType::class, [
            'choices' => [
                'RUE' => 'RUE',
                'AV' => 'AV',
                'BD' => 'BD',
                'VLA' => 'VLA',
                'QUAI' => 'QUAI',
            ],
            'label' => 'Type de voie'
        ])
        ->add('code_postal', ChoiceType::class, [
            'choices' => [
                '75001' => '75001',
                '75002' => '75002',
                '75003' => '75003',
                '75004' => '75004',
                '75005' => '75005',
                '75006' => '75006',
                '75007' => '75007',
                '75008' => '75008',
                '75009' => '75009',
                '75010' => '75010',
                '75011' => '75011',
                '75012' => '75012',
                '75013' => '75013',
                '75014' => '75014',
                '75015' => '75015',
                '75016' => '75016',
                '75017' => '75017',
                '75018' => '75018',
                '75019' => '75019',
                '75020' => '75020',
            ],
            'label' => 'Code Postal'
        ])
        ->add('type_local', ChoiceType::class, [
            'choices' => [
                'Appartement' => 'Appartement',
                'Maison' => 'Maison',
            ],
            'label' => 'Type de local'
        ])
        ->add('surface_reelle_bati', NumberType::class, [
            'label' => 'Surface réelle bâti'
        ])
        ->add('nb_pieces', NumberType::class, [
            'label' => 'Nombre de pièces'
        ])
        ->add('surface_terrain', NumberType::class, [
            'label' => 'Surface du terrain'
        ])
        ->add('Submit', SubmitType::class, [
            'label' => 'Simuler'
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
