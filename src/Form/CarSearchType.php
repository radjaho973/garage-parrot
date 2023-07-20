<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\Brand;
use App\Entity\Category;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class CarSearchType extends AbstractType
{
    private $carRepository;
    

    public function __construct(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
       
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
           
            ->add('year_circulation',RangeType::class,[
                'label' => 'Année de mise en circulation',
                'attr' => [
                    'min' => $options['min_year'],
                    'max' => $options['max_year'],
                    'value' => $options['min_year'],
                    // 'step' => 100
                ],
                'required' => false,
                'invalid_message' => 'Rentrer un nombre ou un chiffre'
            ])

            ->add('Prix',RangeType::class,[
                'attr' => [
                    'min' => $options['min_price'],
                    'max' => $options['max_price'],
                    'value' => $options['min_price'],
                    'step' => 100
                ],
                'required' => false,
                'invalid_message' => 'Rentrer un nombre ou un chiffre'
            ])

            ->add('category', EntityType::class,[
                'label' => 'Carburant',
                'class' => Category::class,
                'choice_label' => 'category',
                    'multiple' => false,
                    'expanded' => false,
                    'placeholder' => 'Toutes Catégories',
            ])
            ->add('brand', EntityType::class,[
                'label' => 'Marque',
                'class' => Brand::class,
                'choice_label' => 'brand',
                    'multiple' => false,
                    'expanded' => false,
                    'placeholder' => 'Toutes Marques',
            ])
            ->add('Rechercher', ButtonType::class, [
                
            ]);
            
        ;
        
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        
        $getCarMinMaxYear = $this->carRepository->getMinMaxYear()[0];
        $getCarMinMaxPrice = $this->carRepository->getMinMaxPrice()[0];
        $resolver->setDefaults([
            'min_year' => $getCarMinMaxYear["year_min"],
            'max_year' => $getCarMinMaxYear["year_max"],
            'min_price' => $getCarMinMaxPrice["price_min"],
            'max_price' => $getCarMinMaxPrice["price_max"],
        ]);
    }
}
