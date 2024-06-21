<?php

namespace App\Form\Type;

use App\Model\Paints;
use Infinite\FormBundle\Form\Type\CheckboxGridType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaintsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('paints', CheckboxGridType::class, [
            'x_choices' => [
                'white' => 'White',
                'beige' => 'Beige',
                'yellow' => 'Yellow',
            ],
            'x_path' => '[color]',
            'y_choices' => [
                'matte' => 'Matte',
                'satin' => 'Satin',
                'gloss' => 'Gloss',
                'high_gloss' => 'High gloss',
            ],
            'y_path' => '[finish]',
        ]);
    }

    public function getBlockPrefix(): string
    {
        return 'paints';
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Paints::class,
        ]);
    }
}
