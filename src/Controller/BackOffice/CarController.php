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
use App\Repository\ImageCollectionRepository;
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
        return $this->render('back_office/car/index.html.twig', [
            'cars' => $carRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_car_new', methods: ['GET', 'POST'])]
    public function new(EntityManagerInterface $em, Request $request, CarRepository $carRepository, SluggerInterface $slugger): Response
    {
        $car = new Car();

        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // correspond à CollectionType dans le formulaire
            $imageCollection = $form->get('image_collection');
            
            if ($imageCollection) {
                
                $CarName = $form->get('name')->getData();
                //pour chaque ImageCollectionType dans CollectionType
                //On récupère le FileType de ImageCollectionType
                foreach ($imageCollection as $imageInput) {
                    $uploadedImage = $imageInput->get('images')->getData();
                    
                    $originalFileName = pathinfo($CarName, PATHINFO_FILENAME);
                    // transforme le nom du fichier en slug utilisable
                    $safeFileName = $slugger->slug($originalFileName);
                    $newFileName = $safeFileName.'-'.uniqid().'.'.$uploadedImage->guessExtension();
                    
                    try{
                        $uploadedImage->move(
                            //services.yaml sous parameters
                            $this->getParameter('image_directory'),
                            $newFileName
                        );
                    }catch (FileException $e){
                        dd($e);
                    }
                    // ajout du slug à la table image collection
                    // et liaison avec la voiture enregistré 
                    $imageCollection = new ImageCollection();
                    $imageCollection->setImageUrl($newFileName);
                    $car->addImageCollection($imageCollection);
                    
                    $em->persist($imageCollection);
                }
            }
            
            $categoryName = $form->get('categorie')->getData();
            // dd($categoryName);
            $category = new Category();
            $category->setCategory($categoryName);
            $car->setCategory($category);
            
            $brandName = $form->get('Marque')->getData();
            
            $brand = new Brand();
            $brand->setBrand($brandName);
            $car->setBrand($brand);
            
            $em->persist($category);
            $em->persist($brand);
            $em->persist($car);
            $em->flush();
            

            return $this->redirectToRoute('back_office_app_car_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back_office/car/new.html.twig', [
            'car' => $car,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_car_show', methods: ['GET'])]
    public function show(Car $car, Request $request): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //do some stuff
        }

        return $this->render('back_office/car/show.html.twig', [
            'car' => $car,
            'form' => $form
        ]);
    }

    #[Route('/{id}/edit', name: 'app_car_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Car $car, CarRepository $carRepository): Response
    {
        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $carRepository->save($car, true);

            return $this->redirectToRoute('back_office_app_car_index', [], Response::HTTP_SEE_OTHER);
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

        return $this->redirectToRoute('back_office_app_car_index', [], Response::HTTP_SEE_OTHER);
    }
}
