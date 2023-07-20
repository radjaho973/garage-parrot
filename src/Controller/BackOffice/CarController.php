<?php

namespace App\Controller\BackOffice;

use App\Entity\Car;
use App\Entity\Brand;
use App\Form\CarType;
use App\Entity\Category;
use App\Entity\ImageCollection;
use App\Form\ContactType;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/back-office/car')]
class CarController extends AbstractController
{
    #[Route('/', name: 'back_office_app_car_index', methods: ['GET'])]
    public function index(CarRepository $carRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_EMPLOYEE');

        return $this->render('back_office/car/index.html.twig', [
            'cars' => $carRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_car_new', methods: ['GET', 'POST'])]
    public function new(EntityManagerInterface $em, Request $request, CarRepository $carRepo, SluggerInterface $slugger): Response
    {
        $this->denyAccessUnlessGranted('ROLE_EMPLOYEE');

        $car = new Car();
        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $CarName = $form->get('name')->getData();
            $CarBrand = $form->get('brand')->getData()->getBrand();
            
            $imgFileArray = $form->get('images_file_collection');
            
            
            //ici on regarde si l'utilisateur à soumis des images
            if (!empty($imgFileArray->getData())) {
                //si oui alors pour chaque fichier on assigne un slug unique
                //qu'on enregistre dans image_url et on stocke le fichier
                //dans son dossier respectif
                foreach ($imgFileArray as $imgFile) {
                    
                    $uploadedImage = $imgFile->getData();
                    
                    // crée un nom de fichier utilisable
                    $constructFileName = $CarBrand."-".$CarName;
                    $safeFileName = $slugger->slug($constructFileName);
                    $newFileName = $safeFileName.'_'.uniqid().'.'.$uploadedImage->guessExtension();
                    //ex: Peugeot-206_464648974cgf.jpg
                    
                    // on déplace le fichier dans le dossier des voitures
                    try{
                        $uploadedImage->move(
                            //services.yaml sous parameters
                            $this->getParameter('image_directory'),
                            $newFileName
                        );
                    }catch (FileException $e){
                        return new $e(`Une erreur c'est produite durant
                        l'envoie de fichier` ,400 );
                    }
                    // ajout du slug à la table image collection
                    // et liaison avec la voiture enregistré 
                    $imageCollection = new ImageCollection;
                    $imageCollection->setImageUrl($newFileName);
                    $car->addImageCollection($imageCollection);
                    $em->persist($imageCollection);
                }
            }else{ //si il n'y à pas d'image envoyé
                $imageCollection = new ImageCollection;
                    $imageCollection->setImageUrl("car-default.jpg");
                    $car->addImageCollection($imageCollection);
                    $em->persist($imageCollection);
            }


            $carRepo->save($car, true);

            return $this->redirectToRoute('back_office_app_car_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back_office/car/new.html.twig', [
            'car' => $car,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_car_show', methods: ['GET'])]
    public function show(Car $car, Request $request): Response
    {
        
        $this->denyAccessUnlessGranted('ROLE_EMPLOYEE');

       
        return $this->render('back_office/car/show.html.twig', [
            'car' => $car,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_car_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Car $car, CarRepository $carRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_EMPLOYEE');

        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $carRepository->save($car, true);

            return $this->redirectToRoute('back_office_app_car_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back_office/car/edit.html.twig', [
            'car' => $car,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_car_delete', methods: ['POST'])]
    public function delete(Request $request, Car $car, CarRepository $carRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_EMPLOYEE');
        
        if ($this->isCsrfTokenValid('delete'.$car->getId(), $request->request->get('_token'))) {
            $carRepository->remove($car, true);
        }

        return $this->redirectToRoute('back_office_app_car_index', [], Response::HTTP_SEE_OTHER);
    }
}
