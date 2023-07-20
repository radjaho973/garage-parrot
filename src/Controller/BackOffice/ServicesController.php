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
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('back-office/admin/services')]
class ServicesController extends AbstractController
{
    #[Route('/', name: 'app_services_index', methods: ['GET'])]
    public function index(ServicesRepository $servicesRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('back_office/services/index.html.twig', [
            'services' => $servicesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_services_new', methods: ['GET', 'POST'])]
    public function new(SluggerInterface $slugger, Request $request, ServicesRepository $servicesRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $service = new Services();
        $form = $this->createForm(ServicesType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $ImageFile = $form->get('picture_src')->getData();
            
            if ($ImageFile) {
                    
                    $ServiceName = $form->get('name')->getData();
                    
                    $safeFileName = $slugger->slug($ServiceName);
                    
                    $newFileName = $safeFileName.'-'.uniqid().'.'.$ImageFile->guessExtension();
                    
                    try{
                        $ImageFile->move(
                            //services.yaml sous parameters
                            $this->getParameter('service_directory'),
                            $newFileName
                        );
                        $service->setpicture_src($newFileName);
                        
                    }catch (FileException $e){
                        return new $e(`Une erreur c'est produite durant
                        l'envoie de fichier`,400 );
                    }
                }else{
                    throw new FileException(`Une erreur c'est produite durant
                    l'envoie de fichier` ,400);
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
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('back_office/services/show.html.twig', [
            'service' => $service,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_services_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request,SluggerInterface $slugger, Services $service, ServicesRepository $servicesRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $form = $this->createForm(ServicesType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $ImageFile = $form->get('picture_src')->getData();
            
            // On remplace l'anciènne image  par la nouvelle si elle existe
            if ($ImageFile) {

                $ServiceName = $form->get('name')->getData();
                    
                    // transforme le nom du fichier en slug utilisable
                    $safeFileName = $slugger->slug($ServiceName);
                    
                    $newFileName = $safeFileName.'-'.uniqid().'.'.$ImageFile->guessExtension();
                    ;
                    
                    try{
                        $ImageFile->move(
                            //services.yaml sous parameters
                            $this->getParameter('service_directory'),
                            $newFileName
                        );
                        $service->setpicture_src($newFileName);
                        
                    }catch (FileException $e){
                        return new Response(`Une erreur c'est produite durant
                        l'envoie de fichier`,400 );
                    }
            }
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
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        if ($this->isCsrfTokenValid('delete'.$service->getId(), $request->request->get('_token'))) {
            $servicesRepository->remove($service, true);
        }

        return $this->redirectToRoute('app_services_index', [], Response::HTTP_SEE_OTHER);
    }
}
