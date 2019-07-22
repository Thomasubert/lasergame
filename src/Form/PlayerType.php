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

           // ->add('card',
             //   EntityType::class,
               // [
                 //   'class' => Card::class,
                   // 'label' => 'Numéro de carte du joueur',
                   // 'required' => false
                    
               //  ])

               ->add('score', IntegerType::class,
              [ 'label' => false,
                  'attr' => [
        'class' => 'input'
    ]])

           ->add('streetNumber',
               IntegerType::class,
               [

                   'label' => false,
                   'required' => false,
                   'attr' => ['placeholder' => 'Numéro',
                       'class' => 'input']

               ])

            ->add('streetName',
               TextType::class,
               [
                   'label' => false,
                   'required' => false,
                   'attr' => ['placeholder' => 'Rue',
                       'class' => 'input']
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
