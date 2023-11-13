<?php


namespace  App\Controller\Admin;

use App\Entity\Actualites;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/ affichebackendaaa')]
class BackactuController extends AbstractController
{

    #[Route('/', name: 'app_afficheactuaaa')]
    public function index(ManagerRegistry $doctrine): Response
    {
        
      
        $repository = $doctrine->getRepository(Actualites::class);
        $actu = $repository->findAll();
        
        return $this->render('admin/radio/emission.html.twig', [
            'emission' => $actu
        ]);
    }


    #[Route('/{id<\d+>}', name: 'app_detail')]
    public function emisson(Actualites $actu  = null): Response
    {
       
       if(!$actu){
        $this->addFlash(type: 'error', message: "la personne d'id nexiste pas");
        return $this->redirectToRoute('pp_detail');
       }
        return $this->render('admin/radio/atelier.html.twig', [
            'actu' => $actu,
        ]);
    }

}