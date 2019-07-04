<?php

namespace App\Form;

use App\Entity\Card;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('GET')
            ->add('user',
                EntityType::class,
                [
                    'label' => 'User',
                    'class' => User::class,
                    'placeholder' => 'Choisissez',
                    'required' => false
                ])

            ->add('card',
                EntityType::class,
                [
                    'label' => 'Card',
                    'class' => Card::class,
                    'placeholder' => 'Choisissez',
                    'required' => false
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
