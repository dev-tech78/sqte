<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WebSerieController extends AbstractController
{
    #[Route('/web/serie', name: 'app_web_serie')]
    public function index(): Response
    {
        return $this->render('web_serie/index.html.twig', [
            'controller_name' => 'WebSerieController',
        ]);
    }


    #[Route('/web/serie/one', name: 'app_web_oneserie')]
    public function webserierByone(): Response
    {
        return $this->render('web_serie/webserie.html.twig', [
          
        ]);
    }
}
