<?php


namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class SearchCardType
 * @package App\Form
 */
class SearchCardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('codeCard', IntegerType::class,
                [
                    'label' => false,
                    'attr' => [
                        'class' => 'input'
                    ]
                ])
        ;
    }
}