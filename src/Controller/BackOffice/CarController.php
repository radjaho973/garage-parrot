<?php

namespace App\Controller\BackOffice;

use App\Entity\Car;
use App\Entity\ImageCollection;
use App\Form\CarType;
use App\Repository\CarRepository;
use App\Repository\ImageCollectionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/back-office/car')]
class CarController extends AbstractController
{
    #[Route('/', name: 'app_car_index', methods: ['GET'])]
    public function index(CarRepository $carRepository): Response
    {
        return $this->render('back_office/car/index.html.twig', [
            'cars' => $carRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_car_new', methods: ['GET', 'POST'])]
    public function new(ImageCollectionRepository $ImageRepo, Request $request, CarRepository $carRepository, SluggerInterface $slugger): Response
    {
        $car = new Car();
        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $ImageFile = $form->get('images')->getData();
        //    dd($ImageFile->setClientOriginalName()) ;
            if ($ImageFile) {
                
                $CarName = $form->get('name')->getData();
                $originalFileName = pathinfo($CarName, PATHINFO_FILENAME);
                // transforme le nom du fichier en slug utilisable
                $safeFileName = $slugger->slug($originalFileName);

                $newFileName = $safeFileName.'-'.uniqid().'.'.$ImageFile->guessExtension();
                
                try{
                    $ImageFile->move(
                        //services.yaml sous parameters
                        $this->getParameter('image_directory'),
                        $newFileName
                    );
                }catch (FileException $e){
                    dd($e);
                }
                // ajout du slug à la table image collection
                // et liaison avec la voiture enregistré 
                $imageCollection = new ImageCollection;
                $imageCollection->setImageUrl($newFileName);
                $car->addImageCollection($imageCollection);
                
                $ImageRepo->save($imageCollection,true);
            }
            
            $carRepository->save($car, true);

            return $this->redirectToRoute('app_car_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back_office/car/new.html.twig', [
            'car' => $car,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_car_show', methods: ['GET'])]
    public function show(Car $car): Response
    {
        return $this->render('back_office/car/show.html.twig', [
            'car' => $car,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_car_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Car $car, CarRepository $carRepository): Response
    {
        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $carRepository->save($car, true);

            return $this->redirectToRoute('app_car_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back_office/car/edit.html.twig', [
            'car' => $car,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_car_delete', methods: ['POST'])]
    public function delete(Request $request, Car $car, CarRepository $carRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$car->getId(), $request->request->get('_token'))) {
            $carRepository->remove($car, true);
        }

        return $this->redirectToRoute('app_car_index', [], Response::HTTP_SEE_OTHER);
    }
}
