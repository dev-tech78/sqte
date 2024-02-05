<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Actualites;
use App\Repository\ActualitesRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ActualitesRepository $repos,
     Request $request, ManagerRegistry $entityManager): Response
    {
       $article = $repos->findBy([], ['id'=>'desc'],3);
       
      
       if($request->request->count() > 0){
        $contact = new Contact();
        $contact->setNom($request->request->get('nom'))
            ->setTitle($request->request->get('title'))
            ->setEmail($request->request->get('email'))
            ->setNature($request->request->get('nature'))
            ->setContent($request->request->get('content'));
            $anno = $entityManager->getManager();
             $anno->persist($contact);
             $anno->flush();
             return $this->redirectToRoute('app_page');

       }



       
       
       
       
       return $this->render('home/index.html.twig', [
            'article' => $article,
        ]);
    }

    #[Route('/{id<\d+>}/{slug}', name: 'detail')]
    public function article(Actualites $article = null): Response
    {
        
        if(! $article){
            $this->addFlash(type: 'error' ,message: "L'article  ");
            return $this->redirectToRoute('detail');
        }
        return $this->render('actualites/article.html.twig', [
            'article' => $article,
        ]);
    }

    #[Route('/bienvenu', name: 'app_page')]
    public function bienvenu():Response
    {
        
        return $this->render('home/bienvenu.html.twig', [
           
        ]);
    }
    
}
