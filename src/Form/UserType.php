<?php

namespace App\Form;

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

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname',
                TextType::class,
                [
                    'label' => 'Lastname'
                ])
            ->add('firstname',
                TextType::class,
                [
                    'label' => 'Firstname'
                ])
            ->add('email',
                EmailType::class,
                [
                    'label' => 'Email'
                ])
         //   ->add('roles')
            ->add('password',
             // 2 champs qui doivent avoir la même valeur
             RepeatedType::class,
             [
                 // ...de type password
                 'type' => PasswordType::class,
                 // options du 1er champ
                 'first_options' => [
                     'label' => 'Mot de passe'
                 ],
                 // options du 2nd champ
                 'second_options' => [
                     'label' => 'Confirmation du mot de passe'
                 ],
                 // message si les 2 champs n'ont pas la même valeur
                 'invalid_message' => 'La confirmation ne correspond pas au mot de passe'
             ]
         )

            ->add('phone',
                TelType::class,
                [
                    'label' => 'Tel.'
                ])

            ->add('birthdate',
                BirthdayType::class,
                [
                    'label' => 'Date de naissance du joueur',
                    'required' => false,
                    'widget' => 'choice',
                    'format' => 'dd/MM/yyyy',
                    'html5' => false
                ])

            ->add('streetNumber',
                TextType::class,
                [
                    'label' => 'Numéro',
                    'required' => false,
                    'html5' => false
                ])

            ->add('streetName',
                TextType::class,
                [
                    'label' => 'Rue',
                    'required' => false,
                    'html5' => false
                ])

            ->add('zip',
                TextType::class,
                [
                    'label' => 'Code postal',
                    'required' => false,
                    'html5' => false
                ])

            ->add('city',
                TextType::class,
                [
                    'label' => 'ville',
                    'required' => false,
                    'html5' => false
                ])

            ->add('country',
                TextType::class,
                [
                    'label' => 'Pays',
                    'required' => false,
                    'html5' => false
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


