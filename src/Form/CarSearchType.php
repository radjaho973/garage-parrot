<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CarSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('text_search',TextType::class,[
                'required' => false,
                'label' => false,
                'help' => 'Rentrer un nom ou une marque de véhicule',
                'sanitize_html' => true,
                'attr' => [
                    'placeholder' => 'Recherche',
                    'class' => 'ajax-form',
                ]
            ])
            ->add('Prix',RangeType::class,[
                
                'attr' => [
                    'min' => 0,
                    'max' => 100000,
                    'value' => 100000,
                    // 'step' => 100
                ],
                'required' => false,
                'invalid_message' => 'Rentrer un nombre ou un chiffre'
            ])
            ->add('yearPlacedInCirculation')
            ->add('mileage')
            ->add('description')
            // ->add('categorie',TextType::class,[
            //     'mapped'=> false
            // ])
            // ->add('Marque',TextType::class,[
            //     'mapped'=> false
            // ])
            ->add('category', CollectionType::class,[
                'entry_type'=> CategoryType::class,
                    'by_reference'=> false,
                    'allow_add'=> true,
                    'allow_delete'=> true,
                    'entry_options' => ['label'=>false],
                    'prototype'=> true,
            ])
            // ->add('brand', CollectionType::class,[
            //     'entry_type'=> BrandType::class,
            //         'by_reference'=> false,
            //         'allow_add'=> true,
            //         'allow_delete'=> true,
            //         'entry_options' => ['label'=>true],
            //         'prototype'=> true,
            // ])
            // ->add('image_collection', CollectionType::class,[
            //     'mapped' => false,
            //     'entry_type'=> ImageCollectionType::class,
            //         'by_reference'=> false,
            //         'allow_add'=> true,
            //         'allow_delete'=> true,
            //         'entry_options' => ['label'=>false],
            //         'prototype'=> true,
            // ])
            
        ;
    }
}
