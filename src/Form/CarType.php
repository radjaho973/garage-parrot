<?php

namespace App\Form;

use App\Entity\Car;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('price')
            ->add('yearPlacedInCirculation')
            ->add('mileage')
            ->add('description')
            ->add('categorie',TextType::class,[
                'mapped'=> false
            ])
            ->add('Marque',TextType::class,[
                'mapped'=> false
            ])
            // ->add('category', CollectionType::class,[
            //     'entry_type'=> CategoryType::class,
            //         'by_reference'=> false,
            //         'allow_add'=> true,
            //         'allow_delete'=> true,
            //         'entry_options' => ['label'=>false],
            //         'prototype'=> true,
            // ])
            // ->add('brand', CollectionType::class,[
            //     'entry_type'=> BrandType::class,
            //         'by_reference'=> false,
            //         'allow_add'=> true,
            //         'allow_delete'=> true,
            //         'entry_options' => ['label'=>true],
            //         'prototype'=> true,
            // ])
            ->add('image_collection', CollectionType::class,[
                'mapped' => false,
                'entry_type'=> ImageCollectionType::class,
                    'by_reference'=> false,
                    'allow_add'=> true,
                    'allow_delete'=> true,
                    'entry_options' => ['label'=>false],
                    'prototype'=> true,
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}
