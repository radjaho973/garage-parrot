<?php

namespace App\Form;

use App\Entity\WeekDay;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class WeekHoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $daysOfWeek = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];

        foreach ($daysOfWeek as $day) {
            //chaque jour en miniscule avec seulement les 3 première lettres
            $shortDayName = strtolower(substr($day, 0, 3));

            $builder
                ->add($shortDayName.'_day', HiddenType::class, [
                    'data' => $day,
                    // 'label' => $day
                ])
                ->add($shortDayName.'_start_time', TimeType::class, [
                    'label' => $day." heure d'ouverture",
                ])
                ->add($shortDayName.'_end_time', TimeType::class,[
                    'label' => $day." heure de fermeture"
                ])
                ->add($shortDayName.'_closed', CheckboxType::class, [
                    'label' => 'Fermé',
                    'required' => false
                ]);
        }
        $builder->add("Enregistrer",SubmitType::class);
    }
}

