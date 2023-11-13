<?php

namespace App\Controller;

use App\Entity\Actualites;
use App\Repository\ActualitesRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/actualites' , name: 'app_')]
class ActualitesController extends AbstractController
{
    #[Route('/{page?1}/{nbre?6}', name: 'actualites')]
    public function index(ActualitesRepository $repository,
     ManagerRegistry $doctrine, $page, $nbre): Response
    {
       
        $repository = $doctrine->getRepository(Actualites::class);
        $nbPersonne = $repository->count([]);
        $nbrePage =  ceil(num: $nbPersonne / $nbre);
        $article = $repository->findBy([], ['id' => 'DESC'], $nbre, offset:($page -1) * $nbre);
        return $this->render('actualites/index.html.twig', [
            'article' => $article,
            'isPaginated' => true,
            'nbrePage' =>$nbrePage,
            'page' => $page,
            'nbre' =>$nbre
        ]);
    }

    #[Route('/{id<\d+>}/{slug}', name: 'detail')]
    public function article(Actualites $actu = null ): Response
    {
        
        // if(! $actu){
        //     $this->addFlash(type: 'Error', message: "L'article n'existe pas ");
        //     return $this->redirectToRoute('detail');
       // }

       
       
       
       
       
        return $this->render('actualites/article.html.twig', [
            'article' => $actu,
          
        ]);
    }

    

    //  #[Route('/cherche/{title}', name: 'actualites')]
    //  public function findByArticle($title,
    //   ManagerRegistry $doctrine): Response
    //  {
    //      $repository = $doctrine->getRepository(Actualites::class);
    //      $actu = $repository->findByArticle($title);
    //      return $this->render('actualites/index.html.twig', [
    //          'article' => $actu,
          
    //      ]);

    // }


}
