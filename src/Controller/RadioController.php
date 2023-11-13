<?php

namespace App\Controller;


use App\Entity\CategorieRadio;
use App\Repository\AtelierRepository;
use App\Repository\EmissionRadioRepository;
use App\Repository\CategorieRadioRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class RadioController extends AbstractController
{
    #[Route('/radio', name: 'app_radio')]
    public function index(CategorieRadioRepository $repo,
     AtelierRepository $repository, EmissionRadioRepository $repoRadio
    ): Response
    {
     
        return $this->render('radio/index.html.twig',
         [ 'repos' => $repo->findBy([], ['id' => 'asc']),
        'atelier' => $repository->findBy(['categorieAtelier' => '3']),
        'programme' => $repoRadio->findAll()
        
     ]);

    }

    #[Route('/radio/{nom}', name:'app_emession')]
    public function emssion(CategorieRadio $categorie, Request $request){
        
       
        $session = $request->getSession();
        if($session->has(name: 'nbFavorite')){
            $nbreFavorite = $session->get( name: 'nbFavorite') + 1;
        }else{
            $nbreFavorite = 1;

        }

        $session->set('nbFavorite', $nbreFavorite);
       
        $prodect = $categorie->getCatradio();
        return $this->render('radio/emission.html.twig', [ 
    'prodect' => $prodect ]);
    }



    #[Route('/radio/atelier/radio', name:'app_atelier')]
    public function AtlierRadio(AtelierRepository $repository){
        
       
        
        return $this->render('radio/atelier.html.twig', [ 
    'atelier' =>$repository->findBy(['categorieAtelier' => '3']) ]);
    }




   

    
}
