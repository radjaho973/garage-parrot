<?php

namespace App\Controller;

use App\Entity\Testimonials;
use App\Repository\CarRepository;
use App\Form\UserTestimonialsType;
use App\Repository\ServicesRepository;
use App\Repository\TestimonialsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request, TestimonialsRepository $testimonialsRepository ,CarRepository $carRepo,ServicesRepository $servicesRepo,TestimonialsRepository $testimonialsRepo): Response
    {
        $latestCars = $carRepo->findBy([],["id"=>"DESC"],5);
        $services = $servicesRepo->findAll();
        
        $testimonials = $testimonialsRepo->getValidatedTestimonials();

        //?
        //? NEW TESTIMONIAL
        //?
        $testimonial = new Testimonials();
        $form = $this->createForm(UserTestimonialsType::class, $testimonial);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $numberInp = $form->get("note")->getData();
            if ($numberInp > 10) {
                $numberInp = 10;
                
            }elseif($numberInp < 0){
                $numberInp = 0;
            }
            $testimonial->setNote($numberInp);
            $testimonial->setIsValidated(false);
            $testimonial->setPendingVerification(true);
            $testimonialsRepository->save($testimonial, true);
            // dd($testimonial);

            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('home/index.html.twig', [
            'latest_cars' => $latestCars,
            'services' => $services,
            'testimonials' => $testimonials,
            //? NEW FORM
            'testimonial' => $testimonial,
            'form' => $form,

        ]);
    }
    // #[Route('/new-testimonial', name: 'app_testimonials_new', methods: ['GET', 'POST'])]
    // public function new(Request $request, TestimonialsRepository $testimonialsRepository): Response
    // {
        
    //     $testimonial = new Testimonials();
    //     $form = $this->createForm(UserTestimonialsType::class, $testimonial);
    //     $form->handleRequest($request);
        
    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $testimonial->setIsValidated(false);
    //         $testimonial->setPendingVerification(true);
    //         $testimonialsRepository->save($testimonial, true);
    //         // dd($testimonial);

    //         return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
    //     }
    //     return $this->render('_new_testimonial.html.twig', [
    //         'testimonial' => $testimonial,
    //         'form' => $form,
    //     ]);
    // }
}
