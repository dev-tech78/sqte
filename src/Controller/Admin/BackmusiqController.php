<?php


namespace  App\Controller\Admin;

use App\Entity\Musique;
use App\Repository\MusiqueRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/ affichebackendaaaa')]
class BackmusiqController extends AbstractController
{

    #[Route('/', name: 'app_affichemusique')]
    public function index(MusiqueRepository $repos): Response
    {
        
      
      
        $ateliermao = $repos->findAll();
        
        return $this->render('admin/radio/emission.html.twig', [
            'ateliermao' =>  $ateliermao
        ]);
    }


    #[Route('/{id<\d+>}', name: 'app_detail')]
    public function emisson(Musique $musique  = null): Response
    {
       
       if(!$musique){
        $this->addFlash(type: 'error', message: "la personne d'id nexiste pas");
        return $this->redirectToRoute('ppp_detail');
       }
        return $this->render('admin/radio/atelier.html.twig', [
            'emissionRadio' => $musique,
        ]);
    }

}