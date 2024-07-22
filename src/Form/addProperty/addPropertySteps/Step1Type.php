<?php

namespace App\Form\addProperty\addPropertySteps;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class Step1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Ville', ChoiceType::class, [
                'label' => 'Ville',
                'attr' => ['class' => 'form-select', 'placeholder' => 'Paris'],
                'choices' => [
                    'Paris' => 'Paris',
                ],
                'disabled' => true,
                'mapped' => false,
            ])
            ->add('no_voie', TextType::class, [
                'label' => 'Numéro Voie',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Entrez le numéro de la voie']
            ])
            ->add('type_voie', ChoiceType::class, [
                'label' => 'Type Voie',
                'choices' => [
                    'RUE' => 'RUE',
                    'AV' => 'AV',
                    'BD' => 'BD',
                    'CITE' => 'CITE',
                    'IMP' => 'IMP',
                    'SQ' => 'SQ',
                    'QUAI' => 'QUAI',
                    'CRS' => 'CRS'
                ],
                'attr' => ['class' => 'form-select']
            ])
            ->add('b_t_q', ChoiceType::class, [
                'label' => 'Complément d\'adresse',
                'choices' => [
                    'N\A' => 'N\A',
                    'Bis' => 'Bis',
                    'Ter' => 'Ter',
                    'Quarter' => 'Quarter'
                ],
                'attr' => ['class' => 'form-select']
            ])
            ->add('voie', TextType::class, [
                'label' => 'Voie',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Entrez la voie']
            ])
            ->add('code_postal', ChoiceType::class, [
                'label' => 'Code Postale',
                'choices' => array_combine(range(75001, 75020), range(75001, 75020)),
                'attr' => ['class' => 'form-select']
            ])

           ->add('nb_pieces', ChoiceType::class, [
                'label' => 'Nombre de pièces',
                //'choices' => array_combine(range(1, 6), range(1, 6)),
                'choices' => [
                'Studio' => '1',
                'T1' => '1',
                'T2' => '2',
                'T3' => '3',
                'T4' => '4',
                'T5' => '5',
                'T6' => '6',

                ],
                'attr' => ['class' => 'form-select']
                ])

                ->add('surface_reelle_bati', NumberType::class, [
                'label' => 'Surface du bien m2',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Entrez la surface']
                ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
