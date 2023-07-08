<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Bundle\SecurityBundle\SecurityBundle;
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
        $userRole = $this->getUser()->getRoles();
        
        if ($userRole[0] == "ROLE_ADMIN") {

            return $this->redirectToRoute('app_user_index');
        
        }elseif ($userRole[0] == "ROLE_EMPLOYEE") {

            return $this->redirectToRoute('app_car_index');
        }elseif (empty($userRole)) {

            return $this->redirectToRoute('app_login');
        }
    }
}
