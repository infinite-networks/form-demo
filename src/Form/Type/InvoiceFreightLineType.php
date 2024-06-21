<?php

namespace App\Form\Type;

use App\Model\InvoiceFreightLine;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InvoiceFreightLineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('courier', TextType::class);
        $builder->add('unitPrice', NumberType::class);

        $builder->add('_type', HiddenType::class, [
            'data'   => $this->getBlockPrefix(),
            'mapped' => false
        ]);
    }

    public function getBlockPrefix(): string
    {
        return 'invoice_freight_line';
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class'  => InvoiceFreightLine::class,
            'model_class' => InvoiceFreightLine::class,
        ]);
    }
}
