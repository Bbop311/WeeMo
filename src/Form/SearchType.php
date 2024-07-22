<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code_postal', ChoiceType::class, [
                'choices' => [
                    'Paris 20'=> 75020,
                    'Paris 19'=> 75019,
                    'Paris 18'=> 75018,
                    'Paris 17'=> 75017,
                    'Paris 16'=> 75016,
                    'Paris 15'=> 75015,
                    'Paris 14'=> 75014,
                    'Paris 13'=> 75013,
                    'Paris 12'=> 75012,
                    'Paris 11'=> 75011,
                    'Paris 10'=> 75010,
                    'Paris 09'=> 75009,
                    'Paris 08'=> 75008,
                    'Paris 07'=> 75007,
                    'Paris 06'=> 75006,
                    'Paris 05'=> 75005,
                    'Paris 04'=> 75004,
                    'Paris 03'=> 75003,
                    'Paris 02'=> 75002,
                    'Paris 01'=> 75001,
                ],
                'required' => false,
                'label' => 'Arrondissement'
            ])
            /* ->add('type_local', TextType::class, [
                // 'help' => 'SALUT',
                'label' => 'Type de bien',
                'label_attr' => [
                    'class' => 'form-label',
                    // 'style' => 'color: blue',
                ],
                'attr' => [
                    'placeholder' => 'Ex: ???'
                ],
                'required' => false,
                // 'data' => 'SALUT',
            ]) */
            /* ->add('created_at', DateType::class, [
                // 'help' => 'SALUT',
                'label' => 'Déposé le:',
                'label_attr' => [
                    'class' => 'form-label',
                    // 'style' => 'color: blue',
                ],
                'attr' => [
                    'placeholder' => 'Renseignez le nombres de pièces',
                    'color' => 'color: blue',
                ],
                'required' => false,
                // 'data' => 'SALUT',
            ]) */
            /* ->add('updated_at', DateType::class, [
                // 'help' => 'SALUT',
                'label' => 'Mis à jour le:',
                'label_attr' => [
                    'class' => 'form-label',
                    // 'style' => 'color: blue',
                ],
                'attr' => [
                    'placeholder' => 'Renseignez le nombres de pièces',
                    'color' => 'color: blue',
                ],
                'required' => false,
                // 'data' => 'SALUT',
            ]) */
            ->add('nb_of_bedrooms', TextType::class, [
                // 'help' => 'SALUT',
                'label' => 'Nombres de pièces',
                'label_attr' => [
                    'class' => 'form-label',
                    // 'style' => 'color: blue',
                ],
                'attr' => [
                    'placeholder' => 'Ex: 4',
                    'color' => 'color: blue',
                ],
                'required' => false,
                // 'data' => 'SALUT',
            ])
            ->add('surface_reelle_bati_min', NumberType::class, [
                // 'help' => 'SALUT',
                'label' => 'Surface Min',
                'label_attr' => [
                    'class' => 'form-label',
                    // 'style' => 'color: blue',
                ],
                'attr' => [
                    'placeholder' => 'Renseignez la surface minimum'
                ],
                'required' => false,
                // 'data' => 'SALUT',
            ])->add('surface_reelle_bati_max', NumberType::class, [
                // 'help' => 'SALUT',
                'label' => 'Surface Max',
                'label_attr' => [
                    'class' => 'form-label',
                    // 'style' => 'color: blue',
                ],
                'attr' => [
                    'placeholder' => 'Renseignez la surface maximum'
                ],
                'required' => false,
                // 'data' => 'SALUT',
            ])
            ->add('Submit', SubmitType::class, [
                'label' => 'Rechercher'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
