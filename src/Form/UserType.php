<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname')
            ->add('firstname')
            ->add('email')
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
            ->add('phone')
            ->add('password')
            ->add('birthdate')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}


