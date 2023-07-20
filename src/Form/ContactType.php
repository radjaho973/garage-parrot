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
                'attr' => ['placeholder' => 'Titre'],
                'row_attr' => [
                    'class' => 'col-md-12'
                ],
            ])
            ->add('name',options:[
                'label' => false,
                'attr' => ['placeholder' => 'Prénom'],
                'row_attr' => [
                    'class' => 'col-md-6'
                ],
            ])
            ->add('surname',options:[
                'label' => false,
                'attr' => ['placeholder' => 'Nom'],
                'row_attr' => [
                    'class' => 'col-md-6'
                ],
            ])
            ->add('email',EmailType::class,[
                'label' => false,
                'attr' => ['placeholder' => 'Email'],
                'row_attr' => [
                    'class' => 'col-md-6'
                ],
                'invalid_message' => 'Veuillez rentrer une adresse email valide'
            ])
            ->add('phone',TelType::class,[
                'label' => false,
                'attr' => ['placeholder' => 'Téléphone'],
                'row_attr' => [
                    'class' => 'col-md-6'
                ],
                'invalid_message' => 'Veuillez rentrer un numéro valide'
            ])
            ->add('message',TextareaType::class,[
                'required' => false,
                'label' => false,
                'attr' => ['placeholder' => 'Message'],
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
