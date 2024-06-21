<?php

namespace App\Form\Type;

use App\Entity\SalesmanProductArea;
use Infinite\FormBundle\Form\Type\EntityCheckboxGridType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class SalesmanType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('name', TextType::class, [
            'required' => false,
        ]);

        $builder->add('productAreas', EntityCheckboxGridType::class, [
            'class'  => SalesmanProductArea::class,
            'x_path' => 'productSold',
            'y_path' => 'areaServiced',
        ]);
    }

    public function getBlockPrefix(): string
    {
        return 'salesman';
    }
}
