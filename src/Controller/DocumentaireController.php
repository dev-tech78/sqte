<?php

namespace App\Controller;


use App\Repository\DocumentaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/documentaire')]
class DocumentaireController extends AbstractController
{
    #[Route('/', name: 'app_documentaire')]
    public function index(DocumentaireRepository $repos): Response
    {
        
      
        $doc = $repos->findAll();
      
        return $this->render('documentaire/index.html.twig', [
            'doc' => $doc,
            
         
        ]);
    }

    #[Route('/{id<\d+>}{slug}', name: 'app_doclong')]
    public function doclong(): Response
    {
        return $this->render('documentaire/doclonbyone.html.twig', [
         
        ]);
    }

    #[Route('/documentaire/courtmetrage', name: 'app_docourt')]
    public function docourt(): Response
    {
        return $this->render('documentaire/docurt.html.twig', [
         
        ]);
    }

    #[Route('/documentaire/evenement', name: 'app_evenement')]
    public function evenement(): Response
    {
        return $this->render('documentaire/evenement.html.twig', [
         
        ]);
    }


    #[Route('/documentaire/doclongone', name: 'app_byOneDoc')]
    public function doclongByOne(): Response
    {
        return $this->render('documentaire/doclonbyone.html.twig', [
         
        ]);
    }

    #[Route('/documentaire/docourtone', name: 'app_byOneDocurt')]
    public function docurtgByOne(): Response
    {
        return $this->render('documentaire/docurtbyone.html.twig', [
         
        ]);
    }

    #[Route('/documentaire/evenOne', name: 'app_byOnevenement')]
    public function evenementByOne(): Response
    {
        return $this->render('documentaire/evenementbyone.html.twig', [
         
        ]);
    }
}
