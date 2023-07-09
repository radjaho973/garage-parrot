<?php

namespace App\Controller\BackOffice;

use App\Entity\Services;
use App\Form\ServicesType;
use App\Repository\ServicesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('back-office/services')]
class ServicesController extends AbstractController
{
    #[Route('/', name: 'app_services_index', methods: ['GET'])]
    public function index(ServicesRepository $servicesRepository): Response
    {
        return $this->render('back_office/services/index.html.twig', [
            'services' => $servicesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_services_new', methods: ['GET', 'POST'])]
    public function new(SluggerInterface $slugger, Request $request, ServicesRepository $servicesRepository): Response
    {
        $service = new Services();
        $form = $this->createForm(ServicesType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ImageFile = $form->get('picture_src')->getData();
            if ($ImageFile) {
                    
                    $ServiceName = $form->get('name')->getData();
                    $originalFileName = pathinfo($ServiceName, PATHINFO_FILENAME);
                    // transforme le nom du fichier en slug utilisable
                    $safeFileName = $slugger->slug($originalFileName);
                    
                    $newFileName = $safeFileName.'-'.uniqid().'.'.$ImageFile->guessExtension();
                    
                    try{
                        $ImageFile->move(
                            //services.yaml sous parameters
                            $this->getParameter('service_directory'),
                            $newFileName
                        );
                        $service->setPictureSrc($newFileName);
                        
                    }catch (FileException $e){
                        dd($e);
                    }
                }
                
                $servicesRepository->save($service, true);

                return $this->redirectToRoute('app_services_index', [], Response::HTTP_SEE_OTHER);
            }
            
        return $this->renderForm('back_office/services/new.html.twig', [
            'service' => $service,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_services_show', methods: ['GET'])]
    public function show(Services $service): Response
    {
        return $this->render('back_office/services/show.html.twig', [
            'service' => $service,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_services_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Services $service, ServicesRepository $servicesRepository): Response
    {
        $form = $this->createForm(ServicesType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $servicesRepository->save($service, true);

            return $this->redirectToRoute('app_services_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back_office/services/edit.html.twig', [
            'service' => $service,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_services_delete', methods: ['POST'])]
    public function delete(Request $request, Services $service, ServicesRepository $servicesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$service->getId(), $request->request->get('_token'))) {
            $servicesRepository->remove($service, true);
        }

        return $this->redirectToRoute('app_services_index', [], Response::HTTP_SEE_OTHER);
    }
}
