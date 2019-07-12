<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\Card;
use App\Entity\User;
use phpDocumentor\Reflection\Types\Integer;
use function PHPSTORM_META\type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
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

            ->add('birthdate',
                BirthdayType::class,
                [
                    'label' => 'Date de naissance du joueur',
                    'required' => false,
                    'widget' => 'choice',
                    'format' => 'dd/MM/yyyy',
                    'html5' => false
                ])

           // ->add('card',
             //   EntityType::class,
               // [
                 //   'class' => Card::class,
                   // 'label' => 'Numéro de carte du joueur',
                   // 'required' => false
                    
               //  ])

           ->add('streetNumber',
               IntegerType::class,
               [

                   'label' => 'Numéro',
                   'required' => false

               ])

            ->add('streetName',
               TextType::class,
               [
                   'label' => 'Rue',
                   'required' => false
               ])

            ->add('zip',
                TextType::class,
                [
                    'label' => 'Code postal',
                    'required' => false
                ])

            ->add('city',
                TextType::class,
                [
                    'label' => 'Ville',
                    'required' => false
                ])

            ->add('country',
                TextType::class,
                [
                    'label' => 'Pays',
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
