<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',
                EmailType::class,
                [
                    'label' => false,

                        'attr' => ['placeholder' => 'Mail',
                            'class' => 'input']
                ])
            ->add('lastname',
                TextType::class,
                [
                    'label' => false,
                    'attr' => ['placeholder' => 'Nom',
                        'class' => 'input']
                ])
            ->add('firstname',
                TextType::class,
                [
                    'label' => false,
                    'attr' => ['placeholder' => 'Prénom',
                        'class' => 'input']
                ])
            ->add('phone',
                TelType::class,
                [
                    'label' => false,
                    'attr' => ['placeholder' => 'Tel',
                                'class' => 'input']
                ])

            ->add('birthdate',
                BirthdayType::class,
                [
                    'label' => false,
                    'required' => false,
                    'widget' => 'choice',
                    'format' => 'dd/MM/yyyy',
                    'html5' => false,
                    'attr' => [
                        'class' => 'input_format'
                    ]
                ])

            ->add('password',
                // 2 champs qui doivent avoir la même valeur
                RepeatedType::class,
                [
                    // ...de type password
                    'type' => PasswordType::class,
                    // options du 1er champ
                    'first_options' => [
                        'label' => false,
                        'attr' => ['placeholder' => 'Mot de passe',
                            'class' => 'input']

                    ],
                    // options du 2nd champ
                    'second_options' => [
                        'label' => false,
                        'attr' => ['placeholder' => 'Confirmation du mot de passe',
                            'class' => 'input']
                    ],
                    // message si les 2 champs n'ont pas la même valeur
                    'invalid_message' => 'La confirmation ne correspond pas au mot de passe'
                ])

               ->add('score', TextType::class,
              [ 'label' => false,
                  'required' => false,
                  'attr' => [
                            'class' => 'input'
                    ]
              ])

            ->add('zip',
                TextType::class,
                [
                    'label' => false,
                    'required' => false,
                    'attr' => ['placeholder' => 'Code postal',
                        'class' => 'input']
                ])

            ->add('city',
                TextType::class,
                [
                    'label' => false,
                    'required' => false,
                    'attr' => ['placeholder' => 'Ville',
                        'class' => 'input']
                ])

            ->add('country',
                TextType::class,
                [
                    'label' => false,
                    'required' => false,
                    'attr' => ['placeholder' => 'Pays',
                        'class' => 'input']
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
