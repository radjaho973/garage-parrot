<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\ImageCollection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

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
            ->add('images',FileType::class, [
                'label'=> 'Fichier Image',
                'mapped'=> false,
                'required'=> false,
                'constraints' =>[
                    new File ([
                        'maxSize' => '1024k',
                        'extensions' =>[
                            'webp',
                            'jpeg',
                            'png'
                        ],
                        'mimeTypesMessage' => 'Veuillez Uploader une image au format webp, jpeg ou png.'
                    ])
                ],

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
