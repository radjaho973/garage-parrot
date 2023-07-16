<?php

namespace App\Controller\BackOffice;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BackOfficePanelController extends AbstractController
{
    #[Route('/back-office', name: 'app_back_office_employee_panel')]
    public function displayEmployeePanel(): Response
    {
        return $this->render('back_office/back_office_panel/employee_panel.html.twig', [
            'controller_name' => 'BackOfficePanelController',
        ]);
    }

    #[Route('/back-office/admin', name: 'app_back_office_admin_panel')]
    public function displayAdminPanel(UserRepository $userRepo): Response
    {
        return $this->render('back_office/back_office_panel/admin_panel.html.twig', [
            'controller_name' => 'BackOfficePanelController',
            'users' => $userRepo->findAll(),
        ]);
    }
}
