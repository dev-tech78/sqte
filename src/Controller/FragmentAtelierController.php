<?php

namespace App\Controller;

use App\Repository\AtelierRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class FragmentAtelierController extends AbstractController
{
    #[Route('/fragment', name: 'fragment_atelier')]
    public function index(AtelierRepository $repository): Response
    {
        $atelierradio = $repository->findBy(['categorieAtelier' => '3'],['id' => 'DESC'], 1);
        $ateliercinema = $repository->findBy(['categorieAtelier' => '1'],['id' => 'DESC'], 1);
        $ateliermusique = $repository->findBy(['categorieAtelier' => '2'],['id' => 'DESC'], 1);

        return $this->render('fragment_atelier/index.html.twig', [
            'radio' =>  $atelierradio,
            'cinema' =>  $ateliercinema,
            'musique' => $ateliermusique
        ]);
    }


 

    

 
}
