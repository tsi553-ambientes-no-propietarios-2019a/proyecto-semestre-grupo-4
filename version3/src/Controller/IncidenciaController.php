<?php

namespace App\Controller;

use App\Entity\Incidencia;
use App\Form\IncidenciaType;
use App\Repository\IncidenciaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/incidencia")
 */
class IncidenciaController extends AbstractController
{
    /**
     * @Route("/", name="incidencia_index", methods={"GET"})
     */
    public function index(IncidenciaRepository $incidenciaRepository): Response
    {
        return $this->render('incidencia/index.html.twig', [
            'incidencias' => $incidenciaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="incidencia_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $incidencium = new Incidencia();
        $form = $this->createForm(IncidenciaType::class, $incidencium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($incidencium);
            $entityManager->flush();

            return $this->redirectToRoute('incidencia_index');
        }

        return $this->render('incidencia/new.html.twig', [
            'incidencium' => $incidencium,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="incidencia_show", methods={"GET"})
     */
    public function show(Incidencia $incidencium): Response
    {
        return $this->render('incidencia/show.html.twig', [
            'incidencium' => $incidencium,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="incidencia_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Incidencia $incidencium): Response
    {
        $form = $this->createForm(IncidenciaType::class, $incidencium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('incidencia_index');
        }

        return $this->render('incidencia/edit.html.twig', [
            'incidencium' => $incidencium,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="incidencia_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Incidencia $incidencium): Response
    {
        if ($this->isCsrfTokenValid('delete'.$incidencium->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($incidencium);
            $entityManager->flush();
        }

        return $this->redirectToRoute('incidencia_index');
    }
}
