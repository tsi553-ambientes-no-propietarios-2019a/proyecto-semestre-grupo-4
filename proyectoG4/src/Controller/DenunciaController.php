<?php

namespace App\Controller;

use App\Entity\Denuncia;
use App\Form\DenunciaType;
use App\Repository\DenunciaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/denuncia")
 */
class DenunciaController extends AbstractController
{
    /**
     * @Route("/", name="denuncia_index", methods={"GET"})
     */
    public function index(DenunciaRepository $denunciaRepository): Response
    {
        return $this->render('denuncia/index.html.twig', [
            'denuncias' => $denunciaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="denuncia_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $denuncium = new Denuncia();
        $form = $this->createForm(DenunciaType::class, $denuncium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($denuncium);
            $entityManager->flush();

            return $this->redirectToRoute('denuncia_index');
        }

        return $this->render('denuncia/new.html.twig', [
            'denuncium' => $denuncium,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="denuncia_show", methods={"GET"})
     */
    public function show(Denuncia $denuncium): Response
    {
        return $this->render('denuncia/show.html.twig', [
            'denuncium' => $denuncium,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="denuncia_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Denuncia $denuncium): Response
    {
        $form = $this->createForm(DenunciaType::class, $denuncium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('denuncia_index', [
                'id' => $denuncium->getId(),
            ]);
        }

        return $this->render('denuncia/edit.html.twig', [
            'denuncium' => $denuncium,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="denuncia_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Denuncia $denuncium): Response
    {
        if ($this->isCsrfTokenValid('delete'.$denuncium->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($denuncium);
            $entityManager->flush();
        }

        return $this->redirectToRoute('denuncia_index');
    }
}
