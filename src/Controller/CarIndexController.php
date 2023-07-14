<?php

namespace App\Controller;

use App\Form\CarSearchType;
use App\Repository\CarRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\RateLimiter\RateLimiterFactory;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarIndexController extends AbstractController
{
    //method : "POST"
    #[Route('/car/index', name: 'app_car_index', methods:["POST","GET"])]
    public function index(CarRepository $carRepo,Request $request): Response
    {
        $cars = $carRepo->findAll();
        
        $form = $this->createForm(CarSearchType::class);
        $form->handleRequest($request);

        if ($request->isXmlHttpRequest()) {
            
            function ajaxSearch($request){
                $requestBody = $request->getContent();
                return json_encode("ceci est une réponse de symfony");
            }
        }else{
        }

        // if ($form->isSubmitted() && $form->isValid()) {
            // dd($form->get('recherche')->getData());
        // }
        return $this->render('car_index/index.html.twig', [
            'cars'=> $cars,
            'form'=> $form,
            'controller_name' => 'CarIndexController',
        ]);
    }
    #[Route('/car/index/ajax', name: 'app_car_index_ajax', methods:["POST"])]
    public function ajax(CarRepository $carRepo,Request $request,RateLimiterFactory $rateLimit, NormalizerInterface $normalizer): JsonResponse
    {
        
        if (!$request->isXmlHttpRequest()) {
            return $this->json('error');
        }else{
            //ajout d'une limite de requête ajax pour sécuriser l'application
            $limiter = $rateLimit->create($request->getClientIp());
            // https://symfony.com/doc/current/rate_limiter.html#rate-limiting-in-action
            //passe les classes à l'intérieur de la fonction pour les
            //utiliser
            function dbQuery($request, CarRepository $carRepo){
                
                $data = json_decode($request->getContent(),true);
                //requête personalisé dans le repo
                $dbQueryResult = $carRepo->search($data["searchQuery"]);
            
                return $dbQueryResult;
            }
            // Rqresult est un tableau avec les résultats de la recherche
            $Rqresult = dbQuery($request,$carRepo);
            // options 'groups' défini dans les entités
            // Car;Category;ImageCollection & Brand afin de signaler à
            //normalizer quel données encodé en format Json pour éviter les boucles infinies.
            $carNormalized = $normalizer->normalize($Rqresult,null,[
                'groups' => 'car:object'
            ]);
        }   
        //retourne une JsonResponse
        return $this->json($carNormalized);
       
    }
}
