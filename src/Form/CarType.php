<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\Brand;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',options:[
                'label' => 'Nom'
            ])
            ->add('price',options:[
                'label' => 'Prix'
            ])
            ->add('yearPlacedInCirculation',options:[
                'label' => 'Année de mise en circulation'
            ])
            ->add('mileage',options:[
                'label' => 'Kilométrage'
            ])
            ->add('description',TextareaType::class)
            ->add('category',EntityType::class,[
                'class' => Category::class,
                'choice_label' => 'category',
                    'multiple' => false,
                    'expanded' => false,
            ])
            ->add('brand',EntityType::class,[
                'class' => Brand::class,
                'choice_label' => 'brand',
                    'multiple' => false,
                    'expanded' => false,
            ])
            ->add('images_file_collection', CollectionType::class,[
                'label' =>false,
                'mapped' => false,
                'entry_type'=> FileType::class,
                    'by_reference'=> false,
                    'allow_add'=> true,
                    'allow_delete'=> true,
                    'empty_data' => null,
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
