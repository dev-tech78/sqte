<?php

namespace App\Controller;

use App\Entity\Musique;
use App\Repository\MusiqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



#[Route('/musique')]
class MusiqueController extends AbstractController
{
    #[Route('/', name: 'app_musique')]
    public function index(MusiqueRepository $repository): Response
    {
        $production = $repository->findBy(['categorieMusique' => '1'],['id' => 'DESC'], 1);
        $enregistrement = $repository->findBy(['categorieMusique' => '2'],['id' => 'DESC'], 1);
        return $this->render('musique/index.html.twig', [
            'production' => $production,
            'enregistrement' => $enregistrement
        ]);
    }

    #[Route('/musique/add/{slug}', name:'app_production')]
    public function production(Musique $production): Response
    {


if(!$production) {
    $this->addFlash(type:'error', message: "L'article demmandé est pas disponible dans cette page");
    return $this->redirectToRoute('production');
}
        return $this->render('musique/composition.html.twig', [
            'composistion' => $production,

        ]);
    
}

      #[Route('/musiqu/{slug}', name:'app_enregistrement')]
      public function enregistrement(Musique $enregistrement): Response
      {


if(!$enregistrement) {
    $this->addFlash(type:'error', message: "L'article demmandé est pas disponible dans cette page");
    return $this->redirectToRoute('production');
}
          return $this->render('musique/enregistrement.html.twig', [
              'enregistrement' => $enregistrement,

          ]);
      
      }
}
