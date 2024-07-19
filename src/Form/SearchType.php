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
            ->add('code_postal', NumberType::class, [
                // 'help' => 'SALUT',
                'label' => 'Code Postal',
                'label_attr' => [
                    'class' => 'form-label',
                    // 'style' => 'color: blue',
                ],
                'attr' => [
                    'placeholder' => 'Ex: 75019'
                ],
                'required' => false,
                // 'data' => 'SALUT',
            ])
            ->add('commune', ChoiceType::class, [
                'choices' => [
                    'Paris 20'=> 'Paris 20',
                    'Paris 19'=> 'Paris 19',
                    'Paris 18'=> 'Paris 18',
                    'Paris 17'=> 'Paris 17',
                    'Paris 16'=> 'Paris 16',
                    'Paris 15'=> 'Paris 15',
                    'Paris 14'=> 'Paris 14',
                    'Paris 13'=> 'Paris 13',
                    'Paris 12'=> 'Paris 12',
                    'Paris 11'=> 'Paris 11',
                    'Paris 10'=> 'Paris 10',
                    'Paris 09'=> 'Paris 09',
                    'Paris 08'=> 'Paris 08',
                    'Paris 07'=> 'Paris 07',
                    'Paris 06'=> 'Paris 06',
                    'Paris 05'=> 'Paris 05',
                    'Paris 04'=> 'Paris 04',
                    'Paris 03'=> 'Paris 03',
                    'Paris 02'=> 'Paris 02',
                    'Paris 01'=> 'Paris 01',
                ],
                'required' => false,
            ])
            ->add('type_local', TextType::class, [
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
            ])
            ->add('created_at', DateType::class, [
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
            ])
            ->add('updated_at', DateType::class, [
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
            ])
            ->add('nb_pieces', TextType::class, [
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
            ->add('surface_terrain', NumberType::class, [
                // 'help' => 'SALUT',
                'label' => 'Surface du terrain',
                'label_attr' => [
                    'class' => 'form-label',
                    // 'style' => 'color: blue',
                ],
                'attr' => [
                    'placeholder' => 'Renseignez la surface du terrain'
                ],
                'required' => false,
                // 'data' => 'SALUT',
            ])
            ->add('Submit', SubmitType::class, [
                'label' => 'Rechercher'
            ])
            ->add('Reset', ResetType::class, [
                'label' => 'Réinitialiser'
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
