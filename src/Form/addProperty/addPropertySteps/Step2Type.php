<?php

namespace App\Form\addProperty\addPropertySteps;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class Step2Type extends AbstractType
{
   
            public function buildForm(FormBuilderInterface $builder, array $options): void
            {
                $builder
                    ->add('number_of_bedrooms', ChoiceType::class, [
                        'label' => 'Nombre de chambres',
                        'choices' => array_combine(range(0, 5), range(0, 5)),
                        'attr' => [
                            'class' => 'form-select',
                            'placeholder' => 'Select number of bedrooms'
                        ]
                    ])
                    ->add('floor', ChoiceType::class, [
                        'label' => 'Etage',
                        'choices' => array_combine(range(1, 25), range(1, 25)),
                        'attr' => [
                            'class' => 'form-select',
                            'placeholder' => 'Select floor'
                        ]
                    ])
                    ->add('heating_type', ChoiceType::class, [
                        'label' => 'Type chauffage',
                        'choices' => [
                            'Non' => '0',
                            'Gaz' => 'Gaz',
                            'Electric' => 'Electric',
                            'Au Bois' => 'Au Bois',
                            'Au Fioul' => 'Au Fioul',
                        ],
                        'attr' => [
                            'class' => 'form-select',
                            'placeholder' => 'Type de Chauffage',
                            
                        ]
                    ])
                    ->add('property_condition', ChoiceType::class, [
                        'label' => 'Etat du bien',
                        'choices' => [
                            'Neuf' => 'neuf',
                            'Renové (-2ans)' => 'renove',
                            'Très bon' => 'tres_bon',
                            'Bon' => 'bon',
                            'A rafraichir' => 'a_rafraichir',
                            'A rénover' => 'a_renover',
                        ],
                        'attr' => [
                            'class' => 'form-select',
                            'placeholder' => 'Select property condition'
                        ]
                    ])
                    ->add('elevator', CheckboxType::class, [
                        'label' => 'Ascenseur',
                        'required' => false,
                        'attr' => [
                            'class' => 'form-check-input'
                        ]
                    ])
                    ->add('balcony', CheckboxType::class, [
                        'label' => 'Balcon',
                        'required' => false,
                        'attr' => [
                            'class' => 'form-check-input'
                        ]
                    ])
                    ->add('parking', CheckboxType::class, [
                        'label' => 'Parking',
                        'required' => false,
                        'attr' => [
                            'class' => 'form-check-input'
                        ]
                    ])
                    ->add('air_condition', CheckboxType::class, [
                        'label' => 'Climatisation',
                        'required' => false,
                        'attr' => [
                            'class' => 'form-check-input'
                        ]
                    ])
                    ->add('energy_class', ChoiceType::class, [
                        'label' => 'Classe énergétique',
                        'choices' => [
                            'A' => 'A',
                            'B' => 'B',
                            'C' => 'C',
                            'D' => 'D',
                            'E' => 'E',
                            'F' => 'F',
                            'G' => 'G',
                            'N/A' => 'N/A',
                        ],
                        'attr' => [
                            'class' => 'form-select',
                            'placeholder' => 'Select energy class'
                        ]
                    ]);
            }
        
            public function configureOptions(OptionsResolver $resolver)
            {
                $resolver->setDefaults([]);
            }
        }