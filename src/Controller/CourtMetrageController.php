<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CourtMetrageController extends AbstractController
{
    #[Route('/court/metrage', name: 'app_court_metrage')]
    public function index(): Response
    {
        return $this->render('court_metrage/index.html.twig', [
        ]);
    }


    #[Route('/court/metrage/One', name: 'app_byOnecourt_metrage')]
    public function CourtMatrageByOne(): Response
    {
        return $this->render('court_metrage/courtOne.html.twig', [
        ]);
    }
}
