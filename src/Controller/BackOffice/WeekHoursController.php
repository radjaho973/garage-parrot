<?php

namespace App\Controller\BackOffice;

use App\Entity\WeekDay;
use App\Entity\OpenHours;
use App\Form\WeekHoursType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WeekHoursController extends AbstractController
{
    #[Route('back-office/admin/open', name: 'app_week_hours')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(WeekHoursType::class);
        $form->handleRequest($request);
        $daysOfWeek = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];

        if ($form->isSubmitted() && $form->isValid()) {
            $formArrayResult = $form->getData();
            
            //On vérifie que l'input caché de
            // chaque jour n'a pas été modifié
            // foreach ($daysOfWeek as $day) {
                //chaque jour en miniscule avec seulement les 3 première lettres
            //         //ex : si "Lundi" == lun_day => "Lundi"
            //     if ($day == $formArrayResult[$shortDayName."_day"]) {
                //         $weekDay = new WeekDay;
                //         $weekDay->setDay($day);
                //     }
                // }
                foreach ($daysOfWeek as $day) {
                //chaque jour en miniscule avec seulement les 3 première lettres
                    $dayShort = strtolower(substr($day, 0, 3));

                    $weekDay = new WeekDay;
                    $weekDay->setDay($day);
                    $openHours = new OpenHours;
                        //ex: lun_closed => false
                    if ($form->get($dayShort."_closed")->getData()) {
                        $openHours->setIsClosed(1);
                        $weekDay->setOpenHours($openHours);
                    }else{
                        $openHours->setStartTime($form->get($dayShort."_start_time")->getData());
                        $openHours->setEndTime($form->get($dayShort."_start_time")->getData());
                        $openHours->setIsClosed(0);
                        $weekDay->setOpenHours($openHours);
                    }
                    $em->persist($openHours);
                    $em->persist($weekDay);
                    // dd($form->get($dayShort."_closed")->getData());
                }
                
                $em->flush($weekDay);
        }
        return $this->render('back_office/week_hours/index.html.twig', [
            'form' => $form,
            'controller_name' => 'WeekHoursController',
        ]);
    }
}
