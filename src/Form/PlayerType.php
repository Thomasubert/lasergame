<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\Card;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
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
                    'label' => 'Email du joueur'
                ])
            ->add('lastname',
                TextType::class,
                [
                    'label' => 'Nom du joueur'
                ])
            ->add('firstname',
                TextType::class,
                [
                    'label' => 'Prénom du joueur'
                ])
            ->add('phone',
                TelType::class,
                [
                    'label' => 'Numéro du téléphone du joueur'
                ])
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
            ->add('birthdate',
                BirthdayType::class,
                [
                    'label' => 'Date de naissance du joueur',
                    'required' => false,
                    'widget' => 'choice',
                    'format' => 'dd/MM/yyyy',
                    'html5' => false
                ])
            ->add('address',
                EntityType::class,
                [
                    'class' => Address::class,
                    'label' => 'Adresse du joueur',
                    'required' => false
                ])
            ->add('card',
                EntityType::class,
                [
                    'class' => Card::class,
                    'label' => 'Numéro de carte du joueur',
                    'required' => false
                    
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
