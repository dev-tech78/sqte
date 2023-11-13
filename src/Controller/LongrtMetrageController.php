<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LongrtMetrageController extends AbstractController
{
    #[Route('/longrt/metrage', name: 'app_longrt_metrage')]
    public function index(): Response
    {
        return $this->render('longrt_metrage/index.html.twig', [
         
        ]);
    }

    #[Route('/longrt/metrage/one', name: 'app_OneLong_metrage')]
    public function LongMetrageOne(): Response
    {
        return $this->render('longrt_metrage/longmetragebyOne.html.twig', [
         
        ]);
    }
}
