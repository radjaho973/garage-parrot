<?php

namespace App\Controller;

use App\Repository\CarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(CarRepository $carRepo): Response
    {
        $latestCars = $carRepo->findBy([],["id"=>"DESC"],5);
        // dd($latestCars[1]->getImageCollection()->getValues());
        return $this->render('home/index.html.twig', [
            'latest_cars' => $latestCars,
            'controller_name' => 'HomeController',
        ]);
    }
}
