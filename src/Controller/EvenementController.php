<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EvenementController extends AbstractController
{
    #[Route('/evenement', name: 'app_evenement')]
    public function index(): Response
    {
        return $this->render('evenement/index.html.twig', [
            'controller_name' => 'EvenementController',
        ]);
    }

    #[Route('/evenement/one', name: 'app_byonevenement')]
    public function evenmentByOne(): Response
    {
        return $this->render('evenement/evenement.html.twig', [
            'controller_name' => 'EvenementController',
        ]);
    }
}
