<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
         // get the login error if there is one
         
         $error = $authenticationUtils->getLastAuthenticationError();
    
         // last username entered by the user
         $lastUsername = $authenticationUtils->getLastUsername();
        
        return $this->render('login/index.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
            'controller_name' => 'LoginController',
        ]);
    }
    #[Route('/login-redirect', name: 'app_login_redirect')]
    public function loginRedirect(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_EMPLOYEE');
        $userRole = $this->getUser()->getRoles();
        
        if ($userRole[0] == "ROLE_ADMIN") {
            
            return $this->redirectToRoute('app_back_office_admin_panel');
            
        }elseif ($userRole[0] == "ROLE_EMPLOYEE") {

            return $this->redirectToRoute('app_back_office_employee_panel');
        }elseif (empty($userRole) || $userRole == null) {
            dd($this->getUser());
            return $this->redirectToRoute('app_login');
        }
    }
}
