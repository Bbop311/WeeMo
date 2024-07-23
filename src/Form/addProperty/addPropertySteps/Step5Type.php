<?php

namespace App\Form\addProperty\addPropertySteps;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\NotBlank;



class Step5Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        
        ->add('phone_number', TextType::class, [
            'label' => 'Renseignez votre Numéro de télephone pour être contacté rapidement',
            'attr' => [
                'class' => 'form-control', 
                'placeholder' => 'Numéro de télephone'
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Veuillez entrer votre numéro de téléphone',
                ]),
                new Regex([
                    'pattern' => '/^[0-9]{10}$/',
                    'message' => 'Le numéro de téléphone doit comporter exactement 8 chiffres',
                ]),
                new Length([
                    'max' => 10,
                    'maxMessage' => 'Le numéro de téléphone ne doit pas dépasser {{ limit }} chiffres',
                ]),
            ],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
