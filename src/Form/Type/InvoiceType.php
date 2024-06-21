<?php

namespace App\Form\Type;

use App\Model\Invoice;
use Infinite\FormBundle\Form\Type\PolyCollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InvoiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('recipient', TextType::class, [
            'required' => false,
        ]);

        $builder->add('lines', PolyCollectionType::class, [
            'required' => false,
            'types' => [
                InvoiceFreightLineType::class,
                InvoiceProductLineType::class,
                InvoiceServiceLineType::class,
            ],
            'allow_add'    => true,
            'allow_delete' => true,
        ]);
    }

    public function getBlockPrefix(): string
    {
        return 'invoice';
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(array(
            'data_class' => Invoice::class,
        ));
    }
}
