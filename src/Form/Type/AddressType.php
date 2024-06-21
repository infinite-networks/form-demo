<?php

namespace App\Form\Type;

use App\Model\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('line1', TextType::class);
        $builder->add('line2', TextType::class, ['required' => false]);
        $builder->add('line3', TextType::class, ['required' => false]);
        $builder->add('postcode', TextType::class);
    }

    public function getBlockPrefix(): string
    {
        return 'address';
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
