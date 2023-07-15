<?php

namespace App\Controller\BackOffice;

use App\Form\WeekHoursType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WeekHoursController extends AbstractController
{
    #[Route('back-office/admin/open', name: 'app_week_hours')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(WeekHoursType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            
            // return $this->redirectToRoute('app_login');
        }
        return $this->render('back_office/week_hours/index.html.twig', [
            'form' => $form,
            'controller_name' => 'WeekHoursController',
        ]);
    }
}
