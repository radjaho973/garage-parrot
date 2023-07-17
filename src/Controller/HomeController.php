<?php

namespace App\Controller;

use App\Repository\CarRepository;
use App\Repository\ServicesRepository;
use App\Repository\TestimonialsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(CarRepository $carRepo,ServicesRepository $servicesRepo,TestimonialsRepository $testimonialsRepo): Response
    {
        $latestCars = $carRepo->findBy([],["id"=>"DESC"],5);
        $services = $servicesRepo->findAll();
        
        $testimonials = $testimonialsRepo->getValidatedTestimonials();
      

        return $this->render('home/index.html.twig', [
            'latest_cars' => $latestCars,
            'services' => $services,
            'testimonials' => $testimonials,
            'controller_name' => 'HomeController',
        ]);
    }
}
