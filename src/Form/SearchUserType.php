<?php


namespace App\Form;

use App\Entity\Card;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;







use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class SearchUserType
 * @package App\Form
 */

class SearchUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('lastname',
                TextType::class,
                [
                    'label' => false,
                    'attr' => [
                        'class' => 'input'
                    ]
                ]
                )
            ;
    }
}

