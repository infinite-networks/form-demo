<?php

namespace App\Form\Type;

use App\Model\Numbers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NumbersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('numbers', CollectionType::class, [
            'entry_type'     => NumberType::class,
            'allow_add'      => true,
            'allow_delete'   => true,
            'error_bubbling' => false,
        ]);
    }

    public function getBlockPrefix(): string
    {
        return 'numbers';
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(array(
            'data_class' => Numbers::class,
        ));
    }
}
