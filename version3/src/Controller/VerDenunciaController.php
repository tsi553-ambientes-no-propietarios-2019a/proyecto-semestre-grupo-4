<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Denuncias;

class VerDenunciaController extends AbstractController
{
    /**
     * @Route("/ver/denuncia", name="ver_denuncia")
     */
    public function index()
    {
        $denunciaRepository = $this ->getDoctrine()->getRepository(Denuncias::class);
        $denuncias = $denunciaRepository->findAll();
        
        return $this->render('ver_denuncia/index.html.twig', array('denuncias'=>$denuncias));
    }
}
