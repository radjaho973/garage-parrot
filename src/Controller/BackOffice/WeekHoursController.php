<?php

namespace App\Controller\BackOffice;

use App\Entity\WeekDay;
use App\Entity\OpenHours;
use App\Form\WeekHoursType;
use App\Repository\WeekDayRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WeekHoursController extends AbstractController
{
    #[Route('back-office/admin/open', name: 'app_week_hours')]
    public function index(Request $request,WeekDayRepository $weekDayRepo, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(WeekHoursType::class);
        $form->handleRequest($request);
        $daysOfWeek = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];

        if ($form->isSubmitted() && $form->isValid()) {

                foreach ($daysOfWeek as $day) {
                    //On assigne à chaque jour son correspondant en bdd
                    $existingDay = $weekDayRepo->findOneBy([
                        'day' => $day
                    ]);

                // chaque jour en miniscule avec seulement les 3 première lettres
                    $dayShort = strtolower(substr($day, 0, 3));
                    // pour chaque jour on crée des heures d'ouverture
                    // et fermeture sauf si fermé
                    $newOpenHours = $existingDay->getOpenHours();
                    // ex: get(lun_closed)
                    if ($form->get($dayShort."_closed")->getData()) { //retourne un booléen
                        $newOpenHours->setIsClosed(1);
                        $existingDay->setOpenHours($newOpenHours);
                    }else{
                        $newOpenHours->setStartTime($form->get($dayShort."_start_time")->getData());
                        $newOpenHours->setEndTime($form->get($dayShort."_start_time")->getData());
                        $newOpenHours->setIsClosed(0);
                        $existingDay->setOpenHours($newOpenHours);
                    }
                    $em->persist($newOpenHours);
                    $em->persist($existingDay);
                }
                
                $em->flush();
        }
        return $this->render('back_office/week_hours/index.html.twig', [
            'days_of_week' => $daysOfWeek,
            'form' => $form,
        ]);
    }
}
