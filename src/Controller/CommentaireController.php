<?php

namespace App\Controller;

use App\Entity\Actualites;
use App\Entity\Commentaire;
use App\Form\ComentaireType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommentaireController extends AbstractController
{
    #[Route('/commentaire', name: 'app_commentaire')]
    public function index(
    Request $request, ManagerRegistry $entityManager  ): Response
    {
        $article = new Actualites();
        $commentaire = new Commentaire();
 
        $form = $this->createForm(ComentaireType::class, $commentaire);
        $form->handleRequest($request);
   
    if($form->isSubmitted() && $form->isValid()) {
        //$commentaire->setActualites($article);
        $anno = $entityManager->getManager();
        $anno->persist($commentaire);
        $anno->flush();
        
    }
      
    
        return $this->render('commentaire/index.html.twig', [
            'commentForm' => $form->createView()
        ]);
    }
}
