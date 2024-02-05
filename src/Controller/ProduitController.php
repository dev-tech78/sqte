<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/produit', name: 'app_')]
class ProduitController extends AbstractController
{
    
    #[Route('/', name: 'index')]
    public function index(SessionInterface $session, ProduitRepository $repos)
    {
        $panier = $session->get('panier', []);

        // On initialise des variables
        $data = [];
        $totla = 0;

        foreach($panier as $id => $qunatite){
            $produit =  $repos->find($id);

            $data[] = [
                'produit' => $produit,
                'quantite' =>$qunatite
            ];

            $totla += $produit->getPrice() * $qunatite;
        }

        return $this->render('produit/index.html.twig', compact('data'));
    }
    
    
    
    #[Route('/add{id}', name: 'add')]
    public function add(Produit $produit, SessionInterface $session): Response
    {
        
        //On rècupère l'id de produit
        $id = $produit->getId();

        //On récupère le panier existant
        $panier = $session->get('panier', []);

        // On ajoute le produit dans le panier s'il n-y est pas encore
        // Sinon on incrémente sa quantité
        if(empty($panier[$id])){
            $panier[$id] = 1;
        }else{
            $panier[$id] ++;
        }

        $session->set('panier', $panier);

        //On redirige vers la page du panier
        return $this->redirectToRoute('app_index');

        // return $this->render('produit/index.html.twig', [
        //     'controller_name' => 'ProduitController',
        // ]);
    }


    #[Route('/remove{id}', name: 'remove')]
    public function remove(Produit $produit, SessionInterface $session): Response
    {
        
        //On rècupère l'id de produit
        $id = $produit->getId();

        //On récupère le panier existant
        $panier = $session->get('panier', []);

        // On retire le produit dans le panier s'il n-y  a qu'1 exmplaire 
        // Sinon on déncrémente sa quantité
        if(!empty($panier[$id])){

            if($panier[$id] > 1){
              $panier[$id] --;
         
        }else{
           unset($panier[$id]);
        }
    }
        $session->set('panier', $panier);

        //On redirige vers la page du panier
        return $this->redirectToRoute('app_index');

        // return $this->render('produit/index.html.twig', [
        //     'controller_name' => 'ProduitController',
        // ]);
    }

 




}
