<?php

namespace App\Form\Type;

use App\Model\InvoiceServiceLine;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InvoiceServiceLineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('description', TextType::class);
        $builder->add('quantity', NumberType::class);
        $builder->add('unitPrice', Numbertype::class);

        $builder->add('_type', HiddenType::class, [
            'data'   => $this->getBlockPrefix(),
            'mapped' => false
        ]);
    }

    public function getBlockPrefix(): string
    {
        return 'invoice_service_line';
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class'  => InvoiceServiceLine::class,
            'model_class' => InvoiceServiceLine::class,
        ]);
    }
}
