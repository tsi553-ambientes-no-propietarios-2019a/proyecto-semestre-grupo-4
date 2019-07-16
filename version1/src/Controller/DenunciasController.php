<?php

namespace App\Controller;

use App\Entity\Denuncias;
use App\Form\DenunciasType;
use App\Repository\DenunciasRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/denuncias")
 */
class DenunciasController extends AbstractController
{
    /**
     * @Route("/", name="denuncias_index", methods={"GET"})
     */
    public function index(DenunciasRepository $denunciasRepository): Response
    {
        return $this->render('denuncias/index.html.twig', [
            'denuncias' => $denunciasRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="denuncias_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $denuncia = new Denuncias();
        $form = $this->createForm(DenunciasType::class, $denuncia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($denuncia);
            $entityManager->flush();

            return $this->redirectToRoute('denuncias_index');
        }

        return $this->render('denuncias/new.html.twig', [
            'denuncia' => $denuncia,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="denuncias_show", methods={"GET"})
     */
    public function show(Denuncias $denuncia): Response
    {
        return $this->render('denuncias/show.html.twig', [
            'denuncia' => $denuncia,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="denuncias_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Denuncias $denuncia): Response
    {
        $form = $this->createForm(DenunciasType::class, $denuncia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('denuncias_index');
        }

        return $this->render('denuncias/edit.html.twig', [
            'denuncia' => $denuncia,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="denuncias_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Denuncias $denuncia): Response
    {
        if ($this->isCsrfTokenValid('delete'.$denuncia->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($denuncia);
            $entityManager->flush();
        }

        return $this->redirectToRoute('denuncias_index');
    }
}
