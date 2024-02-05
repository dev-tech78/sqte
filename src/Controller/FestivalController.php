<?php

namespace App\Controller;

use App\Entity\Festival;
use App\Repository\FestivalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/festival')]
class FestivalController extends AbstractController
{
    #[Route('/', name: 'festival')]
    public function index(FestivalRepository $repos): Response
    {
       
       
        $festival = $repos->findAll();
        return $this->render('festival/index.html.twig', [
            'festival' => $festival
          
        ]);
    }


    #[Route('/{id<\d+>}{slug}', name: 'app_byonefestival')]
    public function fistivalByOne( Festival $festival): Response
    {
        return $this->render('festival/festivalbyone.html.twig', [

            'festival' => $festival
          
        ]);
    }
}
