<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/info')]
class InfoController extends AbstractController
{
    #[Route('/', name: 'app_info')]
    public function index(): Response
    {
        
        return $this->render('info/index.html.twig', [
            'controller_name' => 'InfoController',
        ]);
    }

    #[Route('/vente', name: 'app_vent')]
    public function ConditionVente(): Response
    {
        
        return $this->render('info/cvent.html.twig', [
            'controller_name' => 'InfoController',
        ]);
    }
    #[Route('/mentio', name: 'app_mention')]
    public function MentionLegales(): Response
    {
        
        return $this->render('info/cvent.html.twig', [
            'controller_name' => 'InfoController',
        ]);
    }

  
}
