<?php

namespace App\Form;

use App\Entity\WeekDay;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

class WeekHoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Lundi', TextType::class, [
                'disabled' => true,
                'data' => 'Lundi',
            ])
            ->add('start_hours',TimeType::class)
            ->add('end_hours',TimeType::class)
            ->add('closed',CheckboxType::class,[
                'label' => 'Fermé'
            ])
        ;
    }

    // public function configureOptions(OptionsResolver $resolver): void
    // {
    //     $resolver->setDefaults([
    //         'data_class' => WeekDay::class,
    //     ]);
    // }
}
