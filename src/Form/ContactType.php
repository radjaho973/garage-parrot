<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',options:[
                'row_attr' => [
                    'class' => 'col-md-6'
                ],
            ])
            ->add('name',options:[
                'row_attr' => [
                    'class' => 'col-md-6'
                ],
            ])
            ->add('surname',options:[
                'row_attr' => [
                    'class' => 'col-md-6'
                ],
            ])
            ->add('email',EmailType::class,[
                'row_attr' => [
                    'class' => 'col-md-6'
                ],
                'invalid_message' => 'Veuillez rentrer une adresse email valide'
            ])
            ->add('phone',TelType::class,[
                'row_attr' => [
                    'class' => 'col-md-6'
                ],
                'invalid_message' => 'Veuillez rentrer un numéro valide'
            ])
            ->add('message',TextareaType::class,[
                'row_attr' => [
                    'class' => 'col-md-12'
                ],
            ])
            ->add('link',HiddenType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
