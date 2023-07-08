<?php

namespace App\Controller\BackOffice;

use App\Entity\Testimonials;
use App\Form\TestimonialsType;
use App\Repository\TestimonialsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/back-office/testimonials')]
class TestimonialsController extends AbstractController
{
    #[Route('/', name: 'app_testimonials_index', methods: ['GET'])]
    public function index(TestimonialsRepository $testimonialsRepository): Response
    {
        return $this->render('back_office/testimonials/index.html.twig', [
            'testimonials' => $testimonialsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_testimonials_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TestimonialsRepository $testimonialsRepository): Response
    {
        $testimonial = new Testimonials();
        $form = $this->createForm(TestimonialsType::class, $testimonial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $testimonialsRepository->save($testimonial, true);

            return $this->redirectToRoute('app_testimonials_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back_office/testimonials/new.html.twig', [
            'testimonial' => $testimonial,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_testimonials_show', methods: ['GET'])]
    public function show(Testimonials $testimonial): Response
    {
        return $this->render('back_office/testimonials/show.html.twig', [
            'testimonial' => $testimonial,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_testimonials_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Testimonials $testimonial, TestimonialsRepository $testimonialsRepository): Response
    {
        $form = $this->createForm(TestimonialsType::class, $testimonial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $testimonialsRepository->save($testimonial, true);

            return $this->redirectToRoute('app_testimonials_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back_office/testimonials/edit.html.twig', [
            'testimonial' => $testimonial,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_testimonials_delete', methods: ['POST'])]
    public function delete(Request $request, Testimonials $testimonial, TestimonialsRepository $testimonialsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$testimonial->getId(), $request->request->get('_token'))) {
            $testimonialsRepository->remove($testimonial, true);
        }

        return $this->redirectToRoute('app_testimonials_index', [], Response::HTTP_SEE_OTHER);
    }
}
