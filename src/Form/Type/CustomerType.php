<?php

namespace App\Form\Type;

use App\Model\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('name', TextType::class);
        $builder->add('addresses', CollectionType::class, [
            'entry_type'     => AddressType::class,
            'allow_add'      => true,
            'allow_delete'   => true,
            'error_bubbling' => false,
        ]);
    }

    public function getBlockPrefix(): string
    {
        return 'customer';
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Customer::class,
        ]);
    }
}
