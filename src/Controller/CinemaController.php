<?php

namespace App\Controller;


use App\Entity\Fiction;
use App\Repository\FictionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cinema')]
class CinemaController extends AbstractController
{
    #[Route('/', name: 'app_cinema')]
    public function index(FictionRepository $repos): Response
    {
       
        
        $longue = $repos->findBy( ['categoriFiction' => '1'], ['id' => 'desc'],1);
        $court = $repos->findBy(['categoriFiction' => '2'], ['id' => 'asc'],1);
        $serie = $repos->findBy( ['categoriFiction' => '3'], ['id' => 'asc'],1);
        return $this->render('cinema/index.html.twig', [
            'longue' => $longue,
            'court' => $court,
            'serie' => $serie
         ]);
    }

 //َaffichage  de fiction longumetrage
    #[Route('/cinema/long', name: 'app_long')]
    public function LongueMetrage(FictionRepository $repos): Response
    {
        
        $longue = $repos->findBy( ['categoriFiction' => '1'], ['id' => 'asc']);
        return $this->render('cinema/longue.html.twig', ['longue' => $longue ]);
    }
//َaffichage  de fiction longumetrage par one 
    #[Route('/cinema/{id<\d+>}', name: 'app_lbyone')]
    public function LongueMetrageByOne(Fiction $longue): Response
    {
        
       if(!$longue){
        $this->addFlash(type:'error', message: "Le film demmandé est pas disponible dans cette page");
        return $this->redirectToRoute('app_lbyone');
       }
        return $this->render('cinema/longue.html.twig', ['longue' => $longue ]);
    }



  
    #[Route('/cinema/court', name: 'app_court')]
    public function courMetrage(FictionRepository $repos): Response
    {
        
        $court = $repos->findBy( ['categoriFiction' => '2'], ['id' => 'asc'],1);
        return $this->render('cinema/court.html.twig', ['court' => $court ]);
    }
    #[Route('/cinema/{id<\d+>}/courtmetrage', name: 'app_court.lbyone')]
    public function CourtMetrageByOne(Fiction $court): Response
    {
        
       if(!$court){
        $this->addFlash(type:'error', message: "Le film demmandé est pas disponible dans cette page");
        return $this->redirectToRoute('app_lbyone');
       }
        return $this->render('cinema/longmetragebyOne.html.twig', ['longue' => $court ]);
    }

   


    #[Route('/cinema/serie', name: 'app_serie')]
    public function courtSerie(FictionRepository $repos): Response
    {
        
        $serie = $repos->findBy( ['categoriFiction' => '3'], ['id' => 'asc'],1);
        return $this->render('cinema/serie.html.twig', ['serie' => $serie ]);
    }
    #[Route('/cinema/{id<\d+>}/serie', name: 'app_serie.lbyone')]
    public function SeriegeByOne(Fiction $serie): Response
    {
        
       if(!$serie){
        $this->addFlash(type:'error', message: "Le film demmandé est pas disponible dans cette page");
        return $this->redirectToRoute('app_lbyone');
       }
        return $this->render('cinema/webserie.html.twig', ['longue' => $serie
    
    ]);
    }



        
    #[Route('/cinema/documentaire', name: 'app_documentaire')]
    public function documentaire(): Response
    {
        return $this->render('cinema/documentaire.html.twig', [ ]);
    }

    #[Route('/cinema/festivale', name: 'app_festivale')]
    public function festival(): Response
    {
        return $this->render('cinema/festival.html.twig', [ ]);
    }

    #[Route('/cinema/atelier', name: 'app_atelier')]
    public function telier(): Response
    {
        return $this->render('cinema/atelier.html.twig', [ ]);
    }
}
